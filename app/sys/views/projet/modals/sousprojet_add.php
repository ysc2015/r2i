<script>
    $(document).ready(function() {
        $("#message_sub_project_add").hide();
        $("#save_sub_project").click(function () {
            $("#message_sub_project_add").fadeOut();
            //console.log('clicked');
            //console.log(dt.row('.selected').data().id_projet);
            $.ajax({
                method: "POST",
                url: "api/sousprojet/sous_projet_add.php",
                data: {
                    idp: dt.row('.selected').data().id_projet,
                    dep: dt.row('.selected').data().ville,//ville
                    ville: dt.row('.selected').data().nom_ville,
                    plaque: dt.row('.selected').data().trigramme_dept,
                    zone: $('#sousprojet_zone').val()

                }
            }).done(function (msg) {
                if(App.showMessage(msg, '#message_sub_project_add', null))
                    $('#sousprojet_zone').val('');
                format ( {id_projet : dt.row('.selected').data().id_projet} ) ;
                //dataTable.draw(false);
            });
        });
    } );
</script>
<!-- ajouter projet Modal -->
<div class="modal fade" id="add-subproject" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter sous projet</h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="sous_project_form">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="sousprojet_dep">Département <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" id="sousprojet_dep" name="sousprojet_dep" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="sousprojet_ville">Ville <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="sousprojet_ville" name="sousprojet_ville" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="sousprojet_plaque">Plaque <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="sousprojet_plaque" name="sousprojet_plaque" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="sousprojet_zone">Zone <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="sousprojet_zone" name="sousprojet_zone">
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_sub_project_add' role='alert'>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="save_sub_project" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter projet Modal -->