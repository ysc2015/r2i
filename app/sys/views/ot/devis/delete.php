


<button id="delete_devis" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-devis-dialog-confirm" title="Supprimer ce devis?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>confirmer la suppression?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-devis-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/ot/devis/devis_delete.php",
                        data: {
                            iddevis: devis_dt.row('.selected').data().iddevis
                        }
                    }).done(function (message) {
                        devis_dt.draw((false));
                        $(devis_btns.join(',')).addClass("disabled");
                        $( "#delete-devis-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#devis_supprime_btn").click(function(e) {
            e.preventDefault();
            $("#delete-devis-dialog-confirm").dialog("open");
        });
    } );
</script>