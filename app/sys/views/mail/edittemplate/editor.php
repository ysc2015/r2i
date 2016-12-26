<!-- CKEditor Container -->
<div class="tab-pane active">
    <div class="block-content tab-content">
        <div class="col-md-6"><select class="form-control " name="type_template" id="type_template">
                <option value="">
                    Séléctionner une template à modifier
                </option>
                <option value="2">
                    Mail Notif Attribution de charge (BEI)
                </option>
                <option value="3">
                    Mail Notif Attribution OT
                </option>
                <option value="4">
                    Mail Notif Control des plan OK
                </option>
            </select>
        </div>
        <div class="col-md-6">
            <input class="form-control " type="text" name="object_template" id="object_template">

        </div>
        <div class="col-md-12">
            <textarea id="js-ckeditor" name="ckeditor"></textarea>
        </div>
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