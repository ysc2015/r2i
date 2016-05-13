package fr.free.r2i.fragments;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;

import fr.free.r2i.R;
import fr.free.r2i.activities.ChambreDetailActivity;
import fr.free.r2i.activities.MapsActivity;
import fr.free.r2i.adapters.ChambresAdapter;
import fr.free.r2i.model.Chambre;
import fr.free.r2i.util.JSONBuilderParser;
import fr.free.r2i.views.DividerItemDecoration;

public class InfoFragment extends Fragment {

    private RecyclerView mRecyclerView;
    private ChambresAdapter mAdapter;
    private ArrayList<Chambre> mChambres;

    public static String chambres;
    public String otitle;
    public String comment;
    public String submittedOn;

    public InfoFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View rootView = inflater.inflate(R.layout.fragment_info, container, false);
        TextView titleView = (TextView) rootView.findViewById(R.id.detail_title);
        TextView commentView = (TextView) rootView.findViewById(R.id.detail_comment);
        TextView submittedOnView = (TextView) rootView.findViewById(R.id.detail_submittedOn);

        mChambres = JSONBuilderParser.fromJSON(Chambre.class, chambres);
        TextView nmbrChambres = (TextView) rootView.findViewById(R.id.nmbr_chambres);
        nmbrChambres.setText("" + mChambres.size());

        ProgressBar progressBar = (ProgressBar) rootView.findViewById(R.id.chTraite);
        progressBar.setVisibility(View.VISIBLE);
        progressBar.setMax(100);

        TextView totalChView = (TextView) rootView.findViewById(R.id.totalChmbres);
        totalChView.setText(""+mChambres.size());
        int count = 0;
        for(Chambre c: mChambres){
            if(c.getIsTraitee()){
                count++;
            }
        }
        TextView ChmbrsTraitees = (TextView) rootView.findViewById(R.id.ChmbresTraitees);
        ChmbrsTraitees.setText(""+count);

        int percent = (count*100)/mChambres.size();
        progressBar.setProgress(percent);

        TextView percentView = (TextView) rootView.findViewById(R.id.prgrsPercent);
        percentView.setText(percent+"%");

        titleView.setText("Titre : "+otitle);
        commentView.setText("Type : "+comment);
        submittedOnView.setText("Horodatage : "+submittedOn);

        mRecyclerView = (RecyclerView) rootView.findViewById(R.id.rvChambres);

        mAdapter = new ChambresAdapter(mChambres);
        mAdapter.setOnItemClickListener(new ChambresAdapter.OnItemClickListener() {
            @Override
            public void onItemClick(View view, int position) {
                Chambre chambre = mChambres.get(position);
                Toast.makeText(getActivity(), chambre.getRefChambre() + " was clicked!", Toast.LENGTH_SHORT).show();
                Intent i = new Intent(getActivity(), ChambreDetailActivity.class);
                i.putExtra("refChambre", chambre.getRefChambre());
                i.putExtra("typeChambre", chambre.getTypeChambre());
                i.putExtra("ville", chambre.getVille());
                i.putExtra("latitude", chambre.getLatitude());
                i.putExtra("longitude", chambre.getLongitude());
                startActivity(i);
            }
        });

        mAdapter.setOnMapsClickListener(new ChambresAdapter.OnMapsClickListener() {
            @Override
            public void onMapsClick(Button btnMaps, int position) {
                Chambre chambre = mChambres.get(position);
                Toast.makeText(getActivity(), chambre.getRefChambre() + " was clicked!", Toast.LENGTH_SHORT).show();
                Intent i = new Intent(getActivity(), MapsActivity.class);
                i.putExtra("latitude", chambre.getLatitude());
                i.putExtra("longitude", chambre.getLongitude());
                startActivity(i);
            }
        });

        mRecyclerView.setAdapter(mAdapter);
        mRecyclerView.setLayoutManager(new LinearLayoutManager(getActivity()));
        RecyclerView.ItemDecoration itemDecoration = new
                DividerItemDecoration(getActivity(), DividerItemDecoration.VERTICAL_LIST);
        mRecyclerView.addItemDecoration(itemDecoration);

        return rootView;
    }

    public String getChambres() {
        return chambres;
    }

    public void setChambres(String chambres) {
        this.chambres = chambres;
    }

    public String getOtitle() {
        return otitle;
    }

    public void setOtitle(String otitle) {
        this.otitle = otitle;
    }

    public String getComment() {
        return comment;
    }

    public void setComment(String comment) {
        this.comment = comment;
    }

    public String getSubmittedOn() {
        return submittedOn;
    }

    public void setSubmittedOn(String submittedOn) {
        this.submittedOn = submittedOn;
    }
}