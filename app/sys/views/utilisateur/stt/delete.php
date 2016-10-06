

<button id="delete_stt" class='btn btn-danger btn-sm' data-toggle="modal" data-target="#"><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-suser-dialog-confirm" title="Supprimer cet utilisateur?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Confirmer la suppression?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-suser-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/utilisateur/free/user_delete.php",
                        data: {
                            idu: susers_dt.row('.selected').data().id_utilisateur
                        }
                    }).done(function (message) {
                        susers_dt.draw((false));
                        $(susers_btns.join(',')).addClass("disabled");
                        $( "#delete-suser-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_stt").click(function(e) {
            e.preventDefault();
            $("#delete-suser-dialog-confirm").dialog("open");
        });
    } );
</script>