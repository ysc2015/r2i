<!-- Table projets -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="projet_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>id</th>
                <th>id chefs de projet</th>
                <th>projet</th>
                <th><?=$lang["date_creation"]?></th>
                <th><?=$lang["date_attribution"]?></th>
                <th style="width: 20%;">%</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>id</th>
                <th>id chefs de projet</th>
                <th>projet</th>
                <th><?=$lang["date_creation"]?></th>
                <th><?=$lang["date_attribution"]?></th>
                <th style="width: 20%;">%</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table projets -->
<script>
    var projet_dt;
    var btns = ["#add_sub_project_show",
        "#update_project_show",
        "#delete_project"];
    $(document).ready(function() {
        projet_dt = $('#projet_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "api/projet/projet/projet_liste.php",
            "columns": [
                { "data": "id_projet" },
                { "data": "id_projet_osa" },
                { "data": "id_chef_projet" },
                { "data": "projet_nom" },
                { "data": "date_creation" },
                { "data": "date_attribution" },
                { "data": "id_projet" }
            ],
            "columnDefs": [
                { "targets": [ 0,1,2 ], "visible": false, "searchable": false },
                {
                    "targets": 6,
                    "data": "id_projet",
                    "render": function ( data, type, full, meta ) {
                        return '<span class="label label-info">40%</span>';
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( settings ) {
                console.log('drawCallback');
                if(typeof sousprojet_dt !== 'undefined') {
                    sousprojet_dt.draw(false);
                    $("#listesousprojet_block_title").html('sous projets (tous)');
                }
            }
        } );

        $(btns.join(',')).addClass("disabled");

        $('#projet_table tbody').on( 'click', 'tr', function (evt) {
            var $table=$(evt.target).closest('table');
            if($table.attr('id').indexOf('projet_table') > -1) {
                if ( $(this).hasClass('selected') ) {
                    $("#listesousprojet_block_title").html('sous projets (tous)');
                    $(this).removeClass('selected');
                    $('.linked').prop('disabled', true);
                    $(btns.join(',')).addClass("disabled");

                }
                else {
                    projet_dt.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                    $(btns.join(',')).removeClass("disabled");
                    if(projet_dt.row('.selected').data() != undefined) {
                        $('.linked').prop('disabled', false);
                    }

                    $("#listesousprojet_block_title").html('sous projets ('+projet_dt.row('.selected').data().projet_nom+')');
                }
            }
            if(typeof sousprojet_dt !== 'undefined') {
                sousprojet_dt.draw(false);
            }
        } );

        $("#listesousprojet_block_title").html('sous projets (tous)');
    } );
</script>