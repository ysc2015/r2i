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
import android.widget.Toast;

import fr.free.r2i.R;
import r2i.free.r2k.pointblqdao.db.DaoMaster;
import r2i.free.r2k.pointblqdao.db.DaoSession;
import r2i.free.r2k.pointblqdao.db.Moyens;
import r2i.free.r2k.pointblqdao.db.MoyensDao;
import r2i.free.r2k.pointblqdao.db.Type_PointDao;

/**
 * Created by rc2k on 05/05/16.
 */
public class PBMoyMisOEuvreFragment extends Fragment {
    CheckBox checkAguiComp1,checkAguiComp2,checkAguiComp3,checkAguivc_aigui1,checkAguivc_aigui2,checkAguivc_aigui3,
            checkAguiCanne1,checkAguiCanne2,checkAguiCanne3,checkHydro1,checkHydro2,checkHydro3,checkIdenPoinBLq1,
            checkIdenPoinBLq2,checkIdenPoinBLq3,checkIdenSond1,checkIdenSond2,checkIdenSond3,checkTenConta1,checkTenConta2
            ,checkTenConta3;

    Moyens moyens;
    DaoSession mSession;
    DaoMaster daoMaster;
    SQLiteDatabase db;
    Type_PointDao type_pointDao ;
    MoyensDao moyensDao;
    int AguiComp,aguivc_agui,aguiCanne,hydro,IdenPoinblq,IdenSond,TenCOnt;
    public PBMoyMisOEuvreFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_pb_moy_mis_oeuvre, container, false);



        checkAguiComp1=(CheckBox)rootView.findViewById(R.id.checkAguiComp1);
        checkAguiComp2=(CheckBox)rootView.findViewById(R.id.checkAguiComp2);
        checkAguiComp3=(CheckBox)rootView.findViewById(R.id.checkAguiComp3);

        checkAguivc_aigui1=(CheckBox)rootView.findViewById(R.id.checkAguivc_aigui1);
        checkAguivc_aigui2=(CheckBox)rootView.findViewById(R.id.checkAguivc_aigui2);
        checkAguivc_aigui3=(CheckBox)rootView.findViewById(R.id.checkAguivc_aigui3);

        checkAguiCanne1=(CheckBox)rootView.findViewById(R.id.checkAguiCanne1);
        checkAguiCanne2=(CheckBox)rootView.findViewById(R.id.checkAguiCanne2);
        checkAguiCanne3=(CheckBox)rootView.findViewById(R.id.checkAguiCanne3);


        checkHydro1=(CheckBox)rootView.findViewById(R.id.checkHydro1);
        checkHydro2=(CheckBox)rootView.findViewById(R.id.checkHydro2);
        checkHydro3=(CheckBox)rootView.findViewById(R.id.checkHydro3);

        checkIdenPoinBLq1=(CheckBox)rootView.findViewById(R.id.checkIdenPoinBLq1);
        checkIdenPoinBLq2=(CheckBox)rootView.findViewById(R.id.checkIdenPoinBLq2);
        checkIdenPoinBLq3=(CheckBox)rootView.findViewById(R.id.checkIdenPoinBLq3);


        checkIdenSond1=(CheckBox)rootView.findViewById(R.id.checkIdenSond1);
        checkIdenSond2=(CheckBox)rootView.findViewById(R.id.checkIdenSond2);
        checkIdenSond3=(CheckBox)rootView.findViewById(R.id.checkIdenSond3);

        checkTenConta1=(CheckBox)rootView.findViewById(R.id.checkTenConta1);
        checkTenConta2=(CheckBox)rootView.findViewById(R.id.checkTenConta2);
        checkTenConta3=(CheckBox)rootView.findViewById(R.id.checkTenConta3);

        checkTenConta1=(CheckBox)rootView.findViewById(R.id.checkTenConta1);
        checkTenConta2=(CheckBox)rootView.findViewById(R.id.checkTenConta2);
        checkTenConta3=(CheckBox)rootView.findViewById(R.id.checkTenConta3);
        AguiComp=0; aguivc_agui=0;aguiCanne=0 ; hydro= 0;  IdenPoinblq=0;
        IdenSond=0; TenCOnt=0;
        DaoMaster.DevOpenHelper helper=  new DaoMaster.DevOpenHelper(getActivity(), "dbPointBlq", null);
        db = helper.getWritableDatabase();
        daoMaster = new DaoMaster(db);
        mSession = daoMaster.newSession();
        moyensDao=mSession.getMoyensDao();
        type_pointDao=mSession.getType_PointDao();
        FloatingActionButton fab = (FloatingActionButton)rootView.findViewById(R.id.save3);

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

        if(checkAguiComp1.isChecked())
        {
            AguiComp=1;
        }
        if(checkAguiComp2.isChecked()){
            AguiComp=2;
        }
        if(checkAguiComp3.isChecked()){
            AguiComp=3;
        }


        if(checkAguivc_aigui1.isChecked())
        {
            aguivc_agui=1;
        }
        if(checkAguivc_aigui2.isChecked()){
            aguivc_agui=2;
        }
        if(checkAguivc_aigui3.isChecked()){
            aguivc_agui=3;
        }

        if(checkAguiCanne1.isChecked())
        {
            aguiCanne=1;
        }
        if(checkAguiCanne2.isChecked()){
            aguiCanne=2;
        }
        if(checkAguiCanne3.isChecked()){
            aguiCanne=3;
        }


        if(checkHydro1.isChecked())
        {
            hydro=1;
        }
        if(checkHydro2.isChecked()){
            hydro=2;
        }
        if(checkHydro3.isChecked()){
            hydro=3;
        }


        if(checkIdenPoinBLq1.isChecked())
        {
            IdenPoinblq=1;
        }
        if(checkIdenPoinBLq2.isChecked()){
            IdenPoinblq=2;
        }
        if(checkIdenPoinBLq3.isChecked()){
            IdenPoinblq=3;
        }


        if(checkIdenSond1.isChecked())
        {
            IdenSond=1;
        }
        if(checkIdenSond2.isChecked()){
            IdenSond=2;
        }
        if(checkIdenSond3.isChecked()){
            IdenSond=3;
        }


        if(checkTenConta1.isChecked())
        {
            TenCOnt=1;
        }
        if(checkTenConta2.isChecked()){
            TenCOnt=2;
        }
        if(checkTenConta3.isChecked()){
            TenCOnt=3;
        }


        if(checkTenConta1.isChecked())
        {
            TenCOnt=1;
        }
        if(checkTenConta2.isChecked()){
            TenCOnt=2;
        }
        if(checkTenConta3.isChecked()){
            TenCOnt=3;
        }
        if( AguiComp==0 || aguivc_agui==0||
                aguiCanne==0 || hydro== 0 || IdenPoinblq==0 ||
                IdenSond==0|| TenCOnt==0 )
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
        moyens=new Moyens(null,AguiComp,aguivc_agui,aguiCanne,hydro,
                IdenPoinblq,IdenSond,TenCOnt);

        moyensDao.insert(moyens);
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
