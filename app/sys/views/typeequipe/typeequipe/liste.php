<!-- Table type ot -->
<div class="block">
    <div class="block-content table-responsive">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table id="type_equipe_table" class="table table-bordered table-striped js-dataTable-full" width="100%">
            <thead>
            <tr>
                <th>idteq</th>
                <th>lib</th>
                <th>visible A2T</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>idteq</th>
                <th>lib</th>
                <th>visible A2T</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Table type ot -->
<script>
    var type_eq_dt;
    var type_eq_btns = ["#update_type_eq_show",
        "#delete_type_eq"];
    $(document).ready(function() {
        type_eq_dt = $('#type_equipe_table').on('preXhr.dt', function ( e, settings, data ) {
            $('#typeeq_block').addClass('block-opt-refresh');
        }).DataTable( {
            "language": {
                "url": "assets/js/plugins/datatables/French.json"
            },
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'api/typeequipe/typeequipe/typeequipe_liste.php'
            },
            "columns": [
                { "data": "id_equipe_types" },
                { "data": "lib_type" },
                { "data": "a2t" }
            ],
            "columnDefs": [
                { "targets": [ 0 ], "visible": false, "searchable": false },
                {
                    "targets": 2,
                    "data": "a2t",
                    "render": function ( data, type, full, meta ) {
                        //return data == 1 ? "OUI" : "NON"
                        return '<label class="css-input switch switch-sm switch-success"> <input id="'+full.id_equipe_types+'" class="a2tcheckbox" type="checkbox" value="FALSE" '+(data == 1 ? 'checked=""' : '')+'><span></span></label>'
                    }
                }
            ],
            "order": [[0, 'desc']]
            ,
            "drawCallback": function( /*settings*/ ) {
                $('#typeeq_block').removeClass('block-opt-refresh');
                $(type_eq_btns.join(',')).addClass("disabled");
            }
        } );

        $(type_eq_btns.join(',')).addClass("disabled");

        $('#type_equipe_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                $(type_eq_btns.join(',')).addClass("disabled");
            }
            else {
                type_eq_dt.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');

                $(type_eq_btns.join(',')).removeClass("disabled");
            }

        } );

        $('body').on('change',".a2tcheckbox",function (e){
            e.preventDefault();
            var visa2t;
            if($(this).is(':checked')){
                visa2t = 1;
            }else{
                visa2t = 2;
            }

            console.log($( this).attr('id'));

            $('#typeeq_block').addClass('block-opt-refresh');

            $.ajax({
                method: "POST",
                url: "api/typeequipe/typeequipe/typeequipe_set_visible.php",
                dataType: "json",
                data: {
                    idt : $( this).attr('id'),
                    visa2t : visa2t
                }
            }).done(function (message) {
                if(message.error == 0) {
                    type_eq_dt.draw(false);
                }

                $('#typeeq_block').removeClass('block-opt-refresh');
            });
        });

    } );
</script>