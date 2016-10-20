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
        var team_id = 0;
        var soc_id = 0;
        var initCalendar = function() {
            $('#calender').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                },
                events: {
                    url: 'api/ot/planningot/calendar_events.php',
                    data: function() { // a function that returns an object
                        return {
                            team_id : getTeamId(),
                            soc_id : getSocId()
                        };
                    }
                },
                eventClick: function(calEvent, jsEvent, view) {

                    //console.log(calEvent.socid);

                    $('#modal_cal_ot_title').html('ordre de travail : '+calEvent.etape + '-'+calEvent.typeot);

                    $('#ot_entreprise_cal2').val(calEvent.socid);

                    $.ajax({
                        method: "POST",
                        url: "api/ot/planningot/get_entry_soc_teams.php",
                        dataType: "json",
                        data: {
                            ide: calEvent.socid
                        }
                    }).done(function (data) {
                        $('#ot_equipe_cal').html('<option value="" selected="">Sélectionnez une équipe</option>');
                        for(var i = 0 ; i < data.length ; i++) {
                            html = '<option value="'+data[i]['id']+'">'+data[i]['nom']+'</option>';
                            $('#ot_equipe_cal').append(html);
                        }
                        $('#ot_equipe_cal').val(calEvent.equipeid);
                        $('#affecter_date_debut_cal').val(calEvent.dd);
                        $('#affecter_date_fin_cal').val(calEvent.df);
                        $('#modal-ot-cal').modal('show');
                    });

                }
            });
        }
        var refresh = function() {
            $('#calender').fullCalendar( 'refetchEvents' );
        }

        var setTeamId = function(Id) {
            team_id = Id;
        }
        var setSocId = function(Id) {
            soc_id = Id;
        }
        var getTeamId = function() {
            return team_id;
        }
        var getSocId = function(Id) {
            return  soc_id;
        }
        return {
            initCalendar : initCalendar,
            refresh : refresh,
            setTeamId : setTeamId,
            setSocId : setSocId

        }
    }();
    var update = false;
    var old_tr = null;
    var old_tr_class = '';
    var ot_affect_dt;
    var ot_affect_btns = ["#affecter_ot_show","#annuler_affecter"];
    var planning = function() {
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
                    //$("#calender").fullCalendar( 'gotoDate', '2016-10-18' );
                    //$('#calender').fullCalendar('render');
                    jQuery('#ot_entreprise_cal').select2({
                        autocomplete: true
                    });
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

                    jQuery('#ot_entreprise').select2({
                        autocomplete: true
                    });

                    break;
                default:
                    break;
            }
        }
        var initEvents = function(view) {
            switch (view) {
                case 'cal' :
                    $("#ot_entreprise_cal").change(function() {
                        calendar.setTeamId(0);
                        calendar.setSocId($( this).val());
                        calendar.refresh();
                        $('#teams_list_cal').html('');
                        $.ajax({
                            method: "POST",
                            url: "api/ot/planningot/get_entry_soc_teams.php",
                            dataType: "json",
                            data: {
                                ide: $("#ot_entreprise_cal").val()
                            }
                        }).done(function (data) {
                            var link = document.createElement('a');
                            link.setAttribute('href', 'javascript:void(0)');
                            link.setAttribute('class', 'list-group-item active');
                            link.innerHTML = '<span class="badge">'+data.length+'</span><i class="fa fa-fw fa-user push-5-r"></i> Equipes';
                            $('#teams_list_cal').append(link);
                            /*$('#teams_list_cal').html('<a class="list-group-item active" href="javascript:void(0)"><span class="badge">'+data.length+'</span><i class="fa fa-fw fa-user push-5-r"></i> Equipes</a>');
                            for(var i = 0 ; i < data.length ; i++) {
                                html = '<a class="list-group-item" href="javascript:void(0)" onclick="calendar.test(\'data[i][\'id\']\')">'+data[i]['nom']+'</a>';
                                $('#teams_list_cal').append(html);
                            }*/

                            for(var i = 0 ; i < data.length ; i++) {
                                var link2 = document.createElement('a');
                                link2.setAttribute('href', 'javascript:void(0)');
                                link2.setAttribute('class', 'list-group-item teamsfrom');
                                link2.innerHTML = data[i]['nom'];
                                link2.onclick = (function() {
                                    var currentId = data[i]['id'];
                                    return function() {
                                        //calendar.test(currentId);
                                        calendar.setTeamId(currentId);
                                        calendar.refresh();
                                    }
                                })();
                                //html = '<a class="list-group-item" href="javascript:void(0)" onclick="calendar.test(\'data[i][\'id\']\')">'+data[i]['nom']+'</a>';
                                $('#teams_list_cal').append(link2);
                            }



                            /*link.onclick = (function() {
                                var currentI = i;
                                return function() {
                                    onClickLink(currentI + '');
                                }
                            })();*/
                        });
                    });
                    $('body').on('click', '.teamsfrom', function() {
                        $('.teamsfrom').removeClass('active2');
                        $( this ).addClass('active2');
                    });
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
                    $("#affecter_ot_show").click(function() {
                        console.log('affecter_ot_show');
                        update = false;
                        $("#ot_entreprise").trigger('change');
                    });
                    $("#annuler_affecter").click(function() {
                        $.ajax({
                            method: "POST",
                            url: "api/ot/planningot/annuler_affectation.php",
                            dataType: "json",
                            data: {
                                idot: ot_affect_dt.row('.selected').data().id_ordre_de_travail
                            }
                        }).done(function (message) {
                            if(message.error == 0) {
                                ot_affect_dt.draw(false);
                            }
                            App.showMessage(message,'#message_annuler_affecter_ot');
                        });
                    });
                    $("#save_ot_affecter").click(function() {
                        console.log(ot_affect_dt.row('.selected').data().id_ordre_de_travail);
                        $.ajax({
                            method: "POST",
                            url: "api/ot/planningot/affecter_ot_team.php",
                            dataType: "json",
                            data: {
                                idot: ot_affect_dt.row('.selected').data().id_ordre_de_travail,
                                ide: $("#ot_entreprise").val(),
                                ideq: $("#ot_equipe").val(),
                                date1: $("#affecter_date_debut").val(),
                                date2: $("#affecter_date_fin").val()
                            }
                        }).done(function (message) {
                            if(message.error == 0) {
                                $("#ot_affecter_form")[0].reset();
                                update = true;
                            }
                            App.showMessage(message,'#message_affecter_ot');
                        });
                    });
                    $("#ot_entreprise").change(function() {
                        $.ajax({
                            method: "POST",
                            url: "api/ot/planningot/get_entry_soc_teams.php",
                            dataType: "json",
                            data: {
                                ide: $("#ot_entreprise").val()
                            }
                        }).done(function (data) {
                                console.log(data);
                                $('#ot_equipe').html('<option value="" selected="">Sélectionnez une équipe</option>');
                                for(var i = 0 ; i < data.length ; i++) {
                                    html = '<option value="'+data[i]['id']+'">'+data[i]['nom']+'</option>';
                                    $('#ot_equipe').append(html);
                                }
                        });
                    });
                    $('#affecter-ot').on('hidden.bs.modal', function () {
                        if(update) {
                            ot_affect_dt.draw(false);
                        }
                        console.log('hidden');
                    })
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