

<button id="open_list_pblq" class='btn btn-info btn-sm'data-toggle="modal" data-target='#view-pblq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Points bloquants</button>
<!-- liste points bloquants Modal -->
<div style="position: fixed;" class="modal fade" id="view-pblq"  role="dialog" aria-hidden="true"><!--tabindex="-1"-->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <button id="close-project-add-form" data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Points bloquants</h3>
                </div>
                <div id="block-content-id" class="block-content">
                    <!-- Table pblq -->
                    <div class="block">
                        <div class="block-content table-responsive">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <table id="pblq_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>id</th>
                                    <th>réalisé par</th>
                                    <th>ref entreprise</th>
                                    <th>responsable</th>
                                    <th>ref chantier</th>
                                    <th>date controle</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>id</th>
                                    <th>réalisé par</th>
                                    <th>ref entreprise</th>
                                    <th>responsable</th>
                                    <th>ref chantier</th>
                                    <th>date controle</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- END Table pblq -->
                </div>
                <div class="modal-footer">
                    <button style="float: left;" id="add_pblq_show" class='btn btn-success btn-sm' data-toggle="modal" data-target='#add-pblq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-plus'>&nbsp;</span> Ajouter point bloquant</button>
                    <button style="float: left;" id="update_pblq_show" class='btn btn-primary btn-sm' data-toggle="modal" data-target='#update-pblq' data-backdrop="static" data-keyboard="false"><span class='glyphicon glyphicon-edit'>&nbsp;</span> Modifier</button>
                    <button style="float: left;" id="delete_pblq" class='btn btn-danger btn-sm' data-toggle="modal" data-target="#"><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
                    <div id="delete-pblq-dialog-confirm" title="Supprimer ce point bloquant?">
                        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>confirmer?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END liste points bloquants Modal -->
<script>
    /**
     * déclarations scripts points bloquants
     * */
    var pblq_dt;
    var pblq_btns = ["#update_pblq_show","#delete_pblq"];
    var update_pblq;
    /**
     * fin déclarations scripts points bloquants
     * */
    $(document).ready(function() {
        $("#open_list_pblq").click(function() {
            pblq_dt.ajax.url( 'api/pointbloquant/pointbloquant/pblq_liste.php?idchambre='+(chambre_ot_dt.row('.selected').data()!==undefined?chambre_ot_dt.row('.selected').data().id_chambre:0) ).load();
        });

        $("#update_pblq_show").click(function() {

            update_pblq = false;

            for (var key in upblq1_formdata) {

                console.log('key => ' + key + ' value => ' + pblq_dt.row('.selected').data()[key]);
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);

                $('#pblq1_id_utilisateur').val(pblq_dt.row('.selected').data().pblq1_utilisateur);
                $('#pblq1_id_entreprise').val(pblq_dt.row('.selected').data().pblq1_entreprise);
                $('#pblq1_id_equipe_stt').val(pblq_dt.row('.selected').data().pblq1_responsable);
                $('#pblq1_nature_travaux').val(pblq_dt.row('.selected').data().pblq1_nature_travaux);
            }
            for (var key in upblq2_formdata) {
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);
            }
            for (var key in upblq3_formdata) {
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);
            }
            for (var key in upblq4_formdata) {
                $('#'+key).val(pblq_dt.row('.selected').data()[key]);
            }

            App.activaTab('pblq1_update_tab');
        });

        $("#add_pblq_show").click(function() {
            redraw_pblq = false;
            $("#info_pblq_form1")[0].reset();
            $("#info_pblq_form2")[0].reset();
            $("#info_pblq_form3")[0].reset();
            $("#info_pblq_form4")[0].reset();

            $('#apblq1_id_entreprise').val(ot_dt.row('.selected').data().id_entreprise);
            $('#apblq1_id_equipe_stt').val(ot_dt.row('.selected').data().id_equipe_stt);
            $('#apblq1_nature_travaux').val(ot_dt.row('.selected').data().type_ot);


            App.activaTab('validation-step1');
        });

        /**
         * déclarations scripts points bloquants
         * */
        pblq_dt = $('#pblq_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/pointbloquant/pointbloquant/pblq_liste.php?idchambre='+(chambre_ot_dt.row('.selected').data()!==undefined?chambre_ot_dt.row('.selected').data().id_chambre:0)
            },
            "columns": [
                { "data": "id_point_bloquant" },
                { "data": "pblq1_id_chambre" },
                { "data": "pblq1_utilisateur" },
                { "data": "pblq1_entreprise" },
                { "data": "pblq1_responsable" },
                { "data": "pblq1_ref_chantier" },
                { "data": "pblq1_date_controle" }
            ],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": false },
                {
                    "targets": 2,
                    "render": function ( data, type, full, meta ) {
                        return  full.prenom_utilisateur + ' ' + full.nom_utilisateur;
                    }
                },
                {
                    "targets": 3,
                    "render": function ( data, type, full, meta ) {
                        return full.entname;
                    }
                },
                {
                    "targets": 4,
                    "render": function ( data, type, full, meta ) {
                        return  full.prenom + ' ' + full.nom;
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(pblq_btns.join(',')).addClass("disabled");
            }
        } );

        $(pblq_btns.join(',')).addClass("disabled");

        $('#pblq_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(pblq_btns.join(',')).addClass("disabled");
            }
            else {
                pblq_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(pblq_btns.join(',')).removeClass("disabled");
            }

        } );

        $( "#delete-pblq-dialog-confirm" ).dialog({
            appendTo : '#block-content-id',
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/pointbloquant/pointbloquant/delete_pblq.php",
                        data: {
                            idp: pblq_dt.row('.selected').data().id_point_bloquant
                        }
                    }).done(function (message) {
                        pblq_dt.ajax.url( 'api/pointbloquant/pointbloquant/pblq_liste.php?idchambre='+(chambre_ot_dt.row('.selected').data()!==undefined?chambre_ot_dt.row('.selected').data().id_chambre:0) ).load();
                        $( "#delete-pblq-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_pblq").click(function(e) {
            e.preventDefault();
            $("#delete-pblq-dialog-confirm").dialog("open");
        });
        /**
         * fin déclarations scripts points bloquants
         * */

    } );
</script>

<?php

include_once __DIR__."/modals/add_pblq.php";
include_once __DIR__."/modals/update_pblq.php";

?>