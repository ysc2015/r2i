package fr.free.r2i.adapters;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ProgressBar;
import android.widget.TextView;

import java.util.List;

import fr.free.r2i.R;
import fr.free.r2i.model.Chambre;
import fr.free.r2i.model.OrdreTravail;
import fr.free.r2i.util.JSONBuilderParser;

/**
 * Created by zouftou on 4/3/16.
 */
public class OrdresAdapter extends
        RecyclerView.Adapter<OrdresAdapter.ViewHolder> {

    private List<OrdreTravail> mOrdres;

    public OrdresAdapter(List<OrdreTravail> ordres) {
        mOrdres = ordres;
    }

    private static OnItemClickListener listener;

    public interface OnItemClickListener {
        void onItemClick(View itemView, int position);
    }

    public void setOnItemClickListener(OnItemClickListener listener) {
        this.listener = listener;
    }

    public class ViewHolder extends RecyclerView.ViewHolder{
        public TextView titleTextView;
        public TextView commentTextView;
        public TextView dateTimeTextView;
        public TextView nmbrChambresTextView;
        public TextView avancementTextView;
        public ProgressBar progressBar;
        public ViewHolder(final View itemView) {
            super(itemView);
            titleTextView = (TextView) itemView.findViewById(R.id.ot_title);
            commentTextView = (TextView) itemView.findViewById(R.id.ot_comment);
            dateTimeTextView = (TextView) itemView.findViewById(R.id.ot_datetime);
            nmbrChambresTextView = (TextView) itemView.findViewById(R.id.ot_nbchambre);
            avancementTextView = (TextView) itemView.findViewById(R.id.ot_avancement);
            progressBar = (ProgressBar) itemView.findViewById(R.id.status);
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
    public OrdresAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        Context context = parent.getContext();
        LayoutInflater inflater = LayoutInflater.from(context);
        View ordresView = inflater.inflate(R.layout.item_ordre_travail, parent, false);
        ViewHolder viewHolder = new ViewHolder(ordresView);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(OrdresAdapter.ViewHolder viewHolder, int position) {
        OrdreTravail ordre = mOrdres.get(position);
        List<Chambre> mChambres = JSONBuilderParser.fromJSON(Chambre.class, ordre.getChambres());
        int nmbrChambres = mChambres.size();
        int count = 0;
        for(Chambre c: mChambres){
            if(c.getIsTraitee()){
                count++;
            }
        }
        TextView titleTextView = viewHolder.titleTextView;
        titleTextView.setText(ordre.getTitle());
        TextView commentTextView = viewHolder.commentTextView;
        commentTextView.setText(ordre.getComment());
        TextView dateTimeTextView = viewHolder.dateTimeTextView;
        dateTimeTextView.setText(ordre.getSubmittedOn());
        TextView nmbrChambresTextView = viewHolder.nmbrChambresTextView;
        nmbrChambresTextView.setText(nmbrChambres+" chambres");
        int percent = (count*100)/nmbrChambres;
        TextView avancementTextView = viewHolder.avancementTextView;
        avancementTextView.setText(percent+"%");
        ProgressBar progressBar = viewHolder.progressBar;
        progressBar.setVisibility(View.VISIBLE);
        progressBar.setMax(100);
        progressBar.setProgress(percent);
    }

    @Override
    public int getItemCount() {
        return mOrdres.size();
    }

    public void animateTo(List<OrdreTravail> ordres) {
        applyAndAnimateRemovals(ordres);
        applyAndAnimateAdditions(ordres);
        applyAndAnimateMovedItems(ordres);
    }

    private void applyAndAnimateRemovals(List<OrdreTravail> newOrdres) {
        for (int i = mOrdres.size() - 1; i >= 0; i--) {
            final OrdreTravail ot = mOrdres.get(i);
            if (!newOrdres.contains(ot)) {
                removeItem(i);
            }
        }
    }

    private void applyAndAnimateAdditions(List<OrdreTravail> newOrdres) {
        for (int i = 0, count = newOrdres.size(); i < count; i++) {
            final OrdreTravail ot = newOrdres.get(i);
            if (!mOrdres.contains(ot)) {
                addItem(i, ot);
            }
        }
    }

    private void applyAndAnimateMovedItems(List<OrdreTravail> newOrdres) {
        for (int toPosition = newOrdres.size() - 1; toPosition >= 0; toPosition--) {
            final OrdreTravail ot = newOrdres.get(toPosition);
            final int fromPosition = mOrdres.indexOf(ot);
            if (fromPosition >= 0 && fromPosition != toPosition) {
                moveItem(fromPosition, toPosition);
            }
        }
    }

    public OrdreTravail removeItem(int position) {
        final OrdreTravail model = mOrdres.remove(position);
        notifyItemRemoved(position);
        return model;
    }

    public void addItem(int position, OrdreTravail ot) {
        mOrdres.add(position, ot);
        notifyItemInserted(position);
    }

    public void moveItem(int fromPosition, int toPosition) {
        final OrdreTravail model = mOrdres.remove(fromPosition);
        mOrdres.add(toPosition, model);
        notifyItemMoved(fromPosition, toPosition);
    }

    public void clear() {
        mOrdres.clear();
        notifyDataSetChanged();
    }

    public void addAll(List<OrdreTravail> list) {
        mOrdres.addAll(list);
        notifyDataSetChanged();
    }
}