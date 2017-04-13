<!DOCTYPE html>
<?php include_once 'config.php'; 
if(isLogged()) {
    ResponseHelper::redirect('index.php');
    exit();
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SNK | Login</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Toastr style -->
        <link href="assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Ladda style -->
        <link href="assets/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">

        <link href="assets/css/animate.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body class="gray-bg">

        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>

                <h3>Welcome to SNK Admin Area</h3>
                <p>Login in. To see it in action.</p>
                <form class="m-t" role="form">
                    <div class="form-group">
                        <input id="userName" name="userName" class="form-control" placeholder="Username" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <button id="login_btn" class="ladda-button btn btn-primary block full-width m-b" data-style="expand-left"><span class="ladda-label">Login</span></button>

                    <a href="#"><small>Forgot password?</small></a>
                    
                </form>
                <p class="m-t"> <small><?php echo $lang['copy']; ?></small> </p>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="assets/js/jquery-2.1.1.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/functions.js"></script>
        <!-- Toastr script -->
        <script src="assets/js/plugins/toastr/toastr.min.js"></script>
        <!-- Ladda -->
        <script src="assets/js/plugins/ladda/spin.min.js"></script>
        <script src="assets/js/plugins/ladda/ladda.min.js"></script>
        <script src="assets/js/plugins/ladda/ladda.jquery.min.js"></script>

        <script type="text/javascript">
            $(function () {
                //$('.ladda-button').ladda('bind');
                var l = $( '.ladda-button' ).ladda();
                

                $('#login_btn').click(function () {                    
                    $.ajax({
                        url: 'api/index.php?action=login&api=login',
                        method: 'POST',
                        data: {
                            userName: valById('userName'),
                            password: valById('password'),
                        },
                        success: function (data) {
                            if (data.err > 0) {
                                showNotification('Error', data.msg, 'error');
                            } else {
                                showNotification('Success', data.msg);
                                window.location.href = 'index.php';
                            }
                        },
                        error: function (data) {
                        },
                        beforeSend: function () {
                            l.ladda( 'start' );
                        },
                        complete: function () {
                            l.ladda( 'stop' );
                        }
                    });
                });
            });
        </script>

    </body>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.5/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Jun 2016 07:20:27 GMT -->
</html>
