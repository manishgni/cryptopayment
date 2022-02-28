<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('NewDashboard/') ?>assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo base_url('NewDashboard/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

 <style>
    body{
            background: url(https://artisticuniversal.com/uploads/page-bg.jpg);
          background-size: cover;
          background-size: cover;
          background-position: center;
          position: relative;
        }
      /* input.form-control {
          border: 0px;
          border-bottom: 1px #38a4f8 solid;
          background: rgb(230 230 230 / 28%);
          height: 40px;
          font-size: 15px;
      }*/
   
        .forgot-heading h4{
          text-transform: uppercase;
        }
        .forgot-heading hr {
            width: 100px;
            border-color: #5cbaff;
            border-width: 1px;
            border-style: dashed;
            margin-top: 0;
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
          font-size: 20px;
          margin-top: 20px;
        }
    </style>
</head>

<body>
 <div class="body-overlay"></div>

    <div class="account-pages pt-5">
        <div class="container">
            <div class="row justify-content-center m-2">
            
                <div class="col-md-6 col-lg-5 bg-white m-auto rounded">
                    <div class="card overflow-hidden">
                         <div class="forgot-heading text-center">
                           <div class="bg-black">
                                <div class="text-primary text-center p-2">
                                    <a href="index-2.html" class="logo logo-admin">
                                        <img src="<?php echo base_url(logo); ?>" style="max-width:85%;margin-bottom: 20px;margin: 0;">
                                    </a>
                                    
                                </div>
                            </div>
                          <h3 class="page-title">ForGot Password</h3>
                          <p class="text-dark font-size-16">Sign in to continue to Website</p>
                        </div>

                        <div class="card-body">
                            <div class="">
                               <div class="details password-form">
              <?php echo form_open(base_url('Dashboard/forgot_password/')); ?>
                <p style="color:red;text-align: center;"><?php echo $this->session->flashdata('message'); ?></p>
              <div class="panel-body">
                  <div class="details password-form">
                      <fieldset>
                          <div class="form-group">
                              <div class="label-area">
                                  <label>User ID:</label>
                              </div>
                              <div class="row-holder">
                                  <input id="SiteURL" type='text' name='user_id' maxlength='50' class="form-control" placeholder="User ID Or Email"/>
                              </div>
                          </div>
                          <div class="form-group" style="text-align: right;">
                              <button id="signupBtn" type="submit" class="btn btn-primary w-100 font-size-18" name='Submit' value='Login'>Forget Password Account </button>
                          </div>

                      </fieldset>
                  </div>
              </div>
              <?php echo form_close(); ?>



                <div class="form-group text-center" style="color:#000;padding: 15px 0px;">
                    Don't have an account? <a href="<?php echo base_url(); ?>Dashboard/User/Register" style="color: red;font-weight: 600;">Click Here</a>
                </div>
                <div class="form-group" style="text-align:center;">
                    <center class="text-bold"><p><a style="background: #4CAF50;
color: white;
padding: 10px 20px;
border-radius:5px;
width: 100%;" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Click Here to Login</a></p></center>
                </div>
            </div>
					</div>
                            </div>

                        <!-- <div class="text-center">
                        <p>Already have an account?<a href="<?php //echo base_url('Dashboard/User/Register'); ?>" class="text-info m-l-5"> Sign In</a></p>
                    </div> -->
    </div>
                    </div>




                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url('NewDashboard/') ?>assets/libs/node-waves/waves.min.js"></script>

    <script src="<?php echo base_url('NewDashboard/') ?>assets/js/app.js"></script>


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
