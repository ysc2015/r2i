<script>
    $(document).ready(function() {
        $("#message_tablette_update").hide();
        $("#update_tablette").click(function () {
            $("#message_tablette_update").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/tablette/tablette_update.php",
                data: {
                    idt : dt.row('.selected').data().id_tablette,
                    imei : $("#tablette_update_imei").val(),
                    company : $("#tablette_update_company").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_tablette_update')) {
                    dt.draw(false);
                    $(btns.join(',')).addClass("disabled");
                }
            });
        });
    } );
</script>
<!-- modifier mail creation Modal -->
<div class="modal fade" id="update-tablette" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier Tablette</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="update_tablette_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="tablette_update_imei">Imei <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="tablette_update_imei" name="tablette_update_imei">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="tablette_update_company">Entreprise STT <span class="text-danger">*</span></label>
                                <select class="form-control" id="tablette_update_company" name="tablette_update_company" size="1">
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
                        <div class='alert alert-success' id='message_tablette_update' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="update_tablette" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier mail creation Modal -->