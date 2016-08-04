<?php $sousprojet_phase = SousProjetPlaquePhase::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet))); ?>
<form class="js-validation-bootstrap form-horizontal" id="gestionplaque_phase_form" name="gestionplaque_phase_form">
    <?php if($sousprojet_phase !== NULL) {?>
        <input type="hidden" id="id_sous_projet_plaque_phase" name="id_sous_projet_plaque_phase" value="<?=$sousprojet_phase->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_plaque_phase_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée phase crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="instigateur">Instigateur <span class="text-danger">*</span></label>
            <select class="form-control" id="instigateur" name="instigateur">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectPhaseInstigateur::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_phase_instigateur\" ". ($sousprojet_phase!==NULL && $sousprojet_phase->instigateur==$result->id_phase_instigateur ?"selected": "")." >$result->lib_phase_instigateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="vague">Vague <span class="text-danger">*</span></label>
            <select class="form-control" id="vague" name="vague" disabled="">
                <option value="" selected="" disabled="">Sélectionnez une phase</option>
                <?php
                $results = SelectPlaquePhase::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_plaque_phase\" ". ($sousprojet_infoplaque!==NULL && $sousprojet_infoplaque->phase==$result->id_plaque_phase ?"selected": "")." >$result->lib_plaque_phase</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3"><label for="date_lancement">Date Lancement <span class="text-danger">*</span></label><input class="form-control" type="date" id="date_lancement" name="date_lancement" value="<?=($sousprojet_phase !== NULL?$sousprojet_phase->date_lancement:"")?>"></div>
    </div>
    <div class="alert alert-success" id="message_gestion_plaque_phase" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_plaque_phase_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>