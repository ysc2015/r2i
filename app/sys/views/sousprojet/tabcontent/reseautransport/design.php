<?php $sousprojet_tdesign = SousProjetTransportDesign::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_tdesign !== NULL) {?>
        <input type="hidden" id="id_sous_projet_transport_design" name="id_sous_projet_transport_design" value="<?=$sousprojet_tdesign->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_plaque_pos_adresse_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée transport design crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="td_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="td_intervenant_be" name="td_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_tdesign!==NULL && $sousprojet_tdesign->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="td_date_debut">Date de Début <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="td_date_debut" name="td_date_debut" value="<?=($sousprojet_tdesign !== NULL?$sousprojet_tdesign->date_debut:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="td_date_ret_prevue">Date ret Prev <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="td_date_ret_prevue" name="td_date_ret_prevue" value="<?=($sousprojet_tdesign !== NULL?$sousprojet_tdesign->date_ret_prevue:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="td_duree">Durée(jours) <span class="text-danger">*</span></label>
            <input readonly class="form-control" type="text" id="td_duree" name="td_duree" value="<?=($sousprojet_tdesign !== NULL?$sousprojet_tdesign->duree:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="td_lineaire_transport">Linéaire Transport <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="td_lineaire_transport" name="td_lineaire_transport" value="<?=($sousprojet_tdesign !== NULL?$sousprojet_tdesign->lineaire_transport:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="td_nb_zones">Nbe Zones <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="td_nb_zones" name="td_nb_zones" value="<?=($sousprojet_tdesign !== NULL?$sousprojet_tdesign->nb_zones:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="td_ok">OK <span class="text-danger">*</span></label>
            <select class="form-control" id="td_ok" name="td_ok">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectOk::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_ok\" ". ($sousprojet_tdesign!==NULL && $sousprojet_tdesign->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_transport_design" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_transport_design_btn" class="btn btn-primary" type="button">Enregistrer</button></div>
    </div>
</form>