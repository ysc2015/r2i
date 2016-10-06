<script>
    $(document).ready(function() {
        $("#message_user_update").hide();
        $("#update_user").click(function () {
            $("#message_user_update").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/utilisateur/free/user_update.php",
                data: {
                    idu : users_dt.row('.selected').data().id_utilisateur,
                    nom : $("#user_update_nom").val(),
                    prenom : $("#user_update_prenom").val(),
                    email : $("#user_update_email").val(),
                    pwd : $("#user_update_pwd").val(),
                    profil : $("#user_update_profil").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_user_update')) {
                    users_dt.draw(false);
                    $(users_btns.join(',')).addClass("disabled");
                }
            });
        });
    } );
</script>
<!-- modifier utilisateur Modal -->
<div class="modal fade" id="update-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier Utilisateur</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="update_user_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user_update_nom">Nom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="user_update_nom" name="user_update_nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user_update_prenom">Prénom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="user_update_prenom" name="user_update_prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user_update_email">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="user_update_email" name="user_update_email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user_update_pwd">Mot de passe <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="user_update_pwd" name="user_update_pwd" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <select class="form-control" id="user_update_profil" name="user_update_profil" size="1">
                                    <option value="" selected disabled>Séléctionnez Profil</option>
                                    <?php
                                    $profils = Profil::all(
                                        array('conditions' => array("id_profil_utilisateur != ?", 2)
                                        )
                                    );
                                    foreach($profils as $profil) {
                                        echo "<option value=\"$profil->id_profil_utilisateur\">$profil->lib_profil_utilisateur</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_user_update' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="update_user" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier utilisateur Modal -->