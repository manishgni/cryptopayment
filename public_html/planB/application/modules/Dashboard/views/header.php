<?php
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}
$user_info = userinfo();
$bankinfo = bankinfo();
$none = 0;
?>
<!doctype html>
<html lang="en">
<head>
<title><?php echo title; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<link rel="icon" href="<?php echo base_url('') ?>Latestdashbaord/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="<?php echo base_url('') ?>Latestdashbaord/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('') ?>Latestdashbaord/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url('') ?>Latestdashbaord/css/plugin.css"/>

<!-- MAIN CSS -->
<link rel="stylesheet" href="<?php echo base_url('') ?>Latestdashbaord/css/main.css">
</head>

<body data-theme="dark" class="font-nunito">

<div id="wrapper" class="theme-cyan">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="<?php echo base_url('') ?>Latestdashbaord/images/logo-icon.svg" width="48" height="48" alt="Iconic"></div>
            <p>Please wait...</p>
        </div>
    </div>

    <!-- Top navbar div start -->
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand">
                <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
                <button type="button" class="btn-toggle-fullwidth"><i class="fa fa-bars"></i></button>
                <a href="<?php echo base_url('Dashboard/User/'); ?>"> <img src="https://mycrowdpay.com/uploads/logo.png"> </a> 
            </div>
            
            <div class="navbar-right">
                <form id="navbar-search" class="navbar-form search-form">
                    <input value="" class="form-control" placeholder="Search here..." type="text">
                    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                </form>                

                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="notification-dot"></span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li class="header"><strong>You have 4 new Notifications</strong></li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-info text-warning"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
                                                <span class="timestamp">10:00 AM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>                               
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-like text-success"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Your New Campaign <strong>Holiday Sale</strong> is approved.</p>
                                                <span class="timestamp">11:30 AM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                 <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-pie-chart text-info"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Website visits from Twitter is 27% higher than last week.</p>
                                                <span class="timestamp">04:00 PM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-info text-danger"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Error on website analytics configurations</p>
                                                <span class="timestamp">Yesterday</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="footer"><a href="javascript:void(0);" class="more">See all notifications</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url('/Dashboard/User/logout')?>" class="icon-menu"><i class="fa fa-power-off"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- main left menu -->
    <div id="left-sidebar" class="sidebar">
        <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
        <div class="sidebar-scroll">
            <div class="user-account">
                <img src="<?php echo base_url('') ?>Latestdashbaord/images/user.png" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span>Welcome,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $user_info->name; ?></strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="<?php echo base_url('Dashboard/Profile'); ?>"><i class="icon-user"></i>Edit Profile</a></li>
                        <li><a href="<?php echo base_url('Dashboard/Profile/passwordReset'); ?>"><i class="icon-pencil"></i>Reset Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('/Dashboard/User/logout')?>"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
                <hr>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu">Menu</a></li>
            </ul>
                
            <!-- Tab panes -->
            <div class="tab-content padding-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu li_animation_delay">
                            <li class="active">
                                <a href="<?php echo base_url('Dashboard/User/'); ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="fa fa-th-large"></i><span>Profile</span></a>
                                <ul>

                                    <li><a href="<?php echo base_url('Dashboard/Profile'); ?>">Edit Profile</a></li>
                                    <li><a href="<?php echo base_url('Dashboard/Profile/passwordReset'); ?>">Password Reset</a></li>
                                    <li><a href="<?php echo base_url('Dashboard/Profile/accountDetails'); ?>">Update Tron Address</a></li>
                                    <li><a href="<?php echo base_url('Dashboard/Profile/usdtaddress'); ?>"> Update USDT Address </a></li>

                                </ul>
                            </li>
                            <li>
                                <a href="#Widgets" class="has-arrow"><i class="fa fa-puzzle-piece"></i><span>My Packages</span></a>
                                <ul>      
                                    <?php if($none == 0):?>
                                        <li><a href="<?php echo base_url('Dashboard/Activation'); ?>">Buy Packages</a></li>
                                    <?php endif;?> 
                                    <?php if($none == 1): if($user_info->paid_status == 1):?>
                                        <li><a href="<?php echo base_url('Dashboard/Activation/UpgradeAccount'); ?>">Upgrade Account</a></li>
                                    <?php endif; endif;?>                               
                                   
                                </ul>
                            </li>
                            <li>
                                <a href="#uiElements" class="has-arrow"><i class="fa fa-diamond"></i><span>Deposit</span></a>
                                <ul>
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalance'); ?>">Add Balance</a></li> -->
                                    <li><a href="<?php echo base_url('Dashboard/Payment'); ?>">Add Balance</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/fund/Request_fund/'); ?>">Deposit Balance</a></li>
                                  <!-- <li><a href="<?php echo base_url('Dashboard/fund/depositHistory'); ?>">Deposit  Token History</a></li> -->
                                  <li><a href="<?php echo base_url('Dashboard/fund/requests'); ?>">Deposit History</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/fund/wallet_ledger'); ?>">Wallet Ledger</a></li>
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalanceHistory'); ?>">Topup Wallet History</a></li> -->
                                 
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Dashboard/Register/?sponser_id=' . $user_info->user_id); ?>"><i class="fa fa-diamond"></i><span>Register</span></a>
                            </li>
                            <li>
                                <a href="#charts" class="has-arrow"><i class="fa fa-area-chart"></i><span>My Income</span></a>
                                <ul>
                                    <?php
                                  $incomes = incomes();
                                  foreach ($incomes as $key => $income) {
                                      echo' <li>
                                            <a href="' . base_url('Dashboard/User/Income/' . $key) . '">' . $income . '</a>
                                         </li>';
                                  }
                                  ?>

                                 <!-- <li><a href="<?php echo base_url('Dashboard/User/income_ledgar'); ?>"><i class="icon-energy"></i>  Income Ledger</a></li> -->
                                  <!--  <li><a href="<?php //echo base_url('Dashboard/Settings/payout_summary'); ?>"><i class="icon-energy"></i> Datewise Payout Summary</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/Settings/week_payout_summary'); ?>"><i class="icon-energy"></i> Weekwise Payout Summary</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <a href="#forms" class="has-arrow"><i class="fa fa-pencil"></i><span>Withdrawal</span></a>
                                <ul>
                                      <li><a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal</a></li>
                                      <li><a href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li>
                                   <!-- <li><a href="<?php //echo base_url('Dashboard/matchingWithdraw') ?>">Withdrawal</a></li> -->
                              
                                <!-- <li><a href="<?php //echo base_url('Dashboard/DirectAirdropIncomeWithdraw') ?>">Airdrop Income Withdrawal</a></li> -->
                                <li><a href="<?php echo base_url('Dashboard/eWalletTransfer') ?>"> Transfer Income to E-Wallet</a></li>
                               
                                <li><a href="<?php echo base_url('Dashboard/eWalletTransfer2') ?>"> Transfer to E-Wallet</a></li>
                                <!--  -->

                                 <!--  <li><a href="<?php //echo base_url('Dashboard/Withdraw/ActivateBanking') ?>"> 1. Activate Banking</a></li> -->
                                  <!-- <li><a href="<?php echo base_url('Dashboard/SecureWithdraw/addBeneficiary') ?>"> 1. Add New Beneficiary</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/SecureWithdraw/beneficiaryList') ?>"> 2. IMPS Transfer</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/bank_transfer_summary') ?>">Bank Transfer Summary</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <a href="#Tables" class="has-arrow"><i class="fa fa-table"></i><span>My Partners</span></a>
                                <ul>
                                     <li><a href="<?php echo base_url('Dashboard/User/Directs'); ?>">My Directs</a></li>

                                  <li><a href="<?php echo base_url('Dashboard/User/DownlineCount'); ?>">My Total Partners</a></li>
                                   <li><a href="<?php echo base_url('Dashboard/User/pool1/'.$user_info->user_id); ?>">1.Pool Tree</a></li>
                                   <li><a href="<?php echo base_url('Dashboard/User/pool2/'.$user_info->user_id); ?>">2.Pool Tree </a></li> 
                                   <li><a href="<?php echo base_url('Dashboard/User/pool3/'.$user_info->user_id); ?>">3.Pool Tree</a></li> 

                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/Genelogy'); ?>">Team View</a></li> -->
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/poolTeam'); ?>">Pool Team</a></li> -->

                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>">My Direct Tree</a></li> -->
                                   <!-- <li><a href="<?php //echo base_url('Dashboard/User/DownlineCount'); ?>">My Total Team</a></li> -->
                                  <!--<li><a href="<?php //echo base_url('Dashboard/User/Downline/?position=L'); ?>">Left Downline</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/User/Downline/?position=R'); ?>">Right Downline</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/User/GenelogyTree/' . $user_info->user_id); ?>">Team Tree</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <a href="#Authentication" class="has-arrow"><i class="fa fa-lock"></i><span>Support Ticket</span></a>
                                <ul>
                                    <li><a href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>">Create Ticket</a></li>
                                 <li><a href="<?php echo base_url('Dashboard/Support/Inbox'); ?>">Ticket History</a></li>
                                  <!-- <li><a href="<?php echo base_url('Dashboard/Support/Outbox'); ?>">OutBox</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url('/Dashboard/User/logout')?>"><i class="icon-power"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>          
        </div>
    </div>