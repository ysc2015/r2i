<script>
    $(document).ready(function() {
        $("#message_equipe_add").hide();
        $("#save_equipe").click(function () {

            $("#message_equipe_add").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/entreprise/entreprise/equipe_add.php",
                data: {
                    ide: entreprise_dt.row('.selected').data().id_entreprise,
                    imei: $('#equipe_imei').val(),
                    nom: $('#equipe_nom').val(),
                    prenom: $('#equipe_prenom').val(),
                    tel: $('#equipe_tel').val(),
                    mail: $('#equipe_mail').val(),
                    type_equipe: $('#type_equipe').val()


                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_equipe_add')) {
                    $("#equipe_add_form")[0].reset();
                    equipe_dt.draw((false));
                }
            });
        });
    } );
</script>
<!-- ajouter equipe Modal -->
<div class="modal fade" id="add-equipe" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter équipe</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="equipe_add_form">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="equipe_imei">IMEI <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_imei" name="equipe_imei">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_nom">Nom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_nom" name="equipe_nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_prenom">Prénom <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_prenom" name="equipe_prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_tel">Tél <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_tel" name="equipe_tel">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="equipe_mail">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="equipe_mail" name="equipe_mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="type_equipe">Type équipe <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control " id="type_equipe" name="type_equipe">
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
                        <div class='alert alert-success' id='message_equipe_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_equipe" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter equipe Modal -->