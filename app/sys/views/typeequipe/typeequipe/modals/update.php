<!-- modifier type equipe Modal -->
<div class="modal fade" id="mod-type-eq" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier type équipe</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="update_type_eq_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="update_lib_type_eq">Lib type équipe<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="update_lib_type_eq" name="update_lib_type_eq">
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_type_eq_update' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_type_eq_update" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier type equipe Modal -->
<script>
    $(document).ready(function() {

        $("#save_type_eq_update").click(function() {
            $.ajax({
                method: "POST",
                url: "api/typeequipe/typeequipe/typeequipe_update.php",
                dataType: "json",
                data: {
                    idt : type_eq_dt.row('.selected').data().id_equipe_types,
                    lib : $('#update_lib_type_eq').val()
                }
            }).done(function (message) {
                if(message.error == 0) {
                    update = true;
                }
                App.showMessage(message,'#message_type_eq_update');
            });
        });

        $('#mod-type-eq').on('hidden.bs.modal', function () {
            if(update) {
                type_eq_dt.draw(false);
            }
        })
    } );
</script>