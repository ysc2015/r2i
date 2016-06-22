<?php
/**
 * file: login.php
 * User: rabii
 */

include __DIR__."/../../inc/session.php";

$email;
$pwd;

extract($_POST);

SessionManager::init();

SessionManager::check(function ($logged, $data) {

    require_once __DIR__ . "/../../php-activerecord/ActiveRecord.php";

    require_once __DIR__ . "/../../inc/config.php";

    if ($logged) {

        $connectedProfil = Utilisateur::first(
            array('conditions' =>
                array("MD5(email_utilisateur) = ? and MD5(pass_utilisateur) = ?", $data[0], $data[1])
            )
        );
        //var_dump($connectedProfil);
        if ($connectedProfil) {

            header("location: index.php");
            exit();

        } else {

            //echo "not found";
            SessionManager::logout(function () {
            });
        }

    }

    global $pwderror;
    global $emailerror;
    global $email;
    global $pwd;

    if (!isset($email) or !isset($pwd)) return;
        if (empty($email)) $emailerror = "has-error";
    if (empty($pwd)) $pwderror = "has-error";


    if (!empty($emailerror) or !empty($pwderror)) return;

    $connectedProfil = Utilisateur::first(
        array('conditions' =>
            array("email_utilisateur = ? and pass_utilisateur = ?", $email, $pwd)
        )
    );
    //var_dump($connectedProfil);
    if ($connectedProfil) {
        SessionManager::login(array($email, $pwd), false, function () {

            header("location: index.php");
            exit(0);

        });


    } else {
        $emailerror = "has-error";
        $pwderror = "has-error";

    }


});

?>
<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>R2I - Outils de gestion déploiement</title>

    <meta name="description" content="R2I - Outils de gestion déploiement">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

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
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

    <!-- R2I CSS framework -->
    <link rel="stylesheet" id="css-main" href="assets/css/oneui.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->
</head>
<body>
<!-- Login Content -->
<div class="content overflow-hidden">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <!-- Login Block -->
            <div class="block block-themed animated fadeIn">
                <div class="block-header bg-primary">
                    <!--<ul class="block-options">
                        <li>
                            <a href="base_pages_reminder.html">Forgot Password?</a>
                        </li>
                        <li>
                            <a href="base_pages_register.html" data-toggle="tooltip" data-placement="left" title="New Account"><i class="si si-plus"></i></a>
                        </li>
                    </ul>-->
                    <h3 class="block-title">Connexion</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <!-- Login Title -->
                    <h1 class="h2 font-w600 push-30-t push-5">R2I</h1>
                    <p>Bonjour, connectez vous.</p>
                    <!-- END Login Title -->

                    <!-- Login Form -->
                    <!-- jQuery Validation (.js-validation-login class is initialized in js/pages/base_pages_login.js) -->
                    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                    <form class="form-horizontal push-30-t push-50" action="" method="post">
                        <div class="form-group has-feedback <?= $emailerror ?>">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary floating">
                                    <input class="form-control" type="text" id="email" name="email" required="">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback <?= $pwderror ?>">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary floating">
                                    <input class="form-control" type="password" id="pwd" name="pwd" required="">
                                    <label for="pwd">Mot de passe</label>
                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <div class="col-xs-12">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="login-remember-me" name="login-remember-me"><span></span> Remember Me?
                                </label>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <button class="btn btn-block btn-primary" type="submit"><i class="si si-login pull-right"></i> Log in</button>
                            </div>
                        </div>
                    </form>
                    <!-- END Login Form -->
                </div>
            </div>
            <!-- END Login Block -->
        </div>
    </div>
</div>
<!-- END Login Content -->

<!-- Login Footer -->
<div class="push-10-t text-center animated fadeInUp">
    <small class="text-muted font-w600"><span class="js-year-copy"></span> &copy; R2I 1.0</small>
</div>
<!-- END Login Footer -->

<!-- R2I Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
</body>
</html>