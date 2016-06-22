<script>
    function resetform() {
        $("#add_project_form")[0].reset();
    };
    $(document).ready(function() {

        $("#message_project_add").hide();

        var uploader = $("#fileuploader").uploadFile({
            url: "api/projet_add.php",
            multiple:true,
            dragDrop:true,
            dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
            fileName: "myfile",
            autoSubmit: false,
            dynamicFormData: function()
            {
                var data ={
                    ville: $("#ville").val(),
                    trigramme_dept: $("#trigramme_dept").val(),
                    code_site_origine: $("#code_site_origine").val(),
                    type_site_origine: $("#type_site_origine").val(),
                    taille: $("#taille").val(),
                    etat_site_origine: $("#etat_site_origine").val(),
                    date_mad_site_origine: $("#date_mad_site_origine").val(),
                    nbr_fichiers : this.selectedFiles
                };
                return data;
            },
            multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",

            uploadStr:"Téléchargez",
            allowedTypes: "xlsx",
            afterUploadAll:function(obj) {
                //You can get data of the plugin using obj
                obj.reset();
                dt.draw(false);
                var r = obj.getResponses();
                var lastrep = App.getJsonObject(r[r.length - 1]);
                console.log(lastrep);
                if(lastrep.error != undefined) {
                    App.showMessage(lastrep, '#message_project_add', resetform);
                }
            }
        });

        $("#add_project").click(function() {
            uploader.startUpload();
        });


    } );
</script>
<!-- ajouter projet Modal -->
<div class="modal fade" id="add-project" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Ajouter projet</h3>
                </div>
                <div class="block-content">
                    <form id="add_project_form" class="js-validation-bootstrap form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="ville">Ville <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="ville" name="ville">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="trigramme_dept">Trigramme de la plaque + Dept sur deux chiffres <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="trigramme_dept" name="trigramme_dept">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="code_site_origine">Code site d’origine <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="code_site_origine" name="code_site_origine">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="type_site_origine">Type de Site d’origine <span class="text-danger">*</span></label>
                                <select class="form-control" id="type_site_origine" name="type_site_origine">
                                    <option value="" selected disabled>Séléctionnez type</option>
                                    <?php
                                        $types = SelectSiteOrigineType::all();
                                        foreach($types as $type) {
                                            echo "<option value=\"$type->id_site_origine_type\">$type->lib_site_origine_type</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="taille">Taille approximative en LR <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" id="taille" name="taille">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="etat_site_origine">Etat Site Origine <span class="text-danger">*</span></label>
                                <select class="form-control" id="etat_site_origine" name="etat_site_origine">
                                    <option value="" selected disabled>Séléctionnez état</option>
                                    <?php
                                        $states = SelectSiteOrigineEtat::all();
                                        foreach($states as $state) {
                                            echo "<option value=\"$state->id_site_origine_etat\">$state->lib_site_origine_etat</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="date_mad_site_origine">Date Mise à disposition site Origine <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="date_mad_site_origine" name="date_mad_site_origine">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="fileuploader">Fichiers contour ou SD<span class="text-danger">*</span></label>
                                <div id="fileuploader">SD ou Contour de plaque relatif au projet</div>
                            </div>
                        </div>

                        <!--<div class="form-group">
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="button">Enregistrer</button>
                            </div>
                        </div>-->
                    </form>
                    <div class='alert alert-success' id='message_project_add' role='alert'>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <button class="btn btn-sm btn-primary" id="add_project" type="button"><i class="fa fa-check"></i> Enregistrer</button>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter projet Modal -->