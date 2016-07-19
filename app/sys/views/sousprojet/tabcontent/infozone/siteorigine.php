<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_siteorigine !== NULL) {?>
        <input type="hidden" id="id_sous_projet_site_origine" name="id_sous_projet_site_origine" value="<?=$sousprojet_siteorigine->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_site_origine_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée site origine crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="code_site">Code Site <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="code_site" name="code_site" readonly="" value="<?=($projet !== NULL?$projet->code_site_origine:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="type_so">Type <span class="text-danger">*</span></label>
            <select class="form-control" id="type_so" name="type_so" disabled="">
                <option value="" selected="" disabled="">Sélectionnez un type</option>
                <?php
                $results = SelectSiteOrigineType::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_site_origine_type\" ". ($projet!==NULL && $projet->type_site_origine==$result->id_site_origine_type ?"selected": "")." >$result->lib_site_origine_type</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="auto_adduction">Auto Adduction <span class="text-danger">*</span></label>
            <select class="form-control" id="auto_adduction" name="auto_adduction">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectSiteOrigineAutoAdduction::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_site_origine_auto_adduction\" ". ($sousprojet_siteorigine!==NULL && $sousprojet_siteorigine->auto_adduction==$result->id_site_origine_auto_adduction ?"selected": "")." >$result->lib_site_origine_auto_adduction</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="travaux_adduction">Travaux adduction <span class="text-danger">*</span></label>
            <select class="form-control" id="travaux_adduction" name="travaux_adduction">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectSiteOrigineTravauxAdduction::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_site_origine_travaux_adduction\" ". ($sousprojet_siteorigine!==NULL && $sousprojet_siteorigine->travaux_adduction==$result->id_site_origine_travaux_adduction ?"selected": "")." >$result->lib_site_origine_travaux_adduction</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="recette_adduction">Recette Adduction <span class="text-danger">*</span></label>
            <select class="form-control" id="recette_adduction" name="recette_adduction">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectSiteOrigineRecetteAdduction::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_site_origine_recette_adduction\" ". ($sousprojet_siteorigine!==NULL && $sousprojet_siteorigine->recette_adduction==$result->id_site_origine_recette_adduction ?"selected": "")." >$result->lib_site_origine_recette_adduction</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_infozone_site_origine" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_site_origine_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>