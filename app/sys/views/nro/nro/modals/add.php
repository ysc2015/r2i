<script>
    $(document).ready(function() {
        $("#message_nro_add").hide();
        $("#save_nro").click(function () {
            $("#message_nro_add").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/nro/nro/nro_add.php",
                data: {
                    idn : $("#nro").val(),
                    idu : $("#user").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_nro_add')) {
                    nro_dt.draw(false);
                    $(nro_btns.join(',')).addClass("disabled");
                    //$("#user").select2('val', 'All');
                    $("#nro").val('');
                }
            });
        });
    } );
</script>
<!-- ajouter mail creation Modal -->
<div class="modal fade" id="add-nro" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter Nro</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_nro_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="nro">Code site d’origine (Nro)<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="nro" name="nro">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="user">Utilisateur <span class="text-danger">*</span></label>
                                <select class="form-control" id="user" name="user" style="width: 100%;">
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
                        <div class='alert alert-success' id='message_nro_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_nro" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter mail creation Modal -->