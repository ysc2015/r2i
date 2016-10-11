


<button id="delete_pblq" class='btn btn-danger btn-sm' data-toggle="modal" data-target="#"><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-pblq-dialog-confirm" title="Supprimer ce projet?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Tous les sous-projets liés seront supprimés. Etes vous sur?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-pblq-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/projet/projet/projet_delete.php",
                        data: {
                            idp: projet_dt.row('.selected').data().id_projet
                        }
                    }).done(function (message) {
                        projet_dt.draw((false));
                        $(btns.join(',')).addClass("disabled");
                        $( "#delete-pblq-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_pblq").click(function(e) {
            e.preventDefault();
            $("#delete-pblq-dialog-confirm").dialog("open");
        });
    } );
</script>