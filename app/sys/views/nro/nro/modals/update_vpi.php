<script>
    $(document).ready(function() {
        $("#message_nro_update").hide();
        $("#save_nro_update").click(function () {
            $("#message_nro_update").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/nro/nro/nro_update_vpi.php",
                data: {
                    idnro: nro_dt.row('.selected').data().id_nro,
                    idu : $("#update_user").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_nro_update')) {
                    nro_dt.draw(false);
                    $(nro_btns.join(',')).addClass("disabled");
                }
            });
        });
    } );
</script>
<!-- modifier nro creation Modal -->
<div class="modal fade" id="update-nro" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier Nro</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_nro_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="update_nro">Code site d’origine (Nro)<span class="text-danger">*</span></label>
                                <input readonly class="form-control" type="text" id="update_nro" name="update_nro">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="update_user">Utilisateur <span class="text-danger">*</span></label>
                                <select class="form-control" id="update_user" name="update_user" style="width: 100%;">
                                    <option value="" selected="">Sélectionnez un utilisateur</option>
                                    <?php
                                    $results = Utilisateur::all(array('conditions' => array("id_profil_utilisateur = ?", 7)));
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_utilisateur\" ". ($sousProjet->transportrecette!==NULL && $sousProjet->transportrecette->doe==$result->id_utilisateur ?"selected": "")." >$result->prenom_utilisateur $result->nom_utilisateur</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_nro_update' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_nro_update" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier nro creation Modal -->