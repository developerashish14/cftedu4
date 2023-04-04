<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Counsellor</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/fevicon.png'); ?>">
    <!-- Styles -->
    <link href="<?= base_url('assets'); ?>/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/themify-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/unix.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">
    <style>
        #forhetPass{
            display: none;
        }
    </style>
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="login-content">
					<?php if($allow){ ?>
                        <div class="login-form" id="loginghg">
                            <h4>Counsellor Admin</h4>
                            <form class="form-submit" action="login/signin">
                            <?=csrf_field();?>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" placeholder="Email" name="user_email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="user_pass">
                                </div>
                                <div class="checkbox">
                                    <label>
										<input type="checkbox"> Remember Me
									</label>
                                    <label class="pull-right">
										<a href="#" id="forgouij">Forgotten Password?</a>
									</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign in</button>
                            </form>
                        </div>
                        
                        <div class="login-form" id="forhetPass">
                            <h4>Reset Password</h4>
                            <form class="form-submit" action="<?= site_url('login/forgetpas'); ?>">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" placeholder="Email" name="forget_email">
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-15">Submit</button>
                                <div class="register-link text-center">
                                    <p>Back to <a href="#" id="backtolog"> Login</a></p>
                                </div>
                            </form>
                        </div>
					<?php }else{ ?>
						<div class="login-form">
                            <h4>Your IP Address has not allowed to access: <?=$ip;?> </h4>
                        </div>
					<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="preloader"></div>
</body>
    <script src="<?= base_url('assets/js/lib/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/lib/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/myjs.js'); ?>"></script>
</html>