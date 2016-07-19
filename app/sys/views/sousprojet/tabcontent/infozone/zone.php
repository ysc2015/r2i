<form class="js-validation-bootstrap form-horizontal">
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
            <label for="nbr_zone">Nbe de Zones de la Plaque <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="nbr_zone" name="nbr_zone" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->nbr_zone:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="lr_sur_pm">LR sur PM existant <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="lr_sur_pm" name="lr_sur_pm" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->lr_sur_pm:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="lr">LR <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="lr" name="lr" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->lr:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="nbr_de_site">NB DE SITE <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="nbr_de_site" name="nbr_de_site" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->nbr_de_site:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="nb_fo_sur_pm">NB FO SUR PM <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="nb_fo_sur_pm" name="nb_fo_sur_pm" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->nb_fo_sur_pm:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="nb_fo_sur_pmz">NB FO SUR PMZ <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="nb_fo_sur_pmz" name="nb_fo_sur_pmz" value="<?=($sousprojet_zone !==NULL?$sousprojet_zone->nb_fo_sur_pmz:"")?>">
        </div>
    </div>
    <div class="alert alert-success" id="message_infozone_zone" role="alert" style="display: none;">

    </div>
    <div class="form-group">
        <div class="col-md-8">
            <button id="id_sous_projet_zone_btn" class="btn btn-primary" type="button">Enregistrer</button>
        </div>
    </div>
</form>