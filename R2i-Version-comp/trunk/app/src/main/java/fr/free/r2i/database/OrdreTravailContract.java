package fr.free.r2i.database;

import android.provider.BaseColumns;

/**
 * Created by rc2k on 06/04/16.
 */
public final class OrdreTravailContract {

    public OrdreTravailContract() {}

    public static abstract class OrdreEntry implements BaseColumns {
        public static final String TABLE_NAME = "ordres";
        public static final String COLUMN_NAME_ORDRE_ID = "otid";
        public static final String COLUMN_NAME_TITLE = "title";
        public static final String COLUMN_NAME_COMMENT = "comment";
    }
}
