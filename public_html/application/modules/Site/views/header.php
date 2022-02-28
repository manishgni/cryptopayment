<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="Loxicat">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo title;?></title>
	<link href="images/favicon.png" rel="shortcut icon" type="image/png">
	<!-- REVOLUTION LAYERS STYLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('SiteAssets/'); ?>revolution/css/layers.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('SiteAssets/'); ?>revolution/css/settings.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('SiteAssets/'); ?>revolution/css/navigation.css">
	<!-- Main Stylesheet -->
	<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>css/style.css">
	<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>css/responsive.css">
	<style>
	@media (max-width: 991px){
.logo img {
    height: 105px;
}
.header-style-two .header-wrapper .header-navigation-area {
    background: #45b5f8;
    transition: all 0.4s ease-out 0s;
}
.mean-container a.meanmenu-reveal {
    border: 1px solid #ffffff;
    color: #ffffff;
    margin-top: -38px;
}
.mean-container a.meanmenu-reveal span {
    background: #ffffff;
}
.header-searchbox-style-two .show-searchbox a i {
        font-size: 29px;
    color: #fff;

}
.header-wrapper .header-navigation-area {
    padding: 0px 0;
}
.header-style-two .header-wrapper .header-middle {
    padding: 0px 0;

}
.header-top-area.bg-secondary-color.d-none.d-lg-block {
    display: block !important;
}
.col-lg-6.header-top-right-part.text-right {
    display: none !important;
}
.header-top-area:before {

    background: #171717;

}
.bg-secondary-color {
    background: #171717;
}
.header-top-area:after {

    background: #171717;

}
.header-top-area .header-top-left-part .phone {
    padding-left: 0px !important;
    width: 100%;
    float: left;
}
.header-top-area .header-top-left-part .address:after {
    background: #161616 !important;

}
.header-top-area .header-top-left-part {

    text-align: center !important;
}
.mr-3, .mx-3 {
    margin-right: 1rem!important;
    display: none !important;
}
.navbar-brand {
    text-align: left !important;
    float: left;
    padding: 0px !important;
    float: left !important;
    margin: 0px !important;
}
.header-middle .d-none {
    display: block!important;
}
.d-none.d-md-flex.align-items-center.mr-3 {
    display: none !important;
}
.minus-margin-top {
    margin-top: 10px !important;
}
}
.header-middle {
    background: #fff;
}
.header-style-two .header-wrapper .header-middle h6{color:#000}
	</style>
</head>

<body>
	<!-- Preloader Start -->
	<!-- <div class="preloader"></div> -->
	<!-- Preloader End -->
	<!-- header Start -->
	<header class="header-style-two">
		<div class="header-wrapper">
			<div class="header-top-area bg-secondary-color d-none d-lg-block">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 header-top-left-part">
							<!---<span class="address"><i class="webexflaticon webex-flaticon-placeholder-1"></i> LOS ANGELES,22,193,<br>WALNUT PARK CALIFORNIA,22,028,<br>PALM LOS ANGELES,21,870 <br>STATE - CALIFORNIA,USA</span>-->
							<span class="phone"><i class="webexflaticon webex-flaticon-send"></i> +0890-564-5644</span>
						</div>
						<div class="col-lg-6 header-top-right-part text-right">
							<ul class="social-links">
								<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
							<div class="language">
								<a class="language-btn" href="#"><i class="webexflaticon webex-flaticon-internet"></i> English</a>
								<ul class="language-dropdown">
									<li><a href="#">English</a></li>
									<li><a href="#">Bangla</a></li>
									<li><a href="#">French</a></li>
									<li><a href="#">Spanish</a></li>
									<li><a href="#">Arabic</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-middle">
				<div class="container">
					<div class="row">
						<div class="col-md-12 d-flex align-items-center justify-content-between">
							<a class="navbar-brand logo" href="/">
								<img id="logo-image" class="img-center" src="<?php echo base_url(logo); ?>" alt="">
							</a>
							<div class="topbar-info-area d-none d-sm-flex align-items-center justify-content-between">
								<div class="d-none d-md-flex align-items-center mr-3">
									<i class="webexflaticon webex-flaticon-globe-1 text-primary-color"></i>
									<div>
										<h6>Address</h6>
										<a class="text-gray" href="mailto:contact@scootpool.uk">(i)LOS ANGELES,22,193,WALNUT PARK CALIFORNIA,22,028,PALM LOS ANGELES,21,870 STATE - CALIFORNIA,USA</a>
										<br>
										<a class="text-gray" href="mailto:contact@scootpool.uk">(ii	)22,028,PALM LOS ANGELES,21,870 STATE - CALIFORNIA,USA</a>
									</div>
								</div>
								<div class="d-none d-md-flex align-items-center mr-3">
									<i class="webexflaticon webex-flaticon-globe-1 text-primary-color"></i>
									<div>
										<h6>Address</h6>
										
									</div>
								</div>
								<div class="d-flex align-items-center mr-3">
									<i class="webexflaticon webex-flaticon-phone-1 text-primary-color"></i>
									<div>
										<h6>Call Us</h6>
										<a class="text-gray" href="tel:xxxxxxxxxx">+0890-564-5644</a>
									</div>
								</div>
								<div class="d-none d-lg-flex align-items-center">
									<i class="webexflaticon webex-flaticon-mail-1 text-primary-color"></i>

									<div>
										<h6>Email Us</h6>
											<a class="text-gray" href="mailto:crowdpayfsr@gmail.com">crowdpayfsr@gmail.com</a>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-navigation-area three-layers-header">
				<div class="container">
					<div class="row">
						<div class="col-xl-12 col-lg-12">
							<div class="header-searchbox-style-two">
								<div class="side-panel side-panel-trigger text-right d-none d-lg-block">
									<span class="bar1"></span>
									<span class="bar2"></span>
									<span class="bar3"></span>
								</div>
								<div class="show-searchbox">
									<a href="#"><i class="webex-icon-Search"></i></a>
								</div>
								<div class="toggle-searchbox">
									<form action="#" id="searchform-all" method="get">
										<div>
											<input type="text" id="s" class="form-control" placeholder="Search...">
											<div class="input-box">
												<input type="submit" value="" id="searchsubmit"><i class="fa fa-search"></i>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="main-menu">
								<nav id="mobile-menu">
									<ul>
										<li >
											<a class="active" href="/">Home</a>

										</li>
										<li><a href="#<?php echo base_url('Site/Main/about'); ?>">About Us</a></li>

										

										<li>
											<a href="#<?php echo base_url('Site/Main/contact'); ?>">Contact Us</a>

										</li>
										<li style="margin-right:10px">
											<a style="background:black; border-radius: 5px;color:#fff; padding:10px 20px" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login</a>

										</li>
										<li style="margin-right:0px">
											<a style="background:#45b5f8; border-radius: 5px; color:#fff; padding:10px 20px" href="<?php echo base_url('Dashboard/User/Register'); ?>">Create Account</a>

										</li>

										<li style="margin-right:10px">
											<a style="background:black; border-radius: 5px;color:#fff; padding:10px 20px" href="https://mycrowdpay.com/planB/Dashboard/User/MainLogin/">Plan B Login</a>

										</li>
										<li style="margin-right:0px">
											<a style="background:#45b5f8; border-radius: 5px; color:#fff; padding:10px 20px" href="https://mycrowdpay.com/planB/Dashboard/User/Register/">Plan B Register</a>

										</li>
									</ul>
								</nav>
							</div>
							<div class="side-panel-content">
								<div class="close-icon">
									<button><i class="webex-icon-cross"></i></button>
								</div>
								<div class="side-panel-logo mrb-30">
									<a href="index-2.html">
										<img src="<?php echo base_url(logo); ?>" alt="" />
									</a>
								</div>
								<div class="side-info mrb-30">
									<div class="side-panel-element mrb-25">
										<h4 class="mrb-10">Office Address</h4>
										<ul class="list-items">
											<li><span class="fa fa-globe mrr-10 text-primary-color"></span>LOS ANGELES,22,193,
WALNUT PARK CALIFORNIA,22,028,
PALM LOS ANGELES,21,870
STATE - CALIFORNIA,USA</li>
											<li><span class="fa fa-envelope-o mrr-10 text-primary-color"></span>crowdpayfsr@gmail.com</li>
											<li><span class="fa fa-phone mrr-10 text-primary-color"></span>+0890-564-5644</li>
										</ul>
									</div>
									<div class="side-panel-element mrb-30">
										<h4 class="mrb-15">Pintarest</h4>
										<ul class="pintarest-list">
											<li><a href="#"><img class="img-full" src="images/side-panel/1.jpg" alt=""></a></li>
											<li><a href="#"><img class="img-full" src="images/side-panel/2.jpg" alt=""></a></li>
											<li><a href="#"><img class="img-full" src="images/side-panel/3.jpg" alt=""></a></li>
											<li><a href="#"><img class="img-full" src="images/side-panel/4.jpg" alt=""></a></li>
											<li><a href="#"><img class="img-full" src="images/side-panel/5.jpg" alt=""></a></li>
											<li><a href="#"><img class="img-full" src="images/side-panel/6.jpg" alt=""></a></li>
										</ul>
									</div>
								</div>
								<h4 class="mrb-15">Social List</h4>
								<ul class="social-list">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
							</div>
							<div class="mobile-menu"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
