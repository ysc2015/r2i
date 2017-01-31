<!-- Table détails sous projets -->
<div class="block">
    <div class="block-content table-responsive" style="overflow-x: scroll;">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="details_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th class="bg bg-info-light" colspan="4" style="text-align: center;">Site</th>
                <!--CTR-->
                <th class="bg bg-success-light" colspan="12" style="text-align: center;">CTR</th>
                <!--CDI-->
                <th class="bg bg-warning-light" colspan="12" style="text-align: center;">CDI</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Infos Sous Projet</th>
                <!--CTR-->
                <th colspan="4" style="text-align: center;">Aiguillage</th>
                <th colspan="2" style="text-align: center;">CMD Structurante</th>
                <th colspan="3" style="text-align: center;">Tirage</th>
                <th colspan="3" style="text-align: center;">Raccordement</th>
                <!--CDI-->
                <th colspan="4" style="text-align: center;">Aiguillage</th>
                <th colspan="2" style="text-align: center;">CMD Structurante</th>
                <th colspan="3" style="text-align: center;">Tirage</th>
                <th colspan="3" style="text-align: center;">Raccordement</th>
            </tr>
            <tr>
                <th>Sous-projet</th>
                <th>Ville</th>
                <th>LR</th>
                <th>LR sur PM Existant</th>
                <!--CTR-->
                <th>Design</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <th>Réalisation</th>
                <th>Validation</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <!--CDI-->
                <th>Design</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <th>Réalisation</th>
                <th>Validation</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>Sous-projet</th>
                <th>Ville</th>
                <th>LR</th>
                <th>LR sur PM Existant</th>
                <!--CTR-->
                <th>Design</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <th>Réalisation</th>
                <th>Validation</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <!--CDI-->
                <th>Design</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <th>Réalisation</th>
                <th>Validation</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table détails sous projets -->

<script>
    var details_dt;
    $(document).ready(function() {

        details_dt = $('#details_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: 'Excel',
                    header : true,
                    className : 'button button-primary',
                    filename : 'avancement général'
                }
            ],
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/projet/sousprojet/details_liste.php?idp='
            },
            "columns": [
                { "data": "id_sous_projet" },
                { "data": "ville" },
                { "data": "lr" },
                { "data": "lr_sur_pm" },
                { "data": "ctr_design_lib_ok" },
                { "data": "ctr_aiguillage_lib_controle_plan" },
                { "data": "ctr_aiguillage_ordre_de_travail" },
                { "data": "ctr_aiguillage_lib_etat_retour" },
                { "data": "ctr_aiguillage_lib_commande_acces" },
                { "data": "ctr_aiguillage_lib_go_ft" },
                { "data": "ctr_tirage_lib_controle_plan" },
                { "data": "ctr_tirage_ordre_de_travail" },
                { "data": "ctr_tirage_lib_etat_retour" },
                { "data": "ctr_raccord_lib_controle_plan" },
                { "data": "ctr_raccord_ordre_de_travail" },
                { "data": "ctr_raccord_lib_etat_retour" },
                { "data": "cdi_design_lib_ok" },
                { "data": "cdi_raccord_lib_controle_plan" },
                { "data": "cdi_raccord_ordre_de_travail" },
                { "data": "cdi_raccord_lib_etat_retour" },
                { "data": "cdi_aiguillage_lib_commande_acces" },
                { "data": "cdi_aiguillage_lib_go_ft" },
                { "data": "cdi_tirage_lib_controle_plan" },
                { "data": "cdi_tirage_ordre_de_travail" },
                { "data": "cdi_tirage_lib_etat_retour" },
                { "data": "cdi_raccord_lib_controle_plan" },
                { "data": "cdi_raccord_ordre_de_travail" },
                { "data": "cdi_raccord_lib_etat_retour" }

            ],
            "columnDefs": [
                /*{ "targets": [ 0,1 ], "visible": false, "searchable": false },*/
                /*{ "targets": [ 7 ], "visible": false, "searchable": true },*/
                {
                    "targets": 0,
                    "render": function ( data, type, full, meta ) {
                        return  '<a href="?page=sousprojet&idsousprojet='+full.id_sous_projet+'">'+full.lib_nro + '-' + full.zone+'</a>';
                    }
                },
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
            }
        } );
    } );
</script>