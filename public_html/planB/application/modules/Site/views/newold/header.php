<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
} 
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo title;?></title>

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/meanmenu.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/boxicons.min.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/owl.theme.default.min.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/animate.min.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/fonts/flaticon.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/odometer.min.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/nice-select.min.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/magnific-popup.min.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/style.css">

<link rel="stylesheet" href="<?php echo base_url('');?>newassets/css/responsive.css">

<link rel="icon" type="image/png" href="<?php echo base_url('');?>newassets/img/favicon.png">
</head>
<body>

<div class="loader">
<div class="d-table">
<div class="d-table-cell">
<div class="spinner">
<div class="double-bounce1"></div>
<div class="double-bounce2"></div>
</div>
</div>
</div>
</div>


<div class="header-area two">
<div class="container">
<div class="row align-items-center">
<div class="col-lg-6">
<div class="left">
<ul>
<li>
<i class='bx bx-phone'></i>
<a href="tel:7528965874">9765372059
</a>
</li>
<li>
<i class='bx bx-mail-send'></i>
<a href="mailto:info@smartpaybharat.com"><span>roimaker.in@gmail.com</span></a>
</li>
</ul>
</div>
</div>
<div class="col-lg-6">
<div class="right">
<ul>
<li>
<a href="#" target="_blank">
<i class='bx bxl-facebook'></i>
</a>
</li>
<li>
<a href="#" target="_blank">
<i class='bx bxl-twitter'></i>
</a>
</li>
<li>
<a href="#" target="_blank">
<i class='bx bxl-pinterest-alt'></i>
</a>
</li>
<li>
<a href="#" target="_blank">
<i class='bx bxl-linkedin'></i>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>


<div class="navbar-area sticky-top">

<div class="mobile-nav">
<a href="/" class="logo">
<img src="<?php echo base_url('');?>newassets/img/logo.png" alt="Logo" style="max-width: 230px;">
</a>
</div>

<div class="main-nav two">
<div class="container">
<nav class="navbar navbar-expand-md navbar-light">
<a class="navbar-brand" href="/">
<img src="<?php echo base_url('');?>newassets/img/logo.png" alt="Logo" style="max-width: 270px;">
</a>
<div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
<ul class="navbar-nav">
<li class="nav-item">
<a href="/" class="nav-link dropdown-toggle active">Home </a>

</li>

<li class="nav-item">
<a href="#" class="nav-link">About</a>
</li>

<li class="nav-item">
<a href="<?php echo base_url('uploads/business-plan.pdf');?>" class="nav-link" target="_blank">Business Plan</a>
</li>

<li class="nav-item">
<a href="<?php echo base_url('Site/Main/contact');?>" class="nav-link">Contact</a>
</li>
</ul>
<div class="side-nav">

<a class="consultant-btn" href="<?php echo base_url('Dashboard/User/Register/'); ?>" style="background-color:#229fd7 !important;color:#fff;">
Register
</a>
<a class="consultant-btn" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>"  style="background-color:#ffc600 !important;color:#fff;">
Login
</a>
</div>
</div>
</nav>
</div>
</div>
</div>
