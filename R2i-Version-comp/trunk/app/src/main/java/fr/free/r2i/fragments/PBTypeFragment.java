package fr.free.r2i.fragments;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.app.Fragment;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.Toast;

import fr.free.r2i.R;
import r2i.free.r2k.pointblqdao.db.DaoMaster;
import r2i.free.r2k.pointblqdao.db.DaoSession;
import r2i.free.r2k.pointblqdao.db.Type_Point;
import r2i.free.r2k.pointblqdao.db.Type_PointDao;

/**
 * A placeholder fragment containing a simple view.
 */
public class PBTypeFragment extends Fragment {
    CheckBox checkRes1,checkRes2,checkRes3,checkConduit1,checkConduit2,checkConduit3,checkConduitCass1,
            checkConduitCass2,checkConduitCass3,checkTamp1,checkTamp2,checkTamp3,checkChambEnro1,checkChambEnro2,checkChambEnro3,
            checkResEmp1,checkResEmp2,checkResEmp3,checkChambINex1,checkChambINex2,checkChambINex3,checkProb1,checkProb2,
            checkProb3;
    int Res1,Conduit1,ConduitCass1,tamp,chambEnro,resEmp,chamInex,prob;
    Type_Point type_point;
    Type_PointDao type_pointDao;
    DaoSession mSession;
    EditText editTextAutre;
    DaoMaster daoMaster;
    SQLiteDatabase db;
    Button save;
    public PBTypeFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_pb_type, container, false);
        //CheckBox

        checkRes1=(CheckBox)rootView.findViewById(R.id.checkRes1);
        checkRes2=(CheckBox)rootView.findViewById(R.id.checkRes2);
        checkRes3=(CheckBox)rootView.findViewById(R.id.checkRes3);
        checkConduit1=(CheckBox)rootView.findViewById(R.id.checkConduit1);
        checkConduit2=(CheckBox)rootView.findViewById(R.id.checkConduit2);
        checkConduit3=(CheckBox)rootView.findViewById(R.id.checkConduit3);
        checkConduitCass1=(CheckBox)rootView.findViewById(R.id.checkConduiCass1);
        checkConduitCass2=(CheckBox)rootView.findViewById(R.id.checkConduitCass2);
        checkConduitCass3=(CheckBox)rootView.findViewById(R.id.checkConduitCass3);

        checkTamp1=(CheckBox)rootView.findViewById(R.id.checkTamp1);
        checkTamp2=(CheckBox)rootView.findViewById(R.id.checkTamp2);
        checkTamp3=(CheckBox)rootView.findViewById(R.id.checkTamp3);

        checkChambEnro1=(CheckBox)rootView.findViewById(R.id.checkChambEnro1);
        checkChambEnro2=(CheckBox)rootView.findViewById(R.id.checkChambEnro2);
        checkChambEnro3=(CheckBox)rootView.findViewById(R.id.checkChambEnro3);

        checkResEmp1=(CheckBox)rootView.findViewById(R.id.checkResEmp1);
        checkResEmp2=(CheckBox)rootView.findViewById(R.id.checkResEmp2);
        checkResEmp3=(CheckBox)rootView.findViewById(R.id.checkResEmp3);

        checkChambINex1=(CheckBox)rootView.findViewById(R.id.checkChambINex1);
        checkChambINex2=(CheckBox)rootView.findViewById(R.id.checkChambINex2);
        checkChambINex3=(CheckBox)rootView.findViewById(R.id.checkChambINex3);
        checkProb1=(CheckBox)rootView.findViewById(R.id.checkProb1);
        checkProb2=(CheckBox)rootView.findViewById(R.id.checkProb2);
        checkProb3=(CheckBox)rootView.findViewById(R.id.checkProb3);
         Res1=0; Conduit1=0;ConduitCass1=0; tamp= 0 ;chambEnro=0 ;resEmp=0;
        chamInex=0; prob=0;
        editTextAutre=(EditText)rootView.findViewById(R.id.editTextAutre);
        DaoMaster.DevOpenHelper helper=  new DaoMaster.DevOpenHelper(getActivity(), "dbPointBlq", null);
        db = helper.getWritableDatabase();
        daoMaster = new DaoMaster(db);
        mSession = daoMaster.newSession();
        type_pointDao=mSession.getType_PointDao();
        FloatingActionButton fab = (FloatingActionButton)rootView.findViewById(R.id.save2);

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
    public void save(){

        if(checkRes1.isChecked())
        {
            Res1=1;
        }
        if(checkRes2.isChecked()){
            Res1=2;
        }
        if(checkRes3.isChecked()){
            Res1=3;
        }

        if(checkConduit1.isChecked())
        {
            Conduit1=1;
        }
        if(checkConduit2.isChecked()){
            Conduit1=2;
        }
        if(checkConduit3.isChecked()){
            Conduit1=3;
        }


        if(checkConduitCass1.isChecked())
        {
            ConduitCass1=1;
        }
        if(checkConduitCass2.isChecked()){
            ConduitCass1=2;
        }
        if(checkConduitCass3.isChecked()){
            ConduitCass1=3;
        }


        if(checkTamp1.isChecked())
        {
            tamp=1;
        }
        if(checkTamp2.isChecked()){
            tamp=2;
        }
        if(checkTamp3.isChecked()){
            tamp=3;
        }


        if(checkChambEnro1.isChecked())
        {
            chambEnro=1;
        }
        if(checkChambEnro2.isChecked()){
            chambEnro=2;
        }
        if(checkChambEnro3.isChecked()){
            chambEnro=3;
        }


        if(checkResEmp1.isChecked())
        {
            resEmp=1;
        }
        if(checkResEmp2.isChecked()){
            resEmp=2;
        }
        if(checkResEmp3.isChecked()){
            resEmp=3;
        }



        if(checkChambINex1.isChecked())
        {
            chamInex=1;
        }
        if(checkChambINex2.isChecked()){
            chamInex=2;
        }
        if(checkChambINex3.isChecked()){
            chamInex=3;
        }


        if(checkProb1.isChecked())
        {
            prob=1;
        }
        if(checkProb2.isChecked()){
            prob=2;
        }
        if(checkProb3.isChecked()){
            prob=3;
        }
        if(editTextAutre.getText().toString()=="" || Res1==0 || Conduit1==0||
                ConduitCass1==0 || tamp== 0 || chambEnro==0 ||
                resEmp==0|| chamInex==0 || prob==0 )
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
        type_point=new Type_Point(null,Res1,Conduit1,ConduitCass1,tamp,chambEnro,resEmp,chamInex,prob
                ,editTextAutre.getText().toString());
        type_pointDao.insert(type_point);
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