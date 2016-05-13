package fr.free.r2i.activities;

import android.app.Fragment;
import android.app.FragmentTransaction;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.os.Bundle;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.CompoundButton;
import android.widget.PopupWindow;
import android.widget.RadioGroup;
import android.widget.Switch;
import android.widget.TextView;

import fr.free.r2i.R;
import fr.free.r2i.fragments.VueMasquesFragment;
import fr.free.r2i.fragments.VuePhotosFragment;
import fr.free.r2i.fragments.VueSynoFragment;

public class ChambreDetailActivity extends AppCompatActivity {

    private static final String TAG = ChambreDetailActivity.class.getSimpleName();

    private String refChambre;
    private String typeChambre;
    private String ville;
    private String latitude;
    private String longitude;
    private VuePhotosFragment vuePhotosFragment;
    private boolean popupBool=true;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chambre_detail);
        setTitle(R.string.activity_detail_chambre);

        Intent i = getIntent();
        refChambre = i.getStringExtra("refChambre");
        typeChambre = i.getStringExtra("typeChambre");
        ville = i.getStringExtra("ville");
        latitude = i.getStringExtra("latitude");
        longitude = i.getStringExtra("longitude");

        TextView refChambreView = (TextView) findViewById(R.id.refchambre);
        refChambreView.setText("Ref chambre : "+refChambre);
        TextView typeChambreView = (TextView) findViewById(R.id.typeChambre);
        typeChambreView.setText("Type chambre : " + typeChambre);
        TextView villeView = (TextView) findViewById(R.id.villeChambre);
        villeView.setText("Ville : " + ville);

        final Button btnInfos = (Button) findViewById(R.id.btnInfoCh);
        btnInfos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(popupBool) {
                    LayoutInflater layoutInflater = (LayoutInflater) getBaseContext()
                            .getSystemService(LAYOUT_INFLATER_SERVICE);
                    View popupView = layoutInflater.inflate(R.layout.popup_chambre_info, null);
                    final PopupWindow popupWindow = new PopupWindow(
                            popupView,
                            RadioGroup.LayoutParams.WRAP_CONTENT,
                            RadioGroup.LayoutParams.WRAP_CONTENT);

                    TextView txtRefChambr = (TextView) popupView.findViewById(R.id.txtRefChambr);
                    txtRefChambr.setText(refChambre);
                    TextView txtTypeChambre = (TextView) popupView.findViewById(R.id.txtTypeChambre);
                    txtTypeChambre.setText(typeChambre);
                    TextView txtVilleChambre = (TextView) popupView.findViewById(R.id.txtVilleChambre);
                    txtVilleChambre.setText(ville);
                    TextView txtLatiChambre = (TextView) popupView.findViewById(R.id.txtLatiChambre);
                    txtLatiChambre.setText(latitude);
                    TextView txtLongChambre = (TextView) popupView.findViewById(R.id.txtLongChambre);
                    txtLongChambre.setText(longitude);

                    Button btnDismiss = (Button) popupView.findViewById(R.id.dismiss);
                    btnDismiss.setOnClickListener(new Button.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                            popupWindow.dismiss();
                            popupBool = true;
                        }
                    });
                    popupWindow.showAsDropDown(btnInfos, -148, 10);
                    popupBool = false;
                }
            }
        });

        Button btnCapPic = (Button) findViewById(R.id.btnCapPic);
        btnCapPic.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                captureImage();
            }
        });
        Button btnPntBloc = (Button) findViewById(R.id.btnPntBloc);
        btnPntBloc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(ChambreDetailActivity.this, PointBloquantActivity.class);
                startActivity(i);
            }
        });

        Button fabMaps = (Button) findViewById(R.id.btnMaps);
        fabMaps.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(ChambreDetailActivity.this, MapsActivity.class);
                i.putExtra("latitude", latitude);
                i.putExtra("longitude", longitude);
                startActivity(i);
            }
        });

        final TextView statusView = (TextView) findViewById(R.id.status);
        Switch sButton = (Switch) findViewById(R.id.switchActiv);
        sButton.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton cb, boolean on) {
                if (on) {
                    statusView.setText("Traitée");
                    statusView.setTextColor(Color.parseColor("#84b000"));
                } else {
                    statusView.setText("Non Traitée");
                    statusView.setTextColor(Color.parseColor("#191970"));
                }
            }
        });

        Button btnVuePhotos = (Button) findViewById(R.id.btnVuePhotos);
        btnVuePhotos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                FragmentTransaction fragmentTransaction = getFragmentManager().beginTransaction();
                vuePhotosFragment = new VuePhotosFragment();
                vuePhotosFragment.setRefChambre(refChambre);
                fragmentTransaction.replace(R.id.fragment_container, vuePhotosFragment);
                fragmentTransaction.commit();
            }
        });

        Button btnVueSyno = (Button) findViewById(R.id.btnVueSyno);
        btnVueSyno.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                replaceFragment(new VueSynoFragment());
            }
        });

        Button btnVueMask = (Button) findViewById(R.id.btnVueMask);
        btnVueMask.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                replaceFragment(new VueMasquesFragment());
            }
        });

        FragmentTransaction fragmentTransaction = getFragmentManager().beginTransaction();
        vuePhotosFragment = new VuePhotosFragment();
        vuePhotosFragment.setRefChambre(refChambre);
        fragmentTransaction.add(R.id.fragment_container, vuePhotosFragment);
        fragmentTransaction.commit();
    }

    public void replaceFragment(Fragment fragment){
        FragmentTransaction fragmentTransaction = getFragmentManager().beginTransaction();
        fragmentTransaction.replace(R.id.fragment_container, fragment);
        //fragmentTransaction.addToBackStack(null);
        fragmentTransaction.commit();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){
            case android.R.id.home:
                ChambreDetailActivity.this.finish();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == REQUEST_IMAGE_CAPTURE && resultCode == RESULT_OK) {
            Bundle extras = data.getExtras();
            Bitmap imageBitmap = (Bitmap) extras.get("data");
            vuePhotosFragment.storeAndShowImage(Bitmap.createScaledBitmap(imageBitmap, 800, 760, false));
        }
    }

    static final int REQUEST_IMAGE_CAPTURE = 1;

    private void captureImage() {
        Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            startActivityForResult(takePictureIntent, REQUEST_IMAGE_CAPTURE);
        }
    }
}