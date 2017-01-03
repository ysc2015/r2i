<div class="row">
    <div class="col-md-12">
        <button id="download_devis" class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-download'>&nbsp;</span> Télécharger devis</button>
    </div>
</div>
<br>
<div class="row items-push">
    <div class="col-md-12">
        <button id="id_devis_edit_btn" class="btn btn-info btn-sm" type="button"><i id="hdf0454ff" class="fa fa-plus push-5-r"></i> Linéaire de réseau</button>
    </div>
    <div id="lineare_groupe" style="border-left: dashed 1px #000;border-right: dashed 1px #000;border-bottom: dashed 1px #000;margin-top: 5px;padding: 5px;display: none">
        <label><span class="label label-info">Câbles </span></label>
        <div class="form-group">
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                <label for="ta_lineaire1">câble 720FO <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire1" name="ta_lineaire1" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire1:"")?>">
            </div>
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                <label for="ta_lineaire_reseau">câble 432FO <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire2" name="ta_lineaire2" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire2:"")?>">
            </div>
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                <label for="ta_lineaire_reseau">câble 288FO <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire3" name="ta_lineaire3" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire3:"")?>">
            </div>
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                <label for="ta_lineaire_reseau">câble 144FO <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire4" name="ta_lineaire4" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire4:"")?>">
            </div>
        </div>
        <label><span class="label label-warning">Boites </span></label>
        <div class="form-group">
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                <label for="ta_lineaire_reseau">BPE 720FO <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire5" name="ta_lineaire5" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire5:"")?>">
            </div>
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                <label for="ta_lineaire_reseau">BPE 432FO <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire6" name="ta_lineaire6" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire6:"")?>">
            </div>
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">288FO </span></label>-->
                <label for="ta_lineaire_reseau">BPE 288FO <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire7" name="ta_lineaire7" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire7:"")?>">
            </div>
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">144FO </span></label>-->
                <label for="ta_lineaire_reseau">BPE 144FO <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire8" name="ta_lineaire8" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire8:"")?>">
            </div>
        </div>
        <label><span class="label label-primary">NRO </span></label>
        <div class="form-group">
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">720FO </span></label>-->
                <label for="ta_lineaire_reseau">CTR <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire9" name="ta_lineaire9" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire9:"")?>">
            </div>
            <div class="col-md-3">
                <!--<label for="ta_lineaire_reseau"><span class="label label-success">432FO </span></label>-->
                <label for="ta_lineaire_reseau">TOR <!--<span class="text-danger">*</span>--></label>
                <input class="form-control  lineareInput" type="number" id="ta_lineaire10" name="ta_lineaire10" value="<?=($sousProjet->transportaiguillage !== NULL?$sousProjet->transportaiguillage->lineaire10:"")?>">
            </div>
        </div>
    </div>
</div>
<br>
<div id="devis_uploads">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-6">
            <label for="devis_bon_cmd_uploader">Bon(s) de commande(s)</label>
            <div id="devis_bon_cmd_uploader"></div>
        </div>
        <div class="col-md-6">
            <label for="devis_autre_uploader">Autre(s) attachement(s)</label>
            <div id="devis_autre_uploader"></div>
        </div>
    </div>
</div>
<script>
    var uploader1_options = {
        url: "api/ot/devis/upload_devis_bon_cmd.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "pdf",
        onLoad:function(obj)
        {
            if(id_devis > 0) {
                $.ajax({
                    cache: false,
                    url: "api/ot/devis/load_bon_cmd.php",
                    method:"POST",
                    data: {iddevis:id_devis},
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                        }
                    }
                });
            }
        },
        dynamicFormData: function()
        {
            var data ={
                iddevis: id_devis
            };
            return data;
        },
        afterUploadAll:function(obj) {
        },
        downloadCallback:function(data,pd)
        {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            location.href="api/file/download.php?id="+id;
        },
        deleteCallback: function (data, pd) {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            $.ajax({
                method: "POST",
                url: "api/file/delete.php",
                data: {
                    id: id
                }
            }).done(function (message) {
                console.log(message);
            });

        }
    }
    var uploader2_options = {
        url: "api/ot/devis/upload_devis_autre.php",
        multiple:true,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        allowedTypes: "pdf",
        onLoad:function(obj)
        {
            if(id_devis > 0) {
                $.ajax({
                    cache: false,
                    url: "api/ot/devis/load_devis_autre.php",
                    method:"POST",
                    data: {iddevis:id_devis},
                    dataType: "json",
                    success: function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            obj.createProgress(data[i]["name"],data[i]["path"],data[i]["size"],data[i]["id"]);
                        }
                    }
                });
            }
        },
        dynamicFormData: function()
        {
            var data ={
                iddevis: id_devis
            };
            return data;
        },
        afterUploadAll:function(obj) {
        },
        downloadCallback:function(data,pd)
        {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            location.href="api/file/download.php?id="+id;
        },
        deleteCallback: function (data, pd) {
            var obj;
            var id;
            try {
                obj = $.parseJSON(data);
                id = obj[0].id;
            } catch (e) {
                var arr = (data + '').split("_");
                id = arr[0];
            }

            $.ajax({
                method: "POST",
                url: "api/file/delete.php",
                data: {
                    id: id
                }
            }).done(function (message) {
                console.log(message);
            });

        }
    }
    $(function () {
        // Init page plugins & helpers
        uploader1_options = merge_options(defaultUploaderStrLocalisation,uploader1_options);
        uploader1 = $("#devis_bon_cmd_uploader").uploadFile(uploader1_options);

        uploader2_options = merge_options(defaultUploaderStrLocalisation,uploader2_options);
        uploader2 = $("#devis_autre_uploader").uploadFile(uploader2_options);
    });
    $(document).ready(function() {

        $("#download_devis").click(function() {
            if(ot_dt.row('.selected').data()!== undefined) {
                location.href="api/file/parserfile.php?id="+id_devis+"&idsp="+ot_dt.row('.selected').data().id_sous_projet+"&idtot="+ot_dt.row('.selected').data().id_type_ordre_travail;
            }
        });

        $("#id_devis_edit_btn").click(function () {

            if ( $( "#lineare_groupe" ).is( ":hidden" ) ) {
                $("#hdf0454ff").removeClass("fa-plus");
                $("#hdf0454ff").addClass("fa-minus");
                $( "#lineare_groupe" ).show( "fast" );
            } else {
                $( "#lineare_groupe" ).slideUp();
                $("#hdf0454ff").removeClass("fa-minus");
                $("#hdf0454ff").addClass("fa-plus");
            }
        });

    } );
</script>