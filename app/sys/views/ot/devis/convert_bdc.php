


<button id="convert_bdc_devis" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-remove'>&nbsp;</span>Conversion BDC</button>
<div id="convert_bdc-devis-dialog-confirm" title="Convertir ce devis?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>confirmer la conversion BDC?</p>
</div>
<script>
    $(document).ready(function() {
        $( "#convert_bdc-devis-dialog-confirm" ).dialog({
            autoOpen: false,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
                "Oui": function() {
                    $.ajax({
                        method: "POST",
                        url: "api/ot/devis/devis_convert_bdc.php",
                        data: {
                            iddevis: devis_dt.row('.selected').data().iddevis
                        }
                    }).done(function (message) {
                        devis_dt.draw((false));
                        $(devis_btns.join(',')).addClass("disabled");
                        $( "#convert_bdc-devis-dialog-confirm" ).dialog( "close" );
                    });
                },
                Non: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        $("#devis_convert_bdc_btn").click(function(e) {
            e.preventDefault();
            $("#convert_bdc-devis-dialog-confirm").dialog("open");
        });
    } );
</script>