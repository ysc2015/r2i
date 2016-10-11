
<button id="delete_equipe" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer Equipe</button>
<div id="delete-equipe-dialog-confirm" title="Supprimer cette equipe?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Etes vous sur?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-equipe-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/entreprise/equipe/equipe_delete.php",
                        data: {
                            ide: equipe_dt.row('.selected').data().id_equipe_stt
                        }
                    }).done(function (message) {
                        equipe_dt.draw((false));
                        $( "#delete-equipe-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_equipe").click(function(e) {
            e.preventDefault();
            $("#delete-equipe-dialog-confirm").dialog("open");
        });
    } );
</script>