<div class="col-md-3">
    <div class="form-group">
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
            <!--<a class="list-group-item active" href="javascript:void(0)"><span class="badge">3</span><i class="fa fa-fw fa-user push-5-r"></i> Equipes</a>
            <a class="list-group-item" href="javascript:void(0)">
                Equipe1
            </a>
            <a class="list-group-item" href="javascript:void(0)">Equipe1</a>
            <a class="list-group-item" href="javascript:void(0)">
                Equipe1
            </a>-->
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