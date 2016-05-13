package fr.free.r2i.fragments;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

import fr.free.r2i.R;
import r2i.free.r2k.pointblqdao.db.DaoMaster;
import r2i.free.r2k.pointblqdao.db.DaoSession;
import r2i.free.r2k.pointblqdao.db.Info;
import r2i.free.r2k.pointblqdao.db.InfoDao;

/**
 * Created by rc2k on 05/05/16.
 */
public class PBGeneralInfosFragment extends Fragment {
    EditText date,heure,user,entre,resp,adr,ref;
    Button save1;
    int  natTrvx,enviro;
    Info info;
    InfoDao infoDao;
    DaoSession mSession;
    DaoMaster daoMaster;
    SQLiteDatabase db;
 public  static   boolean swipping1=false;
    CheckBox checkaigui,checktirage,checkracco,checkmesu,checkvoirie,checkimmeub,checksite;
    public PBGeneralInfosFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View rootView = inflater.inflate(R.layout.fragment_pb_general_infos, container, false);
        date=(EditText)rootView.findViewById(R.id.editDate);
        heure=(EditText)rootView.findViewById(R.id.editHeur);
        user=(EditText)rootView.findViewById(R.id.editUser);
        entre=(EditText)rootView.findViewById(R.id.editEntrep);
        resp=(EditText)rootView.findViewById(R.id.editResp);
        adr=(EditText)rootView.findViewById(R.id.editAdr);
        ref=(EditText)rootView.findViewById(R.id.editref);
        //checkBox
        checkaigui=(CheckBox)rootView.findViewById(R.id.checkaigui);
        checktirage=(CheckBox)rootView.findViewById(R.id.checkTirage);
        checkracco=(CheckBox)rootView.findViewById(R.id.checkraccor);
        checkmesu=(CheckBox)rootView.findViewById(R.id.checkmesu);
        checkvoirie=(CheckBox)rootView.findViewById(R.id.checkvoirie);
        checkimmeub=(CheckBox)rootView.findViewById(R.id.checkimmeub);
        checksite=(CheckBox)rootView.findViewById(R.id.checksite);
        natTrvx=0;
        enviro=0;
        DaoMaster.DevOpenHelper helper=  new DaoMaster.DevOpenHelper(getActivity(), "dbPointBlq", null);
        db = helper.getWritableDatabase();
        daoMaster = new DaoMaster(db);
        mSession = daoMaster.newSession();
        infoDao= mSession.getInfoDao();

        FloatingActionButton fab = (FloatingActionButton)rootView.findViewById(R.id.save1);

        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
               /* Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();*/
                 save();
            }
        });

        return rootView;
    }
    private Date ConvertToDate(String dateString){
        SimpleDateFormat dateFormat = new SimpleDateFormat("MM/dd/yyyy hh:mm:ss aa");
        Date convertedDate = new Date();
        try {
            convertedDate = dateFormat.parse(dateString);
        } catch (ParseException e) {

            e.printStackTrace();
        }
        return convertedDate;
    }
    public void save(){
        if(checkaigui.isChecked())
        {
            natTrvx=1;
        }
        if(checktirage.isChecked())
        {
            natTrvx=2;
        }
        if(checkracco.isChecked()){
            natTrvx=3;
        }

        if(checkmesu.isChecked())
        {
            enviro=1;
        }
        if(checkvoirie.isChecked())
        {
            enviro=2;
        }
        if(checkimmeub.isChecked()){
            enviro=3;
        }
        if(checksite.isChecked()){
            enviro=4;
        }

        if(date.getText().toString()=="" || user.getText().toString()=="" || entre.getText().toString()==""||
                resp.getText().toString()=="" || adr.getText().toString()== "" || adr.getText().toString()=="" ||
                ref.getText().toString()==""|| natTrvx==0 || enviro==0 )
        {


            Context context=getActivity();
            LayoutInflater inflater= getLayoutInflater(Bundle.EMPTY);

            View customToastroot =inflater.inflate(R.layout.mytoast, null);

            Toast customtoast=new Toast(context);

            customtoast.setView(customToastroot);
            customtoast.setGravity(Gravity.CENTER_HORIZONTAL | Gravity.CENTER_VERTICAL,0, 0);
            customtoast.setDuration(Toast.LENGTH_LONG);
            customtoast.show();
            return;
        }
        else{
            info =new Info(null,ConvertToDate(date.getText().toString()),user.getText().toString(),
                    entre.getText().toString(),resp.getText().toString(),adr.getText().toString(),ref.getText().toString()
                    ,natTrvx,enviro);
            infoDao.insert(info);
            Context context=getActivity();
            LayoutInflater inflater= getLayoutInflater(Bundle.EMPTY);

            View customToastroot =inflater.inflate(R.layout.mytoast_validation, null);

            Toast customtoast=new Toast(context);

            customtoast.setView(customToastroot);
            customtoast.setGravity(Gravity.CENTER_HORIZONTAL | Gravity.CENTER_VERTICAL,0, 0);
            customtoast.setDuration(Toast.LENGTH_LONG);
            customtoast.show();

        }
    }
}
