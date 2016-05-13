package fr.free.r2i.activities;

import android.content.Context;
import android.content.Intent;
import android.media.AudioManager;
import android.media.MediaPlayer;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.Window;
import android.view.WindowManager;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.Toast;

import fr.free.r2i.R;
import fr.free.r2i.database.ADataBaseHelper;
import fr.free.r2i.util.HttpConnection;

public class SplashScreenActivity extends AppCompatActivity {

    private ADataBaseHelper mDbHelper;
    private MediaPlayer mPlayer;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().requestFeature(Window.FEATURE_ACTION_BAR);
        getSupportActionBar().hide();
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
                WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_splash_screen);
        mDbHelper = ADataBaseHelper.getInstance(this);
        new PrefetchData().execute();
        startAnimations();
    }

    private class PrefetchData extends AsyncTask<Void, Void, Void> {

        public String url = "http://telekom-ayooz.rhcloud.com/api/ordres";
        public String data = "";

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected Void doInBackground(Void... arg0) {
            try {
                HttpConnection http = new HttpConnection();
                data = http.readUrl(url);
            } catch (Exception e) {
                Log.d("Background Task", e.toString());
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void result) {
            super.onPostExecute(result);
            startPlayer(R.raw.beep);
            long delayMillis=2000;
            new Handler().postDelayed(new Runnable() {
                public void run() {
                    if(!data.equals("")) {
                        Toast.makeText(SplashScreenActivity.this, "Chargement des données:", Toast.LENGTH_SHORT).show();
                        Intent i = new Intent(SplashScreenActivity.this, OrdreTravailActivity.class);
                        i.putExtra("ordres", data);
                        startActivity(i);
                        finish();
                    }else{
                        Toast.makeText(SplashScreenActivity.this, "Problème de connexion au serveur !", Toast.LENGTH_SHORT).show();
                        finish();
                    }
                }
            }, delayMillis);
        }
    }

    private void startAnimations() {
        Animation anim = AnimationUtils.loadAnimation(this, R.anim.alpha);
        anim.reset();
        RelativeLayout rl=(RelativeLayout) findViewById(R.id.splash_lay);
        rl.clearAnimation();
        rl.startAnimation(anim);
        anim = AnimationUtils.loadAnimation(this, R.anim.translate);
        anim.reset();
        ImageView iv = (ImageView) findViewById(R.id.logo);
        iv.clearAnimation();
        iv.startAnimation(anim);
    }

    public void startPlayer(int i) {
        mPlayer = MediaPlayer.create(this, i);
        AudioManager am = (AudioManager) this.getSystemService(Context.AUDIO_SERVICE);
        switch (am.getRingerMode()) {
            case AudioManager.STREAM_MUSIC:
                mPlayer.setVolume(0,1);
                break;
        }
        //mPlayer.start();
    }

    public void pausePlayer () {
        if ( mPlayer != null){
            mPlayer.pause();
            mPlayer.stop();
        }
    }
}
