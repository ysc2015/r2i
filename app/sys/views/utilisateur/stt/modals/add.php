<script>
    $(document).ready(function() {
        $("#message_stt_add").hide();
        $("#save_stt").click(function () {
            $("#message_stt_add").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/utilisateur/stt/user_add.php",
                data: {
                    nom : $("#stt_add_nom").val(),
                    prenom : $("#stt_add_prenom").val(),
                    email : $("#stt_add_email").val(),
                    pwd : $("#stt_add_pwd").val(),
                    company : $("#stt_add_company").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_stt_add')) {
                    $("#add_stt_form")[0].reset();
                    susers_dt.draw(false);
                    $(susers_btns.join(',')).addClass("disabled");
                }
            });
        });
    } );
</script>
<!-- ajouter utilisateur stt Modal -->
<div class="modal fade" id="add-stt" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter Utilisateur STT</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_stt_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_add_nom">Nom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="stt_add_nom" name="stt_add_nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_add_prenom">Prénom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="stt_add_prenom" name="stt_add_prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_add_email">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="stt_add_email" name="stt_add_email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_add_pwd">Mot de passe <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="stt_add_pwd" name="stt_add_pwd">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_add_company">Entreprise STT <span class="text-danger">*</span></label>
                                <select class="form-control" id="stt_add_company" name="stt_add_company" size="1">
                                    <option value="" selected disabled>Séléctionnez Entreprise STT</option>
                                    <?php
                                    $companies = EntrepriseSTT::all();
                                    foreach($companies as $company) {
                                        echo "<option value=\"$company->id_entreprise\">$company->nom</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_stt_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_stt" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter utilisateur stt Modal -->