package fr.free.r2i.database;

import android.provider.BaseColumns;

/**
 * Created by rc2k on 11/04/16.
 */
public class ChambreContract {

    public ChambreContract(){}

    public static abstract class ChambreEntry implements BaseColumns {
        public static final String TABLE_NAME = "chambres";
        public static final String COLUMN_NAME_CHAMBRE_REF = "ref";
        public static final String COLUMN_NAME_DATE_CREATION = "datec";
    }
}
