<?php
/**
 * file: assets.php
 * User: rabii
 */
?>
<!-- Icons -->
<!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
<link rel="shortcut icon" href="assets/img/favicons/favicon.png">

<link rel="icon" type="image/png" href="assets/img/favicons/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="assets/img/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="assets/img/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="assets/img/favicons/favicon-160x160.png" sizes="160x160">
<link rel="icon" type="image/png" href="assets/img/favicons/favicon-192x192.png" sizes="192x192">

<link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon-180x180.png">
<!-- END Icons -->

<!-- Stylesheets -->
<!-- Web fonts -->
<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">-->

<!-- OneUI CSS framework -->
<link rel="stylesheet" id="css-main" href="assets/css/oneui.css">

<!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
 <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css">
<!-- END Stylesheets -->

<link rel="stylesheet" href="assets/js/plugins/jquery-upload-file/css/uploadfile.css">
<!--<link rel="stylesheet" href="assets/js/plugins/select2/select2.min.css">
<link rel="stylesheet" href="assets/js/plugins/select2/select2-bootstrap.css">-->
<link rel="stylesheet" href="assets/js/plugins/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="assets/js/plugins/datatables/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/js/plugins/jqGrid/css/ui.jqgrid.css">
<link rel="stylesheet" href="assets/js/plugins/jqGrid/css/ui.jqgrid-bootstrap.css">
<link rel="stylesheet" href="assets/js/plugins/jqGrid/css/ui.jqgrid-bootstrap-ui.css">
<link rel="stylesheet" href="assets/js/plugins/select2-4.0.3/dist/css/select2.min.css">
<!--<link rel="stylesheet" href="assets/js/plugins/select2/select2.min.css">-->
<link rel="stylesheet" href="assets/js/plugins/select2/select2-bootstrap.css">
<link rel="stylesheet" href="assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">

<!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/core/jquery.slimscroll.min.js"></script>
<script src="assets/js/core/jquery.scrollLock.min.js"></script>
<script src="assets/js/core/jquery.appear.min.js"></script>
<script src="assets/js/core/jquery.countTo.min.js"></script>
<script src="assets/js/core/jquery.placeholder.min.js"></script>
<script src="assets/js/core/js.cookie.min.js"></script>
<script src="assets/js/plugins/jquery-upload-file/js/jquery.form.js"></script>
<script src="assets/js/plugins/jquery-upload-file/js/jquery.uploadfile.min.js"></script>
<!--<script src="assets/js/plugins/select2/select2.full.min.js"></script>-->
<script src="assets/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/datatables/dataTables-bootstrap.js"></script>
<script src="assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/plugins/jqGrid/js/jquery.jqGrid.min.js"></script>
<script src="assets/js/plugins/jqGrid/js/i18n/grid.locale-fr.js"></script>
<script src="assets/js/plugins/select2-4.0.3/dist/js/select2.full.min.js"></script>
<script src="assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<!--<script src="assets/js/plugins/select2/select2.full.min.js"></script>-->
<script src="assets/js/common.functions.js.php"></script>
<script src="assets/js/app.js"></script>

<?php if(isset($_GET['page']) && $_GET['page'] == "dashboard") {?>

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="assets/js/plugins/slick/slick.min.css">
    <link rel="stylesheet" href="assets/js/plugins/slick/slick-theme.min.css">

    <!-- Page Plugins -->
    <script src="assets/js/plugins/slick/slick.min.js"></script>
    <script src="assets/js/plugins/chartjs/Chart.min.js"></script>
    <script>
        $(function () {
            // Init page helpers (Slick Slider plugin)
            App.initHelpers('slick');
        });
    </script>

<?php } ?>

<?php if(isset($_GET['page']) && $_GET['page'] == "chambre") {?>

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="assets/js/plugins/magnific-popup/magnific-popup.min.css">

    <!-- Page JS Plugins -->
    <script src="assets/js/plugins/magnific-popup/magnific-popup.min.js"></script>

    <!-- Page JS Code -->
    <script>
        $(function () {
            // Init page helpers (Magnific Popup plugin)
            App.initHelpers('magnific-popup');
        });
    </script>

<?php } ?>

<?php if(isset($_GET['page']) && $_GET['page'] == "sousprojet") {?>
    <!-- Page JS Code -->
    <script src="assets/js/sousprojet.js.php"></script>
<?php } ?>

