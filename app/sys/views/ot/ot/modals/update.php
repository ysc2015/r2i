<!-- modifier ot Modal -->
<div class="modal fade" id="update-ot" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">modifier ordre de travail</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="update_ot_form">
                        <div class="form-group">
                            <div class="col-md-10">
                                <label for="update_commentaire">Commentaire <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="update_commentaire" name="update_commentaire" rows="6" placeholder="Commentaire.."></textarea>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_ot_update' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="update_ot" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier ot Modal -->
<script>
    $(document).ready(function() {

        $("#update_ot").click(function() {
            $.ajax({
                method: "POST",
                url: "api/ot/ot/ot_update.php",
                dataType: "json",
                data: {
                    idot : ot_dt.row('.selected').data().id_ordre_de_travail,
                    /*type_ot : $('#update_type_ot').val(),
                    type_ot_text : $('#update_type_ot option:selected').text(),*/
                    commentaire : $('#update_commentaire').val()
                }
            }).done(function (message) {
                if(message.error == 0) {
                    update = true;
                    getTypeOT('#update_type_ot');
                }
                App.showMessage(message,'#message_ot_update');
            });
        });

        $('#update-ot').on('hidden.bs.modal', function () {
            if(update) {
                ot_dt.draw(false);
            }
        })
    } );
</script>