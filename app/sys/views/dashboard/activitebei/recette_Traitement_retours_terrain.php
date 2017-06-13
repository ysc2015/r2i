<div class="block block-themed" id="recette_Traitement_retours_terrain_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitebei_recette_Traitement_retours_terrain_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button id="activitebei_recette_Traitement_retours_terrain_block_reduce" type="button" data-toggle="block-option" data-action="content_toggle" ><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"> Traitement des retours terrain</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content" id="recette_Traitement_retours_terrain_block_content">
            <div class="row">
                <div class="block">

                    <div class="block-content bg-info-light">
                        <table id="recette_Traitement_retours_terrain_ctr_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
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
                        <table id="recette_Traitement_retours_terrain_cdi_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
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
                            <tr><th colspan="3">Réseau de Transport</th></tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- END Page Content -->
    </div>
</div><div class="block block-themed" id="recette_Traitement_recette_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitebei_recette_Traitement_recette_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button id="activitebei_recette_Traitement_recette_block_reduce" type="button" data-toggle="block-option" data-action="content_toggle" ><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"> Traitement Recette</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content" id="recette_Traitement_recette_block_content">
            <div class="row">
                <div class="block">

                    <div class="block-content bg-info-light">
                        <table id="recette_Traitement_recette_cdi_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr>
                                <th>Code Sous-projet</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Code Sous-projet</th>
                                <th>BEI du NRO</th>
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
var recette_Traitement_retours_terrain_ctr_dt;
var recette_Traitement_retours_terrain_cdi_dt;
var recette_Traitement_recette_dt;
    $(function () {
        // Init page plugins & helpers
    });

    $(document).ready(function() {

        recette_Traitement_retours_terrain_ctr_dt = $('#recette_Traitement_retours_terrain_ctr_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#recette_Traitement_retours_terrain_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/recette_Traitement_retours_terrain_ctr_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "date_attribution_doe" },
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
                    "data": "date_attribution_doe",
                    "render": function ( data, type, full, meta ) {
                        if(full.date_attribution_doe !=null   ) {
                            var dat = new Date(full.date_attribution_doe);
                            return dat.addDays(3);

                        }
                        else return "N/D";
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#recette_Traitement_retours_terrain_block').removeClass('block-opt-refresh');
            }
        } );
        recette_Traitement_retours_terrain_cdi_dt = $('#recette_Traitement_retours_terrain_cdi_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#recette_Traitement_retours_terrain_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/recette_Traitement_retours_terrain_cdi_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "date_attribution_doe" },
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
                    "data": "date_attribution_doe",
                    "render": function ( data, type, full, meta ) {
                        if(full.date_attribution_doe !=null   ) {
                            var dat = new Date(full.date_attribution_doe);
                            return dat.addDays(6);
                        }
                        else return "N/D";
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#recette_Traitement_retours_terrain_block').removeClass('block-opt-refresh');
            }
        } );
        recette_Traitement_recette_dt = $('#recette_Traitement_recette_cdi_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#recette_Traitement_recette_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/recette_Traitement_recette_cdi_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "bei_nro" }
            ],
            "columnDefs": [


                {
                    "targets": 1,
                    "data": "bei_nro",
                    "render": function ( data, type, full, meta ) {
                        if(full.nom_utilisateur !=null && full.prenom_utilisateur != null )
                            return full.nom_utilisateur + '-' + full.prenom_utilisateur;
                        else return "n/d";
                    }
                },
                {
                    "targets": 0,
                    orderData: [ 0, 1 ],
                    "data": "code_sous_projet",
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
                $('#recette_Traitement_recette_block').removeClass('block-opt-refresh');
            }
        } );

    } );
</script>