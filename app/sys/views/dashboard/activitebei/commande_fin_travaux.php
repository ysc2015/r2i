<div class="block block-themed" id="commande_fin_travaux_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitebei_commande_fin_travaux_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button id="activitebei_commande_fin_travaux_block_reduce" type="button" data-toggle="block-option" data-action="content_toggle" ><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"> Commande Fin de Travaux</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content" id="commande_fin_travaux_block_content">
            <div class="row">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Attributions</h3>
                    </div>
                    <div class="block-content bg-info-light">
                        <table id="commande_fin_travaux_ctr_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr><th colspan="3">Réseau de Transport</th></tr>
                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+2 retour presta (jours ouvrés)</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+2 retour presta (jours ouvrés)</th>
                                <th>BEI du NRO</th>
                            </tr>
                            <tr><th colspan="3">Réseau de Transport</th></tr>
                            </tfoot>
                        </table>
                    </div>
                    <br />
                    <br />
                    <div class="block-content bg-info-light">
                        <table id="commande_fin_travaux_cdi_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr><th colspan="3">Réseau de Distribution</th></tr>
                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+2 retour presta (jours ouvrés)</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+2 retour presta (jours ouvrés)</th>
                                <th>BEI du NRO</th>
                            </tr>
                            <tr><th colspan="3">Réseau de Distribution</th></tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- END Page Content -->
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content" id="commande_fin_travaux_hors_delai_block_content">
            <div class="row">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Fin de Commande de fin de travaux Hors Délais</h3>
                    </div>
                    <div class="block-content bg-info-light">
                        <table id="commande_fin_travaux_hors_delai_ctr_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr><th colspan="3">Réseau de Transport</th></tr>
                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+3 (jours ouvrés) à partir de l’attribution de la Fin de travaux</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+3 (jours ouvrés) à partir de l’attribution de la Fin de travaux</th>
                                <th>BEI du NRO</th>
                            </tr>
                            <tr><th colspan="3">Réseau de Transport</th></tr>
                            </tfoot>
                        </table>
                    </div>
                    <br />
                    <br />
                    <div class="block-content bg-info-light">
                        <table id="commande_fin_travaux_hors_delai_cdi_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr><th colspan="3">Réseau de Distribution</th></tr>
                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+6 (jours ouvrés) à partir de l’attribution de la Fin de travaux</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+6 (jours ouvrés) à partir de l’attribution de la Fin de travaux</th>
                                <th>BEI du NRO</th>
                            </tr>
                            <tr><th colspan="3">Réseau de Distribution</th></tr>
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
var commande_fin_travaux_ctr_dt;
var commande_fin_travaux_cdi_dt;
var commande_fin_travaux_hors_delai_cdi_dt;
var commande_fin_travaux_hors_delai_ctr_dt;
    $(function () {
        // Init page plugins & helpers
    });

    $(document).ready(function() {

        commande_fin_travaux_ctr_dt = $('#commande_fin_travaux_ctr_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#commande_fin_travaux_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/commande_fin_travaux_ctr_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "date_creation" },
                { "data": "bei_nro" }
            ],
            "columnDefs": [


                {
                    "targets": 2,
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
                },
                {
                    "targets": 1,
                    orderData: [ 0, 1 ],
                    "data": "date_creation",
                    "render": function ( data, type, full, meta ) {
                        if(full.date_creation !=null   ) {
                            var dat = new Date(full.date_creation);
                            return dat.addDays(2);

                        }
                        else return "N/D";
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#commande_fin_travaux_block').removeClass('block-opt-refresh');
            }
        } );
        commande_fin_travaux_cdi_dt = $('#commande_fin_travaux_cdi_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#commande_fin_travaux_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/commande_fin_travaux_cdi_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "date_creation" },
                { "data": "bei_nro" }
            ],
            "columnDefs": [


                {
                    "targets": 2,
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
                },
                {
                    "targets": 1,
                    orderData: [ 0, 1 ],
                    "data": "date_creation",
                    "render": function ( data, type, full, meta ) {
                        if(full.date_creation !=null   ) {
                            var dat = new Date(full.date_creation);
                            return dat.addDays(2);
                        }
                        else return "N/D";
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#commande_fin_travaux_block').removeClass('block-opt-refresh');
            }
        } );
        /**
         * Commande fin travaux hors delai
         */
        commande_fin_travaux_hors_delai_ctr_dt = $('#commande_fin_travaux_hors_delai_ctr_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#commande_fin_travaux_hors_delai_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/commande_fin_travaux_hors_delai_ctr_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "date_attribution_be" },
                { "data": "bei_nro" }
            ],
            "columnDefs": [


                {
                    "targets": 2,
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
                },
                {
                    "targets": 1,
                    orderData: [ 0, 1 ],
                    "data": "date_attribution_be",
                    "render": function ( data, type, full, meta ) {
                        if(full.date_attribution_be !=null   ) {
                            var dat = new Date(full.date_attribution_be);
                            return dat.addDays(3);

                        }
                        else return "N/D";
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#commande_fin_travaux_hors_delai_block').removeClass('block-opt-refresh');
            }
        } );
        commande_fin_travaux_hors_delai_hors_delai_cdi_dt = $('#commande_fin_travaux_hors_delai_cdi_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#commande_fin_travaux_hors_delai_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/commande_fin_travaux_hors_delai_cdi_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "date_attribution_be" },
                { "data": "bei_nro" }
            ],
            "columnDefs": [


                {
                    "targets": 2,
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
                },
                {
                    "targets": 1,
                    orderData: [ 0, 1 ],
                    "data": "date_attribution_be",
                    "render": function ( data, type, full, meta ) {
                        if(full.date_attribution_be !=null   ) {
                            var dat = new Date(full.date_attribution_be);
                            return dat.addDays(6);
                        }
                        else return "N/D";
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#commande_fin_travaux_hors_delai_block').removeClass('block-opt-refresh');
            }
        } );

    } );
</script>