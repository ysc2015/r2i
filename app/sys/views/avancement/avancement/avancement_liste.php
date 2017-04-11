<!-- Table détails sous projets -->
<div class="block">
    <div class="block-content table-responsive" style="overflow-x: scroll;">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="details_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th class="bg bg-info-light" colspan="4" style="text-align: center;">Site</th>
                <!--CTR-->
                <th class="bg bg-success-light" colspan="18" style="text-align: center;">CTR</th>
                <!--CDI-->
                <th class="bg bg-warning-light" colspan="17" style="text-align: center;">CDI</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Infos Sous Projet</th>
                <!--CTR-->
                <th colspan="4" style="text-align: center;">Aiguillage</th>
                <th colspan="3" style="text-align: center;">CMD Structurante</th>
                <th colspan="3" style="text-align: center;">Tirage</th>
                <th colspan="3" style="text-align: center;">Raccordement</th>
                <th colspan="1" style="text-align: center;">Recette</th>
                <th colspan="3" style="text-align: center;">Commandes Fin Travaux</th>
                <th colspan="1" rowspan="2" style="text-align: center;">Maitre CTR</th>
                <!--CDI-->
                <th colspan="4" style="text-align: center;">Aiguillage</th>
                <th colspan="3" style="text-align: center;">CMD Structurante</th>
                <th colspan="3" style="text-align: center;">Tirage</th>
                <th colspan="3" style="text-align: center;">Raccordement</th>
                <th colspan="1" style="text-align: center;">Recette</th>
                <th colspan="3" style="text-align: center;">Commandes Fin Travaux</th>
            </tr>
            <tr>
                <th>Sous-projet</th>
                <th>Ville</th>
                <th>LR</th>
                <th>LR sur PM Existant</th>

                <!--CTR-->

                <!--Aiguillage-->
                <th>Design</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--CMD Structurante-->
                <th>Réf CMD Accès</th>
                <th>Réalisation</th>
                <th>Validation</th>

                <!--Tirage-->
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--Raccordement-->
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--Recette-->
                <th>Injection NetGeo</th>

                <!--Commandes Fin Travaux-->
                <th>Réf CMD Fin Travaux</th>
                <th>Réalisation</th>
                <th>Validation</th>

                <!--MAITRE CTR
                <th>Maitre CTR</th>
                -->

                <!--CDI-->

                <!--Aiguillage-->
                <th>Design</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--CMD Structurante-->
                <th>Réf CMD Accès</th>
                <th>Réalisation</th>
                <th>Validation</th>

                <!--Tirage-->
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--Raccordement-->
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--Recette-->
                <th>Injection NetGeo</th>

                <!--Commandes Fin Travaux-->
                <th>Réf CMD Fin Travaux</th>
                <th>Réalisation</th>
                <th>Validation</th>
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

                <!--Aiguillage-->
                <th>Design</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--CMD Structurante-->
                <th>Réf CMD Accès</th>
                <th>Réalisation</th>
                <th>Validation</th>

                <!--Tirage-->
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--Raccordement-->
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--Recette-->
                <th>Injection NetGeo</th>

                <!--Commandes Fin Travaux-->
                <th>Réf CMD Fin Travaux</th>
                <th>Réalisation</th>
                <th>Validation</th>

                <!--MAITRE CTR-->
                <th>Maitre CTR</th>

                <!--CDI-->

                <!--Aiguillage-->
                <th>Design</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--CMD Structurante-->
                <th>Réf CMD Accès</th>
                <th>Réalisation</th>
                <th>Validation</th>

                <!--Tirage-->
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--Raccordement-->
                <th>Plans</th>
                <th>OT</th>
                <th>Traitement Retour</th>

                <!--Recette-->
                <th>Injection NetGeo</th>

                <!--Commandes Fin Travaux-->
                <th>Réf CMD Fin Travaux</th>
                <th>Réalisation</th>
                <th>Validation</th>
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
            "iDisplayLength":500,
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
                "url": 'api/projet/sousprojet/details_liste.php?idp=',
                "type": "POST"
            },
            "columns": [
                { "data": "lib_nro" },
                { "data": "ville" },
                { "data": "lr" },
                { "data": "lr_sur_pm" },
                //CTR
                //Aiguillage
                { "data": "ctr_design_lib_ok" },
                { "data": "ctr_aiguillage_lib_controle_plan" },
                { "data": "ctr_aiguillage_ordre_de_travail" },
                { "data": "ctr_aiguillage_lib_etat_retour" },
                //CMD Structurante
                { "data": "ref_commande_acces" },
                { "data": "ctr_aiguillage_lib_commande_acces" },
                { "data": "ctr_aiguillage_lib_go_ft" },
                //Tirage
                { "data": "ctr_tirage_lib_controle_plan" },
                { "data": "ctr_tirage_ordre_de_travail" },
                { "data": "ctr_tirage_lib_etat_retour" },
                //Raccordement
                { "data": "ctr_raccord_lib_controle_plan" },
                { "data": "ctr_raccord_ordre_de_travail" },
                { "data": "ctr_raccord_lib_etat_retour" },
                //Recette
                { "data": "ctr_recette_etat_recette" },
                //Commandes Fin Travaux
                { "data": "ref_commande_fin_travaux" },
                { "data": "ctr_aiguillage_lib_commande_acces2" },
                { "data": "ctr_aiguillage_lib_go_ft2" },
                //Maitre CTR
                { "data": "is_master" },
                //CDI
                //Aiguillage
                { "data": "cdi_design_lib_ok" },
                { "data": "cdi_aiguillage_lib_controle_plan" },
                { "data": "cdi_aiguillage_ordre_de_travail" },
                { "data": "cdi_aiguillage_lib_etat_retour" },
                //CMD Structurante
                { "data": "ref_commande_acces2" },
                { "data": "cdi_aiguillage_lib_commande_acces" },
                { "data": "cdi_aiguillage_lib_go_ft" },
                //Tirage
                { "data": "cdi_tirage_lib_controle_plan" },
                { "data": "cdi_tirage_ordre_de_travail" },
                { "data": "cdi_tirage_lib_etat_retour" },
                //Raccordement
                { "data": "cdi_raccord_lib_controle_plan" },
                { "data": "cdi_raccord_ordre_de_travail" },
                { "data": "cdi_raccord_lib_etat_retour" },
                //Recette
                { "data": "cdi_recette_etat_recette" },
                //Commandes Fin Travaux
                { "data": "ref_commande_fin_travaux2" },
                { "data": "ctr_aiguillage_lib_commande_acces22" },
                { "data": "ctr_aiguillage_lib_go_ft22" },
                //MISC
                { "data": "zone" }

            ],
            "columnDefs": [
                {
                    "targets": 0,
                    orderData: [ 0, 35 ],
                    "data": "lib_nro",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return  '<a href="?page=sousprojet&idsousprojet='+full.id_sous_projet+'">'+full.lib_nro + '-' + full.zone+'</a>';
                        }

                        return full.lib_nro + '-' + full.zone;
                    }
                },
                {
                    "targets": 21,
                    "data": "is_master",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return full.is_master == 1 ? 'OUI' : 'NON';
                        }

                        return full.is_master;

                    }
                },
                { "targets": [ 39 ], "visible": false, "searchable": true }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
            }
        } );
    } );
</script>