<!-- Table détails sous projets -->
<div class="block">
    <div class="block-content table-responsive" style="overflow-x: scroll;">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="details_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th class="bg bg-info-light" colspan="4" style="text-align: center;">Site</th>
                <!--CTR-->
                <th class="bg bg-success-light" colspan="48" style="text-align: center;">CTR</th>
                <!--CDI-->
                <th class="bg bg-warning-light" colspan="47" style="text-align: center;">CDI</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Infos Sous Projet</th>
                <!--CTR-->
                <th colspan="12" style="text-align: center;">Aiguillage</th>
                <th colspan="5" style="text-align: center;">CMD Structurante</th>
                <th colspan="13" style="text-align: center;">Tirage</th>
                <th colspan="13" style="text-align: center;">Raccordement</th>
                <th colspan="1" style="text-align: center;">Recette</th>
                <th colspan="3" style="text-align: center;">Commandes Fin Travaux</th>
                <th colspan="1" rowspan="2" style="text-align: center;">Maitre CTR</th>
                <!--CDI-->
                <th colspan="12" style="text-align: center;">Aiguillage</th>
                <th colspan="5" style="text-align: center;">CMD Structurante</th>
                <th colspan="13" style="text-align: center;">Tirage</th>
                <th colspan="13" style="text-align: center;">Raccordement</th>
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
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret Presta Validé</th>

                <!--CMD Structurante-->
                <th>Date Traitement Ret terrain</th>
                <th>Réf CMD Accès</th>
                <th>Réalisation</th>
                <th>Validation</th>
                <th>Réalis. Ensemble CMD Struc</th>

                <!--Tirage-->
                <th>Date prév de fin tirage</th>
                <th>Date prise en charge BE</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret. Presta validé</th>

                <!--Raccordement-->
                <th>Date prév de fin tirage</th>
                <th>Date prise en charge BE</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret Presta Validé</th>

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
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret Presta Validé</th>

                <!--CMD Structurante-->
                <th>Date Traitement Ret terrain</th>
                <th>Réf CMD Accès</th>
                <th>Réalisation</th>
                <th>Validation</th>
                <th>Réalis. Ensemble CMD Struc</th>

                <!--Tirage-->
                <th>Date prév de fin tirage</th>
                <th>Date prise en charge BE</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret. Presta validé</th>

                <!--Raccordement-->
                <th>Date prév de fin tirage</th>
                <th>Date prise en charge BE</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret Presta Validé</th>

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
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret Presta Validé</th>

                <!--CMD Structurante-->
                <th>Date Traitement Ret terrain</th>
                <th>Réf CMD Accès</th>
                <th>Réalisation</th>
                <th>Validation</th>
                <th>Réalis. Ensemble CMD Struc</th>

                <!--Tirage-->
                <th>Date prév de fin tirage</th>
                <th>Date prise en charge BE</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret. Presta validé</th>

                <!--Raccordement-->
                <th>Date prév de fin tirage</th>
                <th>Date prise en charge BE</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret Presta Validé</th>

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
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret Presta Validé</th>

                <!--CMD Structurante-->
                <th>Date Traitement Ret terrain</th>
                <th>Réf CMD Accès</th>
                <th>Réalisation</th>
                <th>Validation</th>
                <th>Réalis. Ensemble CMD Struc</th>

                <!--Tirage-->
                <th>Date prév de fin tirage</th>
                <th>Date prise en charge BE</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret. Presta validé</th>

                <!--Raccordement-->
                <th>Date prév de fin tirage</th>
                <th>Date prise en charge BE</th>
                <th>Plans</th>
                <th>OT</th>
                <th>Date début OT</th>
                <th>Date fin OT</th>
                <th>Date dérnier upload Retour</th>
                <th>Date Retour VPI</th>
                <th>Retour</th>
                <th>Traitement Retour</th>
                <th>pbc non résolus</th>
                <th>pbc non répondus</th>
                <th>Ret Presta Validé</th>

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
    function getCmdAcces(i) {
        switch (i) {
            case '1' : return 'En Cours';break;
            case '2' : return 'Réalisée';break;
            default : return '';break;
        }
    }
    var details_dt;
    $(document).ready(function() {

        details_dt = $('#details_table').on('preXhr.dt', function ( e, settings, data ) {
            $('#listedetails_block').addClass('block-opt-refresh');
        }).DataTable( {
            "iDisplayLength":1000,
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
                { "data": "lr_sur_pm" },//3
                //CTR
                //Aiguillage
                { "data": "ctr_design_lib_ok" },
                { "data": "ctr_aiguillage_lib_controle_plan" },
                { "data": "ctr_aiguillage_ordre_de_travail" },
                { "data": "ctr_aiguillage_ordre_de_travail_date_debut" },
                { "data": "ctr_aiguillage_ordre_de_travail_date_fin" },
                { "data": "ctr_aiguillage_date_retour" },
                { "data": "ctr_aiguillage_date_retour_vpi" },//10
                { "data": "ctr_aiguillage_date_retour" },
                { "data": "ctr_aiguillage_lib_etat_retour" },
                { "data": "ctr_aiguillage_bp_no_resolu" },
                { "data": "ctr_aiguillage_bp_unanswered" },
                { "data": "ctr_aiguillage_ok" },//15
                //CMD Structurante
                { "data": "traitement_retour_terrain" },
                { "data": "ref_commande_acces" },
                { "data": "ctr_aiguillage_lib_commande_acces" },//18
                { "data": "ctr_aiguillage_lib_go_ft" },
                { "data": "ctr_commande_acces_ok" },//20
                //Tirage
                { "data": "ctr_tirage_date_ret_prevue" },
                { "data": "ctr_tirage_date_charge_be" },
                { "data": "ctr_tirage_lib_controle_plan" },
                { "data": "ctr_tirage_ordre_de_travail" },
                { "data": "ctr_tirage_ordre_de_travail_date_debut" },
                { "data": "ctr_tirage_ordre_de_travail_date_fin" },
                { "data": "ctr_tirage_date_retour" },
                { "data": "ctr_tirage_date_retour_vpi" },//28
                { "data": "ctr_tirage_date_retour" },//29
                { "data": "ctr_tirage_lib_etat_retour" },
                { "data": "ctr_tirage_bp_no_resolu" },
                { "data": "ctr_tirage_bp_unanswered" },
                { "data": "ctr_tirage_ok" },//33
                //Raccordement
                { "data": "ctr_raccord_date_ret_prevue" },
                { "data": "ctr_raccord_date_charge_be" },
                { "data": "ctr_raccord_lib_controle_plan" },
                { "data": "ctr_raccord_ordre_de_travail" },
                { "data": "ctr_raccord_ordre_de_travail_date_debut" },
                { "data": "ctr_raccord_ordre_de_travail_date_fin" },
                { "data": "ctr_raccord_date_retour" },
                { "data": "ctr_raccord_date_retour_vpi" },//41
                { "data": "ctr_raccord_date_retour" },
                { "data": "ctr_raccord_lib_etat_retour" },
                { "data": "ctr_raccord_bp_no_resolu" },
                { "data": "ctr_raccord_bp_unanswered" },
                { "data": "ctr_raccord_ok" },//46
                //Recette
                { "data": "ctr_recette_injection_netgeo" },
                //Commandes Fin Travaux
                { "data": "ref_commande_fin_travaux" },
                { "data": "ctr_aiguillage_lib_commande_acces2" },//49
                { "data": "ctr_aiguillage_lib_go_ft2" },//50
                //Maitre CTR
                { "data": "is_master" }, //51

                //CDI

                //Aiguillage
                { "data": "cdi_design_lib_ok" },
                { "data": "cdi_aiguillage_lib_controle_plan" },
                { "data": "cdi_aiguillage_ordre_de_travail" },
                { "data": "cdi_aiguillage_ordre_de_travail_date_debut" },
                { "data": "cdi_aiguillage_ordre_de_travail_date_fin" },
                { "data": "cdi_aiguillage_date_retour" },
                { "data": "cdi_aiguillage_date_retour_vpi" },//58
                { "data": "cdi_aiguillage_date_retour" },
                { "data": "cdi_aiguillage_lib_etat_retour" },
                { "data": "cdi_aiguillage_bp_no_resolu" },
                { "data": "cdi_aiguillage_bp_unanswered" },
                { "data": "cdi_aiguillage_ok" },//63
                //CMD Structurante
                { "data": "traitement_retour_terrain2" },
                { "data": "ref_commande_acces2" },
                { "data": "cdi_aiguillage_lib_commande_acces" },//66
                { "data": "cdi_aiguillage_lib_go_ft" },
                { "data": "cdi_commande_acces_ok" },//68
                //Tirage
                { "data": "cdi_tirage_date_ret_prevue" },
                { "data": "cdi_tirage_date_charge_be" },
                { "data": "cdi_tirage_lib_controle_plan" },
                { "data": "cdi_tirage_ordre_de_travail" },
                { "data": "cdi_tirage_ordre_de_travail_date_debut" },
                { "data": "cdi_tirage_ordre_de_travail_date_fin" },
                { "data": "cdi_tirage_date_retour" },
                { "data": "cdi_tirage_date_retour_vpi" },//76
                { "data": "cdi_tirage_date_retour" },
                { "data": "cdi_tirage_lib_etat_retour" },
                { "data": "cdi_tirage_bp_no_resolu" },
                { "data": "cdi_tirage_bp_unanswered" },
                { "data": "cdi_tirage_ok" },//81
                //Raccordement
                { "data": "cdi_raccord_date_ret_prevue" },
                { "data": "cdi_raccord_date_charge_be" },
                { "data": "cdi_raccord_lib_controle_plan" },
                { "data": "cdi_raccord_ordre_de_travail" },
                { "data": "cdi_raccord_ordre_de_travail_date_debut" },
                { "data": "cdi_raccord_ordre_de_travail_date_fin" },
                { "data": "cdi_raccord_date_retour" },
                { "data": "cdi_raccord_date_retour_vpi" },//89
                { "data": "cdi_raccord_date_retour" },
                { "data": "cdi_raccord_lib_etat_retour" },
                { "data": "cdi_raccord_bp_no_resolu" },
                { "data": "cdi_raccord_bp_unanswered" },
                { "data": "cdi_raccord_ok" },//94
                //Recette
                { "data": "cdi_recette_injection_netgeo" },
                //Commandes Fin Travaux
                { "data": "ref_commande_fin_travaux2" },
                { "data": "cdi_aiguillage_lib_commande_acces22" },//97
                { "data": "cdi_aiguillage_lib_go_ft22" },
                //MISC
                { "data": "zone" }//99

            ],
            "columnDefs": [
                {
                    "targets": 0,
                    orderData: [ 0, 99 ],
                    "data": "lib_nro",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return  '<a href="?page=sousprojet&idsousprojet='+full.id_sous_projet+'">'+full.lib_nro + '-' + full.zone+'</a>';
                        }

                        return full.lib_nro + '-' + full.zone;
                    }
                },
                {
                    "targets": 4,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_design_lib_ok === '1' ? 'OUI' : full.ctr_design_lib_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 9,
                    "render": function ( data, type, full, meta ) {
                        //return  (full.date_retour_ok !== '0000-00-00 00:00:00' && full.date_retour_ok !== null ? full.date_retour_ok.substring(0, 10) : 'n/d');
                        return  (full.ctr_aiguillage_date_retour !== '0000-00-00 00:00:00' && full.ctr_aiguillage_date_retour !== null ? full.ctr_aiguillage_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 10,
                    "render": function ( data, type, full, meta ) {
                        //return  (full.date_retour_ok !== '0000-00-00 00:00:00' && full.date_retour_ok !== null ? full.date_retour_ok.substring(0, 10) : 'n/d');
                        return  (full.ctr_aiguillage_date_retour_vpi !== '0000-00-00' && full.ctr_aiguillage_date_retour_vpi !== null ? full.ctr_aiguillage_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 11,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_aiguillage_date_retour !== '0000-00-00' && full.ctr_aiguillage_date_retour !== '0000-00-00 00:00:00' && full.ctr_aiguillage_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 15,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_aiguillage_ok === '1' ? 'OUI' : full.ctr_aiguillage_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 16,
                    "render": function ( data, type, full, meta ) {
                        return  (full.traitement_retour_terrain !== '0000-00-00' && full.traitement_retour_terrain !== null ? full.traitement_retour_terrain : 'n/d');
                    }
                },
                {
                    "targets": 18,
                    "render": function ( data, type, full, meta ) {
                        return getCmdAcces(full.ctr_aiguillage_lib_commande_acces);
                    }
                },
                {
                    "targets": 20,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_commande_acces_ok === '1' ? 'OUI' : full.ctr_commande_acces_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 21,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_ret_prevue !== '0000-00-00' && full.ctr_tirage_date_ret_prevue !== null ? full.ctr_tirage_date_ret_prevue : 'n/d');
                    }
                },
                {
                    "targets": 22,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_charge_be !== '0000-00-00 00:00:00' && full.ctr_tirage_date_charge_be !== null ? full.ctr_tirage_date_charge_be : 'n/d');
                    }
                },
                {
                    "targets": 27,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_retour !== '0000-00-00 00:00:00' && full.ctr_tirage_date_retour !== null ? full.ctr_tirage_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 28,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_retour_vpi !== '0000-00-00' && full.ctr_tirage_date_retour_vpi !== null ? full.ctr_tirage_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 29,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_retour !== '0000-00-00' && full.ctr_tirage_date_retour !== '0000-00-00 00:00:00' && full.ctr_tirage_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 34,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_ok === '1' ? 'OUI' : full.ctr_tirage_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 35,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_ret_prevue !== '0000-00-00' && full.ctr_raccord_date_ret_prevue !== null ? full.ctr_raccord_date_ret_prevue : 'n/d');
                    }
                },
                {
                    "targets": 36,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_charge_be !== '0000-00-00 00:00:00' && full.ctr_raccord_date_charge_be !== null ? full.ctr_raccord_date_charge_be : 'n/d');
                    }
                },
                {
                    "targets": 40,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_retour !== '0000-00-00 00:00:00' && full.ctr_raccord_date_retour !== null ? full.ctr_raccord_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 41,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_retour_vpi !== '0000-00-00' && full.ctr_raccord_date_retour_vpi !== null ? full.ctr_raccord_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 42,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_retour !== '0000-00-00' && full.ctr_raccord_date_retour !== '0000-00-00 00:00:00' && full.ctr_raccord_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 46,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_ok === '1' ? 'OUI' : full.ctr_raccord_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 49,
                    "render": function ( data, type, full, meta ) {
                        return getCmdAcces(full.ctr_aiguillage_lib_commande_acces2);
                    }
                },
                {
                    "targets": 51,
                    "data": "is_master",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return full.is_master == 1 ? 'OUI' : 'NON';
                        }

                        return full.is_master;

                    }
                },
                {
                    "targets": 57,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_date_retour !== '0000-00-00 00:00:00' && full.cdi_aiguillage_date_retour !== null ? full.cdi_aiguillage_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 58,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_date_retour_vpi !== '0000-00-00' && full.cdi_aiguillage_date_retour_vpi !== null ? full.cdi_aiguillage_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 59,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_date_retour !== '0000-00-00' && full.cdi_aiguillage_date_retour !== '0000-00-00 00:00:00' && full.cdi_aiguillage_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 63,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_ok === '1' ? 'OUI' : full.cdi_aiguillage_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 64,
                    "render": function ( data, type, full, meta ) {
                        return  (full.traitement_retour_terrain2 !== '0000-00-00' && full.traitement_retour_terrain2 !== null ? full.traitement_retour_terrain2 : 'n/d');
                    }
                },
                {
                    "targets": 66,
                    "render": function ( data, type, full, meta ) {
                        return getCmdAcces(full.cdi_aiguillage_lib_commande_acces);
                    }
                },
                {
                    "targets": 68,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_commande_acces_ok === '1' ? 'OUI' : full.cdi_commande_acces_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 69,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_ret_prevue !== '0000-00-00' && full.cdi_tirage_date_ret_prevue !== null ? full.cdi_tirage_date_ret_prevue : 'n/d');
                    }
                },
                {
                    "targets": 70,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_charge_be !== '0000-00-00 00:00:00' && full.cdi_tirage_date_charge_be !== null ? full.cdi_tirage_date_charge_be : 'n/d');
                    }
                },
                {
                    "targets": 75,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_retour !== '0000-00-00 00:00:00' && full.cdi_tirage_date_retour !== null ? full.cdi_tirage_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 76,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_retour_vpi !== '0000-00-00' && full.cdi_tirage_date_retour_vpi !== null ? full.cdi_tirage_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 77,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_retour !== '0000-00-00' && full.cdi_tirage_date_retour !== '0000-00-00 00:00:00' && full.cdi_tirage_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 81,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_ok === '1' ? 'OUI' : full.cdi_tirage_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 82,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_ret_prevue !== '0000-00-00' && full.cdi_raccord_date_ret_prevue !== null ? full.cdi_raccord_date_ret_prevue : 'n/d');
                    }
                },
                {
                    "targets": 83,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_charge_be !== '0000-00-00 00:00:00' && full.cdi_raccord_date_charge_be !== null ? full.cdi_raccord_date_charge_be : 'n/d');
                    }
                },
                {
                    "targets": 88,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_retour !== '0000-00-00 00:00:00' && full.cdi_raccord_date_retour !== null ? full.cdi_raccord_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 89,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_retour_vpi !== '0000-00-00' && full.cdi_raccord_date_retour_vpi !== null ? full.cdi_raccord_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 90,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_retour !== '0000-00-00' && full.cdi_raccord_date_retour !== '0000-00-00 00:00:00' && full.cdi_raccord_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 94,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_ok === '1' ? 'OUI' : full.cdi_raccord_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 97,
                    "render": function ( data, type, full, meta ) {
                        return getCmdAcces(full.cdi_aiguillage_lib_commande_acces22);
                    }
                },
                { "targets": [ 99 ], "visible": false, "searchable": true }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#listedetails_block').removeClass('block-opt-refresh');
            }
        } );
    } );
</script>