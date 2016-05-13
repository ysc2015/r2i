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
import r2i.free.r2k.pointblqdao.db.Solution;
import r2i.free.r2k.pointblqdao.db.SolutionDao;

/**
 * Created by rc2k on 05/05/16.
 */
public class PBSolutionsPrecFragment extends Fragment {



    DaoSession mSession;
    DaoMaster daoMaster;
    SQLiteDatabase db;
    int  AiguiCompre,AguiVcAgui,AguiACanne,HydroCu,ChangePar,FouiPonc,GeniCiv1,NegoGest,AccompFree;

    Solution solution;
    private Button valider;

    CheckBox checkAiguiCompre1,checkAiguiCompre2,checkAiguiCompre3,checkAguiVcAgui1,checkAguiVcAgui2,checkAguiVcAgui3
            ,  checkAguiACanne1,checkAguiACanne2,checkAguiACanne3,checkHydroCu1,checkHydroCu2,checkHydroCu3,checkChangePar1
            ,checkChangePar2,checkChangePar3,checkFouiPonc1,checkFouiPonc2,checkFouiPonc3,checkGeniCiv1,checkGeniCiv2,checkGeniCiv3,
            checkNegoGest1,checkNegoGest2,checkNegoGest3,checkAccompFree1,checkAccompFree2;

    SolutionDao solutionDao;
    public PBSolutionsPrecFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {


        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View rootView = inflater.inflate(R.layout.fragment_pb_solutions_prec, container, false);
        checkAiguiCompre1=(CheckBox)rootView.findViewById(R.id.checkAiguiCompre1);
        checkAiguiCompre2=(CheckBox)rootView.findViewById(R.id.checkAiguiCompre2);
        checkAiguiCompre3=(CheckBox)rootView.findViewById(R.id.checkAiguiCompre3);

        checkAguiVcAgui1=(CheckBox)rootView.findViewById(R.id.checkAguiVcAgui1);
        checkAguiVcAgui2=(CheckBox)rootView.findViewById(R.id.checkAguiVcAgui2);
        checkAguiVcAgui3=(CheckBox)rootView.findViewById(R.id.checkAguiVcAgui3);

        checkAguiACanne1=(CheckBox)rootView.findViewById(R.id.checkAguiACanne1);
        checkAguiACanne2=(CheckBox)rootView.findViewById(R.id.checkAguiACanne2);
        checkAguiACanne3=(CheckBox)rootView.findViewById(R.id.checkAguiACanne3);

        checkHydroCu1=(CheckBox)rootView.findViewById(R.id.checkHydroCu1);
        checkHydroCu2=(CheckBox)rootView.findViewById(R.id.checkHydroCu2);
        checkHydroCu3=(CheckBox)rootView.findViewById(R.id.checkHydroCu3);

        checkChangePar1=(CheckBox)rootView.findViewById(R.id.checkChangePar1);
        checkChangePar2=(CheckBox)rootView.findViewById(R.id.checkChangePar2);
        checkChangePar3=(CheckBox)rootView.findViewById(R.id.checkChangePar3);


        checkFouiPonc1=(CheckBox)rootView.findViewById(R.id.checkFouiPonc1);
        checkFouiPonc2=(CheckBox)rootView.findViewById(R.id.checkFouiPonc2);
        checkFouiPonc3=(CheckBox)rootView.findViewById(R.id.checkFouiPonc3);


        checkGeniCiv1=(CheckBox)rootView.findViewById(R.id.checkGeniCiv1);
        checkGeniCiv2=(CheckBox)rootView.findViewById(R.id.checkGeniCiv2);
        checkGeniCiv3=(CheckBox)rootView.findViewById(R.id.checkGeniCiv3);


        checkNegoGest1=(CheckBox)rootView.findViewById(R.id.checkNegoGest1);
        checkNegoGest2=(CheckBox)rootView.findViewById(R.id.checkNegoGest2);
        checkNegoGest3=(CheckBox)rootView.findViewById(R.id.checkNegoGest3);

        checkAccompFree1=(CheckBox)rootView.findViewById(R.id.checkAccompFree1);
        checkAccompFree2=(CheckBox)rootView.findViewById(R.id.checkAccompFree2);




        DaoMaster.DevOpenHelper helper=  new DaoMaster.DevOpenHelper(getActivity(), "dbPointBlq", null);
        db = helper.getWritableDatabase();
        daoMaster = new DaoMaster(db);
        mSession = daoMaster.newSession();
        solutionDao=mSession.getSolutionDao();
        FloatingActionButton fab = (FloatingActionButton)rootView.findViewById(R.id.save4);

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

        if(checkAiguiCompre1.isChecked())
        {
            AiguiCompre=1;
        }if(checkAiguiCompre2.isChecked()){
            AiguiCompre=2;
        }
        if(checkAiguiCompre3.isChecked()){
            AiguiCompre=3;
        }


        if(checkAguiVcAgui1.isChecked())
        {
            AguiVcAgui=1;
        }
        if(checkAguiVcAgui2.isChecked()){
            AguiVcAgui=2;
        }
        if(checkAguiVcAgui3.isChecked()){
            AguiVcAgui=3;
        }


        if(checkAguiACanne1.isChecked())
        {
            AguiACanne=1;
        }
        if(checkAguiACanne2.isChecked()){
            AguiACanne=2;
        }
        if(checkAguiACanne3.isChecked()){
            AguiACanne=3;
        }


        if(checkHydroCu1.isChecked())
        {
            HydroCu=1;
        }
        if(checkHydroCu2.isChecked()){
            HydroCu=2;
        }
        if(checkHydroCu3.isChecked()){
            HydroCu=3;
        }

        if(checkChangePar1.isChecked())
        {
            ChangePar=1;
        }
        if(checkChangePar2.isChecked()){
            ChangePar=2;
        }
        if(checkChangePar3.isChecked()){
            ChangePar=3;
        }

        if(checkFouiPonc1.isChecked())
        {
            FouiPonc=1;
        }
        if(checkFouiPonc2.isChecked()){
            FouiPonc=2;
        }
        if(checkFouiPonc3.isChecked()){
            FouiPonc=3;
        }

        if(checkGeniCiv1.isChecked())
        {
            GeniCiv1=1;
        }
        if(checkGeniCiv2.isChecked()){
            GeniCiv1=2;
        }
        if(checkGeniCiv3.isChecked()){
            GeniCiv1=3;
        }


        if(checkNegoGest1.isChecked())
        {
            NegoGest=1;
        }
        if(checkNegoGest2.isChecked()){
            NegoGest=2;
        }
        if(checkNegoGest3.isChecked()){
            NegoGest=3;
        }

        if(checkAccompFree1.isChecked())
        {
            AccompFree=1;
        }
        if(checkAccompFree2.isChecked()){
            AccompFree=2;
        }
        if( AiguiCompre==0 || AguiVcAgui==0||
                AguiACanne==0 || HydroCu== 0 || ChangePar==0 ||
                FouiPonc==0|| GeniCiv1==0 ||NegoGest==0|| AccompFree==0  )
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
        solution=new Solution(null,AiguiCompre,AguiVcAgui,AguiACanne,HydroCu,ChangePar,FouiPonc,GeniCiv1,
                NegoGest,AccompFree);
        solutionDao.insert(solution);
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
