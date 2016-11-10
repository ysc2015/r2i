<!-- Table sous projets -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="sous_projet_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id_sous_projet</th>
                <th>id_projet</th>
                <th>projet</th>
                <th>dep</th>
                <th>ville</th>
                <th>plaque</th>
                <th>zone</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id_sous_projet</th>
                <th>id_projet</th>
                <th>projet</th>
                <th>dep</th>
                <th>ville</th>
                <th>plaque</th>
                <th>zone</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table sous projets -->
<script>
    var sousprojet_dt;
    var sousprojet_dt_btns = ["#open-sub-project",
        "#delete_sub_project"];
    $(document).ready(function() {

        $(sousprojet_dt_btns.join(',')).addClass("disabled");
        sousprojet_dt = $('#sous_projet_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/projet/sousprojet/sousprojet_liste.php?idp='+(projet_dt.row('.selected').data()!=undefined?projet_dt.row('.selected').data().id_projet:0)/*,
                "type": 'POST',
                "data": function ( d ) {
                    if(typeof projet_dt !== 'undefined') {
                        return {idp : projet_dt.row('.selected').data()!=undefined?projet_dt.row('.selected').data().id_projet:0}
                    } else {
                        return {idp : 0}
                    }
                }*/
            },
            "columns": [
                { "data": "id_sous_projet" },
                { "data": "id_projet" },
                { "data": "projet_nom" },
                { "data": "dep" },
                { "data": "ville" },
                { "data": "plaque" },
                { "data": "zone" }
            ],
            "columnDefs": [
                { "targets": [ 0,1 ], "visible": false, "searchable": false },
                {
                    "targets": 2,
                    "render": function ( data, type, full, meta ) {
                        return  full.projet_nom.replace('Etude ','')+ ' ' + full.lib_nro + ' ' + full.zone;
                    }
                },
            ],
            "order": [[1, 'desc']]
            ,
            "drawCallback": function( settings ) {
                if(typeof projet_dt !== 'undefined') {
                    if(projet_dt.row('.selected').data()!=undefined) {
                        $("#listesousprojet_block_title").html('sous projets ('+projet_dt.row('.selected').data().projet_nom+')');
                    } else {
                        $("#listesousprojet_block_title").html('sous projets (tous)');
                    }
                } else {
                    $("#listesousprojet_block_title").html('sous projets (tous)');
                }
            }
        } );

        $('#sous_projet_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(sousprojet_dt_btns.join(',')).addClass("disabled");
            }
            else {
                sousprojet_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(sousprojet_dt_btns.join(',')).removeClass("disabled");
            }

        } );
    } );
</script>