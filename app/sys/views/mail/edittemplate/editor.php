<!-- CKEditor Container -->
<div class="tab-pane active">
    <div class="block-content tab-content">
        <div class="col-md-6"><select class="form-control " name="type_template" id="type_template">
                <option value="">
                    Séléctionner une template à modifier
                </option>
                <?php
                $results = MailNotificationType::all();
                foreach($results as $result) {
                    echo "<option value=\"$result->id_type_notification\">$result->lib_type_notification</option>";
                }
                ?>

            </select>
        </div>
        <div class="col-md-6">
            <input class="form-control " type="text" name="object_template" id="object_template">

        </div>
        <div class="col-md-12">
            <textarea id="js-ckeditor" name="ckeditor"></textarea>
        </div>

        <table class="table table-bordered table-striped js-dataTable-full dataTable">
            <tr>
                <th>Code</th>
                <th>Désignation</th>
            </tr>
            <tr>
                <td>@nom_traiteur_action</td>
                <td>Le nom de l'executeur</td>
            </tr>
            <tr>
                <td>@code_sous_projet</td>
                <td>Code sours projet</td>
            </tr>
            <tr>
                <td>@CDI_CTR</td>
                <td>CDI OU CTR</td>
            </tr>
            <tr>
                <td>@etape_sous_projet </td>
                <td>Etape sous projet</td>
            </tr>
            <tr>
                <td>@nom_ot</td>
                <td>Nom OT</td>
            </tr>
            <tr>
                <td>@nombres_chambre</td>
                <td>Nombre de chambre</td>
            </tr>
            <tr>
                <td>@total_lineaire</td>
                <td>le Total lineaire en ml </td>
            </tr>
            <tr>
                <td>@b_720 , @b_432 , @b_288 , @b_144 , @b_72, @b_48</td>
                <td>Nombre de boitier</td>
            </tr>
            <tr>
                <td>@c_720 , @c_432 , @c_288 , @c_144 , @c_72, @c_48</td>
                <td>Linéaire de Câble en ml</td>
            </tr>
            <tr>
                <td>@nom_entreprise_stt</td>
                <td>Le nom de l'entreprise STT</td>
            </tr>
            <tr>
                <td>@url_projet  </td>
                <td>Le lien ver la page en question</td>
            </tr>
            <tr>
                <td>@id_sous_projet</td>
                <td>ID sous projet </td>
            </tr>
            <tr>
                <td>@commentaire_ot</td>
                <td>Commentaire OT </td>
            </tr>


        </table>
    </div>
</div>


<script>
    $(function () {
         CKEDITOR.replace('js-ckeditor');
        var contenthtml ;
        var object ;
        $("#object_template").blur(function() {
            for(var i in CKEDITOR.instances) {
                contenthtml = CKEDITOR.instances[i].getData();
            }
            object = $("#object_template").val();
            console.log("object : " +object);
            $.ajax({
                method : "GET",
                url : "app/sys/views/mail/edittemplate/change_content_mail_notif.php",
                data : {
                    type : $("#type_template").val(),
                    contenthtml:contenthtml,
                    object:object
                },
                success : function(reponse){
                    console.log("SUCCES");
                }
            });
        });
        for (var i in CKEDITOR.instances) {
            CKEDITOR.instances[i].on('blur', function() {
                for(var i in CKEDITOR.instances) {
                    contenthtml = CKEDITOR.instances[i].getData();
                }
                object = $("#object_template").val();
                console.log("object : " +object);
                $.ajax({
                    method : "GET",
                    url : "app/sys/views/mail/edittemplate/change_content_mail_notif.php",
                    data : {
                        type : $("#type_template").val(),
                        contenthtml:contenthtml,
                        object:object
                    },
                    success : function(reponse){
                      console.log("SUCCES");
                    }
                });

            });
        }
    });

    $(document).ready(function() {
        $("#type_template").change(function(e){
            $.ajax({
                method : "GET",
                url : "app/sys/views/mail/edittemplate/change_content_mail_notif.php",
                data : "type="+$( "#type_template" ).val(),
                success : function(e){
                    var reponse = JSON.parse(e);
                    console.log(reponse);
                    for(var i in CKEDITOR.instances) {
                       CKEDITOR.instances[i].setData($("#js-ckeditor").html(reponse.template));
                    }
                    $("#object_template").val(reponse.object);


                }
            });

    });
        //
    } );
</script>