<div class="block block-themed" id="cats_block">
    <div class="block-header bg-amethyst-light">
        <ul class="block-options">
            <li>
                <button id="cats_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title">Catégories</h3>
    </div>
    <div class="block-content">
        <div class="block" id="cats_block_content">
            <div id="jstree_demo_div"></div>
        </div>
    </div>
</div>

<div class="block block-themed" id="subjects_liste_block">
    <div class="block-header bg-flat-light">
        <ul class="block-options">
            <li>
                <button id="subjects_liste_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title">Sujets</h3>
    </div>
    <div class="block-content">
        <div class="block" id="subjects_liste_block_content">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
            <table id="subjects_table" class="table table-bordered table-striped js-dataTable-full">
                <thead>
                <tr>
                    <th>id</th>
                    <th>sujet</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>id</th>
                    <th>sujet</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="block block-themed" id="subjects_detail_block">
    <div class="block-header bg-city-light">
        <ul class="block-options">
            <li>
                <button id="subjects_detail_block_refresh" type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
            <li>
                <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
            </li>
        </ul>
        <h3 class="block-title">Détail sujet</h3>
    </div>
    <div class="block-content">
        <div class="block" id="subjects_detail_block_content">
            <div class="row">
                <div class="col-md-10">
                    <p>fdsfdsfdsfdsfdsfdsfdsfdsfdsf;
                    dfdsf
                    dfd
                    fdfdfdsfdf</p>
                </div>
                <div class="col-md-2">

                </div>
            </div>
        </div>
    </div>
</div>

<script>

    var subjects_table;

    $(function () {
        // Init page plugins & helpers
        //$('#jstree_demo_div').jstree();

        $('#jstree_demo_div').jstree({ 'core' : {
            'data' : [
                'ex catégorie 1',
                {
                    'text' : 'Root cat 2',
                    'state' : {
                        'opened' : true,
                        'selected' : true
                    },
                    'children' : [
                        { 'text' : 'Child 1' },
                        'Child 2',
                        'Child 3',
                        'Child 4',
                        'Child 5',
                        'Child 6',
                        'Child 6',
                        'Child 6',
                        'Child 6',
                        'Child 6',
                        'Child 6',
                        'Child 6',
                    ]
                }
            ]
        } });
    });
    $(document).ready(function() {

        subjects_table = $('#subjects_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "api/utilisateur/free/free_users_liste.php",
            "columns": [
                { "data": "id_utilisateur" },
                { "data": "nom_utilisateur" }
            ],
            "order": [[0, 'desc']],
            "columnDefs": [
                { "targets": [ 0 ], "visible": false, "searchable": false }
            ],
            "drawCallback": function( /*settings*/ ) {
            }
        } );

    } );
</script>