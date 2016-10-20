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

<div class="modal fade" id="modal-ot-cal" tabindex="-1" role="dialog" aria-hidden="false" style="display: none; padding-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title" id="modal_cal_ot_title"></h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="ot_affecter_form__cal">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="ot_entreprise_cal2">Entreprise <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control " id="ot_entreprise_cal2" name="ot_entreprise_cal2" style="width: 100%;" disabled="">
                                    <option value="" selected="">Sélectionnez une entreprise</option>
                                    <?php
                                    $results = EntrepriseSTT::all();
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="ot_equipe_cal">Equipe <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control " id="ot_equipe_cal" name="ot_equipe_cal" style="width: 100%;" disabled="">
                                    <option value="" selected="">Sélectionnez une équipe</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="affecter_date_debut_cal">Date début <!--<span class="text-danger">*</span>--></label>
                                <input readonly class="form-control " type="date" id="affecter_date_debut_cal" name="affecter_date_debut_cal" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="affecter_date_fin_cal">Date fin <!--<span class="text-danger">*</span>--></label>
                                <input readonly class="form-control " type="date" id="affecter_date_fin_cal" name="affecter_date_fin_cal" value="">
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_affecter_ot_cal' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <!--<button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>-->
            </div>
        </div>
    </div>
</div>

<!--<label for="date_debut">Date début</label>
<input class="form-control " type="date" id="date_debut" name="date_debut" value="">
<label for="date_fin">Date fin</label>
<input class="form-control " type="date" id="date_fin" name="date_fin" value="">
<button id="affecter_ot" class='btn btn-success btn-sm' style="width: 100%;"><span class='glyphicon glyphicon-check'>&nbsp;</span> Affecter</button>
-->