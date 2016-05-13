package fr.free.r2i.util;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.lang.reflect.Constructor;
import java.util.ArrayList;

/**
 * Created by z.ouftou 2016.
 */
public class JSONBuilderParser {

    public static <T> ArrayList<T> fromJSON(Class<T> clazz, String in) {
        JSONArray jsonObjects = stringToJSONArray(in);
        ArrayList<T> ots = new ArrayList<T>();
        for (int i = 0; i < jsonObjects.length(); i++) {
            try {
                Constructor<?> ctor = clazz.getConstructor(JSONObject.class);
                Object object = ctor.newInstance(jsonObjects.getJSONObject(i));
                ots.add((T)object);
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
        return ots;
    }

    public static JSONArray stringToJSONArray(String in){
        JSONArray objects =null;
        try{
            objects = new JSONArray(in);
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return objects;
    }
}
