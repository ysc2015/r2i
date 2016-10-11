


<button id="delete_entreprise" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-entreprise-dialog-confirm" title="Supprimer cette entreprise?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Tous les équipes liées seront supprimés. Etes vous sur?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-entreprise-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/entreprise/entreprise/entreprise_delete.php",
                        data: {
                            ide: entreprise_dt.row('.selected').data().id_entreprise
                        }
                    }).done(function (message) {
                        entreprise_dt.draw((false));
                        $( "#delete-entreprise-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_entreprise").click(function(e) {
            e.preventDefault();
            $("#delete-entreprise-dialog-confirm").dialog("open");
        });
    } );
</script>