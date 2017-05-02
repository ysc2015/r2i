<div class="block block-themed" id="gestionpbcpbt_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitevpi_gestionpbcpbt_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
        </ul>
        <h3 class="block-title">Gestion PBC / PBT</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content">
            <div class="row">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Sous Projets avec PBC sans réponse</h3>
                    </div>
                    <div class="block-content bg-info-light">
                        <table id="gestionpbcpbt_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr>
                                <th>nro</th>
                                <th>zone</th>
                                <th>Code Sous-projet</th>
                                <th>Référence OT</th>
                                <th>Statut OT</th>
                                <th>STT</th>
                                <th>PCI</th>
                                <th>Nombre PBC</th>
                                <th>Date du plus ancien PBC</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>nro</th>
                                <th>zone</th>
                                <th>Code Sous-projet</th>
                                <th>Référence OT</th>
                                <th>Statut OT</th>
                                <th>STT</th>
                                <th>PCI</th>
                                <th>Nombre PBC</th>
                                <th>Date du plus ancien PBC</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </div>
</div>
<script>

    var gestion_travaux_pbc;

    $(function () {
        // Init page plugins & helpers
    });

    $(document).ready(function() {
        gestion_travaux_pbc = $('#gestionpbcpbt_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#gestionpbcpbt_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitevpi/gestion_travaux_pbc.php',
                "type":'POST'
            },
            "columns": [
                { "data": "lib_nro" },
                { "data": "zone" },
                { "data": "id_sous_projet" },
                { "data": "type_ot" },
                { "data": "lib_etat_ot" },
                { "data": "nom" },
                { "data": "pci" },
                { "data": "nbr_pbc" },//prenom_utilisateur
                { "data": "date_oldest" }
            ],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": true },
                {
                    "targets": 2,
                    orderData: [ 0, 1 ],
                    "data": "lib_nro",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return  '<a href="?page=sousprojet&idsousprojet='+full.id_sous_projet+'">'+full.lib_nro + '-' + full.zone+'</a>';
                        }

                        return full.lib_nro + '-' + full.zone;
                    }
                },
                {
                    "targets": 3,
                    orderData: [ 3 ],
                    "data": "type_ot",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return  '<a href="?page=ot&idsousprojet='+full.id_sous_projet+'&tentree='+full.type_entree+'">'+data+'</a>';
                        }

                        return data;
                    }
                },
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#gestionpbcpbt_block').removeClass('block-opt-refresh');
            }
        } );
    } );
</script>