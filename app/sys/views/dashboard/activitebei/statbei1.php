<div class="block block-themed" id="statbei1_block">
    <div class="block-header bg-primary-light">
        <ul class="block-options">
            <li>
                <button id="activitevpi_statbei1_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
        </ul>
        <h3 class="block-title">STAT BEI 1</h3>
    </div>
    <div class="block-content">
        <!-- Page Content -->
        <div class="content">
            <div class="row">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Retours Stt validés par le vpi / non traités par le BE</h3>
                    </div>
                    <div class="block-content bg-info-light">
                        <table id="statbei1_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr>
                                <th>nro</th>
                                <th>zone</th>
                                <th>Code Sous-projet</th>
                                <th>Etape</th>
                                <th>Date validation</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>nro</th>
                                <th>zone</th>
                                <th>Code Sous-projet</th>
                                <th>Etape</th>
                                <th>Date validation</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Etapes validées / Suiv. (non attr)</h3>
                    </div>
                    <div class="block-content bg-info-light">
                        <table id="statbei2_table1" class="table table-bordered table-striped js-dataTable-full" width="100%">
                            <thead>
                            <tr>
                                <th>nro</th>
                                <th>zone</th>
                                <th>Code Sous-projet</th>
                                <th>Etape</th>
                                <th>Date fin étape précédente</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>nro</th>
                                <th>zone</th>
                                <th>Code Sous-projet</th>
                                <th>Etape</th>
                                <th>Date fin étape précédente</th>
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

    var stat_bei_1,stat_bei_2;

    $(function () {
        // Init page plugins & helpers
    });

    $(document).ready(function() {
        stat_bei_1 = $('#statbei1_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#statbei1_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/stat_bei_1.php',
                "type":'POST'
            },
            "columns": [
                { "data": "lib_nro" },
                { "data": "zone" },
                { "data": "id_sous_projet" },
                { "data": "etape" },
                { "data": "date_retour_ok" }
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
                    "targets": 4,
                    "render": function ( data, type, full, meta ) {
                        //return  (full.date_retour_ok !== '0000-00-00 00:00:00' && full.date_retour_ok !== null ? full.date_retour_ok.substring(0, 10) : 'n/d');
                        return  (full.date_retour_ok !== '0000-00-00 00:00:00' && full.date_retour_ok !== null ? full.date_retour_ok : 'n/d');
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                $('#statbei1_block').removeClass('block-opt-refresh');
            }
        } );

        stat_bei_2 = $('#statbei2_table1').on('preXhr.dt', function ( e, settings, data ) {
            $('#statbei1_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/dashboard/activitebei/stat_bei_2.php',
                "type":'POST'
            },
            "columns": [
                { "data": "lib_nro" },
                { "data": "zone" },
                { "data": "id_sous_projet" },
                { "data": "etape" },
                { "data": "date_fin_prev_step" }
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
                    "targets": 4,
                    "render": function ( data, type, full, meta ) {
                        //return  (full.date_fin_prev_step !== '0000-00-00 00:00:00' && full.date_fin_prev_step !== null && full.date_fin_prev_step !== '' ? full.date_fin_prev_step.substring(0, 10) : 'n/d');
                        return  (full.date_fin_prev_step !== '0000-00-00 00:00:00' && full.date_fin_prev_step !== '0000-00-00' && full.date_fin_prev_step !== null && full.date_fin_prev_step !== '' ? full.date_fin_prev_step : 'n/d');
                    }
                }
            ],
            "order": [[0, 'asc']]
            ,
            "drawCallback": function( settings ) {
                $('#statbei1_block').removeClass('block-opt-refresh');
            }
        } );
    } );
</script>