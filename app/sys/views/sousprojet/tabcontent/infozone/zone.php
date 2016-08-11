<?php $sousprojet_zone = SousProjetZone::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="form-horizontal push-10-t push-10" id="sousprojet_zone_form" name="sousprojet_zone_form">
    <div class="row items-push">
        <?php if($sousprojet_zone !== NULL) {?>
            <input type="hidden" id="id_sous_projet_zone" name="id_sous_projet_zone" value="<?=$sousprojet_zone->id_sous_projet?>">
        <?php } else {?>
            <div class="row">
                <div id="id_sous_projet_zone_alert" class="col-md-3">
                    <span class="label label-warning">Aucune entrée info zone crée !</span>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <div class="col-md-3">
                <label for="sz_nbr_zone">Nbe de Zones de la Plaque <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="sz_nbr_zone" name="sz_nbr_zone" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->nbr_zone:"")?>">
            </div>
            <div class="col-md-3">
                <label for="sz_lr_sur_pm">LR sur PM existant <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="sz_lr_sur_pm" name="sz_lr_sur_pm" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->lr_sur_pm:"")?>">
            </div>
            <div class="col-md-3">
                <label for="sz_lr">LR <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="sz_lr" name="sz_lr" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->lr:"")?>">
            </div>
            <div class="col-md-3">
                <label for="sz_nbr_de_site">NB DE SITE <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="sz_nbr_de_site" name="sz_nbr_de_site" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->nbr_de_site:"")?>">
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="sz_nb_fo_sur_pm">NB FO SUR PM <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="sz_nb_fo_sur_pm" name="sz_nb_fo_sur_pm" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->nb_fo_sur_pm:"")?>">
            </div>
            <div class="col-md-3">
                <label for="sz_nb_fo_sur_pmz">NB FO SUR PMZ <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="sz_nb_fo_sur_pmz" name="sz_nb_fo_sur_pmz" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->nb_fo_sur_pmz:"")?>">
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="message_infozone_zone" role="alert" style="display: none;">

    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <div class="form-group">
                    <div class="col-xs-12">
                        <button id="id_sous_projet_zone_btn" class="btn btn-primary" type="button">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>