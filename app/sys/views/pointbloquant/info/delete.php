


<button id="delete_pblq_info" class='btn btn-danger btn-sm' data-toggle="modal" data-target="#"><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-pblq-info-dialog-confirm" title="Supprimer cette info point bloquant?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>confirmer?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-pblq-info-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/pointbloquant/pointbloquant/pblq_info_delete.php",
                        data: {
                            idpi: pblq_info_dt.row('.selected').data().id_traitement_pbt
                        }
                    }).done(function (message) {
                        console.log(message);
                        var obj = JSON.parse(message);
                        if(obj.error == 0) {
                            pblq_info_dt.draw((false));
                            $( "#delete-pblq-info-dialog-confirm" ).dialog( "close" );
                        }
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_pblq_info").click(function(e) {
            e.preventDefault();
            console.log('id : ' + pblq_info_dt.row('.selected').data().id_traitement_pbt);
            $("#delete-pblq-info-dialog-confirm").dialog("open");
        });
    } );
</script>