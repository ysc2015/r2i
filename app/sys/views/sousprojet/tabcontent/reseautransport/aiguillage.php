<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_taiguillage !== NULL) {?>
        <input type="hidden" id="id_sous_projet_transport_aiguillage" name="id_sous_projet_transport_aiguillage" value="<?=$sousprojet_taiguillage->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_transport_aiguillage_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée transport aiguillage crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="ta_intervenant_be" name="ta_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_plans">Plans <span class="text-danger">*</span></label>
            <select class="form-control" id="ta_plans" name="ta_plans">
                <option value="" selected="" disabled="">Sélectionnez état plans</option>
                <?php
                $results = SelectEtatPlan::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_etat_plan\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->plans==$result->id_etat_plan ?"selected": "")." >$result->lib_etat_plan</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_lineaire_reseau">Linéaire de réseau <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="ta_lineaire_reseau" name="ta_lineaire_reseau" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->lineaire_reseau:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
            <select class="form-control" id="ta_controle_plans" name="ta_controle_plans">
                <option value="" selected="" disabled="">Sélectionnez type controle</option>
                <?php
                $results = SelectControlePlan::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_date_transmission_plans">Date Transmission Plans <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="ta_date_transmission_plans" name="ta_date_transmission_plans" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->date_transmission_plans:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_entreprise">Entreprise <span class="text-danger">*</span></label>
            <select class="form-control" id="ta_entreprise" name="ta_entreprise">
                <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                <?php
                $results = SelectEntreprise::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_date_aiguillage">Date Aiguillage <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="ta_date_aiguillage" name="ta_date_aiguillage" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->date_aiguillage:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_date_ret_prevue">Date ret Prev <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="ta_date_ret_prevue" name="ta_date_ret_prevue" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->date_ret_prevue:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_duree">Durée <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="ta_duree" name="ta_duree" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->duree:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
            <select class="form-control" id="ta_controle_demarrage_effectif" name="ta_controle_demarrage_effectif">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectControleDemarrageEffectif::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_date_retour">Date Retour <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="ta_date_retour" name="ta_date_retour" value="<?=($sousprojet_taiguillage !== NULL?$sousprojet_taiguillage->date_retour:"")?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="ta_etat_retour">Etat Retour <span class="text-danger">*</span></label>
            <select class="form-control" id="ta_etat_retour" name="ta_etat_retour">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectEtatRetour::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_taiguillage!==NULL && $sousprojet_taiguillage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_transport_aiguillage" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8">
            <button id="id_sous_projet_transport_aiguillage_btn" class="btn btn-primary" type="button">Enregistrer</button>
        <?php
        $ot = OrdreDeTravail::first(
            array('conditions' =>
                array("id_entree = ? AND type_entree = ?", $sousprojet_taiguillage->id_sous_projet_transport_aiguillage,"transport_aiguillage")
            )
        );
        if($ot !== NULL) {

            echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
        } else {
            echo "  <button id=\"id_sous_projet_transport_aiguillage_create_ot_show\" class=\"btn btn-success\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">créer ordre de travail</button>";
        }
        ?>
        </div>
    </div>
</form>
