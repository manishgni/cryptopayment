<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title><?php echo title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
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
		    	background: url('');
		    	background-size: cover;
		    	background-position: center;
		    	position: relative;
		    	background-attachment: fixed;
		    }
		    h3.page-title {
			    background: #26a0d8;
			    color: #fff;
			    padding: 5px 0 9px;
			    text-transform: uppercase;
			    font-weight: normal;
			    border-radius: 3px;
			    margin-top:30px;
			    font-size: 20px;
			}
			input.form-control {

			    font-size: 17px;
			}
		    .mainregister-bg{
		    background-image:url('https://image.freepik.com/free-vector/forex-trading-with-candle-stick-chart_1017-30885.jpg');
		    background-size: cover;
		    background-position: center;
		    }
		   .body-overlay{
			    	position: absolute;
			    	top: 0;
			    	left: 0;
			    	right: 0;
			    	width: 100%;
			    	height: 100%;
			    	background-color: #000;
			    	opacity: .5;
		    }
		     /*input.form-control {
			    border: 0px;
			    border-bottom: 1px #38a4f8 solid;
			    background: rgb(230 230 230 / 28%);
			}
		     select.form-control {
			    border: 0px;
			    border-bottom: 1px #38a4f8 solid;
			    background: rgb(230 230 230 / 28%);
			}*/

				
			

    	</style>

    </head>

    <body>
    	<div class="body-overlay"></div>
        <!-- <div class="home-btn d-none d-sm-block">
            <a href="index-2.html" class="text-dark"><i class="fas fa-home h2"></i></a>
        </div> -->
        <div class="account-pages pt-5">
            <div class="container">
                <div class="row justify-content-center">
                	
                    <div class="col-md-6 col-lg-6 col-xl-5 bg-white p-3 m-2">
                        <div class="card overflow-hidden">
                        	 <div class="bg-black mb-3">
                                <div class="text-primary text-center">
                                    <a href="index-2.html" class="logo logo-admin">
                                        <img src="<?php echo base_url(logo); ?>" style="max-width:85%;margin-bottom: 20px;margin: 0;">
                                    </a>
                                    <div class="text-center">
			                           	 <h3 class="page-title">Register</h3>
			                        </div>
			                         <p class="text-dark font-size-20">Get your free account now.</p>
                                </div>
                            </div>
                        
                            <div class="card-body p-0">
                                <div class="">
                                    <div class="form-element">
							<!-- <h5><?php //echo title;   ?></h5> -->
							<span class="text-danger">
									<?php echo $this->session->flashdata('error'); ?>
							</span>
                            <div class="col-md-12">
							<?php echo form_open('Dashboard/Register?sponser_id=' . $sponser_id, array('id' => 'RegisterForm')); ?>
                                    <div class="row">
							<div class="col-md-12 form-group has-feedback mb-0">

									<label>Referral ID</label>
									<input type="text" class="form-control" id="sponser_id" value="<?php echo $sponser_id; ?>" name="sponser_id" required>
									<span class="ion ion-locked form-control-feedback "></span>

									<span class="text-danger"> <?php echo form_error('sponser_id'); ?></span>
									<span id="errorMessage" class="text-danger"> </span>
</div>
							<div class="col-md-12 form-group has-feedback mb-0">
									<label>Enter Name</label>
										<div class="form-field">
									<input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" required>
									<span class="ion ion-locked form-control-feedback "></span>
								</div>
									<span class="text-danger"> <?php echo form_error('name'); ?></span>
							</div> 	
							


							<div class="col-md-12 form-group has-feedback mb-0">
									<label>Enter Phone No.</label>
										<div class="form-field">
									<input type="text" class="form-control" name="phone" value="<?php echo set_value('phone'); ?>"  placeholder="Enter Phone No." required>
									<span class="ion ion-locked form-control-feedback "></span>
								</div>
									<span class="text-danger"> <?php echo form_error('phone'); ?></span>
							</div> 	

							
							<div class="col-md-12 Accept my-2">
									<span>
											<input id="chTerms" name="chTerms" type="checkbox" required="required">
									</span>&nbsp;
									I have read the   <a style="cursor:pointer;color:red; font-size:16px" target="_blank" href="#" target="_blank">Terms &amp; Conditions</a>

							</div>
							<div class="col-md-12 form-group has-feedback text-center mb-3">
									<button type="submit" class="btn btn-info btn-block margin-top-10 font-size-20">Submit</button>
							</div>

							<?php echo form_close(); ?>



					</div>
					</div>
					</div>

                                </div>
                            </div>
    						<div class="text-center">

                            <p>Already have an account ? <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="font-weight-medium text-primary"> Login </a> </p>
                          <!--   <p>© <script>document.write(new Date().getFullYear())</script> Veltrix. Crafted with <i class="mdi mdi-heart text-danger"></i> by fortunesclub</p> -->
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

         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

		<script>

	// var selection = document.getElementById("allcountry");
	// 	selection.onchange = function(event){
	// 		var option = '';
	// 		var countryID = event.target.value;
	// 		if(countryID !=''){
	// 			var url ="<?php echo base_url('Dashboard/User/countryCode/');?>"+countryID;
	// 			fetch(url,{
	// 				method:"GET",
	// 			})
	// 			.then(response => response.json())
	// 			.then(response => {
	// 				console.log(response);
	// 				document.getElementById('countryCode1').value = '+'+response.phonecode;
	// 			});
	// 		}else{
	// 			document.getElementById('countryCode1').value = '';
	// 		}
	// };


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


	function sendEmail() {
		var email = document.getElementById("email").value;
		if(email == ''){
			toastr.error('Please enter email id!', {timeOut: 5000})
		}else{
			fetch("<?php echo base_url('Dashboard/User/generateOtp?email='); ?>"+email, {
	           method: "GET",
	           headers: {
	             "X-Requested-With": "XMLHttpRequest"
	           },
	           // body: formData,
	       })
	       .then(response => response.json())
	       .then(result => {
	           if(result.success == '1'){
	              toastr.success(result.message, {timeOut: 5000})
	           }else{
	              toastr.error(result.message, {timeOut: 5000})
	           };
	        });
		}
	}
	</script>
	</body>
</html>
