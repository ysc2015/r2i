

<button id="delete_nro" class='btn btn-danger btn-sm' data-toggle="modal" data-target="#"><span class='glyphicon glyphicon-remove'>&nbsp;</span>Supprimer</button>
<div id="delete-nro-dialog-confirm" title="Supprimer cet nro?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Supprimer cet nro?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#delete-nro-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/nro/nro/nro_delete.php",
                        data: {
                            idn: nro_dt.row('.selected').data().id_nro
                        }
                    }).done(function (message) {
                        nro_dt.draw((false));
                        $(nro_btns.join(',')).addClass("disabled");
                        $( "#delete-nro-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#delete_nro").click(function(e) {
            e.preventDefault();
            $("#delete-nro-dialog-confirm").dialog("open");
        });
    } );
</script>