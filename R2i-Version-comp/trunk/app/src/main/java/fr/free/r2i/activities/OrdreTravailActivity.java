package fr.free.r2i.activities;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.view.MenuItemCompat;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.SearchView;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

import fr.free.r2i.R;
import fr.free.r2i.adapters.OrdresAdapter;
import fr.free.r2i.model.OrdreTravail;
import fr.free.r2i.util.HttpConnection;
import fr.free.r2i.util.JSONBuilderParser;
import fr.free.r2i.views.DividerItemDecoration;

public class OrdreTravailActivity extends AppCompatActivity implements SearchView.OnQueryTextListener,SearchView.OnCloseListener {

    private RecyclerView mRecyclerView;
    private SwipeRefreshLayout mSwipeContainer;
    private OrdresAdapter mAdapter;
    ArrayList<OrdreTravail> mOrdres;
    private String sOrdres;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ordre_travail);
        setTitle(R.string.activity_ot_title);
        Intent i = getIntent();
        sOrdres = i.getStringExtra("ordres");
        mRecyclerView = (RecyclerView) findViewById(R.id.rvOT);
        if(!"".equals(sOrdres)) {
            Log.d("TEEEEEEEEEEEEEEEEST", "  "+sOrdres);
            mOrdres = JSONBuilderParser.fromJSON(OrdreTravail.class, sOrdres);
        }
        mAdapter = new OrdresAdapter(mOrdres);
        mAdapter.setOnItemClickListener(new OrdresAdapter.OnItemClickListener() {
            @Override
            public void onItemClick(View view, int position) {
                OrdreTravail ot = mOrdres.get(position);
                Toast.makeText(OrdreTravailActivity.this, ot.getTitle(), Toast.LENGTH_SHORT).show();
                Intent i = new Intent(OrdreTravailActivity.this, OrdreTravailDetailActivity.class);
                i.putExtra("title", ot.getTitle());
                i.putExtra("comment", ot.getComment());
                i.putExtra("submittedOn", ot.getSubmittedOn());
                i.putExtra("chambres", ot.getChambres());
                startActivity(i);
            }
        });
        mRecyclerView.setAdapter(mAdapter);
        mRecyclerView.setLayoutManager(new LinearLayoutManager(this));
        RecyclerView.ItemDecoration itemDecoration = new
                DividerItemDecoration(this, DividerItemDecoration.VERTICAL_LIST);
        mRecyclerView.addItemDecoration(itemDecoration);

        mSwipeContainer = (SwipeRefreshLayout) findViewById(R.id.swipeContainer);
        mSwipeContainer.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                fetchOrdresAsync();
            }
        });

        mSwipeContainer.setColorSchemeResources(android.R.color.holo_blue_bright,
                android.R.color.holo_green_light,
                android.R.color.holo_orange_light,
                android.R.color.holo_red_light);
    }

    private void fetchOrdresAsync() {
        new PrefetchData().execute();

        mAdapter.clear();
        mAdapter.addAll(JSONBuilderParser.fromJSON(OrdreTravail.class,sOrdres));
        mSwipeContainer.setRefreshing(false);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_main, menu);
        final MenuItem item = menu.findItem(R.id.action_search);
        final SearchView searchView = (SearchView) MenuItemCompat.getActionView(item);
        searchView.setOnQueryTextListener(this);
        return true;
    }

    @Override
    public boolean onQueryTextChange(String query) {
        if(query != "") {
            final List<OrdreTravail> filteredOrdreList = filter(JSONBuilderParser.fromJSON(OrdreTravail.class,sOrdres), query);
            mAdapter.animateTo(filteredOrdreList);
            mRecyclerView.scrollToPosition(0);
        }else{
            mAdapter.animateTo(mOrdres);
            mRecyclerView.scrollToPosition(0);
        }
        return true;
    }

    @Override
    public boolean onQueryTextSubmit(String query) {
        return false;
    }

    private List<OrdreTravail> filter(List<OrdreTravail> ordres, String query) {
        query = query.toLowerCase();
        final List<OrdreTravail> filteredOrdreList = new ArrayList<>();
        for (OrdreTravail ot : ordres) {
            final String text = ot.getTitle().toLowerCase();
            if (text.contains(query)) {
                filteredOrdreList.add(ot);
            }
        }
        return filteredOrdreList;
    }

    @Override
    public boolean onClose() {
        return true;
    }

    private class PrefetchData extends AsyncTask<Void, Void, Void> {

        public String url = "http://telekom-ayooz.rhcloud.com/api/ordres";

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected Void doInBackground(Void... arg0) {
            try {
                HttpConnection http = new HttpConnection();
                sOrdres = http.readUrl(url);
            } catch (Exception e) {
                Log.d("Background Task", e.toString());
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void result) {
            super.onPostExecute(result);
        }

    }
}