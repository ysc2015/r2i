<div class="col-md-3">
    <div class="form-group">
        <?php if($connectedProfil->profil->profil->shortlib == "adm" || $connectedProfil->profil->profil->shortlib == "dov" || $connectedProfil->profil->profil->shortlib == "pov") {?>
            <div class="form-group">
                <label>Filtre vpi / nro</label>
                <div>
                    <label class="checkbox-inline" for="vpi-inline-checkbox">
                        <input class="chb" type="checkbox" id="vpi-inline-checkbox" name="vpi-inline-checkbox" value="vpi"> Vpi
                    </label>
                    <label class="checkbox-inline" for="nro-inline-checkbox">
                        <input class="chb" type="checkbox" id="nro-inline-checkbox" name="nro-inline-checkbox" value="nro"> Nro
                    </label>
                </div>
                <br>
                <select class="form-control select-vpi-nro" id="vpi_select" name="vpi_select">
                    <option value="0" selected="">Sélectionnez un utilisateur</option>
                    <?php
                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 7)));//vpi=7
                    foreach($results as $result) {
                        echo "<option value=\"$result->id_utilisateur\">$result->prenom_utilisateur $result->nom_utilisateur</option>";
                    }
                    ?>
                </select>
                <select class="form-control select-vpi-nro" id="nro_select" name="nro_select" size="1" style="width: 100%;" data-placeholder="Séléctionner nro..">
                    <option value="0" selected="">Sélectionnez un nro</option>
                    <?php
                    $nros = Nro::all();
                    foreach($nros as $nro) {
                        echo "<option value=\"$nro->id_nro\">$nro->lib_nro</option>";
                    }
                    ?>
                </select>
            </div>
        <?php } else {?>
            <div class="form-group">
                <div class="checkbox">
                    <label for="my-plannings">
                        <input type="checkbox" id="my-plannings" name="my-plannings" value="1" checked> Mes plannings
                    </label>
                </div>
            </div>
        <?php }?>
        <label for="ot_entreprise_cal">Entreprise <!--<span class="text-danger">*</span>--></label>
        <select class="form-control " id="ot_entreprise_cal" name="ot_entreprise_cal" style="width: 100%;">
            <option value="" selected="">Tous</option>
            <?php
            $results = EntrepriseSTT::all();
            foreach($results as $result) {
                echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
            }
            ?>
        </select>
        <div id="teams_list_cal" class="list-group" style="padding-top: 10px;">
        </div>
    </div>
</div>
<div class="col-md-9">
    <div id="calender" class="js-calendar"><!--calendar wrapper-->

    </div>
</div>

<!--<label for="date_debut">Date début</label>
<input class="form-control " type="date" id="date_debut" name="date_debut" value="">
<label for="date_fin">Date fin</label>
<input class="form-control " type="date" id="date_fin" name="date_fin" value="">
<button id="affecter_ot" class='btn btn-success btn-sm' style="width: 100%;"><span class='glyphicon glyphicon-check'>&nbsp;</span> Affecter</button>
-->