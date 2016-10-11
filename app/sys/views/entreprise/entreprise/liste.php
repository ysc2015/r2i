<!-- Table entreprise -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="entreprise_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>gérant</th>
                <th>contact nom</th>
                <th>contact prénom</th>
                <th>contact émail</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>gérant</th>
                <th>contact nom</th>
                <th>contact prénom</th>
                <th>contact émail</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table entreprise -->
<script>
    var entreprise_dt;
    var btns = ["#add_equipe_show",
        "#update_entreprise_show",
        "#delete_entreprise"];
    $(document).ready(function() {
        entreprise_dt = $('#entreprise_table').DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": "api/entreprise/entreprise/entreprise_liste.php",
            "columns": [
                { "data": "id_entreprise" },
                { "data": "nom" },
                { "data": "gerant_entreprise" },
                { "data": "contact_nom" },
                { "data": "contact_prenom" },
                { "data": "contact_email" }
            ],
            "columnDefs": [
                { "targets": [0], "visible": false, "searchable": false } ],
            "order": [[1, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $(btns.join(',')).addClass("disabled");
                if(typeof equipe_dt !== 'undefined') {
                    equipe_dt.ajax.url( 'api/entreprise/equipe/equipe_liste.php?ide='+(entreprise_dt.row('.selected').data()!=undefined?entreprise_dt.row('.selected').data().id_entreprise:0) ).load();
                }
            }
        } );

        $(btns.join(',')).addClass("disabled");

        $('#entreprise_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(btns.join(',')).addClass("disabled");
            }
            else {
                entreprise_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(btns.join(',')).removeClass("disabled");
            }

            if(typeof equipe_dt !== 'undefined') {
                equipe_dt.ajax.url( 'api/entreprise/equipe/equipe_liste.php?ide='+(entreprise_dt.row('.selected').data()!=undefined?entreprise_dt.row('.selected').data().id_entreprise:0) ).load();
            }

        } );
    } );
</script>