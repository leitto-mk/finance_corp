<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Metronic Admin Theme #6 | User Login 6</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #6 for " name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/photos/abase-logo.png" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets'); ?>/global/plugins/font-awesome/css/all.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets'); ?>/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets'); ?>/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets'); ?>/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?= base_url('assets'); ?>/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets'); ?>/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= base_url('assets'); ?>/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= base_url('assets'); ?>/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?= base_url('assets'); ?>/pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->

<body class=" login">
    <!-- BEGIN : LOGIN PAGE 5-2 -->
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 login-container bs-reset">
                <img class="login-logo login-6" src="<?= base_url('assets'); ?>/pages/img/login/login-invert.png" width="250" />
                <div class="login-content">
                    <h1>School Information System</h1>
                    <p> Welcome to School Information System (SIS) by ABase. the current stage of this system is on development. this project has been on developmet for 6 months started on August 2019 </p>
                    <form action="<?= base_url('auth/login'); ?>" class="login-form" method="post">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>Enter any username and password. </span>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Username" name="username" required /> </div>
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required /> </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right right">
                                <div class="forgot-password">
                                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                                </div>
                                <button class="btn blue" type="submit">Sign In</button>
                            </div>
                        </div>
                    </form>
                    <!-- BEGIN FORGOT PASSWORD FORM -->
                    <form class="forget-form" action="javascript:;" method="post">
                        <h3>Forgot Password ?</h3>
                        <p> Enter your e-mail address below to reset your password. </p>
                        <div class="form-group">
                            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                        <div class="form-actions">
                            <button type="button" id="back-btn" class="btn blue btn-outline">Back</button>
                            <button type="submit" class="btn blue uppercase pull-right">Submit</button>
                        </div>
                    </form>
                    <!-- END FORGOT PASSWORD FORM -->
                </div>
                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-5 bs-reset">
                        </div>
                        <div class="col-xs-7 bs-reset">
                            <div class="login-copyright text-right">
                                <p>Copyright &copy; ABase <?= date('Y'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bs-reset">
                <div class="login-bg"> </div>
            </div>
        </div>
    </div>
    <!-- END : LOGIN PAGE 5-2 -->




    <!--[if lt IE 9]>
<script src="<?= base_url('assets'); ?>/global/plugins/respond.min.js"></script>
<script src="<?= base_url('assets'); ?>/global/plugins/excanvas.min.js"></script> 
<script src="<?= base_url('assets'); ?>/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="<?= base_url('assets'); ?>/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets'); ?>/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets'); ?>/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets'); ?>/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets'); ?>/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets'); ?>/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?= base_url('assets'); ?>/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets'); ?>/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets'); ?>/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="<?= base_url('assets'); ?>/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?= base_url('assets'); ?>/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?= base_url('assets'); ?>/pages/scripts/login-5.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <!-- END THEME LAYOUT SCRIPTS -->

    <script>
        console.log(`Your screen resolution is:  ${window.screen.width} x ${window.screen.height}`)

        var err_msg = <?= $err_msg ?>

        console.log(err_msg)

        if (err_msg == true) {
            alert("EITHER ID OR PASSWORD IS INCORRECT");
        }
    </script>
</body>

</html>