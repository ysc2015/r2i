<script>
    $(document).ready(function() {
        $("#message_stt_update").hide();
        $("#update_stt").click(function () {
            $("#message_stt_update").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/utilisateur/stt/user_update.php",
                data: {
                    idu : susers_dt.row('.selected').data().id_utilisateur,
                    nom : $("#stt_update_nom").val(),
                    prenom : $("#stt_update_prenom").val(),
                    email : $("#stt_update_email").val(),
                    pwd : $("#stt_update_pwd").val(),
                    company : $("#stt_update_company").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_stt_update')) {
                    susers_dt.draw(false);
                    $(susers_btns.join(',')).addClass("disabled");
                }
            });
        });
    } );
</script>
<!-- modifier utilisateur Modal -->
<div class="modal fade" id="update-stt" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier Utilisateur STT</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="update_stt_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_update_nom">Nom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="stt_update_nom" name="stt_update_nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_update_prenom">Prénom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="stt_update_prenom" name="stt_update_prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_update_email">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="stt_update_email" name="stt_update_email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_update_pwd">Mot de passe <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="stt_update_pwd" name="stt_update_pwd" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="stt_update_company">Entreprise STT <span class="text-danger">*</span></label>
                                <select class="form-control" id="stt_update_company" name="stt_update_company" size="1">
                                    <option value="" selected disabled>Séléctionnez Entreprise STT</option>
                                    <?php
                                    $companies = SelectEntreprise::all();
                                    foreach($companies as $company) {
                                        echo "<option value=\"$company->id_entreprise\">$company->lib_entreprise</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_stt_update' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="update_stt" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier utilisateur stt Modal -->