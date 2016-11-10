


<button id="delete_type_ot" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-type-ot-dialog-confirm" title="Supprimer cet type ot?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>confirmer la suppression?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-type-ot-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/typeot/typeot/typeot_delete.php",
                        data: {
                            idt: type_ot_dt.row('.selected').data().id_type_ordre_travail
                        }
                    }).done(function (message) {
                        type_ot_dt.draw((false));
                        $(type_ot_btns.join(',')).addClass("disabled");
                        $( "#delete-type-ot-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_type_ot").click(function(e) {
            e.preventDefault();
            $("#delete-type-ot-dialog-confirm").dialog("open");
        });
    } );
</script>