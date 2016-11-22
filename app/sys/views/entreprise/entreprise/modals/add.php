<!-- ajouter entreprise Modal -->
<div class="modal fade" id="add-entreprise" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter Entreprise STT</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="entreprise_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="entreprise_nom">Nom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_nom" name="entreprise_nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="entreprise_code">Code entreprise <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_code" name="entreprise_code">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="entreprise_adresse_siege">Adresse siége <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_adresse_siege" name="entreprise_adresse_siege">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="entreprise_adresse_livraison">Adresse livraison <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_adresse_livraison" name="entreprise_adresse_livraison">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="entreprise_gerant_entreprise">Gérant <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_gerant_entreprise" name="entreprise_gerant_entreprise">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="entreprise_contact_nom">Contact nom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_contact_nom" name="entreprise_contact_nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="entreprise_contact_prenom">Contact prénom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_contact_prenom" name="entreprise_contact_prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="entreprise_contact_tel_mobile">Contact mobile <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_contact_tel_mobile" name="entreprise_contact_tel_mobile">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="entreprise_contact_tel_fixe">Contact tél fixe<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_contact_tel_fixe" name="entreprise_contact_tel_fixe">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="entreprise_contact_email">Contact émail <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="entreprise_contact_email" name="entreprise_contact_email">
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_entreprise_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_entreprise" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter entreprise Modal -->
<script>
    $(document).ready(function() {

        $("#message_entreprise_add").hide();

        $("#save_entreprise").click(function () {
            $.ajax({
                method: "POST",
                url: "api/entreprise/entreprise/entreprise_add.php",
                data: {
                    nom: $('#entreprise_nom').val(),
                    code: $('#entreprise_code').val(),
                    adresse_siege: $('#entreprise_adresse_siege').val(),
                    adresse_livraison: $('#entreprise_adresse_livraison').val(),
                    gerant_entreprise: $('#entreprise_gerant_entreprise').val(),
                    contact_nom: $('#entreprise_contact_nom').val(),
                    contact_prenom: $('#entreprise_contact_prenom').val(),
                    contact_tel_mobile: $('#entreprise_contact_tel_mobile').val(),
                    contact_tel_fixe: $('#entreprise_contact_tel_fixe').val(),
                    contact_email: $('#entreprise_contact_email').val()

                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_entreprise_add')) {
                    $("#entreprise_form")[0].reset();
                    entreprise_dt.draw(false);
                }
            });
        });

    } );
</script>