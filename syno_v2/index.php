<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
include_once 'config.php';
$view = isset($_GET['view']) ? $_GET['view'] : 'dash';
$subView = isset($_GET['subView']) ? $_GET['subView'] : '';

if (!isLogged()) {
    //ResponseHelper::redirect('login.php');
    include_once 'login.php';
    exit();
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Synoptique | Dashboard</title>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
        <link href="assets/js/plugins/bootstrap-select-1.12.2/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="assets/css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="assets/css/animate.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        
        <link href="assets/js/plugins/bootstrap-select-1.11.2/dist/css/bootstrap-select.min.css">
        <link href="assets/js/plugins/jquery-upload-file/css/uploadfile.css">
        
        <!-- Mainly scripts -->
        <script src="assets/js/jquery-2.1.1.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- <script src="assets/js/plugins/select2/select2.full.min.js"></script> -->
        <script src="assets/js/plugins/bootstrap-select-1.12.2/js/bootstrap-select.min.js"></script>

        <script src="assets/js/const.js"></script>
        <script src="assets/js/functions.js"></script>

    </head>
    <body>
        <div id="wrapper">
            <?php
            include_once 'views/left.php';
            ?>
            <div id="page-wrapper" class="gray-bg dashbard-1">
                <?php
                include_once 'views/top.php';
                if (file_exists('views/' . $view)) {
                    include_once 'views/' . $view . '/index.php';
                }
                ?>
            </div>
            <?php
            include_once 'views/right.php';
            include_once 'views/footer.php';
            ?>

        </div>

        <!-- Custom and plugin javascript -->
        <script src="assets/js/inspinia.js"></script>
        <script src="assets/js/functions.js"></script>
        <script src="assets/js/plugins/pace/pace.min.js"></script>

        <!-- jQuery UI -->
        <script src="assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>

        <!-- GITTER -->
        <script src="assets/js/plugins/gritter/jquery.gritter.min.js"></script>

        <!-- Sparkline -->
        <script src="assets/js/plugins/sparkline/jquery.sparkline.min.js"></script>

        <!-- Sparkline demo data  -->
        <script src="assets/js/demo/sparkline-demo.js"></script>

        <!-- iCheck -->
        <script src="assets/js/plugins/iCheck/icheck.min.js"></script>

        <!-- Toastr -->
        <script src="assets/js/plugins/toastr/toastr.min.js"></script>

        <script src="assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js" type="application/javascript"></script>
        <script src="assets/js/plugins/jquery-upload-file/js/jquery.uploadfile.min.js" type="application/javascript"></script>

        <script>
            $(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });

                $('.i-checks-form-control').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });

                if ($('.select2') !== undefined) {
                    $('.select2').selectpicker({
                        //style: 'btn-info',
                        size: 4,
                        liveSearch: true,
                        //iconBase: '',
                        showIcon: true
                    });
                }
            });
        </script>

    </body>
</html>
