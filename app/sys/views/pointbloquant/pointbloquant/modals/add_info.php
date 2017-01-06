<!-- ajouter pbt info Modal -->
<div class="modal fade" id="add-info" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter Info(suivi)</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_info_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="zone">Zone <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="text" id="zone" name="zone" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_ville">Ville <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="text" id="info_ville" name="info_ville">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_planches">Planches <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="number" id="info_planches" name="info_planches">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_chambre1">Chambre 1 <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="text" id="info_chambre1" name="info_chambre1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_chambre2">Chambre 2 <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="text" id="info_chambre2" name="info_chambre2">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_id_pci_user">Intervenant PCI <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="info_id_pci_user" name="info_id_pci_user">
                                    <option value="" selected="">Sélectionnez un utilisateur</option>
                                    <?php
                                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 8)));
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_utilisateur\">$result->prenom_utilisateur $result->nom_utilisateur</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_id_bei_user">Intervenant BEI <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="info_id_bei_user" name="info_id_bei_user">
                                    <option value="" selected="">Sélectionnez un utilisateur</option>
                                    <?php
                                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 4)));
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_utilisateur\">$result->prenom_utilisateur $result->nom_utilisateur</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_id_type_traitement_pbt">Traitement <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="info_id_type_traitement_pbt" name="info_id_type_traitement_pbt">
                                    <option value="" selected="">Sélectionnez une valeur</option>
                                    <?php
                                    $results = SelectTypeTraitementPbt::all();
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_type_traitement_pbt\">$result->lib_type_traitement_pbt</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_commentaire">Commentaire <!--<span class="text-danger">*</span>--></label>
                                <textarea class="form-control" id="info_commentaire" name="info_commentaire" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_date_rendu">Date rendu <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control " type="date" id="info_date_rendu" name="info_date_rendu">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_id_solution_traitement_pbt">Solutions <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="info_id_solution_traitement_pbt" name="info_id_solution_traitement_pbt">
                                    <option value="" selected="">Sélectionnez une valeur</option>
                                    <?php
                                    $results = SelectSolutionTraitementPbt::all();
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_solution_traitement_pbt\">$result->lib_solution_traitement_pbt</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="info_id_entreprise">Prestataire <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="info_id_entreprise" name="info_id_entreprise">
                                    <option value="" selected="">Sélectionnez une valeur</option>
                                    <?php
                                    $results = EntrepriseSTT::all();
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_entreprise\">$result->nom</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_info_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_info" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter pbt info Modal -->
<script>
    var info_pblq_formdata = {};
    $(document).ready(function() {
        $("#message_info_add").hide();

        $('#add_info_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            info_pblq_formdata[$( this ).attr('name')] = $( this).val();
        });
        
        $("#save_info").click(function () {
            $("#message_info_add").fadeOut();

            for (var key in info_pblq_formdata) {
                info_pblq_formdata[key] = $('#'+key).val();
            }

            info_pblq_formdata['suffix'] = 'info';
            info_pblq_formdata['info_date_creation'] = '';
            info_pblq_formdata['info_id_point_bloquant'] = pblq_dt.row('.selected').data().id_point_bloquant;

            $.ajax({
                method: "POST",
                url: "api/pointbloquant/pointbloquant/save_info.php",
                data: info_pblq_formdata
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_info_add', null)) {

                    $("#add_info_form")[0].reset();

                    if(typeof pblq_info_dt !== 'undefined') {
                        pblq_info_dt.draw(false);
                    }
                }
            });
        });
    } );
</script>