package fr.free.r2i.model;

import com.google.android.gms.maps.model.LatLng;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by zouftou on 3/24/16.
 */
public class Chambre {

    private String refChambre;
    private String typeChambre;
    private Boolean isTraitee;
    private String ville;
    private String latitude;
    private String longitude;

    public Chambre(JSONObject object){
        try {
            this.refChambre = object.getString("refChambre");
            this.typeChambre = object.getString("typeChambre");
            this.ville = object.getString("ville");
            this.latitude = object.getString("latitude");
            this.longitude = object.getString("longitude");
            this.isTraitee = object.getBoolean("traitee");
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public String getRefChambre() {
        return refChambre;
    }

    public void setRefChambre(String refChambre) {
        this.refChambre = refChambre;
    }

    public String getTypeChambre() {
        return typeChambre;
    }

    public void setTypeChambre(String typeChambre) {
        this.typeChambre = typeChambre;
    }

    public String getVille() {
        return ville;
    }

    public void setVille(String ville) {
        this.ville = ville;
    }

    public Boolean getIsTraitee() { return isTraitee;}

    public void setIsTraitee(Boolean isTraitee) {
        this.isTraitee = isTraitee;
    }

    public String getLatitude() {
        return latitude;
    }

    public void setLatitude(String latitude) {
        this.latitude = latitude;
    }

    public String getLongitude() {
        return longitude;
    }

    public void setLongitude(String longitude) {
        this.longitude = longitude;
    }

    public LatLng getLatLong(){
        return new LatLng(Double.parseDouble(this.latitude),Double.parseDouble(this.longitude));
    }
}