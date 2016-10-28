

<br><br>
<label for="linked-pb">Fichier plans boites (Devis) </label>
<select class="js-select2" id="linked-pb" name="linked-pb" size="1" style="width: 100%;" data-placeholder="Séléctionner fichier plans boites..">
    <option value="">&nbsp;</option>
</select>
<br>
<div class='alert alert-success' id='message_ot_link2' role='alert' style="display: none;">
</div>
<br>
<button id="link_pb" class='btn btn-info btn-sm'><span class='glyphicon glyphicon-check'>&nbsp;</span> Valider</button>
<script>
    $(function () {
        // Init page plugins & helpers
        jQuery('#linked-pb').select2({
            allowClear: true,
            autocomplete: true
        });
    });
    $(document).ready(function() {
        $("#link_pb").click(function() {

            $.ajax({
                method: "POST",
                url: "api/ot/ot/update_pb_files_list.php",
                dataType: "json",
                data: {
                    idf: $('#linked-pb').val(),
                    idot : ot_dt.row('.selected').data().id_ordre_de_travail
                }
            }).done(function (msg) {
                App.showMessage(msg,'#message_ot_link2');
                displayDevis();
            });
        });
    } );
</script>