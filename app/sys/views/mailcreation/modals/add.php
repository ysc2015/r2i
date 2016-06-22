<script>
    $(document).ready(function() {
        $("#message_mail_add").hide();
        $("#save_mail").click(function () {
            $("#message_mail_add").fadeOut();
            $.ajax({
                method: "POST",
                url: "api/test/mailcreation_add.php",
                data: {
                    mail : $("#mail").val()
                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_mail_add')) {
                    $("#add_mail_form")[0].reset();
                    dt.draw(false);
                    $(btns.join(',')).addClass("disabled");
                }
            });
        });
    } );
</script>
<!-- ajouter mail creation Modal -->
<div class="modal fade" id="add-mail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter Mail</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="add_mail_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="mail">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="mail" name="mail">
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_mail_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_mail" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter mail creation Modal -->