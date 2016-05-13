package fr.free.r2i.activities;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;

import java.util.ArrayList;
import java.util.List;

import fr.free.r2i.R;
import fr.free.r2i.fragments.CartoFragment;
import fr.free.r2i.fragments.InfoFragment;
import fr.free.r2i.fragments.SynoFragment;

public class OrdreTravailDetailActivity extends AppCompatActivity {

    private String sChambres;
    private String title;
    private String comment;
    private String submittedOn;

    private ViewPager mViewPager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ordre_travail_detail);
        setTitle(R.string.activity_detail_ot_title);

        Intent i = getIntent();
        title=i.getStringExtra("title");
        comment=i.getStringExtra("comment");
        submittedOn=i.getStringExtra("submittedOn");
        sChambres = i.getStringExtra("chambres");

        mViewPager = (ViewPager) findViewById(R.id.container);
        setupViewPager(mViewPager);

        TabLayout tabLayout = (TabLayout) findViewById(R.id.tabs);
        tabLayout.setupWithViewPager(mViewPager);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                OrdreTravailDetailActivity.this.finish();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }

    private void setupViewPager(ViewPager viewPager) {
        SectionsPagerAdapter adapter = new SectionsPagerAdapter(getSupportFragmentManager());

        InfoFragment infoFragment = new InfoFragment();
        infoFragment.setOtitle(title);
        infoFragment.setComment(comment);
        infoFragment.setSubmittedOn(submittedOn);
        infoFragment.setChambres(sChambres);
        adapter.addFragment(infoFragment, "INFO");

        SynoFragment synoFragment = new SynoFragment();
        adapter.addFragment(synoFragment, "SYNOPTIQUE");

        CartoFragment cartoFragment = new CartoFragment();
        cartoFragment.setChambres(sChambres);
        adapter.addFragment(cartoFragment, "CARTO");

        viewPager.setAdapter(adapter);
    }

    class SectionsPagerAdapter extends FragmentPagerAdapter {

        private final List<Fragment> mFragmentList = new ArrayList<>();
        private final List<String> mFragmentTitleList = new ArrayList<>();

        public SectionsPagerAdapter(FragmentManager manager) {
            super(manager);
        }

        @Override
        public Fragment getItem(int position) {
            return mFragmentList.get(position);
        }

        @Override
        public int getCount() {
            return mFragmentList.size();
        }

        public void addFragment(Fragment fragment, String title) {
            mFragmentList.add(fragment);
            mFragmentTitleList.add(title);
        }

        @Override
        public CharSequence getPageTitle(int position) {
            return mFragmentTitleList.get(position);
        }
    }
}
