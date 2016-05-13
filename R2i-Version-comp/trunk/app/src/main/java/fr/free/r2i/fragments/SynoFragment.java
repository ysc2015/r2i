package fr.free.r2i.fragments;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.webkit.WebView;

import fr.free.r2i.R;

public class SynoFragment extends Fragment {

    private String synoptique;
    private WebView webView;

    public SynoFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_vue_syno, container, false);
        webView = (WebView) rootView.findViewById(R.id.webview);
        loadSyno();
        return rootView;
    }

    public void loadSyno(){
        synoptique = "<svg id='MainSvg' preserveAspectRatio='xMinYMin' viewBox='0 0 7260 8530' xmlns='http://www.w3.org/2000/svg' width='7260' height='8530' > <g id = 'b_116' class = 'boitier' feature = 'boitier:116' onclick='click_element(evt);' ><title>NRO</title><rect stroke-dasharray='5, 5' x='10' y='30' width='200' height='40' fill='red' rx='5' ry='5'></rect><text text-anchor='middle' x='110' y='45' font-family='Verdana' font-size='12' fill='blue' >NRO_NULL_NULL</text><text text-anchor='middle' x='110' y='60' font-family='Verdana' font-size='12' fill='blue' >NULL_NULL</text> <g id = 'c_3' class = 'cable' feature = 'cable:3' onclick='click_element(evt);'><title>CTR_NULL_04_01</title><polyline stroke-dasharray='5, 5' points= '210,50 290,50 450,50' stroke='rgb(255,0,0)' stroke-width='1' fill='none'/><text x='293' y='48' font-family='Verdana' font-size='10' fill='blue'>CTR_NULL_04_01</text><text x='293' y='60' font-family='Verdana' font-size='10' fill='blue'>288_142_330.53</text></g> <g  id = 'b_110' class = 'boitier' feature = 'boitier:110' onclick='click_element(evt);'><title>PEC_NULL_04001</title><rect  stroke-dasharray='5, 5' x='450' y='30' width='200' height='40' fill='white' stroke-width='1' stroke='rgb(0,0,0)' rx='5' ry='5'></rect><text text-anchor='middle' x='550' y='45' font-family='Verdana' font-size='11' fill='blue'>PEC_NULL_04001</text><text text-anchor='middle' x='550' y='60' font-family='Verdana' font-size='11' fill='blue'>GCO2FR6288T1FR11_142</text></g></svg>";
        webView.loadData(synoptique, "text/html", null);
    }

    public String getSynoptique() {
        return synoptique;
    }

    public void setSynoptique(String synoptique) {
        this.synoptique = synoptique;
    }
 
}