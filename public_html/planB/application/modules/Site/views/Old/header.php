<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
header('HTTP/1.1 301 Moved Permanently');
header('Location: ' . $redirect);
exit();
}
?>
<!doctype html>
<html lang="zxx">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/owl.theme.default.min.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/fonts/flaticon.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/boxicons.min.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/animate.min.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/magnific-popup.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/meanmenu.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/nice-select.min.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/style.css">

<link rel="stylesheet" href="<?php echo base_url('SiteAssets/'); ?>assets/css/responsive.css">

<title><?php echo title; ?></title>

<link rel="icon" type="image/png" href="<?php echo base_url('SiteAssets/'); ?>assets/img/favicon.png">
<style>
@media only screen and (max-width: 991px) {
.mean-container .mean-bar {
  background-color: black;
  padding: 0;
}
}
.mean-container .mean-nav ul li a {
    display: block;
    float: left;
    width: 100% !important;
    padding: 7px 10px !important;
    margin: 0;
    text-align: left;
    color: #fff;
    border-top: 1px solid #dbeefd;
    text-decoration: uppercase !important;
    background: #219ad1 !important;
    font-size: 17px !important;
    font-weight: bold !important;
}
.mobile-nav.mean-container .mean-nav ul li a.active {
    color: #fcc502;
}
</style>
</head>
<body>

<div class="preloader">
<div class="d-table">
<div class="d-table-cell">
<div class="spinner">
<div class="circle1"></div>
<div class="circle2"></div>
<div class="circle3"></div>
</div>
</div>
</div>
</div>


<div class="navbar-area">

<div class="mobile-nav">
<a href="/" class="logo">
<img src="<?php echo base_url('SiteAssets/'); ?>assets/img/logos/logo1.png" alt="Logo">
</a>
</div>

<div class="main-nav">
<div class="container-fluid">
<nav class="container-max navbar navbar-expand-md navbar-light ">
<a class="navbar-brand" href="/">
<img style="max-width:200px" src="<?php echo base_url('SiteAssets/'); ?>assets/img/logos/logo1.png" alt="Logo">
</a>
<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
<ul class="navbar-nav m-auto">
<li class="nav-item">
<a href="/" class="nav-link active">
Home

</a>

</li>
<li class="nav-item">
<a href="<?php echo base_url('Site/Main/about');?>" class="nav-link">
About
</a>
<!-- <ul class="dropdown-menu">
<li class="nav-item">
<a href="<?php echo base_url('Site/Main/aboutmd');?>" class="nav-link active">
MD Message
</a>
</li>

</ul> -->
</li>





<li class="nav-item">
<a href="<?php echo base_url('uploads/plan.pdf');?>" class="nav-link">
Business Plan
</a>
</li>

<li class="nav-item">
<a href="<?php echo base_url('Site/Main/contact');?>" class="nav-link">
Contact
</a>
</li>
<li class="nav-item">
<a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="nav-link">
Login
</a>
</li>
<li class="nav-item">
<a href="<?php echo base_url('Dashboard/User/Register'); ?>" class="nav-link">
Register
</a>
</li>
</ul>
<div class="side-btn-area">
<a style="color:#fff" href="tel:8699485126" class="call-btn">
<i class='bx bx-phone'></i>
+91-86994-85126
</a>
</div>
<div class="appointment-btn">
<a href="<?php echo base_url('Dashboard/User/Register'); ?>" class="default-btn default-bg-buttercup">
Register
<i class='bx bx-right-arrow-alt'></i>
</a> <a href="<?php echo base_url('Dashboard/User/MainLogin'); ?>" class="default-btn default-bg-buttercup">
Login
<i class='bx bx-right-arrow-alt'></i>
</a>
</div>
</div>
</nav>
</div>
</div>
</div>
