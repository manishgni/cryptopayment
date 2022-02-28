<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->

    <link rel="shortcut icon" href="<?php echo base_url('GNIUSER/') ?>dist/images/favicon.ico" />
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- START: Template CSS-->
    <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/flags-icon/css/flag-icon.min.css">
           <script src='https://www.google.com/recaptcha/api.js'></script>


    <!-- END Template CSS-->

    <!-- START: Page CSS-->
    <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/social-button/bootstrap-social.css"/>
    <!-- END: Page CSS-->

    <!-- START: Custom CSS-->
    <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/css/main.css">
    <!-- END: Custom CSS-->
    <!-- Bootstrap Css -->

     <style>
        body{
          background: url(https://artisticuniversal.com/uploads/page-bg.jpg);
          background-size: cover;
          background-position: center;
          position: relative;
        }
      /* input.form-control {
          border: 0px;
          border-bottom: 1px #38a4f8 solid;
          background: rgb(230 230 230 / 28%);
          height: 40px;
          font-size: 19px;
      }*/
      .login-heading h4{
        text-transform: uppercase;
      }
      .login-heading hr {
            width: 100px;
            border-color: #5cbaff;
            border-width: 1px;
            border-style: dashed;
            margin-top: 0;
        }
        button#loginBtn {
            padding: 8px 0;
            margin-top: 15px;
            display: inline-block;
            font-size: 20px;
            background: #26a0d8;
        }
        .bg-black p {
            font-size: 18px;
        }
         .body-overlay{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100vh;
            background-color: #000;
            opacity: .5;
        }
        h3.page-title {
          background: #26a0d8;
          color: #fff;
          padding: 5px 0 9px;
          text-transform: uppercase;
          font-weight: normal;
          border-radius: 3px;
          margin-top: 30px;
          font-size: 20px;
      }
      </style>

</head>


<body id="main-container" class="default">
  <div class="body-overlay"></div>
    <!-- START: Main Content-->
    <div class="container">
        <div class="row vh-100 justify-content-between align-items-center p-2">
            <div class="col-12">
            <div class="row">
                <!-- <form action="#" class="row row-eq-height lockscreen  mt-5 mb-5"> -->
              
                    <div class="login-form col-12 col-md-6 col-lg-5 bg-white m-auto">

                      <div class="panel panel-primary p-2 pb-4">
                        <div class="login-heading text-center">
                           <div class="bg-black">
                                <div class="text-primary text-center p-2">
                                    <a href="index-2.html" class="logo logo-admin">
                                        <img src="<?php echo base_url(logo); ?>" style="max-width:85%;margin-bottom: 20px;margin: 0;">
                                    </a>
                                </div>
                            </div>
                          <h3 class="page-title">Login</h3>
                           <p class="text-dark font-size-20">Get your free account now.</p>
                        </div>

      <p style="color:red;text-align: center;"><?php echo $message; ?></p>
      <?php echo form_open(base_url('Dashboard/User/MainLogin'), array('id' => 'loginForm')); ?>
      <!-- <form id="loginForm" method="post" action="/login.asp?ReturnURL="> -->
          <div class="panel-body">
              <div class="details password-form">

                  <div class="form-group has-feedback">
                    <label>User ID</label>
                      <div class="row-holder">
                          <?php
                          echo form_input(array(
                              'type' => 'text',
                              'name' => 'user_id',
                              'class' => 'form-control',
                              'required' => 'true',
                          ));
                          ?>
                          <span class="ion ion-log-in form-control-feedback "></span>
                      </div>
                  </div>
                  <div class="form-group has-feedback">
                    <label>Password</label>
                      <div class="row-holder">
                          <?php
                          echo form_input(array(
                              'type' => 'password',
                              'name' => 'password',
                              'class' => 'form-control',
                              'required' => 'true',
                          ));
                          ?>
                          <span class="ion ion-log-in form-control-feedback "></span>
                      </div>
                  </div>
                   <div class="g-recaptcha" data-sitekey="6Lch4JoeAAAAAEZu3nsywZUzh5UI6fRGxIDTxRRV" name = ""></div>

                     <a href="<?php echo base_url('Dashboard/forgot_password'); ?>" style="text-transform: uppercase;font-size: 15px;display: inline-block;text-align: right;width: 100%;">Forgot Password</a>
                  <div class="form-group has-feedback">
                      <button id="loginBtn" type="submit" class="btn btn-info btn-block margin-top-10" name="Submit" value="Login">Sign in </button>
                  </div>

              </div>


      </form>
  </div>




                    <div class="login-footer text-center">

                       <!-- <p class="my-2 text-muted"> Or connect with </p>
                         <a class="btn btn-social btn-dropbox text-white mb-2">
                            <i class="icon-social-dropbox align-middle"></i>
                        </a>
                        <a class="btn btn-social btn-facebook text-white mb-2">
                            <i class="icon-social-facebook align-middle"></i>
                        </a>
                        <a class="btn btn-social btn-github text-white mb-2">
                            <i class="icon-social-github align-middle"></i>
                        </a>
                        <a class="btn btn-social btn-google text-white mb-2">
                            <i class="icon-social-google align-middle"></i>
                        </a> -->
                        <div class="mt-2">Don't have an account? <a href="<?php echo base_url('Dashboard/Register'); ?>" style="color: #0093ff;">Sign Up</a></div>
                    </div>
                    </div>
                    </div>
          </div>
                </form>
            </div>

        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url('GNIUSER/') ?>dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url('GNIUSER/') ?>dist/vendors/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url('GNIUSER/') ?>dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url('GNIUSER/') ?>dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('GNIUSER/') ?>dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
    <script>
						$(document).on('blur', '#sponser_id', function () {
								check_sponser();
						})
						function check_sponser() {
								var user_id = $('#sponser_id').val();
								if (user_id != '') {
										var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
										$.get(url, function (res) {
												$('#errorMessage').html(res);
										})
								}
						}
						check_sponser();
						$(document).on('submit', '#RegisterForm', function () {
								if (confirm('Please Check All The Fields Before Submit')) {
										yourformelement.submit();
								} else {
										return false;
								}
						})
				</script>
</body>
</html>
