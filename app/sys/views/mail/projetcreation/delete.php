

<button id="delete_user_from" class='btn btn-danger btn-sm' data-toggle="modal" data-target="#"><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-user-dialog-confirm" title="Supprimer cet utilisateur?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Supprimer cet utilisateur de la liste mail création?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-user-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/mail/projetcreation/user_delete.php",
                        data: {
                            idp: mails_dt.row('.selected').data().id_projet_mail_creation
                        }
                    }).done(function (message) {
                        mails_dt.draw((false));
                        $(mails_btns.join(',')).addClass("disabled");
                        $( "#delete-user-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_user_from").click(function(e) {
            e.preventDefault();
            $("#delete-user-dialog-confirm").dialog("open");
        });
    } );
</script>