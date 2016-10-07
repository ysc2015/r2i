

<div id="link_nro_wrp">
    <br><br>
    <label for="linked-nro">NRO Associés </label>
    <select multiple class="js-select2" id="linked-nro" name="linked-nro" size="1" style="width: 100%;" data-placeholder="Séléctionner nro..">
        <option value="">&nbsp;</option>
    </select>
    <br>
    <div class='alert alert-success' id='message_nro_link' role='alert' style="display: none;">
    </div>
    <br>
    <button id="link_nro" class='btn btn-info btn-sm'><span class='glyphicon glyphicon-check'>&nbsp;</span> Valider</button>
</div>
<script>
    $(function () {
        // Init page plugins & helpers
        jQuery('#linked-nro').select2({
            autocomplete: true
        });
    });
    $(document).ready(function() {
        $("#link_nro").click(function() {
            var list = '0';
            if($('#linked-nro').val() != null) {
                list = $('#linked-nro').val().join(',');
            }

            $.ajax({
                method: "POST",
                url: "api/utilisateur/free/update_user_nro_list.php",
                dataType: "json",
                data: {
                    list: list,
                    idu : users_dt.row('.selected').data().id_utilisateur
                }
            }).done(function (msg) {
                App.showMessage(msg,'#message_nro_link');
            });
        });
    } );
</script>