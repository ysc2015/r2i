<!-- Table affectation -->
<div class="block">
    <div class="block-header">
        <h3 class="block-title">Liste OT / Affectations</h3>
    </div>
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="ot_affect_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>idot</th>
                <th>idsp</th>
                <th>tentree</th>
                <th>ot</th>
                <th>entreprise</th>
                <th>prenom</th>
                <th>nom</th>
                <th>date début</th>
                <th>date fin</th>
                <th>état</th>
                <th>état</th>
                <th>BackLog</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>idot</th>
                <th>idsp</th>
                <th>tentree</th>
                <th>ot</th>
                <th>entreprise</th>
                <th>prenom</th>
                <th>nom</th>
                <th>date début</th>
                <th>date fin</th>
                <th>état</th>
                <th>état</th>
                <th>BackLog</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table affectation -->
<button id="affecter_ot_show" class='btn btn-success btn-sm'><span class='glyphicon glyphicon-check'>&nbsp;</span> Affecter ot</button>
<button id="annuler_affecter" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span> Annuler affectation</button>
<button id="transmettre_ot" class='btn btn-info btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span> Transmettre OT</button>
<button id="bklog_ot" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span> BackLog OT</button>
<button id="mod_date_ot" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#mod-date-ot' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-remove'>&nbsp;</span> Modifier la date</button>

<!--<div class='alert alert-success' id='message_annuler_affecter_ot' role='alert' style="display: none;">-->

<!-- affecter ot Modal -->
<div class="modal fade" id="affecter-ot" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Affecter ordre de travail</h3>
                </div>
                <div class="block-content">
                    <div class="row items-push">
                        <div class="col-md-4">
                            <form class="js-validation-bootstrap form-horizontal" id="ot_affecter_form">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="ot_entreprise">Entreprise <!--<span class="text-danger">*</span>--></label>
                                        <select class="form-control" id="ot_entreprise" name="ot_entreprise" style="width: 100%;">
                                            <option value="0" selected="">Tous</option>
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
                                    <div class="col-md-12">
                                        <label for="ot_equipe">Equipe <!--<span class="text-danger">*</span>--></label>
                                        <select class="form-control" id="ot_equipe" name="ot_equipe" style="width: 100%;">
                                            <option value="" selected="">Sélectionnez une équipe</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="affecter_date_debut">Date début <!--<span class="text-danger">*</span>--></label>
                                        <input class="form-control" type="date" id="affecter_date_debut" name="affecter_date_debut" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="affecter_date_fin">Date fin <!--<span class="text-danger">*</span>--></label>
                                        <input class="form-control" type="date" id="affecter_date_fin" name="affecter_date_fin" value="">
                                    </div>
                                </div>
                                <div class='alert alert-success' id='message_affecter_ot' role='alert' style="display: none;">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div id="calender2" class="js-calendar"><!--calendar wrapper-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_ot_affecter" type="button"><i class="fa fa-check"></i> Affecter</button>
            </div>
        </div>
    </div>
</div>
<!-- END affecter ot Modal -->

<!-- Changer date OT Modal -->
<div class="modal fade" id="mod-date-ot" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b" id="mod_date_ot_block_content">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier date OT</h3>
                </div>
                <div class="block-content">
                    <div class="block">
                        <form class="js-validation-bootstrap form-horizontal" id="mod_date_ot_form">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="mod_date_ot_debut">Date début <span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" id="mod_date_ot_debut" name="mod_date_ot_debut">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="mod_date_ot_fin">Date fin <span class="text-danger">*</span></label>
                                    <input class="form-control" type="date" id="mod_date_ot_fin" name="mod_date_ot_fin">
                                </div>
                            </div>
                            <div class='alert alert-success' id='message_mod_date_ot' role='alert' style="display: none;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_date_ot" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END Changer date OT Modal -->