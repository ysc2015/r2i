<?php $sousprojet_dtirage = SousProjetDistributionTirage::first(array('conditions' => array("id_sous_projet = ?", $idsousprojet)));?>
<form class="form-horizontal push-10-t push-10">
    <div class="row items-push">
        <?php if($sousprojet_dtirage !== NULL) {?>
            <input type="hidden" id="id_sous_projet_distribution_tirage" name="id_sous_projet_distribution_tirage" value="<?=$sousprojet_dtirage->id_sous_projet?>">
        <?php } else {?>
            <div class="row">
                <div id="id_sous_projet_distribution_tirage_alert" class="col-md-3">
                    <span class="label label-warning">Aucune entrée distribution tirage crée !</span>
                </div>
            </div>
        <?php }?>
        <div class="form-group">
            <div class="col-md-3">
                <label for="dt_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="dt_intervenant_be" name="dt_intervenant_be">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dt_date_previsionnelle">Date Previsionnelle <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="dt_date_previsionnelle" name="dt_date_previsionnelle" value="<?=($sousprojet_dtirage !== NULL ? $sousprojet_dtirage->date_previsionnelle : "")?>">
            </div>
            <div class="col-md-3">
                <label for="dt_prep_plans">Préparation des plans <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="dt_prep_plans" name="dt_prep_plans">
                    <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->prep_plans==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dt_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="dt_controle_plans" name="dt_controle_plans">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectControlePlan::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row items-push">
        <button id="id_lineaire_distribution_tirage_btn" class="btn btn-danger" type="button"><i id="hdfh04l54ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
        <div id="dt_lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
            <label><span class="label label-info">Câbles </span></label>
            <div class="form-group">
                <div class="col-md-3">
                    <!--<label for="dt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                    <label for="dt_lineaire1">câble 288FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput4" type="number" id="dt_lineaire1" name="dt_lineaire1" value="<?=($sousprojet_dtirage !== NULL?$sousprojet_dtirage->lineaire1:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="dt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                    <label for="dt_lineaire_reseau">câble 144FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput4" type="number" id="dt_lineaire2" name="dt_lineaire2" value="<?=($sousprojet_dtirage !== NULL?$sousprojet_dtirage->lineaire2:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="dt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                    <label for="dt_lineaire_reseau">câble 72FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput4" type="number" id="dt_lineaire3" name="dt_lineaire3" value="<?=($sousprojet_dtirage !== NULL?$sousprojet_dtirage->lineaire3:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="dt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                    <label for="dt_lineaire_reseau">câble 48FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput4" type="number" id="dt_lineaire4" name="dt_lineaire4" value="<?=($sousprojet_dtirage !== NULL?$sousprojet_dtirage->lineaire4:"")?>">
                </div>
            </div>
            <label><span class="label label-warning">Boites </span></label>
            <div class="form-group">
                <div class="col-md-3">
                    <!--<label for="dt_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                    <label for="dt_lineaire_reseau">BPE 288FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput4" type="number" id="dt_lineaire5" name="dt_lineaire5" value="<?=($sousprojet_dtirage !== NULL?$sousprojet_dtirage->lineaire5:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="dt_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                    <label for="dt_lineaire_reseau">BPE 144FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput4" type="number" id="dt_lineaire6" name="dt_lineaire6" value="<?=($sousprojet_dtirage !== NULL?$sousprojet_dtirage->lineaire6:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="dt_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                    <label for="dt_lineaire_reseau">BPE 72FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput4" type="number" id="dt_lineaire7" name="dt_lineaire7" value="<?=($sousprojet_dtirage !== NULL?$sousprojet_dtirage->lineaire7:"")?>">
                </div>
                <div class="col-md-3">
                    <!--<label for="dt_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                    <label for="dt_lineaire_reseau">BPE 48FO <span class="text-danger">*</span></label>
                    <input class="form-control input-lg lineareInput4" type="number" id="dt_lineaire8" name="dt_lineaire8" value="<?=($sousprojet_dtirage !== NULL?$sousprojet_dtirage->lineaire8:"")?>">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="dt_date_transmission_plans">Date Transmission Plans <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="dt_date_transmission_plans" name="dt_date_transmission_plans" value="<?=($sousprojet_dtirage !== NULL ? $sousprojet_dtirage->date_transmission_plans : "")?>">
            </div>
            <div class="col-md-3">
                <label for="dt_entreprise">Entreprise <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="dt_entreprise" name="dt_entreprise">
                    <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                    <?php
                    $results = SelectEntreprise::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dt_date_tirage">Date Tirage <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="dt_date_tirage" name="dt_date_tirage" value="<?=($sousprojet_dtirage !== NULL ? $sousprojet_dtirage->date_tirage : "")?>">
            </div>
            <div class="col-md-3">
                <label for="dt_duree">Durée(jours) <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="number" id="dt_duree" name="dt_duree" value="<?=($sousprojet_dtirage !== NULL ? $sousprojet_dtirage->duree : "")?>">
            </div>
        </div>
    </div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-md-3">
                <label for="dt_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="dt_controle_demarrage_effectif" name="dt_controle_demarrage_effectif">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectControleDemarrageEffectif::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dt_date_retour">Date Retour <span class="text-danger">*</span></label>
                <input class="form-control input-lg" type="date" id="dt_date_retour" name="dt_date_retour" value="<?=($sousprojet_dtirage !== NULL ? $sousprojet_dtirage->date_retour : "")?>">
            </div>
            <div class="col-md-3">
                <label for="dt_etat_retour">Etat Retour <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="dt_etat_retour" name="dt_etat_retour">
                    <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectEtatRetour::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dt_ok">OK <span class="text-danger">*</span></label>
                <select class="form-control input-lg" id="dt_ok" name="dt_ok">
                    <option value="" selected="">Sélectionnez une valeur</option>
                    <?php
                    $results = SelectOk::all();
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_ok\" ". ($sousprojet_dtirage!==NULL && $sousprojet_dtirage->ok==$result->id_ok ?"selected": "")." >$result->lib_ok</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="alert alert-success" id="message_distribution_tirage" role="alert" style="display: none;"></div>
    <div class="row items-push">
        <div class="form-group">
            <div class="col-xs-12"><button id="id_sous_projet_distribution_tirage_btn" class="btn btn-primary" type="button">Enregistrer</button>
                <?php
                if($sousprojet_dtirage !== NULL) {
                    $ot = OrdreDeTravail::first(
                        array('conditions' =>
                            array("id_entree = ? AND type_entree = ?", $sousprojet_dtirage->id_sous_projet_distribution_tirage,"distribution_tirage")
                        )
                    );
                    if($ot !== NULL) {

                        echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
                    } else {
                        echo "  <button id=\"id_sous_projet_distribution_tirage_create_ot_show\" class=\"btn btn-info\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">créer ordre de travail</button>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</form>
