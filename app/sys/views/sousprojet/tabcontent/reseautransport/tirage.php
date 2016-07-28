<form class="js-validation-bootstrap form-horizontal">
    <?php if($sousprojet_ttirage !== NULL) {?>
        <input type="hidden" id="id_sous_projet_transport_tirage" name="id_sous_projet_transport_tirage" value="<?=$sousprojet_ttirage->id_sous_projet?>">
    <?php } else {?>
        <div class="row">
            <div id="id_sous_projet_transport_tirage_alert" class="col-md-3">
                <span class="label label-warning">Aucune entrée transport tirage crée !</span>
            </div>
        </div>
    <?php }?>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_intervenant_be">Intervenant BE <span class="text-danger">*</span></label>
            <select class="form-control" id="tt_intervenant_be" name="tt_intervenant_be">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->intervenant_be==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_date_previsionnelle">Date Previsionnelle <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="tt_date_previsionnelle" name="tt_date_previsionnelle"  value="<?=$sousprojet_ttirage->date_previsionnelle?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_prep_plans">Préparation des plans <span class="text-danger">*</span></label>
            <select class="form-control" id="tt_prep_plans" name="tt_prep_plans">
                <option value="" selected="" disabled="">Sélectionnez un utilisateur</option>
                <?php
                $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                foreach($results as $result) {
                    echo "<option value=\"$result->id_utilisateur\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->prep_plans==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_controle_plans">Contrôle des plans <span class="text-danger">*</span></label>
            <select class="form-control" id="tt_controle_plans" name="tt_controle_plans">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectControlePlan::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_controle_plan\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->controle_plans==$result->id_controle_plan ?"selected": "")." >$result->lib_controle_plan</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_date_transmission_plans">Date Transmission Plans <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="tt_date_transmission_plans" name="tt_date_transmission_plans" value="<?=$sousprojet_ttirage->date_transmission_plans?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_entreprise">Entreprise <span class="text-danger">*</span></label>
            <select class="form-control" id="tt_entreprise" name="tt_entreprise">
                <option value="" selected="" disabled="">Sélectionnez une entreprise</option>
                <?php
                $results = SelectEntreprise::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_entreprise\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->lib_entreprise</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_date_tirage">Date Tirage <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="tt_date_tirage" name="tt_date_tirage" value="<?=$sousprojet_ttirage->date_tirage?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_date_ret_prevue">Date Retour Prev <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="tt_date_ret_prevue" name="tt_date_ret_prevue" value="<?=$sousprojet_ttirage->date_ret_prevue?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_duree">Durée <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="tt_duree" name="tt_duree" value="<?=$sousprojet_ttirage->duree?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_controle_demarrage_effectif">Contrôle démarrage effectif <span class="text-danger">*</span></label>
            <select class="form-control" id="tt_controle_demarrage_effectif" name="tt_controle_demarrage_effectif">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectControleDemarrageEffectif::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_controle_demarrage_effectif\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->controle_demarrage_effectif==$result->id_controle_demarrage_effectif ?"selected": "")." >$result->lib_controle_demarrage_effectif</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_date_retour">Date Retour <span class="text-danger">*</span></label>
            <input class="form-control" type="date" id="tt_date_retour" name="tt_date_retour" value="<?=$sousprojet_ttirage->date_retour?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-3">
            <label for="tt_etat_retour">Etat Retour <span class="text-danger">*</span></label>
            <select class="form-control" id="tt_etat_retour" name="tt_etat_retour">
                <option value="" selected="" disabled="">Sélectionnez une valeur</option>
                <?php
                $results = SelectEtatRetour::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_etat_retour\" ". ($sousprojet_ttirage!==NULL && $sousprojet_ttirage->etat_retour==$result->id_etat_retour ?"selected": "")." >$result->lib_etat_retour</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="alert alert-success" id="message_transport_tirage" role="alert" style="display: none;"></div>
    <div class="form-group">
        <div class="col-md-8"><button id="id_sous_projet_transport_tirage_btn" class="btn btn-primary" type="button">Enregistrer</button>
            <?php
            if($sousprojet_ttirage !== NULL) {
                $ot = OrdreDeTravail::first(
                    array('conditions' =>
                        array("id_entree = ? AND type_entree = ?", $sousprojet_ttirage->id_sous_projet_transport_tirage,"transport_tirage")
                    )
                );
                if($ot !== NULL) {

                    echo "  <a href=\"?page=ot&idot=$ot->id_ordre_de_travail&idsousprojet=$idsousprojet\" class=\"btn btn-info\">ouvrir ordre de travail</a>";
                } else {
                    echo "  <button id=\"id_sous_projet_transport_tirage_create_ot_show\" class=\"btn btn-success\" type=\"button\" data-toggle=\"modal\" data-target=\"#add-ot\" data-backdrop=\"static\" data-keyboard=\"false\">créer ordre de travail</button>";
                }
            }
            ?>
        </div>
    </div>
</form>
