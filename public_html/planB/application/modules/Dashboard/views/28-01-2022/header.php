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
<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="UTF-8">
        <title><?php echo title; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url('uploads/');?>favicon.png" />
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/flags-icon/css/flag-icon.min.css">
        <!-- END Template CSS-->

        <!-- START: Page CSS-->
        <link rel="stylesheet"  href="<?php echo base_url('GNIUSER/') ?>dist/vendors/chartjs/Chart.min.css">
        <!-- END: Page CSS-->

        <!-- START: Page CSS-->
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/morris/morris.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/weather-icons/css/pe-icon-set-weather.min.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/chartjs/Chart.min.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/starrr/starrr.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
        <!-- END: Page CSS-->

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url('GNIUSER/') ?>dist/css/main.css">
        <!-- END: Custom CSS-->
        <style>
              #header-fix .logo-bar{
        padding:5px;
    }
        #header-fix .search-form .form-control {
    font-size: 17px;

    font-weight: bold;
}
.form-control, .form-control:focus, .form-control:disabled, .form-control[readonly] {

    font-size: 15px !important;
}
#header-fix .ring{
    border:5px solid #ffffff;
}
#header-fix .ring-point{
    background-color: #fff;
}
#header-fix .top-icon > li > a > i{
    color: #fff;
}
#header-fix a, #header-fix a:hover{
    color: #fff;
}
body {

    font-size: 14px;

}
            #header-fix nav {
                background: linear-gradient(182deg,#27a1d8,#46aede);
            }
            .sidebar {
                background: linear-gradient(182deg,#27a1d8,#46aede);
            }

            #header-fix nav {
    background: linear-gradient(
182deg
,#000000,#000000);
}
#header-fix .logo-bar {
    padding: 5px;
    background: black;
}
.sidebar {
    background: linear-gradient(
182deg
,#000000,#000000);
}
main {
   
    background: black;
   
}
        </style>
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">

        <!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div class="loader"></div>
        </div>
        <!-- END: Pre Loader-->

        <!-- START: Header-->
        <div id="header-fix" class="header fixed-top">
            <div class="site-width">
                <nav class="navbar navbar-expand-lg  p-0">
                    <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                        <a href="<?php echo base_url('Dashboard/User/'); ?>" class="horizontal-logo text-left">
                             <span class="h4 font-weight-bold align-self-center mb-0 ml-auto"><img style="height: 60px;max-width:100%" src="https://mycrowdpay.com/uploads/logo.png"></span>
                        </a>
                    </div>
                    <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                        <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                    </div>

                    <form class="float-left d-none search-form">
                        <div class="form-group mb-0 position-relative">
                            <input type="text" class="form-control border-0 rounded bg-search pl-5" placeholder="<?php echo $user_info->name; ?> (<?php echo $user_info->user_id; ?>">
                            <div class="btn-search position-absolute top-0">
                                <a href="#"><i class="h6 icon-magnifier"></i></a>
                            </div>
                            <a href="#" class="position-absolute close-button mobilesearch d-lg-none" data-toggle="dropdown" aria-expanded="false"><i class="icon-close h5"></i>
                            </a>

                        </div>
                    </form>
                    <div class="navbar-right ml-auto h-100">
                        <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                            <li class="d-inline-block align-self-center  d-block d-lg-none">
                                <a href="#" class="nav-link mobilesearch" data-toggle="dropdown" aria-expanded="false"><i class="icon-magnifier h4"></i>
                                </a>
                            </li>

                           <!--  <li class="dropdown align-self-center">
                                <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false"><i class="icon-reload h4"></i>
                                    <span class="badge badge-default"> <span class="ring">
                                        </span><span class="ring-point">
                                        </span> </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right border  py-0">
                                    <li>
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="dist/images/author.jpg" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                                <div class="media-body">
                                                    <p class="mb-0">john</p>
                                                    <span class="text-success">New user registered.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="dist/images/author2.jpg" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                                <div class="media-body">
                                                    <p class="mb-0">Peter</p>
                                                    <span class="text-success">Server #12 overloaded.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                            <div class="media">
                                                <img src="dist/images/author3.jpg" alt="" class="d-flex mr-3 img-fluid rounded-circle">
                                                <div class="media-body">
                                                    <p class="mb-0">Bill</p>
                                                    <span class="text-danger">Application error.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li><a class="dropdown-item text-center py-2" href="#"> See All Tasks <i class="icon-arrow-right pl-2 small"></i></a></li>
                                </ul>

                            </li> -->
                            <li class="dropdown align-self-center" style="display: none;">
                                <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false"><i class="icon-bell h4"></i>
                                    <span class="badge badge-default"> <span class="ring">
                                        </span><span class="ring-point">
                                        </span> <?php $newss = newss(); echo count($newss);?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right border   py-0">
                                  <?php foreach($newss as $nk => $n):?>
                                      <!-- <a href="#" class="text-reset notification-item"> -->

                                      <li>
                                          <a class="dropdown-item px-2 py-2 border border-top-0 border-left-0 border-right-0" href="#">
                                              <div class="media">
                                                  <img src="dist/images/author.jpg" alt="" class="d-flex mr-3 img-fluid rounded-circle w-50">
                                                  <div class="media-body">
                                                      <p class="mb-0 text-success"><?php echo $n['title'];?></p>
                                                      <?php echo $n['news'];?>
                                                  </div>
                                              </div>
                                          </a>
                                      </li>


                                      <!-- </a> -->
                                  <?php endforeach;?>
                                    <li><a class="dropdown-item text-center py-2" href="<?php echo base_url('Dashboard/News');?>"> Read All Message <i class="icon-arrow-right pl-2 small"></i></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown user-profile align-self-center d-inline-block">
                                <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                                    <div class="media">
                                        <img src="<?php echo base_url('uploads/'.$bankinfo->profile_image); ?>" alt="" class="d-flex img-fluid rounded-circle" width="29">
                                    </div>
                                </a>

                                <div class="dropdown-menu border dropdown-menu-right p-0">
                                    <a href="<?php echo base_url('Dashboard/User/Profile'); ?>" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                    <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-support mr-2 h6  mb-0"></span> Help Center</a>
                                    <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-globe mr-2 h6 mb-0"></span> Forum</a>
                                    <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-settings mr-2 h6 mb-0"></span> Account Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?php echo base_url('Dashboard/User/logout'); ?>" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                        <span class="icon-logout mr-2 h6  mb-0"></span> Sign Out</a>
                                </div>

                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- END: Header-->

        <!-- START: Main Menu-->
        <div class="sidebar">
            <div class="site-width">
                <!-- START: Menu-->
                <ul id="side-menu" class="sidebar-menu">
                    <li class="dropdown active">
                        <!-- <a href="<?php echo base_url('Dashboard/User/'); ?>"><i class="icon-home mr-1"></i> Dashboard</a> -->
                        <ul>
                            <li class="active"><a href="<?php echo base_url('Dashboard/User/'); ?>"><i class="icon-home"></i> Dashboard</a></li>
                         <!--    <li><a href="<?php echo base_url('Dashboard/Profile'); ?>"><i class="icon-layers"></i> Edit Profile</a></li> -->
                            <!-- <li><a href="<?php echo base_url('Dashboard/Profile/accountDetails'); ?>"><i class="icon-layers"></i> Account Details</a></li>
 -->




                        </ul>
                    </li>
                    
                    <li class="dropdown">
                           <ul>
                            <li class="dropdown"><a href="#"><i class="icon-screen-desktop"></i> Profile</a>
                                <ul class="sub-menu">
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalance'); ?>">Add Balance</a></li> -->
                                 <li><a href="<?php echo base_url('Dashboard/Profile'); ?>"><i class="icon-layers"></i> Edit Profile</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Profile/passwordReset'); ?>"><i class="icon-layers"></i>Password Reset</a></li>
                                 
                                </ul>
                            </li>

                        </ul>
                    <?php if($none == 1):?>
                        <ul>
                            <li class="dropdown"><a href="#"><i class="icon-screen-desktop"></i> Epin Management</a>
                                <ul class="sub-menu">
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalance'); ?>">Add Balance</a></li> -->
                                  <li><a href="<?php echo base_url('Dashboard/Epin/epinHistory/1'); ?>">Unused Epin</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Epin/epinHistory/2'); ?>">Used Epin</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Epin/epinHistory/0'); ?>">Epin History</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Epin/transfer_epins'); ?>">Transfer pins</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/Epin/epinHistory/3'); ?>">Transferred Epin </a></li>
                                </ul>
                            </li>

                        </ul>
                    <?php endif;?>
                        <ul>
                            <li class="dropdown"><a href="#"><i class="icon-screen-desktop"></i>My Packages</a>
                                <ul class="sub-menu">
                                    <?php if($none == 0):?>
                                        <li><a href="<?php echo base_url('Dashboard/Activation'); ?>">Buy Packages</a></li>
                                    <?php endif;?> 
                                    <?php if($user_info->paid_status == 1):?>
                                        <li><a href="<?php echo base_url('Dashboard/Activation/UpgradeAccount'); ?>">Upgrade Account</a></li>
                                    <?php endif;?> 
                                </ul>
                            </li>

                        </ul>
                        <ul class="d-none">
                            <li class="dropdown"><a href="#"><i class="icon-screen-desktop"></i>Pool Status</a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo base_url('Dashboard/Network/'); ?>">Pool Report</a></li>
                                    <?php if($none == 1):?>
                                        <li><a href="<?php echo base_url('Dashboard/Activation/UpgradeAccount'); ?>">Upgrade Account</a></li>
                                    <?php endif;?> 
                                </ul>
                            </li>

                        </ul>
                        <ul>
                            <li class="dropdown"><a href="#"><i class="icon-screen-desktop"></i>Deposit</a>
                                <ul class="sub-menu">
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalance'); ?>">Add Balance</a></li> -->
                                  <li><a href="<?php echo base_url('Dashboard/fund/Request_fund/'); ?>">Deposit Balance</a></li>
                                  <!-- <li><a href="<?php echo base_url('Dashboard/fund/depositHistory'); ?>">Deposit  Token History</a></li> -->
                                  <li><a href="<?php echo base_url('Dashboard/fund/requests'); ?>">Deposit History</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/fund/wallet_ledger'); ?>">Wallet Ledger</a></li>
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/addBalanceHistory'); ?>">Topup Wallet History</a></li> -->
                                </ul>
                            </li>

                        </ul>
                        <ul class="d-none">
                            <li class="dropdown"><a href="#"><i class="icon-screen-desktop"></i>Air Drop</a>
                                <ul class="sub-menu">
                                  <li><a href="<?php echo base_url('Dashboard/Coin'); ?>">Air Drop History</a></li>
                                </ul>
                            </li>

                        </ul>
                         <ul class="d-none">
                            <li class="dropdown"><a href="#"><i class="icon-screen-desktop"></i>Universal Privilege</a>
                                <ul class="sub-menu">
                                  <li><a href="<?php echo base_url('Dashboard/Coin/universalRecord'); ?>">Universal Privilege History</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/User/universalpool'); ?>">Universal Pool</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                   <!--  <li class="dropdown">
                        <ul>
                            <li><a href="<?php// echo base_url('Dashboard/Profile/changePassword'); ?>"><i class="icon-book-open"></i>Change Password</a></li>
                            <li><a href="<?php// echo base_url('Dashboard/Profile/accountDetails'); ?>"><i class="icon-user"></i>KYC Setting</a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown">
                        <ul>
                            <li class="dropdown"><a href="#"><i class="icon-options"></i>My Income</a>
                                <ul class="sub-menu">
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
                            <li class="dropdown"><a href="#"><i class="icon-options-vertical"></i>Withdrawal</a>
                                <ul class="sub-menu">
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/matchingWithdraw') ?>">Withdrawal</a></li> -->
                                <!-- <li><a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal</a></li> -->
                                <!-- <li><a href="<?php //echo base_url('Dashboard/DirectAirdropIncomeWithdraw') ?>">Airdrop Income Withdrawal</a></li> -->
                                <li><a href="<?php echo base_url('Dashboard/eWalletTransfer') ?>"> Transfer Income to E-Wallet</a></li>
                               
                                <li><a href="<?php echo base_url('Dashboard/eWalletTransfer2') ?>"> Transfer to E-Wallet</a></li>
                                <!-- <li><a href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal History</a></li>  -->

                                 <!--  <li><a href="<?php //echo base_url('Dashboard/Withdraw/ActivateBanking') ?>"> 1. Activate Banking</a></li> -->
                                  <li><a href="<?php echo base_url('Dashboard/SecureWithdraw/addBeneficiary') ?>"> 1. Add New Beneficiary</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/SecureWithdraw/beneficiaryList') ?>"> 2. IMPS Transfer</a></li>
                                  <li><a href="<?php echo base_url('Dashboard/bank_transfer_summary') ?>">Bank Transfer Summary</a></li>
                                </ul>
                            </li>


                        </ul>
                    </li>
                    <li class="dropdown">
                        <ul>

                            <li><a href="<?php echo base_url('Dashboard/User/Register/?sponser_id=' . $user_info->user_id); ?>"><i class="icon-calendar"></i> Register</a></li>


                        </ul>
                    </li>




                    <li class="dropdown">
                        <ul>
                            <li class="dropdown"><a href="#"><i class="icon-map"></i>My Partners</a>
                                <ul class="sub-menu">
                                  <li><a href="<?php echo base_url('Dashboard/User/Directs'); ?>">My Directs</a></li>

                                  <li><a href="<?php echo base_url('Dashboard/User/DownlineCount'); ?>">My Total Partners</a></li>
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/Genelogy'); ?>">Team View</a></li> -->
                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/poolTeam'); ?>">Pool Team</a></li> -->

                                  <!-- <li><a href="<?php //echo base_url('Dashboard/User/Tree/' . $user_info->user_id); ?>">My Direct Tree</a></li> -->
                                   <!-- <li><a href="<?php //echo base_url('Dashboard/User/DownlineCount'); ?>">My Total Team</a></li> -->
                                  <!--<li><a href="<?php //echo base_url('Dashboard/User/Downline/?position=L'); ?>">Left Downline</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/User/Downline/?position=R'); ?>">Right Downline</a></li>
                                  <li><a href="<?php //echo base_url('Dashboard/User/GenelogyTree/' . $user_info->user_id); ?>">Team Tree</a></li> -->
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#"><i class="icon-pencil"></i>Support Ticket</a>
                                <ul class="sub-menu">
                                  <li><a href="<?php echo base_url('Dashboard/Support/ComposeMail'); ?>">Create Ticket</a></li>
                                 <li><a href="<?php echo base_url('Dashboard/Support/Inbox'); ?>">Ticket History</a></li>
                                  <!-- <li><a href="<?php echo base_url('Dashboard/Support/Outbox'); ?>">OutBox</a></li> -->
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url('/Dashboard/User/logout')?>">
                                    <i class="icon-lock"></i> Logout
                                </a>
                            </li>

                        </ul>
                    </li>
                </ul>
                <!-- END: Menu-->
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
                    <li class="breadcrumb-item"><a href="#">Application</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- END: Main Menu-->
