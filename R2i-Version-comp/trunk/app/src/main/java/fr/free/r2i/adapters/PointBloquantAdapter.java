package fr.free.r2i.adapters;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import java.util.List;

import fr.free.r2i.R;
import fr.free.r2i.model.Chambre;
import fr.free.r2i.model.OrdreTravail;
import fr.free.r2i.model.PointBloquant;
import fr.free.r2i.util.JSONBuilderParser;

/**
 * Created by rc2k on 11/05/16.
 */
public class PointBloquantAdapter extends
        RecyclerView.Adapter<PointBloquantAdapter.ViewHolder> {

    private List<PointBloquant> mPointBloquants;

    public PointBloquantAdapter(List<PointBloquant> pointBloquants) {
        mPointBloquants = pointBloquants;
    }

    private static OnItemClickListener listener;

    public interface OnItemClickListener {
        void onItemClick(View itemView, int position);
    }

    public void setOnItemClickListener(OnItemClickListener listener) {
        this.listener = listener;
    }

    @Override
    public PointBloquantAdapter.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        Context context = parent.getContext();
        LayoutInflater inflater = LayoutInflater.from(context);
        View pointsBloquantsView = inflater.inflate(R.layout.item_point_bloquant, parent, false);
        ViewHolder viewHolder = new ViewHolder(pointsBloquantsView);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(PointBloquantAdapter.ViewHolder holder, int position) {
        PointBloquant pb = mPointBloquants.get(position);

        /*
        List<PointBloquant> pointBloquants = JSONBuilderParser.fromJSON(PointBloquant.class, ordre.getChambres());
        int nmbrChambres = pointBloquants.size();
        TextView titleTextView = viewHolder.titleTextView;
        titleTextView.setText(ordre.getTitle());
        TextView commentTextView = viewHolder.commentTextView;
        commentTextView.setText(ordre.getComment());
        TextView dateTimeTextView = viewHolder.dateTimeTextView;
        dateTimeTextView.setText(ordre.getSubmittedOn());
        TextView nmbrChambresTextView = viewHolder.nmbrChambresTextView;
        nmbrChambresTextView.setText(nmbrChambres+" chambres");*/

    }

    @Override
    public int getItemCount() {
        return mPointBloquants.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder{
        public TextView titleTextView;
        public TextView commentTextView;
        public TextView dateTimeTextView;
        public TextView nmbrChambresTextView;
        public ViewHolder(final View itemView) {
            super(itemView);
            titleTextView = (TextView) itemView.findViewById(R.id.ot_title);
            commentTextView = (TextView) itemView.findViewById(R.id.ot_comment);
            dateTimeTextView = (TextView) itemView.findViewById(R.id.ot_datetime);
            nmbrChambresTextView = (TextView) itemView.findViewById(R.id.ot_nbchambre);
            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if (listener != null)
                        listener.onItemClick(itemView, getLayoutPosition());
                }
            });
        }
    }
}
