


<button id="delete_ot" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-ot-dialog-confirm" title="Supprimer cet ot?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>confirmer la suppression?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-ot-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/ot/ot/ot_delete.php",
                        data: {
                            idot: ot_dt.row('.selected').data().id_ordre_de_travail
                        }
                    }).done(function (message) {
                        ot_dt.draw((false));
                        $(ot_btns.join(',')).addClass("disabled");
                        $( "#delete-ot-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_ot").click(function(e) {
            e.preventDefault();
            $("#delete-ot-dialog-confirm").dialog("open");
        });
    } );
</script>