<div class="row">
    <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Affichage">
        <div id="view-mode" class="btn-group" data-toggle="btn-toggle">
            <a title="Mode DataGrid" data-view="list" class="btn btn-primary btn-sm active changeview" style="margin-right: 5px;"><i class="fa fa-table text-green"></i></a>
            <a title="Mode Calendrier" data-view="cal" class="btn btn-info btn-sm changeview"><i class="fa fa-calendar text-blue"></i></a>
        </div>
    </div>
</div>
<div class="row" id="planning_wrapper" style="padding-top: 10px;">
    <?php
    include "views/datagrid.php";
    ?>
</div>
<script>
    var defaultView = 'list';
    var calendar = function() {
        var initCalendar = function() {
            $('#calender').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                }
            });
        }
        return {
            initCalendar : initCalendar
        }
    }();
    var planning = function() {
        var old_tr = null;
        var old_tr_class = '';
        var ot_affect_dt;
        var ot_affect_btns = ["#affecter_ot_show","#annuler_affecter"];
        var initContent = function(view) {

            $("#planning_block").toggleClass('block-opt-refresh');
            $.ajax({
                method: "POST",
                data: {
                    view : view
                },
                url: "api/ot/planningot/load_content.php"
            }).done(function (msg) {
                $("#planning_wrapper").html(msg);
                $("#planning_block").removeClass('block-opt-refresh');

                init(view);
                initEvents(view);
            });
        }
        var init = function(view) {
            switch (view) {
                case 'cal' :
                    calendar.initCalendar();
                    break;
                case 'list' :
                    ot_affect_dt = $('#ot_affect_table').DataTable( {
                        "language": {
                            "url": "assets/js/plugins/datatables/French.json"
                        },
                        "autoWidth": false,
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": 'api/ot/ot/ot_affect_liste.php?idsp='+get('idsousprojet')+'&tentree='+get('tentree')
                        },
                        "columns": [
                            { "data": "id_ordre_de_travail" },
                            { "data": "id_sous_projet" },
                            { "data": "type_entree" },
                            { "data": "lib_type_ordre_travail" },
                            { "data": "nom" },
                            { "data": "eqprenom" },
                            { "data": "eqnom" },
                            { "data": "date_debut" },
                            { "data": "date_fin" }
                        ],
                        "columnDefs": [
                            { "targets": [ 0,1,2 ], "visible": false, "searchable": false }
                        ],
                        "order": [[0, 'desc']]
                        ,
                        "drawCallback": function( /*settings*/ ) {
                            $(ot_affect_btns.join(',')).addClass("disabled");
                        },
                        "createdRow": function( row, data, dataIndex ) {
                            /*if ( data[4] == "A" ) {
                                $(row).addClass( 'important' );
                            }*/
                            if(data.date_debut==null || data.date_debut=='') {
                                $(row).addClass( 'notaffected' );
                            } else {
                                $(row).addClass( 'affected' );
                            }
                        }
                    } );

                    $(ot_affect_btns.join(',')).addClass("disabled");

                    break;
                default:
                    break;
            }
        }
        var initEvents = function(view) {
            switch (view) {
                case 'cal' :
                    break;
                case 'list' :
                    $('#ot_affect_table tbody').on( 'click', 'tr', function () {

                        if(old_tr != null) {
                            old_tr.addClass(old_tr_class);
                        }

                        if ( $(this).hasClass('selected') ) {
                            $(this).removeClass('selected');

                            $(ot_affect_btns.join(',')).addClass("disabled");

                            $('#linked-ch').html('<option value="">&nbsp;</option>');
                        }
                        else {

                            if ( $(this).hasClass('affected') ) {
                                $(this).removeClass('affected');
                                old_tr_class = 'affected';
                            }

                            if ( $(this).hasClass('notaffected') ) {
                                $(this).removeClass('notaffected');
                                old_tr_class = 'notaffected';
                            }

                            old_tr = $(this);

                            ot_affect_dt.$('tr.selected').removeClass('selected');

                            $(this).addClass('selected');

                            $(ot_affect_btns.join(',')).addClass("disabled");

                            if(ot_affect_dt.row('.selected').data().date_debut==null || ot_affect_dt.row('.selected').data().date_debut=='') {
                                $("#affecter_ot_show").removeClass('disabled');
                            } else {
                                $("#annuler_affecter").removeClass('disabled');
                            }
                        }

                    } );
                    break;
                default:
                    break;
            }
        }
        return {
            init : init,
            initEvents : initEvents,
            initContent : initContent
        };
    }();
    $(function () {
    });
    $(document).ready(function() {
        $(".changeview").click(function() {
            if(!$( this).hasClass('active')) {
                $('.changeview').toggleClass('active');
                planning.initContent($( this).attr('data-view'));
            }
        });
        planning.init(defaultView);
        planning.initEvents(defaultView);
    } );
</script>