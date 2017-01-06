<!-- modifier pbt info Modal -->
<div class="modal fade" id="update-info" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier Info(suivi)</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="update_info_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="uinfo_ville">Ville <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="text" id="uinfo_ville" name="uinfo_ville">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="uinfo_planches">Planches <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="number" id="uinfo_planches" name="uinfo_planches">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="uinfo_chambre1">Chambre 1 <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="text" id="uinfo_chambre1" name="uinfo_chambre1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="uinfo_chambre2">Chambre 2 <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control" type="text" id="uinfo_chambre2" name="uinfo_chambre2">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="uinfo_id_pci_user">Intervenant PCI <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="uinfo_id_pci_user" name="uinfo_id_pci_user">
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
                                <label for="uinfo_id_bei_user">Intervenant BEI <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="uinfo_id_bei_user" name="uinfo_id_bei_user">
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
                                <label for="uinfo_id_type_traitement_pbt">Traitement <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="uinfo_id_type_traitement_pbt" name="uinfo_id_type_traitement_pbt">
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
                                <label for="uinfo_commentaire">Commentaire <!--<span class="text-danger">*</span>--></label>
                                <textarea class="form-control" id="uinfo_commentaire" name="uinfo_commentaire" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="uinfo_date_rendu">Date rendu <!--<span class="text-danger">*</span>--></label>
                                <input class="form-control " type="date" id="uinfo_date_rendu" name="uinfo_date_rendu">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="uinfo_id_solution_traitement_pbt">Solutions <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="uinfo_id_solution_traitement_pbt" name="uinfo_id_solution_traitement_pbt">
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
                                <label for="uinfo_id_entreprise">Prestataire <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="uinfo_id_entreprise" name="uinfo_id_entreprise">
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
                        <div class='alert alert-success' id='message_info_update' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="update_info" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier pbt info Modal -->
<script>
    var uinfo_pblq_formdata = {};
    $(document).ready(function() {
        $("#message_info_update").hide();

        $('#update_info_form *').filter('.form-control:enabled:not([readonly])').each(function(){
            uinfo_pblq_formdata[$( this ).attr('name')] = $( this).val();
        });

        $("#update_info").click(function () {
            $("#message_info_update").fadeOut();

            for (var key in uinfo_pblq_formdata) {
                uinfo_pblq_formdata[key] = $('#'+key).val();
            }

            uinfo_pblq_formdata['suffix'] = 'uinfo';
            uinfo_pblq_formdata['idpi'] = pblq_info_dt.row('.selected').data().id_traitement_pbt;

            $.ajax({
                method: "POST",
                url: "api/pointbloquant/pointbloquant/update_info.php",
                data: uinfo_pblq_formdata
            }).done(function (msg) {
                var obj = JSON.parse(msg);
                if(obj.error == 0) {
                    update_pblq_info = true;
                }
                App.showMessage(msg,'#message_info_update');
            });
        });

        $('#update-info').on('hidden.bs.modal', function () {
            if(update_pblq_info) {
                pblq_info_dt.draw(false);
            }
        })
    } );
</script>