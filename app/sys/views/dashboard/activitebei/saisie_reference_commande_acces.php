<div class="block block-themed" id="saisie_reference_commande_acces_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitebei_saisie_reference_commande_acces_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button id="activitebei_saisie_reference_commande_acces_block_reduce" type="button" data-toggle="block-option" data-action="content_toggle" ><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title"> Saisie de la référence de Commande d’accès</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content" id="saisie_reference_commande_acces_block_content">
            <div class="row">
                <div class="block">

                    <div class="block-content bg-info-light">
                        <table id="saisie_reference_commande_acces_ctr_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr><th colspan="3">Réseau de Transport</th></tr>
                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+5 (jours ouvrés) à partir de la date de Transmission CA</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+5 (jours ouvrés) à partir de la date de Transmission CA</th>
                                <th>BEI du NRO</th>
                            </tr>
                            <tr><th colspan="3">Réseau de Transport</th></tr>
                            </tfoot>
                        </table>
                    </div>
                    <br />
                    <br />
                    <div class="block-content bg-info-light">
                        <table id="saisie_reference_commande_acces_cdi_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr><th colspan="3">Réseau de Distribution</th></tr>
                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+5 (jours ouvrés) à partir de la date de Transmission CA</th>
                                <th>BEI du NRO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Code Sous-projet</th>
                                <th>Date calculées J+5 (jours ouvrés) à partir de la date de Transmission CA</th>
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
</div>
<script>
var saisie_reference_commande_acces_ctr_dt;
var saisie_reference_commande_acces_cdi_dt;
    $(function () {
        // Init page plugins & helpers
    });

    $(document).ready(function() {

        saisie_reference_commande_acces_ctr_dt = $('#saisie_reference_commande_acces_ctr_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#saisie_reference_commande_acces_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/saisie_reference_commande_acces_ctr_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "date_transmission_ca" },
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
                    "data": "date_transmission_ca",
                    "render": function ( data, type, full, meta ) {
                        if(full.date_transmission_ca !=null   ) {
                            var dat = new Date(full.date_transmission_ca);
                            return dat.addDays(5);

                        }
                        else return "N/D";
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#saisie_reference_commande_acces_block').removeClass('block-opt-refresh');
            }
        } );
        saisie_reference_commande_acces_cdi_dt = $('#saisie_reference_commande_acces_cdi_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#saisie_reference_commande_acces_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/saisie_reference_commande_acces_cdi_liste.php',
                "method":'POST'
            },
            "columns": [
                { "data": "code_sous_projet" },
                { "data": "date_transmission_ca" },
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
                    "data": "date_transmission_ca",
                    "render": function ( data, type, full, meta ) {
                        if(full.date_transmission_ca !=null   ) {
                            var dat = new Date(full.date_transmission_ca);
                            return dat.addDays(5);
                        }
                        else return "N/D";
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#saisie_reference_commande_acces_block').removeClass('block-opt-refresh');
            }
        } );

    } );
</script>