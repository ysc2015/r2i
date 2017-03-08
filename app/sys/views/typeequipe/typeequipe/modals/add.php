<!-- ajouter type equipe Modal -->
<div class="modal fade" id="add-type-eq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter type équipe</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_type_eq_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="lib_type_eq">Lib type équipe<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="lib_type_eq" name="lib_type_eq">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="visible_a2t">Visible A2T <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control" id="visible_a2t" name="visible_a2t" size="1" style="width: 100%;" data-placeholder="Séléctionner une valeur..">
                                    <option value="" selected>Séléctionnez une valeur</option>
                                    <option value="1">OUI</option>
                                    <option value="2">NON</option>
                                </select>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_type_eq_add' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_type_eq" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter type equipe Modal -->
<script>
    $(document).ready(function() {

        $("#save_type_eq").click(function() {
            $.ajax({
                method: "POST",
                url: "api/typeequipe/typeequipe/typeequipe_add.php",
                dataType: "json",
                data: {
                    lib : $('#lib_type_eq').val(),
                    visa2t : $('#visible_a2t').val()
                }
            }).done(function (message) {
                if(message.error == 0) {
                    type_eq_dt.draw(false);
                    $("#add_type_eq_form")[0].reset();
                    //$('#lib_type_eq').val('');
                }
                App.showMessage(message,'#message_type_eq_add');
            });
        });
    } );
</script>