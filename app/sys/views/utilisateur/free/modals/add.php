<script>
    $(document).ready(function() {
        $("#message_user_add").hide();
        $("#save_user").click(function () {
            $("#message_user_add").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/utilisateur/free/user_add.php",
                data: {
                    nom : $("#user_add_nom").val(),
                    prenom : $("#user_add_prenom").val(),
                    email : $("#user_add_email").val(),
                    pwd : $("#user_add_pwd").val(),
                    profil : $("#user_add_profil").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_user_add')) {
                    $("#add_user_form")[0].reset();
                    users_dt.draw(false);
                    $(users_btns.join(',')).addClass("disabled");
                }
            });
        });
    } );
</script>
<!-- ajouter utilisateur Modal -->
<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter Utilisateur</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_user_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user_add_nom">Nom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="user_add_nom" name="user_add_nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user_add_prenom">Prénom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="user_add_prenom" name="user_add_prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user_add_email">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="user_add_email" name="user_add_email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user_add_pwd">Mot de passe <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="user_add_pwd" name="user_add_pwd" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <select class="form-control" id="user_add_profil" name="user_add_profil" size="1">
                                    <option value="" selected disabled>Séléctionnez Profil</option>
                                    <?php
                                    $profils = Profil::all(
                                        array('conditions' => array("id_profil_utilisateur != ?", 1)
                                        )
                                    );
                                    foreach($profils as $profil) {
                                        echo "<option value=\"$profil->id_profil_utilisateur\">$profil->lib_profil_utilisateur</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_user_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_user" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter utilisateur Modal -->