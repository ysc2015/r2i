<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : sousprojet.js
 *  Author     : RR
 *  Description: sousprojet forms js code
 *
 */

<?php
extract($_GET);
extract($_POST);
?>

function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
}

var template = function() {
    var init = function() {
    }
    var initEvents = function() {
    }
    var initTabs = function() {
    }
    var refreshTabs = function() {
    }
    return {
        init : init,
        initEvents : initEvents,
        initTabs : initTabs,
        refreshTabs : refreshTabs
    };
}();

var SProjet = function() {
    var infozone = function() {
        var infoplaque_isnew = undefined;
        var zone_isnew = undefined;
        var siteorigine_isnew = undefined;
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

                init();
                initEvents();
            });
        }
        var refreshTabs = function() {
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

                init();
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
                    console.log(msg);
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
            refreshTabs : refreshTabs
        };
    }();
    return {
        infozone : infozone
    };
}();