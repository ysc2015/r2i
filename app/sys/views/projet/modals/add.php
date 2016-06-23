<!-- ajouter projet Modal -->
<div class="modal fade" id="add-project"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
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
                    <!-- Validation Wizard (.js-wizard-validation class is initialized in js/pages/base_forms_wizard.js) -->
                    <!-- For more examples you can check out http://vadimg.com/twitter-bootstrap-wizard-example/ -->
                    <div class="js-wizard-validation block">
                        <!-- Step Tabs -->
                        <ul class="nav nav-tabs nav-tabs-alt nav-justified">
                            <li class="active">
                                <a class="inactive" href="#validation-step1" data-toggle="tab">1. Info Projet</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step2" data-toggle="tab">2. Chef de projet</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step3" data-toggle="tab">3. Fichiers contour</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step4" data-toggle="tab">4. Envoi de mail</a>
                            </li>
                        </ul>
                        <!-- END Step Tabs -->

                        <!-- Form -->
                        <!-- jQuery Validation (.js-form2 class is initialized in js/pages/base_forms_wizard.js) -->
                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form id="info_project_form" class="js-form1 form-horizontal">
                            <!-- Steps Content -->
                            <div class="block-content tab-content">
                                <!-- Step 1 -->
                                <div class="tab-pane fade fade-right in push-30-t push-50 active" id="validation-step1">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <!--<label for="ville">Ville <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="ville" name="ville">-->
                                                <label for="ville">Ville <span class="text-danger">*</span></label>
                                                <select class="js-select2 form-control" id="ville" name="ville" size="1" style="width: 100%;" data-placeholder="Séléctionner départ/ville..">
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
                                                <label for="trigramme_dept">Trigramme de la plaque + Dept sur deux chiffres <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="trigramme_dept" name="trigramme_dept">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="code_site_origine">Code site d’origine <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="code_site_origine" name="code_site_origine">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="type_site_origine">Type de Site d’origine</label>
                                                <select class="form-control" id="type_site_origine" name="type_site_origine" size="1">
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
                                                <label for="taille">Taille approximative en LR <span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" id="taille" name="taille">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <label for="etat_site_origine">Etat Site Origine</label>
                                                <select class="form-control" id="etat_site_origine" name="etat_site_origine" size="1" style="width: 100%;">
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
                                                <label for="date_mad_site_origine">Date Mise à disposition site Origine <span class="text-danger">*</span></label>
                                                <input class="form-control" type="date" id="date_mad_site_origine" name="date_mad_site_origine">
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_project_add' role='alert'>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 1 -->

                                <!-- Step 2 -->
                                <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step2">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <!--<div class="form-material">-->
                                                <select class="form-control" id="id_chef_projet" name="id_chef_projet" size="1">
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
                                            <!--</div>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_cdp_update' role='alert'>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 2 -->

                                <!-- Step 3 -->
                                <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step3">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="fileuploader">Fichiers contour ou SD<span class="text-danger">*</span></label>
                                            <div id="fileuploader">SD ou Contour de plaque relatif au projet</div>
                                            <div class='alert alert-success' id='message_files_upload' role='alert'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 3 -->
                                <!-- Step 4 -->
                                <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step4">
                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div id="progress_loader_message" class="progress active">
                                                <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Envoi de mail en cours ...</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class='alert alert-success' id='message_send_mail' role='alert'>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 4 -->
                            </div>
                            <!-- END Steps Content -->

                            <!-- Steps Navigation -->
                            <div class="block-content block-content-mini block-content-full border-t">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <!--<button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>-->
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <button class="wizard-next btn btn-success" type="button">Valider <i class="fa fa-arrow-circle-o-right"></i></button>
                                        <button class="wizard-finish btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
                                    </div>
                                </div>
                            </div>
                            <!-- END Steps Navigation -->
                        </form>
                        <!-- END Form -->
                    </div>
                    <!-- END Validation Wizard Wizard -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END ajouter projet Modal -->
<script>
    var id = 0;
    var uploader = null;
    var upload_ok = false;
    var cdp_fullname = undefined;
    // Init wizards with validation, for more examples you can check out http://vadimg.com/twitter-bootstrap-wizard-example/
    var initWizardValidation = function(){
        // Get forms
        var $form = jQuery('.js-form1');

        // Prevent forms from submitting on enter key press
        $form.on('keyup keypress', function (e) {
            var code = e.keyCode || e.which;

            if (code === 13) {
                e.preventDefault();
                return false;
            }
        });

        // Init wizard with validation
        jQuery('.js-wizard-validation').bootstrapWizard({
            'tabClass': '',
            /*'previousSelector': '.wizard-prev',*/
            'nextSelector': '.wizard-next',
            'onTabShow': function($tab, $nav, $index) {
                var $total      = $nav.find('li').length;
                var $current    = $index + 1;

                // Get vital wizard elements
                var $wizard     = $nav.parents('.block');
                var $btnNext    = $wizard.find('.wizard-next');
                var $btnFinish  = $wizard.find('.wizard-finish');

                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $btnNext.hide();
                    $btnFinish.show();
                } else {
                    $btnNext.show();
                    $btnFinish.hide();
                }

                console.log('project id = ' + id);
                console.log('index = ' + $index);//message_cdp_update

                switch ($index) {
                    case 1 : {
                        console.log('message_cdp_update');
                        $("#message_cdp_update").fadeIn(500);
                        $("#message_cdp_update").html('<p>Le projet est créé !</p><p>il est accessible dana la liste des projet</p>');
                        $("#message_cdp_update").fadeOut(5000);
                        break;
                    }
                    case 2 : {
                        console.log('message_files_upload');
                        $("#message_files_upload").fadeIn(500);
                        $("#message_files_upload").html('<p>Le projet est affecté à <strong>'+cdp_fullname+'</strong></p>');
                        $("#message_files_upload").fadeOut(5000);
                        break;
                    }
                    case 3 : {
                        $.ajax({
                            method: "POST",
                            url: "api/projet/projet_send_mail.php",
                            data: {
                                idp: id
                            }
                        }).done(function (message) {
                            $("#progress_loader_message").hide();
                            App.showMessage(message,'#message_send_mail');
                        });
                        break;
                    }
                }
            },
            'onNext': function($tab, $navigation, $index) {
                var ret = false;
                switch ($index) {
                    case 1 : {
                        $.ajax({
                            method: "POST",
                            url: "api/projet/projet_add.php",
                            async: false,
                            data: {
                                ville: $("#ville").val(),
                                trigramme_dept: $("#trigramme_dept").val(),
                                code_site_origine: $("#code_site_origine").val(),
                                type_site_origine: $("#type_site_origine").val(),
                                taille: $("#taille").val(),
                                etat_site_origine: $("#etat_site_origine").val(),
                                date_mad_site_origine: $("#date_mad_site_origine").val()
                            }
                        }).done(function (message) {
                            var obj = $.parseJSON(message);
                            id = obj.id;
                            ret = App.showMessage(message,'#message_project_add');
                            dt.draw(false);
                            $(btns.join(',')).addClass("disabled");
                        });
                        break;
                    }
                    case 2 : {
                        $.ajax({
                            method: "POST",
                            url: "api/projet/projet_cdp_update.php",
                            async: false,
                            data: {
                                idp: id,
                                id_chef_projet: $("#id_chef_projet").val()
                            }
                        }).done(function (message) {
                            var obj = $.parseJSON(message);
                            cdp_fullname = obj.cdp;
                            dt.draw(false);
                            ret = App.showMessage(message,'#message_cdp_update');
                        });
                        break;
                    }
                    case 3 : {
                        ret = upload_ok;
                        break;
                    }
                    case 4 : {
                        ret = true;
                        break;
                    }
                }

                return ret;
            },
            onTabClick: function($tab, $navigation, $index) {
                return false;
            }
        });
    };
    $(document).ready(function() {
        var msg_alerts = ["#message_project_add",
            "#message_cdp_update",
            "#message_send_mail",
            "message_files_upload"];

        $(msg_alerts.join(',')).hide();

        //$("#ville").select2();

        initWizardValidation();
        uploader = $("#fileuploader").uploadFile({
            url: "api/projet/projet_upload_files.php",
            multiple:true,
            dragDrop:true,
            dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
            fileName: "myfile",
            autoSubmit: true,
            dynamicFormData: function()
            {
                var data ={
                    idp: id
                };
                return data;
            },
            multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",

            uploadStr:"Téléchargez",
            allowedTypes: "xlsx",
            afterUploadAll:function(obj) {
                upload_ok = true;
                //You can get data of the plugin using obj
                //obj.reset();

                //console.log(obj.getResponses());
            }
        });
    } );
</script>