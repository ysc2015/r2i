<style>
    .retourpresta .ajax-upload-dragdrop {
        display: none;
    }

    .fcomp-annexe .ajax-upload-dragdrop {
        display: none;
    }
</style>
<div class="block block-themed block-opt-hidden" id="rtransport_block">
    <div class="block-header bg-info">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-down"></i></button>
            </li>
        </ul>
        <?php
        $alerte = "";
        $sousProjet_master = SousProjet::first(
            array('conditions' =>
                array("id_projet = ? AND is_master = 1", $sousProjet->id_projet)
            )
        );

        if($sousProjet_master == NULL) {
            $alerte = "(Aucun sous projet maitre CTR définit pour le projet)";
        } else if($sousProjet_master->id_sous_projet == $sousProjet->id_sous_projet) {
            $alerte = "(Ce sous projet est Maitre CTR)";
        } else {
            $alerte = "(Maitre CTR : ".$sousProjet_master->projet->nro->lib_nro."-".(strlen($sousProjet_master->zone)==1?"0".$sousProjet_master->zone:$sousProjet_master->zone).")";
        }
        ?>
        <h3 class="block-title"><?=$lang["RESEAUTRANSPORT"].$alerte?></h3>
    </div>
    <div class="block-content">
        <div class="block" id="rtransport_block_content">