<!-- voir question/correction Modal -->
<div class="modal fade" id="question-correction" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title" id="question-correction-title"></h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="question_correction_form">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="text1" id="label1"></label>
                                <textarea readonly class="form-control" id="text1" name="text1" rows="6"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="text2" id="label2"></label>
                                <textarea readonly class="form-control" id="text2" name="text2" rows="6"></textarea>
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_save_rep' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_rep" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END voir question/correction Modal -->

<script>

    $(document).ready(function() {

        $('#save_rep').click(function (){
            $.ajax({
                method: "POST",
                url: "api/ot/ot/update_blq_rep.php",
                dataType: "json",
                data: {
                    idblq : blq_pbc_dt.row('.selected').data().id_blq_pbc,
                    reponse_ajustement : $('#text2').val()
                }
            }).done(function (message) {
                if(message.error == 0) {
                    blq_pbc_dt.draw(false);
                    //blq_pbc_dt.ajax.url( 'api/ot/ot/ot_blq_pbc_liste.php?type=1&idot='+(ot_dt.row('.selected').data()!=undefined?ot_dt.row('.selected').data().id_ordre_de_travail:-1) ).load();
                }
                App.showMessage(message,'#message_save_rep');
            });
        });
    } );
</script>