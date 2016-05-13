package fr.free.r2i.fragments;

import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.InflateException;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.PolylineOptions;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import fr.free.r2i.R;
import fr.free.r2i.model.Chambre;
import fr.free.r2i.util.HttpConnection;
import fr.free.r2i.util.JSONBuilderParser;
import fr.free.r2i.util.PathJSONParser;

/**
 * Created by zouftou on 4/3/16.
 */
public class CartoFragment extends Fragment implements OnMapReadyCallback {

    public String chambres;
    private static View mapView;
    private GoogleMap mMap;
    private ArrayList<LatLng> positions;

    public CartoFragment() {
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        if (mapView != null) {
            ViewGroup parent = (ViewGroup) mapView.getParent();
            if (parent != null)
                parent.removeView(mapView);
        }
        try {
            mapView = inflater.inflate(R.layout.fragment_carto, container, false);
        } catch (InflateException e) {
            Log.i("PROBLEM", "MAP VIEW CAN LOADED");
        }

        SupportMapFragment mapFragment = (SupportMapFragment) getChildFragmentManager()
                .findFragmentById(R.id.mapCarto);
        mMap = mapFragment.getMap();

        MarkerOptions options = new MarkerOptions();
        for(LatLng latLng: positions) {
            options.position(latLng);
        }
        mMap.addMarker(options);

        String url = getMapsApiDirectionsUrl();
        ReadTask downloadTask = new ReadTask();
        downloadTask.execute(url);

        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(positions.get(0), 13));
        addMarkers();

        return mapView;
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;
    }

    private String getMapsApiDirectionsUrl() {
        String origin="origin="+ positions.get(0).latitude + "," + positions.get(0).longitude + "&";
        String destination="destination="+ positions.get(positions.size()-1).latitude + "," + positions.get(positions.size()-1).longitude +"&" ;

        String waypoints = "waypoints=optimize:true|";
        int size = positions.size();
        for(int i=1;i<size-1;i++){
            waypoints += positions.get(i).latitude + "," + positions.get(i).longitude;
            if(i<size - 2){
                waypoints+= "|";
            }
        }

        String sensor = "sensor=false";
        String params = origin + destination + waypoints + "&" + sensor;
        String output = "json";
        String url = "https://maps.googleapis.com/maps/api/directions/"
                + output + "?" + params;
        return url;
    }

    private void addMarkers() {
        if (mMap != null) {
            for(LatLng latLng: positions){
                mMap.addMarker(new MarkerOptions().position(latLng)
                        .title("Chambre "));
            }
        }
    }

    private class ReadTask extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... url) {
            String data = "";
            try {
                HttpConnection http = new HttpConnection();
                data = http.readUrl(url[0]);
            } catch (Exception e) {
                Log.d("Background Task", e.toString());
            }
            return data;
        }

        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);
            new ParserTask().execute(result);
        }
    }

    private class ParserTask extends
            AsyncTask<String, Integer, List<List<HashMap<String, String>>>> {

        @Override
        protected List<List<HashMap<String, String>>> doInBackground(
                String... jsonData) {

            JSONObject jObject;
            List<List<HashMap<String, String>>> routes = null;

            try {
                jObject = new JSONObject(jsonData[0]);
                PathJSONParser parser = new PathJSONParser();
                routes = parser.parse(jObject);
            } catch (Exception e) {
                e.printStackTrace();
            }
            return routes;
        }

        @Override
        protected void onPostExecute(List<List<HashMap<String, String>>> routes) {
            ArrayList<LatLng> points = null;
            PolylineOptions polyLineOptions = null;

            // traversing through routes
            for (int i = 0; i < routes.size(); i++) {
                points = new ArrayList<LatLng>();
                polyLineOptions = new PolylineOptions();
                List<HashMap<String, String>> path = routes.get(i);

                for (int j = 0; j < path.size(); j++) {
                    HashMap<String, String> point = path.get(j);

                    double lat = Double.parseDouble(point.get("lat"));
                    double lng = Double.parseDouble(point.get("lng"));
                    LatLng position = new LatLng(lat, lng);

                    points.add(position);
                }

                polyLineOptions.addAll(points);
                polyLineOptions.width(5);
                polyLineOptions.color(Color.BLUE);
            }

            mMap.addPolyline(polyLineOptions);
        }
    }

    public String getChambres() {
        return chambres;
    }

    public void setChambres(String chambres) {
        this.chambres = chambres;
        this.positions = new ArrayList<LatLng>();
        if(chambres != null){
            ArrayList<Chambre> chs = JSONBuilderParser.fromJSON(Chambre.class, chambres);
            for (Chambre c : chs) {
                this.positions.add(c.getLatLong());
            }
        }
    }
}