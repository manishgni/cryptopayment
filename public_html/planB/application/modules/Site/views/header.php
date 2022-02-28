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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo title;?></title>
    <!-- favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/bootstrap.min.css">
    <!-- fontawesome icon  -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/fontawesome.min.css">
    <!-- flaticon css -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/fonts/flaticon.css">
    <!-- animate.css -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/animate.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/modal-video.min.css">
    <!-- slick css -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/slick.css">
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/slick-theme.css">
    <!-- toastr js -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/toastr.min.css">
    <!-- stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/style.css">
    <!-- responsive -->
    <link rel="stylesheet" href="<?php echo base_url('');?>assets/css/responsive.css">
</head>

    <body>

        <div class="notification-alert">
            <div class="notice-list">
                
            </div>
        </div>

        <!-- preloader begin-->
        <div class="preloader">
            <img src="<?php echo base_url('');?>assets/img/tenor.gif" alt="">
        </div>
        <!-- preloader end -->

        <div class="mobile-navbar-wrapper">

            <!-- header begin -->
            <div class="top-header">
            <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
  <a class="navbar-brand" href="/">
      <img src="<?php echo base_url('uploads/');?>logo.png" class="img-fluid">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" style="display: flex;justify-content: end;align-items: center;flex-wrap: wrap;width: 100%;">
 
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
 <!--      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Site/Main/bank');?>">Bank</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link btn-hyipox-2 px-4 text-white" href="<?php echo base_url('Dashboard/User/Register/'); ?>">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn-hyipox-2 px-4 text-white" href="<?php echo base_url('Dashboard/User/MainLogin'); ?>">Login</a>
      </li>
    
    </ul>
    
  </div>
</nav>
            </div>
            </div>
            <!-- header end -->