package fr.free.r2i.fragments;

import android.app.Fragment;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.os.Bundle;
import android.os.Environment;
import android.support.annotation.Nullable;
import android.support.v4.view.PagerAdapter;
import android.support.v4.view.ViewPager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import fr.free.r2i.R;

/**
 * Created by rc2k on 03/05/16.
 */
public class VuePhotosFragment extends Fragment {

    private static final String pathDir = Environment.getExternalStorageDirectory() + "/workimages";
    private List<Bitmap> mImages;
    private LinearLayout thumbs;
    private ViewPager viewPager;
    private Bitmap imageBitmap;
    private String refChambre;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        mImages = getAllPhotosFromSDCard(pathDir);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View rootView = inflater.inflate(R.layout.fragment_vue_photos, container, false);

        viewPager = (ViewPager) rootView.findViewById(R.id.view_pager);
        ImagePagerAdapter adapter = new ImagePagerAdapter();
        viewPager.setAdapter(adapter);

        viewPager.setOnPageChangeListener(new ViewPager.SimpleOnPageChangeListener() {
            @Override
            public void onPageSelected(int position) {
                addMarker(position);
            }
        });

        thumbs = (LinearLayout)rootView.findViewById(R.id.thumbs);
        Bitmap imageBitmap = null;
        for(int i=0;i<mImages.size();i++) {
            imageBitmap = mImages.get(i);
            if(imageBitmap != null) {
                thumbs.addView(addThumb(imageBitmap,i));
            }
        }
        addMarker(0);
        return rootView;
    }

    private View addThumb(Bitmap imageBitmap,final int p) {
        ImageView imageView = new ImageView(getActivity().getApplicationContext());
        imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                viewPager.setCurrentItem(p);
            }
        });
        imageView.setImageBitmap(Bitmap.createScaledBitmap(imageBitmap, 100, 100, false));
        return imageView;
    }

    public void addMarker(int pos) {
        ImageView imageView=null;
        for(int j=0;j<thumbs.getChildCount();j++){
            imageView = (ImageView)thumbs.getChildAt(j);
            imageView.setPadding(10,10,10,10);
            if(imageView != null){
                if(j==pos){
                    imageView.setBackgroundColor(Color.rgb(201,77,77));
                }else {
                    imageView.setBackgroundColor(Color.WHITE);
                }
            }
        }
    }

    public void storeAndShowImage(Bitmap imageBitmap) {
        String partFilename = currentDateFormat();
        setImageBitmap(imageBitmap);
        storePhotoInSDCard(imageBitmap, partFilename);
        mImages.add(imageBitmap);
        thumbs.addView(addThumb(imageBitmap,mImages.size()));
        int pos = viewPager.getAdapter().getCount();
        addMarker(pos);
        viewPager.getAdapter().notifyDataSetChanged();
        viewPager.setCurrentItem(pos);
    }

    private String currentDateFormat() {
        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyyMMdd_HH_mm_ss");
        String  currentTimeStamp = dateFormat.format(new Date());
        return currentTimeStamp;
    }

    private void storePhotoInSDCard(Bitmap bitmap, String currentDate) {

        Bitmap bitmapSaved = Bitmap.createScaledBitmap(bitmap, 800, 760, false);
        File direct = new File(pathDir+"/"+refChambre);
        if (!direct.exists()) {
            File wallpaperDirectory = new File(pathDir+"/"+refChambre);
            wallpaperDirectory.mkdirs();
        }

        File outputFile = new File(pathDir+"/"+refChambre, currentDate + ".jpg");
        try {
            FileOutputStream fileOutputStream = new FileOutputStream(outputFile);
            bitmapSaved.compress(Bitmap.CompressFormat.JPEG, 100, fileOutputStream);
            fileOutputStream.flush();
            fileOutputStream.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private List<Bitmap> getAllPhotosFromSDCard(String pathDir) {
        List<Bitmap> images = new ArrayList<Bitmap>();

        File direct = new File(pathDir+"/"+refChambre);
        if (!direct.exists()) {
            File wallpaperDirectory = new File(pathDir+"/"+refChambre);
            wallpaperDirectory.mkdirs();
        }
        File[] files = direct.listFiles();
        Bitmap bitmap = null;
        if(files != null) {
            for (File file : files) {
                try {
                    FileInputStream fis = new FileInputStream(file);
                    bitmap = BitmapFactory.decodeStream(fis);
                    images.add(bitmap);
                } catch (FileNotFoundException e) {
                    e.printStackTrace();
                }
            }
        }
        return images;
    }

    private class ImagePagerAdapter extends PagerAdapter {

        @Override
        public int getCount() {
            return mImages.size();
        }

        @Override
        public boolean isViewFromObject(View view, Object object) {
            return view == ((ImageView) object);
        }

        @Override
        public Object instantiateItem(ViewGroup container, final int position) {
            Context context = getActivity();
            ImageView imageView = new ImageView(context);
            int padding = context.getResources().getDimensionPixelSize(
                    R.dimen.activity_horizontal_margin);
            imageView.setPadding(padding, padding, padding, padding);
            imageView.setScaleType(ImageView.ScaleType.CENTER_INSIDE);
            imageView.setImageBitmap(mImages.get(position));
            ((ViewPager) container).addView(imageView, 0);
            return imageView;
        }

        @Override
        public void destroyItem(ViewGroup container, int position, Object object) {
            ((ViewPager) container).removeView((ImageView) object);
        }
    }

    public Bitmap getImageBitmap() {
        return imageBitmap;
    }

    public void setImageBitmap(Bitmap imageBitmap) {
        this.imageBitmap = imageBitmap;
    }

    public String getRefChambre() {
        return refChambre;
    }

    public void setRefChambre(String refChambre) {
        this.refChambre = refChambre;
    }
}
