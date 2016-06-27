<script>
    $(document).ready(function() {
        $("#message_mail_update").hide();
        $("#update_mail").click(function () {
            $("#message_mail_update").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/test/mailcreation_update.php",
                data: {
                    idm : dt.row('.selected').data().id_projet_mail_creation,
                    mail : $("#update_mail_value").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_mail_update')) {
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
                    <h3 class="block-title">Modifier Email</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="update_mail_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="update_mail_value">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="update_mail_value" name="update_mail_value">
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_mail_update' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="update_mail" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END modifier mail creation Modal -->