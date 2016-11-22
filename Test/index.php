<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <script src="jQuery-2.1.4.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script src="icheck-1.x/icheck.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="icheck-1.x/skins/all.css">

    <link rel="stylesheet" href="../assets/js/plugins/jquery-upload-file/css/uploadfile.css">
    <script src="../assets/js/plugins/jquery-upload-file/js/jquery.form.js"></script>
    <script src="../assets/js/plugins/jquery-upload-file/js/jquery.uploadfile.min.js"></script>


    <style type="text/css">
        #redBorder {
            border-right-color: red;
            border-right-width: medium;
        }
    </style>

</head>
<body>


<div class="row items-push">
    <div class="form-group">
        <div class="col-md-6">
            <div class="row" style="padding-left: 10px;">
                <label for="ta_fileuploader_chambre">Fichier(s) bkp</label>
                <div id="ta_fileuploader_chambre"></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button id="addProjects" class="btn btn-primary">Injecter projets</button>
    </div>
</div>

<script>
    function setDuree(selector1,selector2,d1,d2) {
        $.ajax({
            method: "POST",
            data: {
                dd : d1,
                df : d2
            },
            url: "api/utils/get_duree.php"
        }).done(function (msg) {

            var obj = JSON.parse(msg);
            //console.log(obj);
            if(obj.duree == "erreur") {
                //var msg = {error : 1, message : 'la date de retour prévue doit étre superieure à la date de début !'};
                //App.showMessage(msg,selector2);
                selector1.val('');

            } else {
                selector1.val(obj.duree);
            }
        });
    }

    function get(name){
        if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
            return decodeURIComponent(name[1]);
    }

    function checkLinears(sel){
        var flag = true;
        $(sel).filter(function() {
            if (this.value == '') {
                flag = false;
                return false;
            }
        });
        return flag;
    }

    function getObjectTypeForEntry(entree) {
        var str = '';
        switch (entree) {
            case 'transportaiguillage' : str='transport_aiguillage_chambre';break;
            case 'transporttirage' : str='transport_tirage_chambre';break;
            case 'transportraccordement' : str='transport_raccord_chambre';break;
            case 'distributionaiguillage' : str='distribution_aiguillage_chambre';break;
            case 'distributiontirage' : str='distribution_tirage_chambre';break;
            case 'distributionraccordement' : str='distribution_raccord_chambre';break;
            default : str='';break;
        }

        return str;
    }

    function getObjectTypeForEntryPB(entree) { /*utilisee pour recuperer plans boites, a creer une entite global c'est temporaire*/
        var str = '';
        switch (entree) {
            case 'transportaiguillage' : str='transport_racoord_pboite';break;
            case 'transporttirage' : str='transport_racoord_pboite';break;
            case 'transportraccordement' : str='transport_racoord_pboite';break;
            case 'distributionaiguillage' : str='distribution_racoord_pboite';break;
            case 'distributiontirage' : str='distribution_racoord_pboite';break;
            case 'distributionraccordement' : str='distribution_racoord_pboite';break;
            default : str='';break;
        }

        return str;
    }

    function getObjectNameForEntry(entree) {
        var str = '';
        switch (entree) {
            case 'transportaiguillage' : str='Transport Aiguillage';break;
            case 'transporttirage' : str='Transport Tirage';break;
            case 'transportraccordement' : str='Transport Raccordement';break;
            case 'distributionaiguillage' : str='Distribution Aiguillage';break;
            case 'distributiontirage' : str='Distribution Tirage';break;
            case 'distributionraccordement' : str='Distribution Raccordement';break;
            default : str='';break;
        }

        return str;
    }

    /**
     * Overwrites obj1's values with obj2's and adds obj2's if non existent in obj1
     * @param obj1
     * @param obj2
     * @returns obj3 a new object based on obj1 and obj2
     */
    function merge_options(obj1,obj2){
        var obj3 = {};
        for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
        for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
        return obj3;
    }

    //shared obj

    var defaultUploaderStrLocalisation = {
        dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
        deletelStr: "Supprimer",
        downloadStr: "Téléchargez",
        uploadStr: "Téléchargez",
        abortStr: "Abandonner",
        cancelStr: "Annuler",
        doneStr: "Términé",
        multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers sont autorisés.",
        extErrorStr: "non autorisé. extensions autorisées :",
        duplicateErrorStr: "fichier éxiste déjà",
        sizeErrorStr: "non autorisé. taille max autorisée :",
        uploadErrorStr: "envoi de fichier non autorisé",
        maxFileCountErrorStr: "non autorisé. max fichiers autorisés :"
    }

    //set ot status

    function setOtStatus(idot,status,selector,dt) {
        $.ajax({
            url: "api/ot/ot/set_ot_status.php",
            dataType: "json",
            method: "POST",
            data: {
                idot : idot,
                status : status
            }
        }).done(function (msg) {
            if(msg.error == 0) {
                dt.ajax.reload();
            }
            App.showMessage(msg,selector);
        });
    }

    function setRetourTerrain(idsp,idtot,selector,val) {
        console.log('tip script ' + idtot);
        $.ajax({
            url: "api/myot/traitement/update_retour_terrain.php",
            dataType: "json",
            method: "POST",
            data: {
                idsp : idsp,
                idtot : idtot,
                val : val
            }
        }).done(function (msg) {
            console.log(msg.message);
            App.showMessage(msg,selector);
        });
    }

    function getRetourTerrain(idsp,idtot,selector) {
        $.ajax({
            url: "api/myot/traitement/get_retour_stt.php",
            dataType: "json",
            method: "POST",
            data: {
                idsp : idsp,
                idtot : idtot
            }
        }).done(function (msg) {
            console.log(msg);
            $(selector).val(msg.retour);
        });
    }




    var taiguillage_chambre_uploader_options = {
        url: "api/sousprojet/reseautransport/upload_bkp.php",
        multiple:false,
        dragDrop:true,
        fileName: "myfile",
        autoSubmit: true,
        showDelete:true,
        showDownload:true,
        showAbort:true,
        allowedTypes: "xlsx,xls",
        afterUploadAll:function(obj) {
            console.log(obj);
        }
    };
    $(function () {
        taiguillage_chambre_uploader_options = merge_options(defaultUploaderStrLocalisation,taiguillage_chambre_uploader_options);
        taiguillage_chambre_uploader_options.abortStr = 'Injection en cours ...';
        taiguillage_chambre_uploader = $("#ta_fileuploader_chambre").uploadFile(taiguillage_chambre_uploader_options);
    });
    $(document).ready(function () {
        $('#addProjects').click(function (){
            console.log('addProjects');
            $.ajax({
                method: "POST",
                dataType: "json",
                url: "api/sousprojet/reseautransport/inject_projects.php"/*,
                data: {
                    id: id
                }*/
            }).done(function (message) {
                console.log(message);
            });
        });
    });
</script>


</body>
</html>
