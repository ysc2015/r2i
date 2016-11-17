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
<div class="modal fade" id="modal-ot-cal" tabindex="-1" role="dialog" aria-hidden="false" style="display: none; padding-right: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title" id="modal_cal_ot_title"></h3>
                </div>
                <div class="block-content">
                    <form class="js-validation-bootstrap form-horizontal" id="ot_affecter_form__cal">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="ot_entreprise_cal2">Entreprise <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control " id="ot_entreprise_cal2" name="ot_entreprise_cal2" style="width: 100%;" disabled="">
                                    <option value="" selected="">Sélectionnez une entreprise</option>
                                    <?php
                                    $results = EntrepriseSTT::all();
                                    foreach($results as $result) {
                                        echo "<option value=\"$result->id_entreprise\" ". ($sousProjet->transportaiguillage!==NULL && $sousProjet->transportaiguillage->id_entreprise==$result->id_entreprise ?"selected": "")." >$result->nom</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="ot_equipe_cal">Equipe <!--<span class="text-danger">*</span>--></label>
                                <select class="form-control " id="ot_equipe_cal" name="ot_equipe_cal" style="width: 100%;" disabled="">
                                    <option value="" selected="">Sélectionnez une équipe</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="affecter_date_debut_cal">Date début <!--<span class="text-danger">*</span>--></label>
                                <input readonly class="form-control " type="date" id="affecter_date_debut_cal" name="affecter_date_debut_cal" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="affecter_date_fin_cal">Date fin <!--<span class="text-danger">*</span>--></label>
                                <input readonly class="form-control " type="date" id="affecter_date_fin_cal" name="affecter_date_fin_cal" value="">
                            </div>
                        </div>
                        <div class='alert alert-success' id='message_affecter_ot_cal' role='alert' style="display: none;">
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Fermer</button>
                <!--<button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>-->
            </div>
        </div>
    </div>
</div>
<script>
    var defaultView = 'list';
    var calendar = function() {
        var team_id = 0;
        var soc_id = 0;
        var date1 = null;
        var date2 = null;
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
                            soc_id : getSocId(),
                            date1 : (date1!==null?date1.format('YYYY-MM-DD'):''),
                            date2 : (date2!==null?date2.format('YYYY-MM-DD'):'')
                        };
                    }
                },
                eventClick: function(calEvent, jsEvent, view) {

                    if(calEvent.id > 0) {
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
                            $('#modal-ot-cal').modal({backdrop: 'static', keyboard: false});
                            $('#modal-ot-cal').modal('show');
                        });
                    } else {
                        console.log(calEvent.id);
                    }

                },
                eventRender: function(event, element) {
                    if(event.id > 0) {
                        element.attr('title','clicker ici pour afficher détails');
                    } /*else {
                        element.attr('title','clicker ici pour basculer vers la liste des ot et conserver la période choisie');
                    }*/
                },
                dayClick: function(date, jsEvent, view) {
                    if(date1==null) {
                        //$(this).css('background-color', 'green');
                        date1 = date;
                    } else if(date2==null) {
                        //$(this).css('background-color', 'green');
                        date2=date;

                        if(date2.diff(date1) <=0) {
                            var d = date1;
                            date1 = date2;
                            date2 = d;
                        }
                        //create event here
                        $('#calender').fullCalendar( 'refetchEvents' );
                    } else {
                        //$(this).css('background-color', 'green');
                        date1 = date;
                        date2 = null;

                        //delete event here
                        $('#calender').fullCalendar( 'refetchEvents' );
                    }

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
                    jQuery('#ot_entreprise').select2({
                        autocomplete: true
                    });
                    $('#calender2').fullCalendar({
                        header: {
                            left: 'prev,next',
                            center: 'title',
                            right: ''
                        },
                        events: {
                            url: 'api/ot/planningot/calendar_events.php',
                            data: function() { // a function that returns an object
                                return {
                                    soc_id : $('#ot_entreprise').val(),
                                    team_id : $('#ot_equipe').val(),
                                    date1 : $('#affecter_date_debut').val(),
                                    date2 : $('#affecter_date_fin').val()
                                };
                            }
                        },
                        eventClick: function(calEvent, jsEvent, view) {
                            if(calEvent.id > 0) {
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
                                    $('#modal-ot-cal').modal({backdrop: 'static', keyboard: false});
                                    $('#modal-ot-cal').modal('show');
                                });
                            } else {
                                console.log(calEvent.id);
                            }
                        },
                        eventRender: function(event, element) {
                            if(event.id > 0) {
                                element.attr('title','clicker ici pour afficher détails');
                            } else {
                                element.attr('title','clicker ici pour basculer vers la liste des ot et conserver la période choisie');
                            }
                        },
                        dayClick: function(date, jsEvent, view) {
                        }

                    });
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
                            { "data": "type_ot" },/*lib_type_ordre_travail*/
                            { "data": "nom" },
                            { "data": "eqprenom" },
                            { "data": "eqnom" },
                            { "data": "date_debut" },
                            { "data": "date_fin" },
                            { "data": "id_type_ordre_travail" }
                        ],
                        "columnDefs": [
                            { "targets": [ 0,1,2,9 ], "visible": false, "searchable": false }
                        ],
                        "order": [[9, 'asc']]
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
                            link.setAttribute('class', 'list-group-item teamsfrom active');
                            link.innerHTML = '<span class="badge">'+data.length+'</span><i class="fa fa-fw fa-user push-5-r"></i> Equipes';
                            link.onclick = (function() {
                                return function() {
                                    //calendar.test(currentId);
                                    calendar.setTeamId(0);
                                    calendar.refresh();
                                }
                            })();
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
                        $('.teamsfrom').removeClass('active');
                        $( this ).addClass('active');
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
                        /*$("#ot_entreprise").select2('val', 'All');
                        update = false;
                        $("#ot_affecter_form")[0].reset();*/
                        $('#affecter-ot').modal({backdrop: 'static', keyboard: false});
                        $('#affecter-ot').modal('show');//tttt
                    });
                    $("#annuler_affecter").click(function() {
                        $.ajax({
                            method: "POST",
                            url: "api/ot/planningot/annuler_affectation.php",
                            dataType: "json",
                            data: {
                                idot: ot_affect_dt.row('.selected').data().id_ordre_de_travail,
                                idtot: ot_affect_dt.row('.selected').data().id_type_ordre_travail,
                                idsp: ot_affect_dt.row('.selected').data().id_sous_projet
                            }
                        }).done(function (message) {
                            if(message.error == 0) {
                                ot_affect_dt.draw(false);
                            }
                            App.showMessage(message,'#message_annuler_affecter_ot');
                        });
                    });
                    $("#save_ot_affecter").click(function() {
                        //console.log(ot_affect_dt.row('.selected').data().id_ordre_de_travail);
                        $.ajax({
                            method: "POST",
                            url: "api/ot/planningot/affecter_ot_team.php",
                            dataType: "json",
                            data: {
                                idot: ot_affect_dt.row('.selected').data().id_ordre_de_travail,
                                idsp: ot_affect_dt.row('.selected').data().id_sous_projet,
                                idtot: ot_affect_dt.row('.selected').data().id_type_ordre_travail,
                                ide: $("#ot_entreprise").val(),
                                ideq: $("#ot_equipe").val(),
                                date1: $("#affecter_date_debut").val(),
                                date2: $("#affecter_date_fin").val()
                            }
                        }).done(function (message) {
                            //console.log(message);
                            if(message.error == 0) {
                                //$("#ot_affecter_form")[0].reset();
                                $("#affecter_date_debut").val('');
                                $("#affecter_date_fin").val('');
                                update = true;
                                $('#calender2').fullCalendar( 'refetchEvents' );
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
                            //console.log(data);
                            $('#ot_equipe').html('<option value="" selected="">Sélectionnez une équipe</option>');
                            for(var i = 0 ; i < data.length ; i++) {
                                html = '<option value="'+data[i]['id']+'">'+data[i]['nom']+'</option>';
                                $('#ot_equipe').append(html);
                            }
                            $('#calender2').fullCalendar( 'refetchEvents' );
                        });
                    });
                    $("#ot_equipe").change(function() {
                        //$('#calender2').fullCalendar('removeEvents');
                        $('#calender2').fullCalendar( 'refetchEvents' );
                    });

                    $("#affecter_date_debut").change(function() {
                        $("#calender2").fullCalendar( 'gotoDate', $( this).val() );
                    });

                    $('#affecter-ot').on('hidden.bs.modal', function () {
                        if(update) {
                            ot_affect_dt.draw(false);
                        }
                        //console.log('hidden');
                    });
                    $('#affecter-ot').on('shown.bs.modal', function () {
                        //console.log('shown');
                        $("#ot_entreprise").select2('val', 'All');
                        update = false;
                        $("#ot_affecter_form")[0].reset();
                        $("#ot_entreprise").trigger('change');
                        $("#calender2").fullCalendar('render');
                        //$('#calender2').fullCalendar( 'refetchEvents' );
                    });
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