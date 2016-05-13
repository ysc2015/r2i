package fr.free.r2i.adapters;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.List;

import fr.free.r2i.R;
import fr.free.r2i.model.Chambre;

/**
 * Created by zouftou on 4/3/16.
 */
public class ChambresAdapter extends
        RecyclerView.Adapter<ChambresAdapter.ViewHolder> {

    private List<Chambre> mChambres;

    public ChambresAdapter(List<Chambre> chambres) {
        mChambres = chambres;
    }

    private static OnItemClickListener listener;

    public interface OnItemClickListener {
        void onItemClick(View itemView, int position);
    }

    private static OnMapsClickListener mapsListener;

    public interface OnMapsClickListener{
        void onMapsClick(Button btnMaps,int position);
    }

    public void setOnItemClickListener(OnItemClickListener listener) {
        this.listener = listener;
    }

    public void setOnMapsClickListener(OnMapsClickListener mapsListener) {
        this.mapsListener = mapsListener;
    }

    public class ViewHolder extends RecyclerView.ViewHolder{
        public TextView refChambreTextView;
        public TextView typeChambreTextView;
        public TextView villeTextView;
        public ImageView traiteeImageView;
        public ViewHolder(final View itemView) {
            super(itemView);
            refChambreTextView = (TextView) itemView.findViewById(R.id.ch_ref);
            typeChambreTextView = (TextView) itemView.findViewById(R.id.ch_type);
            villeTextView = (TextView) itemView.findViewById(R.id.ch_ville);
            traiteeImageView = (ImageView) itemView.findViewById(R.id.ch_traitee);
            final Button btnMaps = (Button) itemView.findViewById(R.id.btn_maps);
            btnMaps.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (mapsListener != null)
                        mapsListener.onMapsClick(btnMaps,getLayoutPosition());
                }
            });
            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (listener != null)
                        listener.onItemClick(itemView, getLayoutPosition());
                }
            });
        }
    }

    @Override
    public ChambresAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        Context context = parent.getContext();
        LayoutInflater inflater = LayoutInflater.from(context);
        View chambreView = inflater.inflate(R.layout.item_chambre, parent, false);
        ViewHolder viewHolder = new ViewHolder(chambreView);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(ChambresAdapter.ViewHolder viewHolder, int position) {
        Chambre chambre = mChambres.get(position);
        TextView refChambreTextView = viewHolder.refChambreTextView;
        refChambreTextView.setText("Ref chambre : "+chambre.getRefChambre());
        TextView dateCreationTextView = viewHolder.typeChambreTextView;
        dateCreationTextView.setText("Type chambre : "+chambre.getTypeChambre());
        TextView villeTextView = viewHolder.villeTextView;
        villeTextView.setText("Ville : "+chambre.getVille());
        ImageView traiteeImageView = viewHolder.traiteeImageView;
        if(chambre.getIsTraitee()){
            traiteeImageView.setImageResource(R.drawable.icn_progress);
        }else{
            traiteeImageView.setImageResource(R.drawable.icn_traite);
        }
    }

    @Override
    public int getItemCount() {
        return mChambres.size();
    }
}