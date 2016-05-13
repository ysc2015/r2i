package fr.free.r2i.model;

import org.json.JSONException;
import org.json.JSONObject;

/**
 * Created by zouftou on 4/3/16.
 */
public class OrdreTravail {

    private String otId;
    private String title;
    private String comment;
    private int status;
    private String submittedOn;
    private String chambres;

    public OrdreTravail(){
        //Lazy
    }
    public OrdreTravail(JSONObject object){
        try {
            this.otId = object.getString("otId");
            this.title = object.getString("title");
            this.submittedOn = object.getString("submittedOn");
            this.comment = object.getString("comment");
            this.chambres = object.getJSONArray("chambres").toString();
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    public String getOtId() {
        return otId;
    }

    public void setOtId(String otId) {
        this.otId = otId;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getComment() {
        return comment;
    }

    public void setComment(String comment) {
        this.comment = comment;
    }

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public String getSubmittedOn() {
        return submittedOn;
    }

    public void setSubmittedOn(String submittedOn) {
        this.submittedOn = submittedOn;
    }

    public String getChambres() {
        return chambres;
    }

    public void setChambres(String chambres) {
        this.chambres = chambres;
    }
}