<div id="calender" class="js-calendar"><!--calendar wrapper-->
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
                                <label for="pci_in_charge">PCI En charge <!--<span class="text-danger">*</span>--></label>
                                <input readonly class="form-control " type="text" id="pci_in_charge" name="pci_in_charge" value="">
                            </div>
                        </div>
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
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="lien_plans">Lien vers les plans <!--<span class="text-danger">*</span>--></label>
                                <textarea readonly class="form-control" id="lien_plans" name="lien_plans" rows="6">
                                </textarea>
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
                    url: 'api/myot/infosot/my_calendar_events.php',
                    data: function() { // a function that returns an object
                        return {
                            idot : (ot_dt.row('.selected').data()!==undefined?ot_dt.row('.selected').data().id_ordre_de_travail:0),
                        };
                    }
                },
                eventClick: function(calEvent, jsEvent, view) {
                    console.log(calEvent);

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
                            $('#modal-ot-cal').modal('show');
                        });

                        $.ajax({
                            method: "POST",
                            url: "api/myot/infosot/get_infos_ot.php",
                            dataType: "json",
                            data: {
                                idot : calEvent.id
                            }
                        }).done(function (data) {
                            $('#pci_in_charge').val(data.pci);
                            $('#lien_plans').val(data.lien);
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
    $(document).ready(function() {
        calendar.initCalendar();
    } );
</script>