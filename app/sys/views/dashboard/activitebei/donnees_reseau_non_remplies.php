<div class="block block-themed" id="donnees_reseau_non_remplies_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitebei_donnees_reseau_non_remplies_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button id="activitebei_donnees_reseau_non_remplies_block_reduce" type="button" data-toggle="block-option" data-action="content_toggle" ><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"> Données Réseau non Remplies</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content" id="donnees_reseau_non_remplies_block_content">
            <div class="row">
                <div class="block">

                    <div class="block-content bg-info-light">
                        <table id="donnees_reseau_non_remplies_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                             <tr>
                                <th>Code Sous-projet</th>
                                <th>Phase</th>
                                <th>Donnée Manquante</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Phase</th>
                                <th>Donnée Manquante</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <br />
                    <br />

                </div>
            </div>

        </div>
        <!-- END Page Content -->
    </div>
</div>
<script>
var donnees_reseau_non_remplies_dt;
    $(function () {
        // Init page plugins & helpers
    });

    $(document).ready(function() {

        donnees_reseau_non_remplies_dt = $('#donnees_reseau_non_remplies_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#donnees_reseau_non_remplies_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/donnees_reseau_non_remplies_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "type_manquant" },
                { "data": "type_etape" },
                { "data": "bei_nro" }
            ],
            "columnDefs": [


                {
                    "targets": 3,
                    "data": "lib_nro",
                    "render": function ( data, type, full, meta ) {
                        if(full.nom_utilisateur !=null && full.prenom_utilisateur != null )
                            return full.nom_utilisateur + '-' + full.prenom_utilisateur;
                        else return "n/d";
                    }
                },
                {
                    "targets": 0,
                    orderData: [ 0, 1 ],
                    "data": "lib_nro",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return  '<a href="?page=sousprojet&idsousprojet='+full.id_sous_projet+'">'+full.lib_nro + '-' + full.zone+'</a>';
                        }

                        return full.lib_nro + '-' + full.zone;
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#donnees_reseau_non_remplies_block').removeClass('block-opt-refresh');
            }
        } );

    } );
</script>