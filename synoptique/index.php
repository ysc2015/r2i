<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    ini_set('error_display', 'on');
    error_reporting(1);
    require_once 'config.php';

    $query = 'SELECT * FROM  `' . $table_prefix . 'alveole_diametre`';
    $alveole_diametre = fetchAll($pdo, $query);

    $query = 'SELECT * FROM  `' . $table_prefix . 'diametre`';
    $diametre = fetchAll($pdo, $query);

    $query = 'SELECT * FROM  `' . $table_prefix . 'masque`';
    $masque = fetchAll($pdo, $query);

    $query = 'SELECT * FROM  `' . $table_prefix . 'passage`';
    $passage = fetchAll($pdo, $query);

    $query = 'SELECT * FROM  `' . $table_prefix . 'type_chambre`';
    $type_chambre = fetchAll($pdo, $query);

    $query = 'SELECT * FROM  `' . $table_prefix . 'type_infra`';
    $type_infra = fetchAll($pdo, $query);

    $query = 'SELECT * FROM  `' . $table_prefix . 'type_reseau`';
    $type_reseau = fetchAll($pdo, $query);

    function getOptions($array, $option_value, $option_text)
    {
        $options = "";
        foreach ($array as $key => $value) {
            $options .= sprintf('<option value="%s">%s</option>', $value[$option_value], ($value[$option_text]));
        }
        return $options;
    }

    define('W_RECT', 200);
    define('H_RECT', 60);
    define('X_TXT_LIB', 15);
    define('X_TXT_VAL', 60);
    ?>
    <meta charset="UTF-8">
    <title>Synoptique</title>

    <script src="assets/plugins/jQuery-2.1.4.min.js" type="application/javascript"></script>

    <script src="assets/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js" type="application/javascript"></script>

    <link href="assets/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="assets/plugins/bootstrap-select-1.11.2/dist/js/bootstrap-select.min.js" type="application/javascript"></script>
    <script src="assets/plugins/bootstrap-notify/bootstrap-notify.min.js" type="application/javascript"></script>
    <script src="assets/plugins/jquery-upload-file/js/jquery.uploadfile.min.js" type="application/javascript"></script>

    <link href="assets/plugins/bootstrap-select-1.11.2/dist/css/bootstrap-select.min.css">
    <link href="assets/plugins/jquery-upload-file/css/uploadfile.css">
    <link href="assets/plugins/bootstrap-notify/animate.css">
    <link href="assets/css/style.css" rel="stylesheet">

    <script src="assets/js/syno.js" type="application/javascript"></script>

    <script type="application/javascript">
        var type_infra_options = <?php echo json_encode($type_infra); ?>;
        var type_chambre_options = <?php echo json_encode($type_chambre); ?>;
        var masque_options = <?php echo json_encode($masque); ?>;
        var type_reseau_options = <?php echo json_encode($type_reseau); ?>;
        var alveole_diametre_options = <?php echo json_encode($alveole_diametre); ?>;
        var diametre_options = <?php echo json_encode($diametre); ?>;
        var passage_options = <?php echo json_encode($passage); ?>;

        $(function () {
            var uploader;
            $('#startUpload').click(function () {
                uploader.startUpload();
            });
            $('#stopUpload').click(function () {
                uploader.stopUpload();
            });
            $('#cancelAll').click(function () {
                uploader.cancelAll();
            });

            uploader = $("#fileuploader").uploadFile({
                url: "api/?api=upload",
                autoSubmit: false,
                sequential: true,
                showProgress: true,
                multiple: false,
                dragDrop: true,
                dragDropStr: "<span><b>Faites glisser et déposez les fichiers</b></span>",
                fileName: "pictures",
                dynamicFormData: function () {
                    var data = {
                        "chambre_id": $('#chambre_id_for_image_upload').val()
                    };
                    return data;
                },
                cancelStr: '<button class="btn btn-xs btn-danger">Cancel</button>',
                multiDragErrorStr: "Plusieurs Drag &amp; Drop de fichiers ne sont pas autorisés.",
                uploadStr: "<button class='btn btn-primary'>Téléchargez</button>",
                allowedTypes: "jpg,png,gif,jpeg,tiff",
                onSubmit: function (files) {
                    $('#loading_gif').show();
                },
                onSuccess: function (files, data, xhr, pd) {
                    console.log(files, data);
                    $('#loading_gif').hide();
                    showNotification(data.msg, (data.err == 0 ? 'success' : 'danger'));
                    imageUploader($('#chambre_id_for_image_upload').val());
                }
            });

            $('#btn_get_path').click(startDrawing);
        });
    </script>


</head>
<body>



<div class="container">

    <div class="row">
        <div class="col-sm-2">
            <label>Chambre Source</label>
        </div>
        <div class="col-sm-2">
            <input id="chambre_src" value="1" class="form-control"/>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <label>Chambre Destination</label>
        </div>
        <div class="col-sm-2">
            <input id="chambre_dst" value="5" class="form-control"/>
        </div>
    </div>
    <div class="row">
        <button class="btn btn-primary" value="Get Path" id="btn_get_path">Générer le Synoptique</button>
        <!-- <button class="btn btn-primary" value="Get Path" id="" onclick="imageUploader()">Show Modal</button> -->
    </div>
    <div class="row">



    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                </ul>
                <div class="tab-content" id="myTabContent">
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <svg id="mainSVG" width="400" height="600">
            </svg>
        </div>
    </div>


</div>


<!-- Modal -->
<div class="modal fade" id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Téléchargement des images</h4>
            </div>
            <div class="modal-body">

                <input id="chambre_id_for_image_upload" type="hidden" value=""/>
                <div class="row" id="photos_area">

                </div>

                <div class="row text-center">
                    <img src="img/gear.gif" id="loading_gif" width="32px" height="32px" style="display: none"/>
                </div>

                <div id="fileuploader">Sélectionner</div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-sm btn-success" id="startUpload"><span
                        class="glyphicon glyphicon-save">&nbsp;</span> Charger l'Image
                </button>
                <button type="button" class="btn btn-sm btn-warning" id="cancelAll"><span
                        class="glyphicon glyphicon-remove">&nbsp;</span> Annuler
                </button>
                <button type="button" class="btn btn-sm btn-danger" id="stopUpload"><span
                        class="glyphicon glyphicon-stop">&nbsp;</span> Arreter
                </button>
                <button type="button" class="btn btn-sm btn-danger" id="showModal"><span
                        class="glyphicon glyphicon-stop">&nbsp;</span> Show Modal
                </button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="imageUploadModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog modal-lg" role="document" style="width: 100%">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <div class="text-center">
                    <img src="" id="show_image" class="img-responsive center-block">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/general.js"></script>
<script src="assets/js/tabs.js"></script>
<script type="text/javascript">
    function showImage(image) {
        $('#show_image').attr('src', image);
        $('#imageUploadModal2').modal('show');
    }
</script>

</body>
</html>