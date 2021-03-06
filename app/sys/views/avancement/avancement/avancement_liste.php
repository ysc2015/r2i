<!-- Table détails sous projets -->
<div class="block">
    <div class="block-content table-responsive" style="overflow-x: scroll;">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="details_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th class="bg bg-info-light" colspan="4" style="text-align: center;">Site</th>
                <!--CTR-->
                <th class="bg bg-success-light" colspan="51" style="text-align: center;">CTR</th>
                <!--CDI-->
                <th class="bg bg-warning-light" colspan="50" style="text-align: center;">CDI</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: center;">Infos Sous Projet</th>
                <!--CTR-->
                <th colspan="13" style="text-align: center;">Aiguillage</th>
                <th colspan="5" style="text-align: center;">CMD Structurante</th>
                <th colspan="14" style="text-align: center;">Tirage</th>
                <th colspan="14" style="text-align: center;">Raccordement</th>
                <th colspan="1" style="text-align: center;">Recette</th>
                <th colspan="3" style="text-align: center;">Commandes Fin Travaux</th>
                <th colspan="1" rowspan="2" style="text-align: center;">Maitre CTR</th>
                <!--CDI-->
                <th colspan="13" style="text-align: center;">Aiguillage</th>
                <th colspan="5" style="text-align: center;">CMD Structurante</th>
                <th colspan="14" style="text-align: center;">Tirage</th>
                <th colspan="14" style="text-align: center;">Raccordement</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                <th>Lien Retour</th>
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
                { "data": "ctr_aiguillage_retour_presta" },//12 = lien retour
                { "data": "ctr_aiguillage_lib_etat_retour" },
                { "data": "ctr_aiguillage_bp_no_resolu" },
                { "data": "ctr_aiguillage_bp_unanswered" },
                { "data": "ctr_aiguillage_ok" },//16
                //CMD Structurante
                { "data": "traitement_retour_terrain" },
                { "data": "ref_commande_acces" },
                { "data": "ctr_aiguillage_lib_commande_acces" },//19
                { "data": "ctr_aiguillage_lib_go_ft" },
                { "data": "ctr_commande_acces_ok" },//21
                //Tirage
                { "data": "ctr_tirage_date_ret_prevue" },
                { "data": "ctr_tirage_date_charge_be" },
                { "data": "ctr_tirage_lib_controle_plan" },
                { "data": "ctr_tirage_ordre_de_travail" },
                { "data": "ctr_tirage_ordre_de_travail_date_debut" },
                { "data": "ctr_tirage_ordre_de_travail_date_fin" },
                { "data": "ctr_tirage_date_retour" },
                { "data": "ctr_tirage_date_retour_vpi" },//29
                { "data": "ctr_tirage_date_retour" },//30
                { "data": "ctr_tirage_retour_presta" },//31 lien retour
                { "data": "ctr_tirage_lib_etat_retour" },
                { "data": "ctr_tirage_bp_no_resolu" },
                { "data": "ctr_tirage_bp_unanswered" },
                { "data": "ctr_tirage_ok" },//35
                //Raccordement
                { "data": "ctr_raccord_date_ret_prevue" },
                { "data": "ctr_raccord_date_charge_be" },
                { "data": "ctr_raccord_lib_controle_plan" },
                { "data": "ctr_raccord_ordre_de_travail" },
                { "data": "ctr_raccord_ordre_de_travail_date_debut" },
                { "data": "ctr_raccord_ordre_de_travail_date_fin" },
                { "data": "ctr_raccord_date_retour" },
                { "data": "ctr_raccord_date_retour_vpi" },//43
                { "data": "ctr_raccord_date_retour" },//44
                { "data": "ctr_raccord_retour_presta" },//45 lien retour
                { "data": "ctr_raccord_lib_etat_retour" },
                { "data": "ctr_raccord_bp_no_resolu" },
                { "data": "ctr_raccord_bp_unanswered" },
                { "data": "ctr_raccord_ok" },//49
                //Recette
                { "data": "ctr_recette_injection_netgeo" },
                //Commandes Fin Travaux
                { "data": "ref_commande_fin_travaux" },
                { "data": "ctr_aiguillage_lib_commande_acces2" },//52
                { "data": "ctr_aiguillage_lib_go_ft2" },//53
                //Maitre CTR
                { "data": "is_master" }, //54

                //CDI

                //Aiguillage
                { "data": "cdi_design_lib_ok" },
                { "data": "cdi_aiguillage_lib_controle_plan" },
                { "data": "cdi_aiguillage_ordre_de_travail" },
                { "data": "cdi_aiguillage_ordre_de_travail_date_debut" },
                { "data": "cdi_aiguillage_ordre_de_travail_date_fin" },
                { "data": "cdi_aiguillage_date_retour" },
                { "data": "cdi_aiguillage_date_retour_vpi" },//61
                { "data": "cdi_aiguillage_date_retour" },//62
                { "data": "cdi_aiguillage_retour_presta" },//63 lien retour
                { "data": "cdi_aiguillage_lib_etat_retour" },
                { "data": "cdi_aiguillage_bp_no_resolu" },
                { "data": "cdi_aiguillage_bp_unanswered" },
                { "data": "cdi_aiguillage_ok" },//67
                //CMD Structurante
                { "data": "traitement_retour_terrain2" },
                { "data": "ref_commande_acces2" },
                { "data": "cdi_aiguillage_lib_commande_acces" },//70
                { "data": "cdi_aiguillage_lib_go_ft" },
                { "data": "cdi_commande_acces_ok" },//72
                //Tirage
                { "data": "cdi_tirage_date_ret_prevue" },
                { "data": "cdi_tirage_date_charge_be" },
                { "data": "cdi_tirage_lib_controle_plan" },
                { "data": "cdi_tirage_ordre_de_travail" },
                { "data": "cdi_tirage_ordre_de_travail_date_debut" },
                { "data": "cdi_tirage_ordre_de_travail_date_fin" },
                { "data": "cdi_tirage_date_retour" },
                { "data": "cdi_tirage_date_retour_vpi" },//80
                { "data": "cdi_tirage_date_retour" },//81
                { "data": "cdi_tirage_retour_presta" },//82 lien retour
                { "data": "cdi_tirage_lib_etat_retour" },
                { "data": "cdi_tirage_bp_no_resolu" },
                { "data": "cdi_tirage_bp_unanswered" },
                { "data": "cdi_tirage_ok" },//86
                //Raccordement
                { "data": "cdi_raccord_date_ret_prevue" },
                { "data": "cdi_raccord_date_charge_be" },
                { "data": "cdi_raccord_lib_controle_plan" },
                { "data": "cdi_raccord_ordre_de_travail" },
                { "data": "cdi_raccord_ordre_de_travail_date_debut" },
                { "data": "cdi_raccord_ordre_de_travail_date_fin" },
                { "data": "cdi_raccord_date_retour" },
                { "data": "cdi_raccord_date_retour_vpi" },//94
                { "data": "cdi_raccord_date_retour" },//95
                { "data": "cdi_raccord_retour_presta" },//96 lien retour
                { "data": "cdi_raccord_lib_etat_retour" },
                { "data": "cdi_raccord_bp_no_resolu" },
                { "data": "cdi_raccord_bp_unanswered" },
                { "data": "cdi_raccord_ok" },//100
                //Recette
                { "data": "cdi_recette_injection_netgeo" },
                //Commandes Fin Travaux
                { "data": "ref_commande_fin_travaux2" },
                { "data": "cdi_aiguillage_lib_commande_acces22" },//103
                { "data": "cdi_aiguillage_lib_go_ft22" },
                //MISC
                { "data": "zone" }//105

            ],
            "columnDefs": [
                {
                    "targets": 0,
                    orderData: [ 0, 105 ],
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
                    "targets": 12,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_aiguillage_retour_presta !== '' && full.ctr_aiguillage_retour_presta !== null ? '<a target="_blank" href="'+full.ctr_aiguillage_retour_presta+'">'+full.ctr_aiguillage_retour_presta+'</a>' : 'n/d');
                    }
                },
                {
                    "targets": 16,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_aiguillage_ok === '1' ? 'OUI' : full.ctr_aiguillage_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 17,
                    "render": function ( data, type, full, meta ) {
                        return  (full.traitement_retour_terrain !== '0000-00-00' && full.traitement_retour_terrain !== null ? full.traitement_retour_terrain : 'n/d');
                    }
                },
                {
                    "targets": 19,
                    "render": function ( data, type, full, meta ) {
                        return getCmdAcces(full.ctr_aiguillage_lib_commande_acces);
                    }
                },
                {
                    "targets": 21,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_commande_acces_ok === '1' ? 'OUI' : full.ctr_commande_acces_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 22,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_ret_prevue !== '0000-00-00' && full.ctr_tirage_date_ret_prevue !== null ? full.ctr_tirage_date_ret_prevue : 'n/d');
                    }
                },
                {
                    "targets": 23,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_charge_be !== '0000-00-00 00:00:00' && full.ctr_tirage_date_charge_be !== null ? full.ctr_tirage_date_charge_be : 'n/d');
                    }
                },
                {
                    "targets": 28,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_retour !== '0000-00-00 00:00:00' && full.ctr_tirage_date_retour !== null ? full.ctr_tirage_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 29,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_retour_vpi !== '0000-00-00' && full.ctr_tirage_date_retour_vpi !== null ? full.ctr_tirage_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 30,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_date_retour !== '0000-00-00' && full.ctr_tirage_date_retour !== '0000-00-00 00:00:00' && full.ctr_tirage_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 31,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_retour_presta !== '' && full.ctr_tirage_retour_presta !== null ? '<a target="_blank" href="'+full.ctr_tirage_retour_presta+'">'+full.ctr_tirage_retour_presta+'</a>' : 'n/d');
                    }
                },
                {
                    "targets": 36,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_tirage_ok === '1' ? 'OUI' : full.ctr_tirage_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 37,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_ret_prevue !== '0000-00-00' && full.ctr_raccord_date_ret_prevue !== null ? full.ctr_raccord_date_ret_prevue : 'n/d');
                    }
                },
                {
                    "targets": 38,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_charge_be !== '0000-00-00 00:00:00' && full.ctr_raccord_date_charge_be !== null ? full.ctr_raccord_date_charge_be : 'n/d');
                    }
                },
                {
                    "targets": 42,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_retour !== '0000-00-00 00:00:00' && full.ctr_raccord_date_retour !== null ? full.ctr_raccord_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 43,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_retour_vpi !== '0000-00-00' && full.ctr_raccord_date_retour_vpi !== null ? full.ctr_raccord_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 44,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_date_retour !== '0000-00-00' && full.ctr_raccord_date_retour !== '0000-00-00 00:00:00' && full.ctr_raccord_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 45,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_retour_presta !== '' && full.ctr_raccord_retour_presta !== null ? '<a target="_blank" href="'+full.ctr_raccord_retour_presta+'">'+full.ctr_raccord_retour_presta+'</a>' : 'n/d');
                    }
                },
                {
                    "targets": 49,
                    "render": function ( data, type, full, meta ) {
                        return  (full.ctr_raccord_ok === '1' ? 'OUI' : full.ctr_raccord_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 52,
                    "render": function ( data, type, full, meta ) {
                        return getCmdAcces(full.ctr_aiguillage_lib_commande_acces2);
                    }
                },
                {
                    "targets": 54,
                    "data": "is_master",
                    "render": function ( data, type, full, meta ) {
                        if(type == "display"){
                            return full.is_master == 1 ? 'OUI' : 'NON';
                        }

                        return full.is_master;

                    }
                },
                {
                    "targets": 60,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_date_retour !== '0000-00-00 00:00:00' && full.cdi_aiguillage_date_retour !== null ? full.cdi_aiguillage_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 61,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_date_retour_vpi !== '0000-00-00' && full.cdi_aiguillage_date_retour_vpi !== null ? full.cdi_aiguillage_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 62,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_date_retour !== '0000-00-00' && full.cdi_aiguillage_date_retour !== '0000-00-00 00:00:00' && full.cdi_aiguillage_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 63,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_retour_presta !== '' && full.cdi_aiguillage_retour_presta !== null ? '<a target="_blank" href="'+full.cdi_aiguillage_retour_presta+'">'+full.cdi_aiguillage_retour_presta+'</a>' : 'n/d');
                    }
                },
                {
                    "targets": 67,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_aiguillage_ok === '1' ? 'OUI' : full.cdi_aiguillage_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 68,
                    "render": function ( data, type, full, meta ) {
                        return  (full.traitement_retour_terrain2 !== '0000-00-00' && full.traitement_retour_terrain2 !== null ? full.traitement_retour_terrain2 : 'n/d');
                    }
                },
                {
                    "targets": 70,
                    "render": function ( data, type, full, meta ) {
                        return getCmdAcces(full.cdi_aiguillage_lib_commande_acces);
                    }
                },
                {
                    "targets": 72,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_commande_acces_ok === '1' ? 'OUI' : full.cdi_commande_acces_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 73,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_ret_prevue !== '0000-00-00' && full.cdi_tirage_date_ret_prevue !== null ? full.cdi_tirage_date_ret_prevue : 'n/d');
                    }
                },
                {
                    "targets": 74,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_charge_be !== '0000-00-00 00:00:00' && full.cdi_tirage_date_charge_be !== null ? full.cdi_tirage_date_charge_be : 'n/d');
                    }
                },
                {
                    "targets": 79,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_retour !== '0000-00-00 00:00:00' && full.cdi_tirage_date_retour !== null ? full.cdi_tirage_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 80,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_retour_vpi !== '0000-00-00' && full.cdi_tirage_date_retour_vpi !== null ? full.cdi_tirage_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 81,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_date_retour !== '0000-00-00' && full.cdi_tirage_date_retour !== '0000-00-00 00:00:00' && full.cdi_tirage_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 82,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_retour_presta !== '' && full.cdi_tirage_retour_presta !== null ? '<a target="_blank" href="'+full.cdi_tirage_retour_presta+'">'+full.cdi_tirage_retour_presta+'</a>' : 'n/d');
                    }
                },
                {
                    "targets": 86,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_tirage_ok === '1' ? 'OUI' : full.cdi_tirage_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 87,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_ret_prevue !== '0000-00-00' && full.cdi_raccord_date_ret_prevue !== null ? full.cdi_raccord_date_ret_prevue : 'n/d');
                    }
                },
                {
                    "targets": 88,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_charge_be !== '0000-00-00 00:00:00' && full.cdi_raccord_date_charge_be !== null ? full.cdi_raccord_date_charge_be : 'n/d');
                    }
                },
                {
                    "targets": 93,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_retour !== '0000-00-00 00:00:00' && full.cdi_raccord_date_retour !== null ? full.cdi_raccord_date_retour : 'n/d');
                    }
                },
                {
                    "targets": 94,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_retour_vpi !== '0000-00-00' && full.cdi_raccord_date_retour_vpi !== null ? full.cdi_raccord_date_retour_vpi : 'n/d');
                    }
                },
                {
                    "targets": 95,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_date_retour !== '0000-00-00' && full.cdi_raccord_date_retour !== '0000-00-00 00:00:00' && full.cdi_raccord_date_retour !== null ? 'OUI' : 'NON');
                    }
                },
                {
                    "targets": 96,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_retour_presta !== '' && full.cdi_raccord_retour_presta !== null ? '<a target="_blank" href="'+full.cdi_raccord_retour_presta+'">'+full.cdi_raccord_retour_presta+'</a>' : 'n/d');
                    }
                },
                {
                    "targets": 100,
                    "render": function ( data, type, full, meta ) {
                        return  (full.cdi_raccord_ok === '1' ? 'OUI' : full.cdi_raccord_ok === '2' ? 'NON' : '');
                    }
                },
                {
                    "targets": 103,
                    "render": function ( data, type, full, meta ) {
                        return getCmdAcces(full.cdi_aiguillage_lib_commande_acces22);
                    }
                },
                { "targets": [ 105 ], "visible": false, "searchable": true }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#listedetails_block').removeClass('block-opt-refresh');
            }
        } );
    } );
</script>