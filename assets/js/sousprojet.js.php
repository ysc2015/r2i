<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : sousprojet.js
 *  Author     : RR
 *  Description: sousprojet forms js code
 *
 */

//global vars

var id_ta = undefined;
var id_tt = undefined;
var id_tr = undefined;

var id_da = undefined;
var id_dt = undefined;
var id_dr = undefined;

function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
}
var deleteFile = function (id,callback) {
    $.ajax({
        method: "POST",
        url: "api/file/delete.php",
        data: {
            id: id
        }
    }).done(function (message) {
        //console.log(message);
        callback();
    });
};


var getSurveyFilesTo = function() {
    $.ajax({
        method: "POST",
        url: "api/sousprojet/get_survey_files.php",
        data: {
            idsp: get('idsousprojet'),
            type_objet: 'liste_adr_survey_to'
        }
    }).done(function (message) {
        var obj = $.parseJSON(message);
        var html;
        if(obj.files.length > 0) {
            html = '<div class="alert alert-info alert-dismissable">';
            $.each(obj.files,function(key,val) {
                html +='<button type="button" class="close" aria-hidden="true" onclick="deleteFile('+val.id_ressource+',getSurveyFilesTo)">×</button>';
                html +='<p><a class="alert-link" href="api/file/download.php?id='+val.id_ressource+'">'+val.nom_fichier+'</a></p>';
            });
        } else {
            html = '<div class="alert alert-warning alert-dismissable">';
            html += '<p>aucun fichier survey adresses trouvé !</p>';
        }

        html +='</div>';
        html +='</div>';

        $("#survey_bei_files").html(html);
    });
};
var getSurveyFilesBack = function() {
    $.ajax({
        method: "POST",
        url: "api/sousprojet/get_survey_files.php",
        data: {
            idsp: get('idsousprojet'),
            type_objet: 'liste_adr_survey_back'
        }
    }).done(function (message) {
        var obj = $.parseJSON(message);
        var html;
        if(obj.files.length > 0) {
            html = '<div class="alert alert-success alert-dismissable">';
            $.each(obj.files,function(key,val) {
                html +='<button type="button" class="close" aria-hidden="true" onclick="deleteFile('+val.id_ressource+',getSurveyFilesBack)">×</button>';
                html +='<p><a class="alert-link" href="api/file/download.php?id='+val.id_ressource+'">'+val.nom_fichier+'</a></p>';
            });
        } else {
            html = '<div class="alert alert-warning alert-dismissable">';
            html += '<p>aucun fichier survey adresses retour trouvé !</p>';
        }

        html +='</div>';
        html +='</div>';

        $("#survey_vip_files").html(html);
    });
};

var template = function() {
    var initTabs = function() {

        init();
        initEvents();
    }
    var init = function() {
    }
    var initEvents = function() {
    }
    return {
        init : init,
        initEvents : initEvents,
        initTabs : initTabs
    };
}();

var SProjet = function() {
    var ids = get('idsousprojet');
    var infozone = function() {
        var done = $.Deferred();
        var sousprojet_formdata = {};
        var infoplaque_formdata = {};
        var zone_formdata = {};
        var siteorigine_formdata = {};
        var infoplaque_isnew = undefined;
        var zone_isnew = undefined;
        var siteorigine_isnew = undefined;
        var refresh = function() {
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet')
                },
                url: "api/sousprojet/get_entries_by_id.php"
            }).done(function (msg) {

                var obj = JSON.parse(msg);
                //console.log(obj);

                id_da = obj.id_da;
                id_dt = obj.id_dt;

                id_ta = obj.id_ta;
                id_tt = obj.id_tt;

                initTabs();
            });
        }
        var initTabs = function() {
            $("#infozone_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet')
                },
                url: "api/sousprojet/blocks/infozone_block.php"
            }).done(function (msg) {
                $("#infozone_block_content").html(msg);
                $("#infozone_block").removeClass('block-opt-refresh');

                done.resolve();

                init();
                initEvents();
            });
        }
        var init = function() {
            $("#message_infozone_nom").hide();
            $("#message_infozone_plaque").hide();
            $("#message_infozone_zone").hide();
            $("#message_infozone_site_origine").hide();

            infoplaque_isnew = ($("#id_sous_projet_plaque").val()?false:true);
            zone_isnew = ($("#id_sous_projet_zone").val()?false:true);
            siteorigine_isnew = ($("#id_sous_projet_site_origine").val()?false:true);
        }
        var initEvents = function() {
            $("#id_sous_projet_btn").click(function() {
                $("#message_infozone_nom").fadeOut();
                $.ajax({
                    method: "POST",
                    url: "api/sousprojet/sous_projet_update.php",
                    data: {
                        ids : get('idsousprojet'),
                        zone : $("#zone").val()
                    }
                }).done(function (msg) {
                    //console.log(msg);
                    App.showMessage(msg, '#message_infozone_nom');
                });
            });
            $("#id_sous_projet_plaque_btn").click(function () {
                $("#message_infozone_plaque").fadeOut();
                $("#infozone_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (infoplaque_isnew?"api/sousprojet/infoplaque_add.php":"api/sousprojet/infoplaque_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        phase: $('#phase').val(),
                        type: $('#type').val()

                    }
                }).done(function (msg) {
                    $("#infozone_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_infozone_plaque')) {
                        $("#id_sous_projet_plaque_alert").hide();
                        infoplaque_isnew = false;

                        //
                        SProjet.gestionplaque.refresh();
                    }
                });
            });
            $("#id_sous_projet_zone_btn").click(function () {
                $("#message_infozone_zone").fadeOut();
                $("#infozone_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (zone_isnew?"api/sousprojet/zone_add.php":"api/sousprojet/zone_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        nbr_zone: $('#nbr_zone').val(),
                        lr_sur_pm: $('#lr_sur_pm').val(),
                        lr: $('#lr').val(),
                        nbr_de_site: $('#nbr_de_site').val(),
                        nb_fo_sur_pm: $('#nb_fo_sur_pm').val(),
                        nb_fo_sur_pmz: $('#nb_fo_sur_pmz').val()

                    }
                }).done(function (msg) {
                    $("#infozone_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_infozone_zone')) {
                        $("#id_sous_projet_zone_alert").hide();
                        zone_isnew = false;
                    }
                });
            });
            $("#id_sous_projet_site_origine_btn").click(function () {
                $("#message_infozone_site_origine").fadeOut();
                $("#infozone_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (siteorigine_isnew?"api/sousprojet/site_origine_add.php":"api/sousprojet/site_origine_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        code_site: $('#code_site').val(),
                        type_so: $('#type_so').val(),
                        auto_adduction: $('#auto_adduction').val(),
                        travaux_adduction: $('#travaux_adduction').val(),
                        recette_adduction: $('#recette_adduction').val()

                    }
                }).done(function (msg) {
                    $("#infozone_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_infozone_site_origine')) {
                        $("#id_sous_projet_site_origine_alert").hide();
                        siteorigine_isnew = false;
                    }
                });
            });
        }
        return {
            init : init,
            initEvents : initEvents,
            initTabs : initTabs,
            refresh : refresh,
            done : done
        };
    }();
    var gestionplaque = function() {
        var done = $.Deferred();
        var phase_formdata = {};
        var tetude_formdata = {};
        var phase_isnew = undefined;
        var tetude_isnew = undefined;

        var refresh = function() {
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet')
                },
                url: "api/sousprojet/get_entries_by_id.php"
            }).done(function (msg) {

                var obj = JSON.parse(msg);
                //console.log(obj);

                id_da = obj.id_da;
                id_dt = obj.id_dt;

                id_ta = obj.id_ta;
                id_tt = obj.id_tt;

                initTabs();

            });
        }
        var initTabs = function() {
            $("#gestionplaque_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet'),
                },
                url: "api/sousprojet/blocks/gestionplaque_block.php"
            }).done(function (msg) {
                $("#gestionplaque_block_content").html(msg);
                $("#gestionplaque_block").removeClass('block-opt-refresh');

                done.resolve();

                init();
                initEvents();

            });
        }
        var init = function() {

            $('#gestionplaque_phase_form *').filter('.form-control:enabled:not([readonly])').each(function(){
                phase_formdata[$( this ).attr('name')] = $( this).val();
            });

            $('#gestionplaque_tetude_form *').filter('.form-control:enabled:not([readonly])').each(function(){
                tetude_formdata[$( this ).attr('name')] = $( this).val();
            });

            $("#message_gestion_plaque_phase").hide();
            $("#message_gestion_plaque_traitement_etude").hide();

            phase_isnew = ($("#id_sous_projet_plaque_phase").val()?false:true);
            tetude_isnew = ($("#id_sous_projet_plaque_traitement_etude").val()?false:true);
        }
        var initEvents = function() {
            $("#id_sous_projet_plaque_phase_btn").click(function () {
                $("#message_gestion_plaque_phase").fadeOut();
                $("#gestionplaque_block").toggleClass('block-opt-refresh');

                for (var key in phase_formdata) {
                    console.log('#'+key);
                    phase_formdata[key] = $('#'+key).val();
                }
                phase_formdata['ids'] = ids;

                $.ajax({
                    method: "POST",
                    url: (phase_isnew?"api/sousprojet/phase_add.php":"api/sousprojet/phase_update.php"),
                    data: /*{
                        ids: get('idsousprojet'),
                        gp_instigateur: $('#gp_instigateur').val(),
                        gp_vague: $('#gp_vague').val(),
                        gp_date_lancement: $('#gp_date_lancement').val()

                    }*/phase_formdata
                }).done(function (msg) {
                    console.log(msg);
                    $("#gestionplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_phase')) {
                        $("#id_sous_projet_plaque_phase_alert").hide();
                        phase_isnew = false;
                    }
                });
            });
            $("#id_sous_projet_plaque_traitement_etude_btn").click(function () {

                $("#message_gestion_plaque_traitement_etude").fadeOut();
                $("#gestionplaque_block").toggleClass('block-opt-refresh');

                for (var key in tetude_formdata) {
                    console.log('#'+key);
                    tetude_formdata[key] = $('#'+key).val();
                }
                tetude_formdata['ids'] = ids;

                console.log(tetude_formdata);

                $.ajax({
                    method: "POST",
                    url: (tetude_isnew?"api/sousprojet/traitementetude_add.php":"api/sousprojet/traitementetude_update.php"),
                    data: /*{
                        ids: get('idsousprojet'),
                        tsite: $('#tsite').val(),
                        charge_etude: $('#charge_etude').val()
                    }*/tetude_formdata
                }).done(function (msg) {
                    $("#gestionplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_traitement_etude')) {
                        $("#id_sous_projet_plaque_traitement_etude_alert").hide();
                        tetude_isnew = false;
                    }
                });
            });
        }
        return {
            init : init,
            initEvents : initEvents,
            initTabs : initTabs,
            refresh : refresh,
            done : done
        };
    }();
    var preparationplaque = function() {
        var done = $.Deferred();
        var formdata = {};
        var fileuploader_survey_bei = null;
        var fileuploader_survey_vip = null;
        var pcarto_isnew = undefined;
        var posadr_isnew = undefined;
        var surveyadr_isnew = undefined;
        var refresh = function(atab = '') {
            //console.log('refresh');
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet')
                },
                url: "api/sousprojet/get_entries_by_id.php"
            }).done(function (msg) {

                var obj = JSON.parse(msg);
                //console.log(obj);

                id_da = obj.id_da;
                id_dt = obj.id_dt;

                id_ta = obj.id_ta;
                id_tt = obj.id_tt;

                initTabs(atab);
            });
        }
        var initTabs = function(atab = '') {

            $("#preparationplaque_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet'),
                },
                url: "api/sousprojet/blocks/preparationplaque_block.php"
            }).done(function (msg) {
                $("#preparationplaque_block_content").html(msg);
                $("#preparationplaque_block").removeClass('block-opt-refresh');

                done.resolve();

                if(atab != "") {
                    $(atab).trigger('click');
                }

                /*if(atab != null) {
                    atab();
                }*/

                init();
                initEvents();

                //init surve adresses files
                getSurveyFilesTo();
                getSurveyFilesBack();
            });
        }
        var init = function() {
            $("#message_gestion_plaque_carto").hide();
            $("#message_gestion_plaque_pos_adresse").hide();
            $("#message_gestion_plaque_survey_adresse").hide();

            pcarto_isnew = ($("#id_sous_projet_plaque_carto").val()?false:true);
            posadr_isnew = ($("#id_sous_projet_plaque_pos_adresse").val()?false:true);
            surveyadr_isnew = ($("#id_sous_projet_plaque_survey_adresse").val()?false:true);

            fileuploader_survey_bei = $("#fileuploader_survey_bei").uploadFile({
                url: "api/sousprojet/upload_survey_file.php",
                multiple:true,
                dragDrop:true,
                dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
                fileName: "myfile",
                autoSubmit: true,
                dynamicFormData: function()
                {
                    var data ={
                        idsp: get('idsousprojet'),
                        type_objet : 'liste_adr_survey_to'
                    };
                    return data;
                },
                multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",

                uploadStr:"Téléchargez",
                allowedTypes: "xlsx",
                afterUploadAll:function(obj) {
                    upload_ok = true;
                    getSurveyFilesTo();
                }
            });
            fileuploader_survey_vip = $("#fileuploader_survey_vip").uploadFile({
                url: "api/sousprojet/upload_survey_file.php",
                multiple:true,
                dragDrop:true,
                dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
                fileName: "myfile",
                autoSubmit: true,
                dynamicFormData: function()
                {
                    var data ={
                        idsp: get('idsousprojet'),
                        type_objet : 'liste_adr_survey_back'
                    };
                    return data;
                },
                multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",

                uploadStr:"Téléchargez",
                allowedTypes: "xlsx",
                afterUploadAll:function(obj) {
                    upload_ok = true;
                    getSurveyFilesBack();
                }
            });

            setDuree($("#pc_duree"),'#message_gestion_plaque_carto',$("#pc_date_debut").val(),$("#pc_date_ret_prevue").val());
            setDuree($("#pa_duree"),'#message_gestion_plaque_pos_adresse',$("#pa_date_debut").val(),$("#pa_date_ret_prevue").val());
            setDuree($("#sa_duree"),'#message_gestion_plaque_survey_adresse',$("#sa_date_debut").val(),$("#sa_date_ret_prevue").val());
        }
        var initEvents = function() {
            $("#id_sous_projet_plaque_carto_btn").click(function () {

                $("#message_gestion_plaque_carto").fadeOut();
                $("#preparationplaque_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (pcarto_isnew?"api/sousprojet/pcarto_add.php":"api/sousprojet/pcarto_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        pc_intervenant_be: $('#pc_intervenant_be').val(),
                        pc_date_debut: $('#pc_date_debut').val(),
                        pc_date_ret_prevue: $('#pc_date_ret_prevue').val(),
                        pc_duree: $('#pc_duree').val(),
                        pc_ok: $('#pc_ok').val()

                    }
                }).done(function (msg) {
                    $("#preparationplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_carto')) {
                        $("#id_sous_projet_plaque_carto_alert").hide();
                        pcarto_isnew = false;
                    }
                });
            });
            $("#id_sous_projet_plaque_pos_adresse_btn").click(function () {

                $("#message_gestion_plaque_pos_adresse").fadeOut();
                $("#preparationplaque_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (posadr_isnew?"api/sousprojet/posadr_add.php":"api/sousprojet/posadr_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        pa_intervenant_be: $('#pa_intervenant_be').val(),
                        pa_date_debut: $('#pa_date_debut').val(),
                        pa_date_ret_prevue: $('#pa_date_ret_prevue').val(),
                        pa_duree: $('#pa_duree').val(),
                        pa_intervenant: $('#pa_intervenant').val(),
                        pa_ok: $('#pa_ok').val()

                    }
                }).done(function (msg) {
                    $("#preparationplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_pos_adresse')) {
                        $("#id_sous_projet_plaque_pos_adresse_alert").hide();
                        posadr_isnew = false;
                    }
                });
            });
            $("#id_sous_projet_plaque_survey_adresse_btn").click(function () {

                $("#message_gestion_plaque_survey_adresse").fadeOut();
                $("#preparationplaque_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (surveyadr_isnew?"api/sousprojet/surveyadr_add.php":"api/sousprojet/surveyadr_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        sa_volume_adresse: $('#sa_volume_adresse').val(),
                        sa_date_debut: $('#sa_date_debut').val(),
                        sa_date_ret_prevue: $('#sa_date_ret_prevue').val(),
                        sa_intervenant: $('#sa_intervenant').val(),
                        sa_duree: $('#sa_duree').val(),
                        sa_ok: $('#sa_ok').val()

                    }
                }).done(function (msg) {

                    $("#preparationplaque_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_gestion_plaque_survey_adresse', refresh, '#surveyadressesterrain_href')) {
                        $("#id_sous_projet_plaque_survey_adresse_alert").hide();
                        surveyadr_isnew = false;
                    }
                });
            });

            $("#pc_date_debut").change(function() {
                setDuree($("#pc_duree"),'#message_gestion_plaque_carto',$( this ).val(),$("#pc_date_ret_prevue").val());
            });
            $("#pc_date_ret_prevue").change(function() {
                setDuree($("#pc_duree"),'#message_gestion_plaque_carto',$("#pc_date_debut").val(),$( this ).val());
            });

            $("#pa_date_debut").change(function() {
                setDuree($("#pa_duree"),'#message_gestion_plaque_pos_adresse',$( this ).val(),$("#pa_date_ret_prevue").val());
            });
            $("#pa_date_ret_prevue").change(function() {
                setDuree($("#pa_duree"),'#message_gestion_plaque_pos_adresse',$("#pa_date_debut").val(),$( this ).val());
            });

            $("#sa_date_debut").change(function() {
                setDuree($("#sa_duree"),'#message_gestion_plaque_survey_adresse',$( this ).val(),$("#sa_date_ret_prevue").val());
            });
            $("#sa_date_ret_prevue").change(function() {
                setDuree($("#sa_duree"),'#message_gestion_plaque_survey_adresse',$("#sa_date_debut").val(),$( this ).val());
            });
        }
        return {
            init : init,
            initEvents : initEvents,
            initTabs : initTabs,
            refresh : refresh,
            done : done
        };
    }();
    var reseautransport = function() {
        var done = $.Deferred();
        var formdata = {};
        var ta_ot_id_entree = undefined;
        var ta_ot_type_entree = 'transport_aiguillage';
        var tt_ot_id_entree = undefined;
        var tt_ot_type_entree = 'transport_tirage';
        var tr_ot_id_entree = undefined;
        var tr_ot_type_entree = 'transport_raccordements';

        var tdesign_isnew = undefined;
        var taiguillage_isnew = undefined;
        var tcmdctr_isnew = undefined;
        var ttirage_isnew = undefined;
        var traccord_isnew = undefined;
        var trecette_isnew = undefined;
        var checkLinears = function() {
            var flag = true;
            $('.lineareInput').filter(function() {
                if (this.value == '') {
                    flag = false;
                    return false;
                }
            });
            return flag;
        }
        var checkLinears2 = function() {
            var flag = true;
            $('.lineareInput2').filter(function() {
                if (this.value == '') {
                    flag = false;
                    return false;
                }
            });
            return flag;
        }
        var refresh = function() {
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet')
                },
                url: "api/sousprojet/get_entries_by_id.php"
            }).done(function (msg) {

                var obj = JSON.parse(msg);
                //console.log(obj);

                id_da = obj.id_da;
                id_dt = obj.id_dt;
                id_dr = obj.id_dr;

                id_ta = obj.id_ta;
                id_tt = obj.id_tt;
                id_tr = obj.id_tr;

                initTabs();
            });
        }
        var initTabs = function() {
            $("#rtransport_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet')
                },
                url: "api/sousprojet/blocks/reseautransport_block.php"
            }).done(function (msg) {
                $("#rtransport_block_content").html(msg);
                $("#rtransport_block").removeClass('block-opt-refresh');

                done.resolve();

                init();
                initEvents();
            });
        }
        var init = function() {
            /*jQuery('.js-tags-input').tagsInput({
                height: '45px',
                width: '100%',
                defaultText: '+',
                removeWithBackspace: true,
                delimiter: [',']
            });*/
            jQuery('.js-tags-input').tagsinput({});
            if(checkLinears()) {
                $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
            } else {
                $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
            }
            if(checkLinears2()) {
                $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
            } else {
                $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
            }

            $("#message_transport_design").hide();
            $("#message_transport_aiguillage").hide();
            $("#message_transport_commande_ctr").hide();
            $("#message_transport_tirage").hide();
            $("#message_transport_raccordements").hide();
            $("#message_transport_recette").hide();

            tdesign_isnew = ($("#id_sous_projet_transport_design").val()?false:true);

            ta_ot_id_entree = id_ta;//console.log('ta_ot_id_entree -> ' + ta_ot_id_entree);
            taiguillage_isnew = ($("#id_sous_projet_transport_aiguillage").val()?false:true);

            tcmdctr_isnew = ($("#id_sous_projet_transport_commande_ctr").val()?false:true);


            tt_ot_id_entree = id_tt;//console.log('tt_ot_id_entree -> ' + tt_ot_id_entree);
            ttirage_isnew = ($("#id_sous_projet_transport_tirage").val()?false:true);

            tr_ot_id_entree = id_tr;
            traccord_isnew = ($("#id_sous_projet_transport_raccordements").val()?false:true);

            trecette_isnew = ($("#id_sous_projet_transport_recette").val()?false:true);

            setDuree($("#td_duree"),'#message_transport_design',$("#td_date_debut").val(),$("#td_date_ret_prevue").val());
            setDuree($("#ta_duree"),'#message_transport_aiguillage',$("#ta_date_aiguillage").val(),$("#ta_date_ret_prevue").val());
            setDuree($("#tt_duree"),'#message_transport_tirage',$("#tt_date_tirage").val(),$("#tt_date_ret_prevue").val());
        }
        var initEvents = function() {
            //App.initHelpers('tags-inputs');
            $("#id_lineaire_transport_aiguillage_btn").click(function () {

                console.log('clicked');
                if ( $( "#lineare_groupe" ).is( ":hidden" ) ) {
                    $("#hdf0454ff").removeClass("fa-plus");
                    $("#hdf0454ff").addClass("fa-minus");
                    $( "#lineare_groupe" ).show( "fast" );
                } else {
                    $( "#lineare_groupe" ).slideUp();
                    $("#hdf0454ff").removeClass("fa-minus");
                    $("#hdf0454ff").addClass("fa-plus");
                }
            });
            $("#id_lineaire_transport_tirage_btn").click(function () {

                console.log('clicked');
                if ( $( "#tt_lineare_groupe" ).is( ":hidden" ) ) {
                    $("#hdf04l54ff").removeClass("fa-plus");
                    $("#hdf04l54ff").addClass("fa-minus");
                    $( "#tt_lineare_groupe" ).show( "fast" );
                } else {
                    $( "#tt_lineare_groupe" ).slideUp();
                    $("#hdf04l54ff").removeClass("fa-minus");
                    $("#hdf04l54ff").addClass("fa-plus");
                }
            });
            $("#transport_aiguillage_osa_btn").click(function () {

                console.log('transport_aiguillage_osa_btn');
                $.ajax({
                    method: "POST",
                    url: 'http://192.168.1.41/osa/api/utilisateur_show.php',
                    data: {
                        r2i : 'rrahmouni@rc2k.fr::rrahmouni'
                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    console.log(obj);
                });
            });
            $("#id_sous_projet_transport_design_btn").click(function () {

                $("#message_transport_design").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (tdesign_isnew?"api/sousprojet/tdesign_add.php":"api/sousprojet/tdesign_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        td_intervenant_be: $('#td_intervenant_be').val(),
                        td_valideur_bei: $('#td_valideur_bei').val(),
                        td_date_debut: $('#td_date_debut').val(),
                        td_date_ret_prevue: $('#td_date_ret_prevue').val(),
                        td_duree: $('#td_duree').val(),
                        td_lineaire_transport: $('#td_lineaire_transport').val(),
                        td_nb_zones: $('#td_nb_zones').val(),
                        td_ok: $('#td_ok').val()

                    }
                }).done(function (msg) {
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_design')) {
                        $("#id_sous_projet_transport_design_alert").hide();
                        tdesign_isnew = false;
                    }
                });
            });
            $("#id_sous_projet_transport_aiguillage_btn").click(function () {

                $("#message_transport_aiguillage").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (taiguillage_isnew?"api/sousprojet/taguillage_add.php":"api/sousprojet/taguillage_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        ta_intervenant_be: $('#ta_intervenant_be').val(),
                        ta_plans: $('#ta_plans').val(),
                        ta_lineaire_reseau: $('#ta_lineaire_reseau').val(),
                        ta_controle_plans: $('#ta_controle_plans').val(),
                        ta_date_transmission_plans: $('#ta_date_transmission_plans').val(),
                        ta_entreprise: $('#ta_entreprise').val(),
                        phase: $('#phase').val(),
                        ta_date_aiguillage: $('#ta_date_aiguillage').val(),
                        ta_date_ret_prevue: $('#ta_date_ret_prevue').val(),
                        ta_duree: $('#ta_duree').val(),
                        ta_controle_demarrage_effectif: $('#ta_controle_demarrage_effectif').val(),
                        ta_date_retour: $('#ta_date_retour').val(),
                        ta_etat_retour: $('#ta_etat_retour').val(),
                        lineaire1: $('#lineaire1').val(),
                        lineaire2: $('#lineaire2').val(),
                        lineaire3: $('#lineaire3').val(),
                        lineaire4: $('#lineaire4').val(),
                        lineaire5: $('#lineaire5').val(),
                        lineaire6: $('#lineaire6').val(),
                        lineaire7: $('#lineaire7').val(),
                        lineaire8: $('#lineaire8').val(),
                        ta_lien_plans: $('#ta_lien_plans').val(),
                        ta_retour_presta: $('#ta_retour_presta').val(),
                        ta_ok: $('#ta_ok').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    //console.log(obj);
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_aiguillage')) {
                        $("#id_sous_projet_transport_aiguillage_alert").hide();
                        if(taiguillage_isnew) {
                            ta_ot_id_entree = obj.id;
                            taiguillage_isnew = false;
                            $("#id_sous_projet_transport_aiguillage_btn").after('  <button id="id_sous_projet_transport_aiguillage_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            //console.log(data_ot);
                        }
                    }
                });
            });
            $('body').on('click', '#id_sous_projet_transport_aiguillage_create_ot_show', function() {
                // do something
                //console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = ta_ot_id_entree;
                data_ot.type_entree = ta_ot_type_entree;
                show_btn = $("#id_sous_projet_transport_aiguillage_create_ot_show");
                create_btn = $("#id_sous_projet_transport_aiguillage_btn");
            });
            $("#id_sous_projet_transport_commande_ctr_btn").click(function () {

                //console.log($('#cctr_ref_commande_acces').val());

                //console.log(jQuery( '.tags' ).tagsInput()[0]);

                $("#message_transport_commande_ctr").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (tcmdctr_isnew?"api/sousprojet/tcmdctr_add.php":"api/sousprojet/tcmdctr_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        cctr_intervenant_be: $('#cctr_intervenant_be').val(),
                        cctr_date_butoir: $('#cctr_date_butoir').val(),
                        cctr_traitement_retour_terrain: $('#cctr_traitement_retour_terrain').val(),
                        cctr_modification_carto: $('#cctr_modification_carto').val(),
                        cctr_commandes_acces: $('#cctr_commandes_acces').val(),
                        cctr_date_transmission_ca: $('#cctr_date_transmission_ca').val(),
                        cctr_ref_commande_acces: $('#cctr_ref_commande_acces').val(),
                        cctr_go_ft: $('#cctr_go_ft').val(),
                        cctr_ok: $('#cctr_ok').val()

                    }
                }).done(function (msg) {
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_commande_ctr')) {
                        $("#id_sous_projet_transport_commande_ctr_alert").hide();
                        tcmdctr_isnew = false;
                    }
                });
            });
            $("#id_sous_projet_transport_tirage_btn").click(function () {

                $("#message_transport_tirage").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (ttirage_isnew?"api/sousprojet/ttirage_add.php":"api/sousprojet/ttirage_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        tt_intervenant_be: $('#tt_intervenant_be').val(),
                        tt_plans: $('#tt_plans').val(),
                        tt_lineaire_reseau: $('#tt_lineaire_reseau').val(),
                        tt_controle_plans: $('#tt_controle_plans').val(),
                        tt_date_transmission_plans: $('#tt_date_transmission_plans').val(),
                        tt_entreprise: $('#tt_entreprise').val(),
                        phase: $('#phase').val(),
                        tt_date_tirage: $('#tt_date_tirage').val(),
                        tt_date_ret_prevue: $('#tt_date_ret_prevue').val(),
                        tt_duree: $('#tt_duree').val(),
                        tt_controle_demarrage_effectif: $('#tt_controle_demarrage_effectif').val(),
                        tt_date_retour: $('#tt_date_retour').val(),
                        tt_etat_retour: $('#tt_etat_retour').val(),
                        lineaire1: $('#tt_lineaire1').val(),
                        lineaire2: $('#tt_lineaire2').val(),
                        lineaire3: $('#tt_lineaire3').val(),
                        lineaire4: $('#tt_lineaire4').val(),
                        lineaire5: $('#tt_lineaire5').val(),
                        lineaire6: $('#tt_lineaire6').val(),
                        lineaire7: $('#tt_lineaire7').val(),
                        lineaire8: $('#tt_lineaire8').val(),
                        tt_lien_plans: $('#tt_lien_plans').val(),
                        tt_retour_presta: $('#tt_retour_presta').val(),
                        tt_ok: $('#tt_ok').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    //console.log(obj);
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_tirage')) {
                        $("#id_sous_projet_transport_tirage_alert").hide();
                        if(ttirage_isnew) {
                            tt_ot_id_entree = obj.id;
                            ttirage_isnew = false;
                            $("#id_sous_projet_transport_tirage_btn").after('  <button id="id_sous_projet_transport_tirage_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            //console.log(data_ot);
                        }
                    }
                });
            });
            $('body').on('click', '#id_sous_projet_transport_tirage_create_ot_show', function() {
                // do something
                //console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = tt_ot_id_entree;
                data_ot.type_entree = tt_ot_type_entree;
                show_btn = $("#id_sous_projet_transport_tirage_create_ot_show");
                create_btn = $("#id_sous_projet_transport_tirage_btn");
            });
            $("#id_sous_projet_transport_raccordements_btn").click(function () {

                $("#message_transport_raccordements").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (traccord_isnew?"api/sousprojet/traccord_add.php":"api/sousprojet/traccord_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        tr_intervenant_be: $('#tr_intervenant_be').val(),
                        tr_preparation_pds: $('#tr_preparation_pds').val(),
                        tr_controle_plans: $('#tr_controle_plans').val(),
                        tr_date_transmission_pds: $('#tr_date_transmission_pds').val(),
                        tr_entreprise: $('#tr_entreprise').val(),
                        tr_date_racco: $('#tr_date_racco').val(),
                        tr_duree: $('#tr_duree').val(),
                        tr_controle_demarrage_effectif: $('#tr_controle_demarrage_effectif').val(),
                        tr_date_retour: $('#tr_date_retour').val(),
                        tr_etat_retour: $('#tr_etat_retour').val(),
                        tr_ok: $('#tr_ok').val()

                    }
                }).done(function (msg) {//console.log(msg);
                    var obj = $.parseJSON(msg);
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_raccordements')) {
                        $("#id_sous_projet_transport_raccordements_alert").hide();
                        if(traccord_isnew) {
                            tr_ot_id_entree = obj.id;
                            traccord_isnew = false;
                            $("#id_sous_projet_transport_raccordements_btn").after('  <button id="id_sous_projet_transport_raccordements_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            //console.log(data_ot);
                        }
                    }
                });
            });
            $('body').on('click', '#id_sous_projet_transport_raccordements_create_ot_show', function() {
                // do something
                //console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = tr_ot_id_entree;
                data_ot.type_entree = tr_ot_type_entree;
                show_btn = $("#id_sous_projet_transport_raccordements_create_ot_show");
                create_btn = $("#id_sous_projet_transport_raccordements_btn");
            });
            $("#id_sous_projet_transport_recette_btn").click(function () {

                $("#message_transport_recette").fadeOut();
                $("#rtransport_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (trecette_isnew?"api/sousprojet/trecette_add.php":"api/sousprojet/trecette_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        trec_intervenant_be: $('#trec_intervenant_be').val(),
                        trec_doe: $('#trec_doe').val(),
                        trec_netgeo: $('#trec_netgeo').val(),
                        trec_intervenant_free: $('#trec_intervenant_free').val(),
                        trec_entreprise: $('#trec_entreprise').val(),
                        trec_date_recette: $('#trec_date_recette').val(),
                        trec_etat_recette: $('#trec_etat_recette').val()

                    }
                }).done(function (msg) {
                    $("#rtransport_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_transport_recette')) {
                        $("#id_sous_projet_transport_recette_alert").hide();
                        trecette_isnew = false;
                    }
                });
            });

            $("#td_date_debut").change(function() {
                setDuree($("#td_duree"),'#message_transport_design',$( this ).val(),$("#td_date_ret_prevue").val());
            });
            $("#td_date_ret_prevue").change(function() {
                setDuree($("#td_duree"),'#message_transport_design',$("#td_date_debut").val(),$( this ).val());
            });

            $("#ta_date_aiguillage").change(function() {
                setDuree($("#ta_duree"),'#message_transport_aiguillage',$( this ).val(),$("#ta_date_ret_prevue").val());
            });
            $("#ta_date_ret_prevue").change(function() {
                setDuree($("#ta_duree"),'#message_transport_aiguillage',$("#ta_date_aiguillage").val(),$( this ).val());
            });

            $("#tt_date_tirage").change(function() {
                setDuree($("#tt_duree"),'#message_transport_tirage',$( this ).val(),$("#tt_date_ret_prevue").val());
            });
            $("#tt_date_ret_prevue").change(function() {
                setDuree($("#tt_duree"),'#message_transport_tirage',$("#tt_date_tirage").val(),$( this ).val());
            });


            $('#lineaire1').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#lineaire2').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#lineaire3').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#lineaire4').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#lineaire5').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#lineaire6').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#lineaire7').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#lineaire8').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_aiguillage_btn").addClass("btn-danger");
                }
            });

            $('#tt_lineaire1').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
                }
            });
            $('#tt_lineaire2').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
                }
            });
            $('#tt_lineaire3').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
                }
            });
            $('#tt_lineaire4').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
                }
            });
            $('#tt_lineaire5').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
                }
            });
            $('#tt_lineaire6').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
                }
            });
            $('#tt_lineaire7').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
                }
            });
            $('#tt_lineaire8').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_transport_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_transport_tirage_btn").addClass("btn-danger");
                }
            });
        }
        return {
            init : init,
            initEvents : initEvents,
            initTabs : initTabs,
            refresh : refresh,
            done : done
        };
    }();
    var reseaudistribution = function() {
        var done = $.Deferred();
        var formdata = {};
        var da_ot_id_entree = undefined;
        var da_ot_type_entree = 'distribution_aiguillage';
        var dt_ot_id_entree = undefined;
        var dt_ot_type_entree = 'distribution_tirage';
        var dr_ot_id_entree = undefined;
        var dr_ot_type_entree = 'distribution_raccordements';

        var ddesign_isnew = undefined;
        var daiguillage_isnew = undefined;
        var dcmdcdi_isnew = undefined;
        var dtirage_isnew = undefined;
        var draccord_isnew = undefined;
        var drecette_isnew = undefined;
        var checkLinears = function() {
            var flag = true;
            $('.lineareInput3').filter(function() {
                if (this.value == '') {
                    flag = false;
                    return false;
                }
            });
            return flag;
        }
        var checkLinears2 = function() {
            var flag = true;
            $('.lineareInput4').filter(function() {
                if (this.value == '') {
                    flag = false;
                    return false;
                }
            });
            return flag;
        }
        var refresh = function() {
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet')
                },
                url: "api/sousprojet/get_entries_by_id.php"
            }).done(function (msg) {

                var obj = JSON.parse(msg);
                //console.log(obj);

                id_da = obj.id_da;
                id_dt = obj.id_dt;
                id_dr = obj.id_dr;

                id_ta = obj.id_ta;
                id_tt = obj.id_tt;
                id_tr = obj.id_tr;

                initTabs();
            });
        }
        var initTabs = function() {
            //console.log('initTabs');
            $("#rdistribution_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    idsousprojet : get('idsousprojet')
                },
                url: "api/sousprojet/blocks/reseaudistribution_block.php"
            }).done(function (msg) {
                $("#rdistribution_block_content").html(msg);
                $("#rdistribution_block").removeClass('block-opt-refresh');

                done.resolve();

                init();
                initEvents();
            } );
        }
        var init = function() {
            jQuery('.js-tags-input').tagsinput({});
            if(checkLinears()) {
                $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
            } else {
                $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
            }
            if(checkLinears2()) {
                $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
            } else {
                $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
            }

            $("#message_distribution_design").hide();
            $("#message_distribution_aiguillage").hide();
            $("#message_distribution_commande_cdi").hide();
            $("#message_distribution_tirage").hide();
            $("#message_distribution_raccordements").hide();
            $("#message_distribution_recette").hide();

            ddesign_isnew = ($("#id_sous_projet_distribution_design").val()?false:true);

            da_ot_id_entree = id_da;
            daiguillage_isnew = ($("#id_sous_projet_distribution_aiguillage").val()?false:true);

            dcmdcdi_isnew = ($("#id_sous_projet_distribution_commande_cdi").val()?false:true);

            dt_ot_id_entree = id_dt;//console.log('dt_ot_id_entree -> ' + dt_ot_id_entree);
            dtirage_isnew = ($("#id_sous_projet_distribution_tirage").val()?false:true);

            dr_ot_id_entree = id_dr;
            draccord_isnew = ($("#id_sous_projet_distribution_raccordements").val()?false:true);

            drecette_isnew = ($("#id_sous_projet_distribution_recette").val()?false:true);

            setDuree($("#dd_duree"),'#message_distribution_design',$("#dd_date_debut").val(),$("#dd_date_fin").val());
            //setDuree($("#ta_duree"),'#message_transport_aiguillage',$("#ta_date_aiguillage").val(),$("#ta_date_ret_prevue").val());
            //setDuree($("#tt_duree"),'#message_transport_tirage',$("#tt_date_tirage").val(),$("#tt_date_ret_prevue").val());
        }
        var initEvents = function() {
            $("#id_lineaire_distribution_aiguillage_btn").click(function () {

                console.log('clicked');
                if ( $( "#da_lineare_groupe" ).is( ":hidden" ) ) {
                    $("#hdfd0454ff").removeClass("fa-plus");
                    $("#hdfd0454ff").addClass("fa-minus");
                    $( "#da_lineare_groupe" ).show( "fast" );
                } else {
                    $( "#da_lineare_groupe" ).slideUp();
                    $("#hdfd0454ff").removeClass("fa-minus");
                    $("#hdfd0454ff").addClass("fa-plus");
                }
            });
            $("#id_lineaire_distribution_tirage_btn").click(function () {

                console.log('clickedsss');
                if ( $( "#dt_lineare_groupe" ).is( ":hidden" ) ) {
                    $("#hdfh04l54ff").removeClass("fa-plus");
                    $("#hdfh04l54ff").addClass("fa-minus");
                    $( "#dt_lineare_groupe" ).show( "fast" );
                } else {
                    $( "#dt_lineare_groupe" ).slideUp();
                    $("#hdfh04l54ff").removeClass("fa-minus");
                    $("#hdfh04l54ff").addClass("fa-plus");
                }
            });
            $("#id_sous_projet_distribution_design_btn").click(function () {

                $("#message_distribution_design").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (ddesign_isnew?"api/sousprojet/ddesign_add.php":"api/sousprojet/ddesign_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        dd_intervenant_be: $('#dd_intervenant_be').val(),
                        dd_intervenant_bex: $('#dd_intervenant_bex').val(),
                        dd_date_debut: $('#dd_date_debut').val(),
                        dd_date_fin: $('#dd_date_fin').val(),
                        dd_duree: $('#dd_duree').val(),
                        dd_lineaire_distribution: $('#dd_lineaire_distribution').val(),
                        dd_etat: $('#dd_etat').val(),
                        dd_date_envoi: $('#dd_date_envoi').val(),
                        dd_ok: $('#dd_ok').val()

                    }
                }).done(function (msg) {
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_design')) {
                        $("#id_sous_projet_distribution_design_alert").hide();
                        ddesign_isnew = false;
                    }
                });
            });
            $("#id_sous_projet_distribution_aiguillage_btn").click(function () {

                $("#message_distribution_aiguillage").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (daiguillage_isnew?"api/sousprojet/daiguillage_add.php":"api/sousprojet/daiguillage_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        da_intervenant_be: $('#da_intervenant_be').val(),
                        da_plans: $('#da_plans').val(),
                        lineaire1: $('#da_lineaire1').val(),
                        lineaire2: $('#da_lineaire2').val(),
                        lineaire3: $('#da_lineaire3').val(),
                        lineaire4: $('#da_lineaire4').val(),
                        lineaire5: $('#da_lineaire5').val(),
                        lineaire6: $('#da_lineaire6').val(),
                        lineaire7: $('#da_lineaire7').val(),
                        lineaire8: $('#da_lineaire8').val(),
                        da_controle_plans: $('#da_controle_plans').val(),
                        da_date_transmission_plans: $('#da_date_transmission_plans').val(),
                        da_entreprise: $('#da_entreprise').val(),
                        da_date_aiguillage: $('#da_date_aiguillage').val(),
                        da_duree: $('#da_duree').val(),
                        da_controle_demarrage_effectif: $('#da_controle_demarrage_effectif').val(),
                        da_date_retour: $('#da_date_retour').val(),
                        da_etat_retour: $('#da_etat_retour').val(),
                        da_ok: $('#da_ok').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    //console.log(obj);
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_aiguillage')) {
                        $("#id_sous_projet_distribution_aiguillage_alert").hide();
                        if(daiguillage_isnew) {
                            da_ot_id_entree = obj.id;
                            daiguillage_isnew = false;
                            $("#id_sous_projet_distribution_aiguillage_btn").after('  <button id="id_sous_projet_distribution_aiguillage_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            //console.log(data_ot);
                        }
                    }
                });
            });
            $('body').on('click', '#id_sous_projet_distribution_aiguillage_create_ot_show', function() {
                // do something
                //console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = da_ot_id_entree;
                data_ot.type_entree = da_ot_type_entree;
                show_btn = $("#id_sous_projet_distribution_aiguillage_create_ot_show");
                create_btn = $("#id_sous_projet_distribution_aiguillage_btn");
            });
            $("#id_sous_projet_distribution_commande_cdi_btn").click(function () {

                $("#message_distribution_commande_cdi").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (dcmdcdi_isnew?"api/sousprojet/dcmdcdi_add.php":"api/sousprojet/dcmdcdi_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        dcc_intervenant_be: $('#dcc_intervenant_be').val(),
                        dcc_date_butoir: $('#dcc_date_butoir').val(),
                        dcc_traitement_retour_terrain: $('#dcc_traitement_retour_terrain').val(),
                        dcc_modification_carto: $('#dcc_modification_carto').val(),
                        dcc_commandes_acces: $('#dcc_commandes_acces').val(),
                        dcc_date_transmission_ca: $('#dcc_date_transmission_ca').val(),
                        dcc_ref_commande_acces: $('#dcc_ref_commande_acces').val(),
                        dcc_go_ft: $('#dcc_go_ft').val(),
                        dcc_ok: $('#dcc_ok').val()

                    }
                }).done(function (msg) {
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_commande_cdi')) {
                        $("#id_sous_projet_distribution_commande_cdi_alert").hide();
                        dcmdcdi_isnew = false;
                    }
                });
            });
            $("#id_sous_projet_distribution_tirage_btn").click(function () {

                $("#message_distribution_tirage").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (dtirage_isnew?"api/sousprojet/dtirage_add.php":"api/sousprojet/dtirage_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        dt_intervenant_be: $('#dt_intervenant_be').val(),
                        dt_date_previsionnelle: $('#dt_date_previsionnelle').val(),
                        dt_prep_plans: $('#dt_prep_plans').val(),
                        lineaire1: $('#dt_lineaire1').val(),
                        lineaire2: $('#dt_lineaire2').val(),
                        lineaire3: $('#dt_lineaire3').val(),
                        lineaire4: $('#dt_lineaire4').val(),
                        lineaire5: $('#dt_lineaire5').val(),
                        lineaire6: $('#dt_lineaire6').val(),
                        lineaire7: $('#dt_lineaire7').val(),
                        lineaire8: $('#dt_lineaire8').val(),
                        dt_controle_plans: $('#dt_controle_plans').val(),
                        dt_date_transmission_plans: $('#dt_date_transmission_plans').val(),
                        dt_entreprise: $('#dt_entreprise').val(),
                        dt_date_tirage: $('#dt_date_tirage').val(),
                        dt_duree: $('#dt_duree').val(),
                        dt_controle_demarrage_effectif: $('#dt_controle_demarrage_effectif').val(),
                        dt_date_retour: $('#dt_date_retour').val(),
                        dt_etat_retour: $('#dt_etat_retour').val(),
                        dt_ok: $('#dt_ok').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    //console.log(obj);
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_tirage')) {
                        $("#id_sous_projet_distribution_tirage_alert").hide();
                        if(dtirage_isnew) {
                            dt_ot_id_entree = obj.id;
                            dtirage_isnew = false;
                            $("#id_sous_projet_distribution_tirage_btn").after('  <button id="id_sous_projet_distribution_tirage_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                            //console.log(data_ot);
                        }
                    }
                });
            });
            $('body').on('click', '#id_sous_projet_distribution_tirage_create_ot_show', function() {
                // do something
                //console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = dt_ot_id_entree;
                data_ot.type_entree = dt_ot_type_entree;
                show_btn = $("#id_sous_projet_distribution_tirage_create_ot_show");
                create_btn = $("#id_sous_projet_distribution_tirage_btn");
            });
            $("#id_sous_projet_distribution_raccordements_btn").click(function () {

                $("#message_distribution_raccordements").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (draccord_isnew?"api/sousprojet/draccord_add.php":"api/sousprojet/draccord_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        dr_intervenant_be: $('#dr_intervenant_be').val(),
                        dr_preparation_pds: $('#dr_preparation_pds').val(),
                        dr_controle_plans: $('#dr_controle_plans').val(),
                        dr_date_transmission_pds: $('#dr_date_transmission_pds').val(),
                        dr_entreprise: $('#dr_entreprise').val(),
                        dr_date_racco: $('#dr_date_racco').val(),
                        dr_duree: $('#dr_duree').val(),
                        dr_controle_demarrage_effectif: $('#dr_controle_demarrage_effectif').val(),
                        dr_date_retour: $('#dr_date_retour').val(),
                        dr_etat_retour: $('#dr_etat_retour').val(),
                        dr_ok: $('#dr_ok').val()

                    }
                }).done(function (msg) {
                    var obj = $.parseJSON(msg);
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_raccordements')) {
                        $("#id_sous_projet_distribution_raccordements_alert").hide();
                        if(draccord_isnew) {
                            dr_ot_id_entree = obj.id;
                            draccord_isnew = false;
                            $("#id_sous_projet_distribution_raccordements_btn").after('  <button id="id_sous_projet_distribution_raccordements_create_ot_show" class="btn btn-success" type="button" data-toggle="modal" data-target="#add-ot" data-backdrop="static" data-keyboard="false">créer ordre de travail</button>');
                        }
                    }
                });
            });
            $('body').on('click', '#id_sous_projet_distribution_raccordements_create_ot_show', function() {
                // do something
                //console.log('show ot body source tag');
                $("#add_ot_form")[0].reset();
                data_ot.id_entree = dr_ot_id_entree;
                data_ot.type_entree = dr_ot_type_entree;
                show_btn = $("#id_sous_projet_distribution_raccordements_create_ot_show");
                create_btn = $("#id_sous_projet_distribution_raccordements_btn");
            });
            $("#id_sous_projet_distribution_recette_btn").click(function () {

                $("#message_distribution_recette").fadeOut();
                $("#rdistribution_block").toggleClass('block-opt-refresh');
                $.ajax({
                    method: "POST",
                    url: (drecette_isnew?"api/sousprojet/drecette_add.php":"api/sousprojet/drecette_update.php"),
                    data: {
                        ids: get('idsousprojet'),
                        drec_intervenant_be: $('#drec_intervenant_be').val(),
                        drec_doe: $('#drec_doe').val(),
                        drec_netgeo: $('#drec_netgeo').val(),
                        drec_intervenant_free: $('#drec_intervenant_free').val(),
                        drec_entreprise: $('#drec_entreprise').val(),
                        drec_date_recette: $('#drec_date_recette').val(),
                        drec_etat_recette: $('#drec_etat_recette').val()

                    }
                }).done(function (msg) {
                    $("#rdistribution_block").removeClass('block-opt-refresh');
                    if(App.showMessage(msg, '#message_distribution_recette')) {
                        $("#id_sous_projet_distribution_recette_alert").hide();
                        drecette_isnew = false;
                    }
                });
            });

            $("#dd_date_debut").change(function() {
                setDuree($("#dd_duree"),'#message_distribution_design',$( this ).val(),$("#dd_date_fin").val());
            });
            $("#dd_date_fin").change(function() {
                setDuree($("#dd_duree"),'#message_distribution_design',$("#dd_date_debut").val(),$( this ).val());
            });

            /*$("#ta_date_aiguillage").change(function() {
                setDuree($("#ta_duree"),'#message_transport_aiguillage',$( this ).val(),$("#ta_date_ret_prevue").val());
            });
            $("#ta_date_ret_prevue").change(function() {
                setDuree($("#ta_duree"),'#message_transport_aiguillage',$("#ta_date_aiguillage").val(),$( this ).val());
            });

            $("#tt_date_tirage").change(function() {
                setDuree($("#tt_duree"),'#message_transport_tirage',$( this ).val(),$("#tt_date_ret_prevue").val());
            });
            $("#tt_date_ret_prevue").change(function() {
                setDuree($("#tt_duree"),'#message_transport_tirage',$("#tt_date_tirage").val(),$( this ).val());
            });*/

            $('#da_lineaire1').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#da_lineaire2').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#da_lineaire3').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#da_lineaire4').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#da_lineaire5').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#da_lineaire6').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#da_lineaire7').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
                }
            });
            $('#da_lineaire8').on('input', function() {
                if(checkLinears()) {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_aiguillage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_aiguillage_btn").addClass("btn-danger");
                }
            });

            $('#dt_lineaire1').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
                }
            });
            $('#dt_lineaire2').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
                }
            });
            $('#dt_lineaire3').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
                }
            });
            $('#dt_lineaire4').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
                }
            });
            $('#dt_lineaire5').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
                }
            });
            $('#dt_lineaire6').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
                }
            });
            $('#dt_lineaire7').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
                }
            });
            $('#dt_lineaire8').on('input', function() {
                if(checkLinears2()) {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-danger");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-success");
                } else {
                    $("#id_lineaire_distribution_tirage_btn").removeClass("btn-success");
                    $("#id_lineaire_distribution_tirage_btn").addClass("btn-danger");
                }
            });
        }
        return {
            init : init,
            initEvents : initEvents,
            initTabs : initTabs,
            refresh : refresh,
            done : done
        };
    }();

    var init = function() {

        $.ajax({
            method: "POST",
            data: {
                idsousprojet : get('idsousprojet')
            },
            url: "api/sousprojet/get_entries_by_id.php"
        }).done(function (msg) {

            $.when(infozone.done,gestionplaque.done,preparationplaque.done,reseautransport.done,reseaudistribution.done).then(function () {
                console.log('all forms loaded successfully');
                //code here
                //$("#draccordements_href").trigger('click');
                /*$("#rdistribution_block_btn").trigger('click');
                $("#draccordements_href").trigger('click');*/

                // Javascript to enable link to tab
                /*var hash = document.location.hash;
                if (hash) {
                    console.log(hash);
                    App.activaTab('draccordements_href');
                }*/

                //$("#draccordements_href").trigger('click');
            });

            var obj = JSON.parse(msg);
            //console.log(obj);

            id_da = obj.id_da;
            id_dt = obj.id_dt;

            id_ta = obj.id_ta;
            id_tt = obj.id_tt;

            infozone.initTabs();
            gestionplaque.initTabs();
            preparationplaque.initTabs();
            reseautransport.initTabs();
            reseaudistribution.initTabs();
        });
    }
    return {
        init : init,
        infozone : infozone,
        gestionplaque : gestionplaque,
        preparationplaque : preparationplaque,
        reseautransport : reseautransport,
        reseaudistribution : reseaudistribution

    };
}();

$(document).ready(function() {
    SProjet.init();
} );