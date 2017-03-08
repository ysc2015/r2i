<script>
    $(document).ready(function() {
        $("#message_equipe_update").hide();
        $("#update_equipe").click(function () {
            $("#message_equipe_update").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/entreprise/equipe/equipe_update.php",
                data: {
                    ide: equipe_dt.row('.selected').data().id_equipe_stt,
                    imei: $('#equipe_update_imei').val(),
                    nom: $('#equipe_update_nom').val(),
                    prenom: $('#equipe_update_prenom').val(),
                    tel: $('#equipe_update_tel').val(),
                    mail: $('#equipe_update_mail').val(),
                    type_equipe: $('#equipe_type_equipe').val()


                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_equipe_update')) {
                    update = true;
                }
            });
        });

        $('#update-equipe').on('hidden.bs.modal', function () {
            if(update) {
                equipe_dt.draw(false);
            }
        })
    } );
</script>
<!-- modifier equipe Modal -->
<div class="modal fade" id="update-equipe" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier équipe</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="equipe_update_form">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="equipe_update_imei">IMEI <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_update_imei" name="equipe_update_imei">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_update_nom">Nom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_update_nom" name="equipe_update_nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_update_prenom">Prénom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_update_prenom" name="equipe_update_prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_update_tel">Tél <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_update_tel" name="equipe_update_tel">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_update_mail">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_update_mail" name="equipe_update_mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_type_equipe">Type équipe <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control " id="equipe_type_equipe" name="equipe_type_equipe">
                                    <option value="" selected="">Sélectionnez un type</option>
                                    <?php
                                    $results = TypeEquipeSTT::all();
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_equipe_types\" >$result->lib_type</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_equipe_update' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="update_equipe" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier equipe Modal -->