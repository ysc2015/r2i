package fr.free.r2i.database;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import java.util.ArrayList;

import fr.free.r2i.model.OrdreTravail;

/**
 * Created by rc2k on 06/04/16.
 */
public class ADataBaseHelper extends SQLiteOpenHelper{

    private static final String TAG = "ADataBaseHelper";

    private static ADataBaseHelper sInstance;

    public static final int DATABASE_VERSION = 1;
    public static final String DATABASE_NAME = "r2i";

    private static final String TEXT_TYPE = " TEXT";
    private static final String COMMA_SEP = ",";

    public static final String COLUMN_NAME_NULLABLE = "";

    private static final String SQL_CREATE_ENTRIES =
            "CREATE TABLE IF NOT EXISTS " + OrdreTravailContract.OrdreEntry.TABLE_NAME + " (" +
                    OrdreTravailContract.OrdreEntry._ID + " INTEGER PRIMARY KEY," +
                    OrdreTravailContract.OrdreEntry.COLUMN_NAME_ORDRE_ID + TEXT_TYPE + COMMA_SEP +
                    OrdreTravailContract.OrdreEntry.COLUMN_NAME_TITLE + TEXT_TYPE + COMMA_SEP +
                    OrdreTravailContract.OrdreEntry.COLUMN_NAME_COMMENT + TEXT_TYPE + " )";

    private static final String SQL_DELETE_ENTRIES =
            "DROP TABLE IF EXISTS " + OrdreTravailContract.OrdreEntry.TABLE_NAME;

    public static synchronized ADataBaseHelper getInstance(Context context) {
        if (sInstance == null) {
            sInstance = new ADataBaseHelper(context.getApplicationContext());
        }
        return sInstance;
    }

    private ADataBaseHelper(Context context) {
        super(context, DATABASE_NAME, null, DATABASE_VERSION);
    }

    public long insertOT(OrdreTravail ot) {
        SQLiteDatabase db = this.getWritableDatabase();

        ContentValues values = new ContentValues();
        values.put(OrdreTravailContract.OrdreEntry.COLUMN_NAME_ORDRE_ID, ot.getOtId());
        values.put(OrdreTravailContract.OrdreEntry.COLUMN_NAME_TITLE, ot.getTitle());
        values.put(OrdreTravailContract.OrdreEntry.COLUMN_NAME_COMMENT, ot.getComment());


        long newRowId = db.insert(
                OrdreTravailContract.OrdreEntry.TABLE_NAME, COLUMN_NAME_NULLABLE,values);

        return newRowId;
    }

    public ArrayList<OrdreTravail> getAllOrdres() {
        ArrayList<OrdreTravail> listOrdres = new ArrayList<OrdreTravail>();
        String ORDRES_SELECT_QUERY =
                String.format("SELECT * FROM %s", OrdreTravailContract.OrdreEntry.TABLE_NAME);

        SQLiteDatabase db = getReadableDatabase();
        Cursor cursor = db.rawQuery(ORDRES_SELECT_QUERY, null);
        try {
            if (cursor.moveToFirst()) {
                do {
                    OrdreTravail ot = new OrdreTravail();
                    ot.setOtId(cursor.getString(cursor.getColumnIndex(OrdreTravailContract.OrdreEntry.COLUMN_NAME_ORDRE_ID)));
                    ot.setTitle(cursor.getString(cursor.getColumnIndex(OrdreTravailContract.OrdreEntry.COLUMN_NAME_TITLE)));
                    ot.setComment(cursor.getString(cursor.getColumnIndex(OrdreTravailContract.OrdreEntry.COLUMN_NAME_COMMENT)));
                    listOrdres.add(ot);
                } while(cursor.moveToNext());
            }
        } catch (Exception e) {
            Log.d(TAG, "Error while trying to get orders from database");
        } finally {
            if (cursor != null && !cursor.isClosed()) {
                cursor.close();
            }
        }
        return listOrdres;
    }

    @Override
    public void onConfigure(SQLiteDatabase db) {
        super.onConfigure(db);
        db.setForeignKeyConstraintsEnabled(true);
    }

    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(SQL_DELETE_ENTRIES);
        db.execSQL(SQL_CREATE_ENTRIES);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL(SQL_DELETE_ENTRIES);
        onCreate(db);
    }

    public void onDowngrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        onUpgrade(db, oldVersion, newVersion);
    }

}
