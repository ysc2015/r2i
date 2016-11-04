


<div id="link_nro2_wrp2">
    <br><br>
    <label for="linked-nro2">NRO Associés </label>
    <select multiple class="js-select2" id="linked-nro2" name="linked-nro2" size="1" style="width: 100%;" data-placeholder="Séléctionner nro..">
        <option value="">&nbsp;</option>
    </select>
    <br>
    <div class='alert alert-success' id='message_nro_link2' role='alert' style="display: none;">
    </div>
    <br>
    <button id="link_nro2" class='btn btn-info btn-sm'><span class='glyphicon glyphicon-check'>&nbsp;</span> Valider</button>
</div>
<script>
    $(function () {
        // Init page plugins & helpers
        jQuery('#linked-nro2').select2({
            autocomplete: true
        });
    });
    $(document).ready(function() {
        $("#link_nro2").click(function() {
            var list = '0';
            if($('#linked-nro2').val() != null) {
                list = $('#linked-nro2').val().join(',');
            }

            $.ajax({
                method: "POST",
                url: "api/utilisateur/free/update_user_nro_list2.php",
                dataType: "json",
                data: {
                    list: list,
                    idu : users_dt.row('.selected').data().id_utilisateur
                }
            }).done(function (msg) {
                App.showMessage(msg,'#message_nro_link2');
            });
        });
    } );
</script>