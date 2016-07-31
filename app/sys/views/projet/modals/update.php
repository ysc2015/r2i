<!-- modifier projet Modal -->
<div class="modal fade" id="update-project" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Modifier projet</h3>
                </div>
                <div class="block-content">
                    <div class="block">
                        <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs">
                            <li class="active">
                                <a href="#info_project_update_tab" data-toggle="tab">Infos Projet</a>
                            </li>
                            <li>
                                <a href="#cdp_update_tab" data-toggle="tab">Chef de projet</a>
                            </li>
                            <li>
                                <a href="#files_update_tab" data-toggle="tab">Fichiers contour (SD)</a>
                            </li>
                        </ul>
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="info_project_update_tab"><!--info_project_update_tab-->
                                <form class="js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="projet_update_ville">Ville <span class="text-danger">*</span></label>
                                                <select class="js-select2 form-control" id="projet_update_ville" name="projet_update_ville" size="1" style="width: 100%;" data-placeholder="Séléctionner départ/ville..">
                                                    <option value="">&nbsp;</option>
                                                    <?php
                                                    $villes = Ville::all();
                                                    foreach($villes as $ville) {
                                                        echo "<option value=\"$ville->code_ville\">$ville->code_ville - $ville->nom_ville</option>";
                                                    }
                                                    ?>
                                                </select>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="projet_update_dept">Trigramme de la plaque + Dept sur deux chiffres <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <!--<input class="form-control" type="text" id="projet_update_trigramme_dept" name="projet_update_trigramme_dept">-->
                                                    <span class="input-group-addon" id="projet_update_trigramme"></span>
                                                    <input class="form-control" type="text" id="projet_update_dept" name="projet_update_dept">
                                                </div>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="projet_update_code_site_origine">Code site d’origine <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="projet_update_code_site_origine" name="projet_update_code_site_origine">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="projet_update_type_site_origine">Type de Site d’origine</label>
                                                <select class="form-control" id="projet_update_type_site_origine" name="projet_update_type_site_origine" size="1">
                                                    <option value="" selected disabled>Séléctionnez type</option>
                                                    <?php
                                                        $types = SelectSiteOrigineType::all();
                                                        foreach($types as $type) {
                                                            echo "<option value=\"$type->id_site_origine_type\">$type->lib_site_origine_type</option>";
                                                    }
                                                    ?>
                                                </select>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="projet_update_taille">Taille approximative en LR <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="projet_update_taille" name="projet_update_taille">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="projet_update_etat_site_origine">Etat Site Origine</label>
                                                <select class="form-control" id="projet_update_etat_site_origine" name="projet_update_etat_site_origine" size="1">
                                                    <option value="" selected disabled>Séléctionnez état</option>
                                                    <?php
                                                        $states = SelectSiteOrigineEtat::all();
                                                        foreach($states as $state) {
                                                            echo "<option value=\"$state->id_site_origine_etat\">$state->lib_site_origine_etat</option>";
                                                    }
                                                    ?>
                                                </select>
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="projet_update_date_mad_site_origine">Date Mise à disposition site Origine <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date" id="projet_update_date_mad_site_origine" name="projet_update_date_mad_site_origine">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_project_update' role='alert'>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-mini block-content-full border-t">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <!--<button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>-->
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
                                                <button class="btn btn-success" id="update_project_infos" type="button">Valider <i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="cdp_update_tab">
                                <form class="js-form1 form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-material">
                                                <select class="form-control" id="projet_update_id_chef_projet" name="id_chef_projet" size="1">
                                                    <option value="" selected disabled>Séléctionnez chef de projet</option>
                                                    <?php

                                                    if($connectedProfil->id_profil_utilisateur == "3")
                                                    echo "<option value=\"$connectedProfil->id_utilisateur\">$connectedProfil->prenom_utilisateur $connectedProfil->nom_utilisateur</option>";
                                                    else {
                                                    $users = Utilisateur::all(
                                                    array('conditions' => array("id_profil_utilisateur = ?", 3)
                                                    )
                                                    );
                                                    foreach($users as $user) {
                                                    echo "<option value=\"$user->id_utilisateur\">$user->prenom_utilisateur $user->nom_utilisateur</option>";
                                                    }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_project_cdp_update' role='alert'>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-mini block-content-full border-t">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <!--<button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>-->
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <button class="btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
                                                <button class="btn btn-success" type="button" id="update_project_cdp">Valider <i class="fa fa-check"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="files_update_tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="fileuploader2"></div>
                                    </div>
                                    <div class="col-md-6" id="project_file_list">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter projet Modal -->
<script>
    var uploader2 = null;
    $(document).ready(function() {
        var msg_alerts = ["#message_project_update",
        "#message_project_cdp_update"];

        $(msg_alerts.join(',')).hide();

        uploader2 = $("#fileuploader2").uploadFile({
            url: "api/projet/projet_upload_files.php",
            multiple:true,
            dragDrop:true,
            dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
            fileName: "myfile",
            autoSubmit: true,
            dynamicFormData: function()
            {
                var data ={
                    idp: idp
                };
                return data;
            },
            multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",

            uploadStr:"Téléchargez",
            allowedTypes: "xlsx",
            afterUploadAll:function(obj) {
                upload_ok = true;
                App.getProjectFiles();
            }
        });

        $("#update_project_infos").click(function() {
            $.ajax({
                method: "POST",
                url: "api/projet/projet_update.php",
                data: {
                    idp: idp,
                    ville: $("#projet_update_ville").val(),
                    trigramme_dept: ($("#projet_update_dept").val()=="" ? "":('PLA' + $("#projet_update_ville").val() + '_' + $("#projet_update_dept").val())),
                    code_site_origine: $("#projet_update_code_site_origine").val(),
                    type_site_origine: $("#projet_update_type_site_origine").val(),
                    taille: $("#projet_update_taille").val(),
                    etat_site_origine: $("#projet_update_etat_site_origine").val(),
                    date_mad_site_origine: $("#projet_update_date_mad_site_origine").val()
                }
            }).done(function (message) {
                App.showMessage(message,'#message_project_update');
                dt.draw(false);
                $(btns.join(',')).addClass("disabled");
            });
        });

        $("#update_project_cdp").click(function() {
            $.ajax({
                method: "POST",
                url: "api/projet/projet_cdp_update.php",
                data: {
                    idp: idp,
                    id_chef_projet: $("#projet_update_id_chef_projet").val()
                }
            }).done(function (message) {
                App.showMessage(message,'#message_project_cdp_update');
                dt.draw(false);
                $(btns.join(',')).addClass("disabled");
            });
        });

        $("#projet_update_trigramme").html('PLA' + $("#projet_update_ville").val() + '_');

        //events
        $("#projet_update_ville").change(function() {
            $("#projet_update_trigramme").html('PLA' + $( this ).val() + '_');
        });
    } );
</script>