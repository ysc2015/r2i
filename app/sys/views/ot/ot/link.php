

<br><br>
<label for="linked-ch">Fichiers chambres </label>
<select multiple class="js-select2" id="linked-ch" name="linked-ch" size="1" style="width: 100%;" data-placeholder="Séléctionner fichiers chambres..">
    <option value="">&nbsp;</option>
</select>
<br>
<div class='alert alert-success' id='message_ot_link' role='alert' style="display: none;">
</div>
<br>
<button id="link_ot" class='btn btn-info btn-sm'><span class='glyphicon glyphicon-check'>&nbsp;</span> Valider</button>
<script>
    $(function () {
        // Init page plugins & helpers
        jQuery('#linked-ch').select2({
            autocomplete: true
        });
    });
    $(document).ready(function() {
        $("#link_ot").click(function() {
            var list = '0';
            if($('#linked-ch').val() != null) {
                list = $('#linked-ch').val().join(',');
            }

            $.ajax({
                method: "POST",
                url: "api/ot/ot/update_ch_files_list.php",
                dataType: "json",
                data: {
                    list: list,
                    idot : ot_dt.row('.selected').data().id_ordre_de_travail
                }
            }).done(function (msg) {
                if(msg.error == 0) {
                    chambre_ot_dt.ajax.url( 'api/ot/chambreot/chambre_liste.php?idot='+ot_dt.row('.selected').data().id_ordre_de_travail ).load();
                }
                App.showMessage(msg,'#message_ot_link');
            });
        });
    } );
</script>