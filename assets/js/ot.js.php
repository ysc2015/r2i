<?php
header("Content-type: application/javascript");
?>
/*
 *  Document   : ot.js.php
 *  Author     : RR
 *  Description: sousprojet forms js code
 *
 */

//global functions & vars goes here

function get(name){
    if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
        return decodeURIComponent(name[1]);
}

var OT = function() {
    var idot = get('idot');

    var infosot = function() {
        var initContent = function() {
            $("#infosot_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    idot : idot
                },
                url: "api/ot/blocks/infosot_block.php"
            }).done(function (msg) {
                $("#infosot_block_content").html(msg);
                $("#infosot_block").removeClass('block-opt-refresh');

                init();
                initEvents();
            });
        }
        var init = function() {
            $("#message_ot_update").hide();
        }
        var initEvents = function() {
            $("#update_ot").click(function() {
                console.log('clicked on mme !');
                $.ajax({
                    method: "POST",
                    url: 'api/ot/ot_update.php',
                    data: {
                        idot : get('idot'),
                        type_ot : $("#type_entree_update").val(),
                        commentaire : $("#commentaire_update").val()
                    }
                }).done(function (msg) {
                    App.showMessage(msg, '#message_ot_update');
                });
            })
        }
        return {
            init : init,
            initEvents : initEvents,
            initContent : initContent
        };
    }();
    var chambre = function() {
        var initContent = function() {
            $("#chambre_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    idot : idot
                },
                url: "api/ot/blocks/chambre_block.php"
            }).done(function (msg) {
                $("#chambre_block_content").html(msg);
                $("#chambre_block").removeClass('block-opt-refresh');

                init();
                initEvents();
            });
        }
        var init = function() {
            $("#chambre_table").jqGrid({
                url: 'api/ot/chambre_grid.php?idsp='+get('idsousprojet')+'&tentree='+get('tentree'),
                //mtype: "GET",
                datatype: "json",
                colModel: [
                    { label: 'id_chambre', name: 'id_chambre', key: true},
                    { label: 'ref_chambre', name: 'ref_chambre' },
                    { label: 'villet', name: 'villet', width: 150 },
                    { label: 'sous_projet', name: 'sous_projet' },
                    { label: 'ref_note', name: 'ref_note' },
                    { label: 'code_ch1', name: 'code_ch1' },
                    { label: 'code_ch2', name: 'code_ch2' },
                    { label:'gps', name: 'gps' }
                ],
                viewrecords: true,
                width: null,
                height: 560,
                shrinkToFit: false,
                responsive: true,
                rowNum: 20,
                pager: "#chambre_table_pager"
            });
        }
        var initEvents = function() {
        }
        return {
            init : init,
            initEvents : initEvents,
            initContent : initContent
        };
    }();
    var synop = function() {
        var initContent = function() {
            $("#synop_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    idot : idot
                },
                url: "api/ot/blocks/synoptique_block.php"
            }).done(function (msg) {
                $("#synop_block_content").html(msg);
                $("#synop_block").removeClass('block-opt-refresh');

                init();
                initEvents();
            });
        }
        var init = function() {
        }
        var initEvents = function() {
        }
        return {
            init : init,
            initEvents : initEvents,
            initContent : initContent
        };
    }();

    var init = function() {

        infosot.initContent();
    }
    return {
        init : init,
        infosot : infosot,
        chambre : chambre,
        synop : synop

    };
}();

$(document).ready(function() {
    //console.log('doc ready');
    //$("#infosot_block").toggleClass('block-opt-refresh');
    //OT.init();
} );