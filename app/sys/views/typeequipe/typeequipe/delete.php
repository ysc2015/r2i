


<button id="delete_type_eq" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-type-eq-dialog-confirm" title="Supprimer cet type équipe?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>confirmer la suppression?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-type-eq-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/typeequipe/typeequipe/typeequipe_delete.php",
                        data: {
                            idt: type_eq_dt.row('.selected').data().id_equipe_types
                        }
                    }).done(function (message) {
                        type_eq_dt.draw((false));
                        $(type_eq_btns.join(',')).addClass("disabled");
                        $( "#delete-type-eq-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_type_eq").click(function(e) {
            e.preventDefault();
            $("#delete-type-eq-dialog-confirm").dialog("open");
        });
    } );
</script>