<?php
include_once'header.php';
$userinfo = userinfo();
// pr($userinfo,true);
?>

<!-- BEGIN #content -->
<div id="content" class="content">
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
        <span style="">DASHBOARD </span> / HOME
    </h2>
    <h1 class="page-header">
        Dashboard
        <small> Account summary, All breif details </small>
        <!-- <marquee direction='left'>Recharge Portal Coming Soon</marquee> -->
        <?php if(!empty($prediction_winner)){ foreach($prediction_winner as $pw){?>
        <p>Today Prediction Winner is <?php echo $pw['user_id'];?></p><br>
        <?php }} ?>
        <?php
        if ($userinfo->paid_status == 1) {
            if ($userinfo->directs <= 3) {
                ?>
                <p style="background: red;
                   color: #fff;
                   padding: 8px;">Time left For CTO bonus: <b id="timer"></b> </p>
                   <?php
               }
           }
           ?>

    </h1>
    <p><script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinMarquee.js"></script><div id="coinmarketcap-widget-marquee" coins="1,1027,825,1839,2010,52,5426,5805,10640,4687,6636" currency="USD" theme="light" transparent="false" show-symbol-logo="true"></div>
</p>
    <script>
        var countDownDate = new Date("<?php echo date('Y-m-d H:i', strtotime('+168 hour', strtotime($userinfo->topup_date))); ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("timer").innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
    <!-- END page-header -->
    <div class="row">
        <!-- BEGIN col-6 -->
        <div class="col-lg-6 col-sm-12">
            <!-- BEGIN widget -->
            <div class="widget widget-card widget-card-rowspan2 dynamic-xs inverse-mode with-min-height">
                <!-- BEGIN widget-card-cover -->
                <div class="widget-card-cover">
                    <div class="cover-bg"></div>
                    <img src="<?php echo base_url('NewTheme/') ?>assets/img/o.jpg" alt="">
                </div>
                <!-- END widget-card-cover -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content">
                    <a href="#" class="widget-title-link bg-primary" style="padding-bottom: 3px;">
                        <span id="date-time"><?php echo $userinfo->created_at; ?></span>
                        <!--<span id="rank_tem"></span>-->
                    </a>
                    <h4 class="widget-title">
                        <b>GETTING STARTED</b>
                    </h4>
                </div>
                <!-- END widget-card-content -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content bottom p-b-5">
                    <div class="text-center">
                        <h4>Package Amount : $<?php echo $userinfo->package_amount; ?></h4>
                        <h3 class="m-b-0">Welcome,
                            <span id="Mem_Name1"><?php echo $userinfo->name; ?></span>
                        </h3>
                        <p class="opacity-7" id="RefLink102">
                            <a style="background:red; padding: 5px; color:white" href="<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $userinfo->user_id) ?>" target="_blank">Share Link: <?php echo ($userinfo->user_id) ?></a>
                        </p>
                    </div>
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-6">
                            <!-- BEGIN widget -->
                            <ul class="widget widget-list m-b-0 no-bg inverse-mode">
                                <li>
                                    <!-- BEGIN widget-list-container -->
                                    <a href="#" class="widget-list-container">
                                        <div class="widget-list-media icon p-l-0">
                                            <i class="ti-user bg-gradient-blue"></i>
                                        </div>
                                        <div class="widget-list-content">
                                            <h4 class="widget-title">My Team</h4>
                                            <!--<div class="widget-desc hidden-xs">Directs, Non-Directs</div>-->
                                            <ul class="widget-inline-list widget-desc hidden-xs">
                                                <li>Non-Directs</li>
                                            </ul>
                                        </div>
                                    </a>
                                    <!-- END widget-list-container -->
                                </li>
                                <li>
                                    <!-- BEGIN widget-list-container -->
                                    <a href="<?php echo base_url('Dashboard/User/Directs') ?>" class="widget-list-container">
                                        <div class="widget-list-media icon p-l-0">
                                            <i class="ti-anchor bg-gradient-purple"></i>
                                        </div>
                                        <div class="widget-list-content">
                                            <h4 class="widget-title">My Referral
                                            </h4>
                                            <div class="widget-desc hidden-xs">Directs</div>
                                        </div>
                                    </a>
                                    <!-- END widget-list-container -->
                                </li>
                                <li>
                                    <!-- BEGIN widget-list-container -->
                                    <a href="<?php echo base_url('Dashboard/User/Register/?sponser_id=' . $userinfo->user_id); ?>" target="_blank" class="widget-list-container">
                                        <div class="widget-list-media icon p-l-0">
                                            <i class="ti-lock bg-gradient-green"></i>
                                        </div>
                                        <div class="widget-list-content">
                                            <h4 class="widget-title">Sign-up</h4>
                                            <div class="widget-desc hidden-xs">Add new user</div>
                                        </div>
                                    </a>
                                    <!-- END widget-list-container -->
                                </li>
                            </ul>
                            <!-- END widget -->
                        </div>
                        <!-- END col-6 -->
                        <!-- BEGIN col-6 -->
                        <div class="col-6">
                            <!-- BEGIN widget -->
                            <ul class="widget widget-list m-b-0 no-bg inverse-mode">
                                <li>
                                    <!-- BEGIN widget-list-container -->
                                    <a href="#" class="widget-list-container">
                                        <div class="widget-list-media icon p-l-0">
                                            <i class="ti-ticket bg-gradient-orange"></i>
                                        </div>
                                        <div class="widget-list-content">
                                            <h4 class="widget-title">Business </h4>
                                            <ul class="widget-inline-list widget-desc hidden-xs">
                                                <h4 class="widget-title">Left Business : $<?php echo $userinfo->leftPower; ?></h4>
                                                <h4 class="widget-title">Right Business : $<?php echo $userinfo->rightPower; ?></h4>
                                            </ul>
                                        </div>
                                    </a>
                                    <!-- END widget-list-container -->
                                </li>

                                <li>
                                    <a href="#" class="widget-list-container">
                                        <div class="widget-list-media icon p-l-0">
                                            <i class="ti-settings bg-gradient-silver"></i>
                                        </div>
                                        <div class="widget-list-content">
                                            <h4 class="widget-title">Settings</h4>
                                            <!--<div class="widget-desc hidden-xs">Accounts, Login password</div>-->
                                            <ul class="widget-inline-list widget-desc hidden-xs">
                                                <li>Accounts</li>
                                                <li>Login password</li>
                                            </ul>
                                        </div>
                                    </a>
                                    <!-- END widget-list-container -->
                                </li>
                            </ul>
                            <!-- END widget -->
                        </div>
                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END widget-card-content -->
            </div>
            <!-- END widget -->
        </div>
        <!-- END col-6 -->
        <!-- BEGIN col-3 -->
        <div class="col-lg-3 col-sm-6">
            <!-- BEGIN widget -->
            <div class="widget widget-card inverse-mode with-min-height">
                <!-- BEGIN widget-card-cover -->
                <div class="widget-card-cover">
                    <div class="cover-bg with-gradient"></div>
                    <img src="<?php echo base_url('NewTheme/') ?>assets/img/c.jpg" alt="">
                </div>
                <!-- END widget-card-cover -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content">
                    <div class="dropdown dropdown-icon pull-right">
                        <a data-toggle="dropdown">
                            <i class="ti-more-alt"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="#">Deposit By F-Wallet</a>
                            </li>
                            <li>
                                <a href="#">Deposit History </a>
                            </li>
                        </ul>
                    </div>
                    <h4 class="widget-title">
                        <b>Available Balance</b>

                    </h4>
                </div>
                <!-- END widget-card-content -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content bottom">
                    <div class="widget-card-icon bg-gradient-purple">
                        <i class="ti-control-backward"></i>
                    </div>
                    <div class="widget-card-info">
                        <h4 class="widget-title">
                            <a href="#" id="TOTAL_DEPOSIT">$<?php echo number_format($income_balance['income_balance'], 2); ?></a>
                        </h4>
                        <ul class="widget-inline-list">
                            <li>Total You Have till now</li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <!-- END widget-card-content -->
            </div>
            <!-- END widget -->
            <!-- BEGIN widget -->
            <div class="widget widget-card inverse-mode with-min-height">
                <!-- BEGIN widget-card-cover -->
                <div class="widget-card-cover">
                    <div class="cover-bg with-gradient"></div>
                    <img src="<?php echo base_url('NewTheme/') ?>assets/img/p.jpg" alt="">
                </div>
                <!-- END widget-card-cover -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content">
                    <div class="dropdown dropdown-icon pull-right">
                        <a data-toggle="dropdown">
                            <i class="ti-more-alt"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="#">Fund-Request</a>
                            </li>
                            <li>
                                <a href="#">Fund-Request Status</a>
                            </li>
                            <li>
                                <a href="#">Transaction History</a>
                            </li>
                        </ul>
                    </div>
                    <h4 class="widget-title">f-Wallet</h4>
                </div>
                <!-- END widget-card-content -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content bottom">
                    <div class="widget-card-icon bg-gradient-red">
                        <i class="ti-control-forward"></i>
                    </div>
                    <div class="widget-card-info">
                        <h4 class="widget-title">
                            <a href="/Dashboard.html#" id="MAR">$<?php echo $wallet_balance['wallet_balance']; ?></a>
                        </h4>
                        <ul class="widget-inline-list">
                            <li>Available On f- Wallet </li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <!-- END widget-card-content -->
            </div>
            <!-- END widget -->
        </div>
        <!-- END col-3 -->
        <!-- BEGIN col-3 -->
        <div class="col-lg-3 col-sm-6">
            <!-- BEGIN widget -->
            <div class="widget widget-card inverse-mode with-min-height">
                <!-- BEGIN widget-card-cover -->
                <div class="widget-card-cover">
                    <div class="cover-bg with-gradient"></div>
                    <img src="<?php echo base_url('NewTheme/') ?>assets/img/nn.jpg" alt="">
                </div>
                <!-- END widget-card-cover -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content">
                    <div class="dropdown dropdown-icon pull-right">
                        <a href="/Dashboard.html#" data-toggle="dropdown">
                            <i class="ti-more-alt"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="<?php echo base_url('Dashboard/DirectIncomeWithdraw') ?>">Withdrawal Request</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('Dashboard/withdraw_history') ?>">Withdrawal Status</a>
                            </li>
                        </ul>
                    </div>
                    <h4 class="widget-title">TOTAL WITHDRAWAL</h4>
                </div>
                <!-- END widget-card-content -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content bottom">
                    <div class="widget-card-icon bg-gradient-orange">
                        <i class="ti-stats-up"></i>
                    </div>
                    <div class="widget-card-info">
                        <h4 class="widget-title">
                            <a href="/Dashboard.html#" id="TotWithdrawal">$<?php echo $total_withdrawal['total_withdrawal'] ?></a>
                        </h4>
                        <ul class="widget-inline-list">
                            <li>Total Withdrawal till now</li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <!-- END widget-card-content -->
            </div>
            <!-- END widget -->
            <!-- BEGIN widget -->
            <div class="widget widget-card inverse-mode with-min-height">
                <!-- BEGIN widget-card-cover -->
                <div class="widget-card-cover">
                    <div class="cover-bg with-gradient"></div>
                    <img src="<?php echo base_url('NewTheme/') ?>assets/img/t.jpeg">
                </div>
                <!-- END widget-card-cover -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content">
                    <div class="dropdown dropdown-icon pull-right">
                        <a href="/Dashboard.html#" data-toggle="dropdown">
                            <i class="ti-more-alt"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="/IWallet-Transaction-History.html">Transaction History</a>
                            </li>
                        </ul>
                    </div>
                    <h4 class="widget-title">
                        <b>TOTAL BONUS</b>
                    </h4>
                </div>
                <!-- END widget-card-content -->
                <!-- BEGIN widget-card-content -->
                <div class="widget-card-content bottom">
                    <div class="widget-card-icon  bg-gradient-green">
                        <i class="ti-wallet"></i>
                    </div>
                    <div class="widget-card-info">
                        <h4 class="widget-title text-ellipsis">
                            <a href="<?php echo base_url('Dashboard/User/income_ledgar'); ?>" id="DED">$<?php echo $total_income['total_income']; ?></a>
                        </h4>
                        <ul class="widget-inline-list">
                            <li>Total Income</li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <!-- END widget-card-content -->
            </div>
            <!-- END widget -->
        </div>
        <!-- END col-3 -->
    </div>

    <div class="ng-scope">


        <div class="ng-scope">
            <div class="ng-scope">
                <!-- ngIf: state.currentStep > 0 -->
                <div class="ng-scope">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="progress-widget panel panel-light-grey border border-dark collapsed" style="">
                                <!-- ngIf: !isMobile -->
                                <button class="progress-widget__btn close progress-widget__btn_close ng-scope" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <!-- ngIf: !state.collapsed -->
                                    <span class="ti-close ng-scope" style=""></span>
                                    <span class="ti-angle-down ng-scope" style=""></span>
                                    <!-- end ngIf: !state.collapsed -->
                                    <!-- ngIf: state.collapsed -->
                                </button>
                                <!-- end ngIf: !isMobile -->
                                <button class="progress-widget__btn close progress-widget__btn_close kki" data-toggle="modal" data-target="#myModal">
                                    <span class="ti-angle-down ng-scope" style=""></span>
                                </button>
                                <!-- ngIf: isMobile -->
                                <div class="progress-widget__wrapper  kik" id="collapseExample">
                                    <!-- step 1 -->
                                    <div class="progress-widget__item  progress-widget__item_4-items passed disabled tooltip-col">
                                        <div class="progress-widget__item-layer">
                                            <div class="progress-widget__circle">
                                                <div class="progress-widget__step">
                                                    <!-- ngIf: state.currentStep <= 1 -->
                                                    <!-- ngIf: state.currentStep > 1 -->
                                                    <span class="ti-check ng-scope" style="position: relative;top: -3px;"></span>
                                                    <!-- end ngIf: state.currentStep > 1 -->
                                                </div>
                                            </div>
                                            <div class="progress-widget__title">
                                                <span>Complete Profile</span>
                                                <span class="tooltiptext3">Fill in all your details in the form to take you one step closer to benifits!</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- step 2 -->
                                    <!-- <div class="progress-widget__item  progress-widget__item_4-items current tooltip-col nocs" ng-class="{&#39;passed&#39;: state.currentStep & gt; 2, &#39;current&#39;: state.currentStep === 2 }" ui-sref="app.money.deposits" href="/en/deposits">
                                        <div class="progress-widget__item-layer">
                                            <div class="progress-widget__circle wr1ing passed" id="DepCnt1">
                                                <div class="progress-widget__step asaping12">
                                                    <span id="PmAcnt" class="ti-check passed progress-widget__circle"></span>
                                                </div>
                                            </div>
                                            <div class="progress-widget__title fancing12">
                                                <span>Bitcoin Account</span>
                                                <span class="tooltiptext3">Add your Bitcoin account for payment withdrawal.</span>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- ************************* GLOBAL Version ************************* -->
                                    <!-- step 3 -->
                                    <div class="progress-widget__item  progress-widget__item_4-items current tooltip-col nocs" ng-class="{&#39;passed&#39;: state.currentStep & gt; 3, &#39;current&#39;: state.currentStep === 3 }" ui-sref="app.money.deposits" href="/en/deposits">
                                        <div class="progress-widget__item-layer">
                                            <div class="progress-widget__circle wr1ing" id="DepCnt2">
                                                <div class="progress-widget__step asaping12">
                                                    <span id="KycCnt">3</span>
                                                </div>
                                            </div>
                                            <div class="progress-widget__title fancing12 ">
                                                <span>Document</span>
                                                <span class="tooltiptext3">Don't forget to upload documents for verification within 30 days so you can continue Benifits!</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- step 4 -->
                                    <div class="progress-widget__item  progress-widget__item_4-items last tooltip-col" ng-class="{&#39;passed&#39;: state.currentStep & gt; 4, &#39;current&#39;: state.currentStep === 4}" ui-sref="app.platforms.download" href="/en/platforms">
                                        <div class="progress-widget__item-layer">
                                            <div class="progress-widget__circle passed" id="DepCnt3">
                                                <div class="progress-widget__step">
                                                    <span id="DepCnt" class="ti-check passed progress-widget__circle"></span>
                                                </div>
                                            </div>
                                            <div class="progress-widget__title ">
                                                <span>Active Account</span>
                                                <span class="tooltiptext3">Choose deposit amount, Growth option for deposit. You can deposit for other/self</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end ngIf: state.currentStep > 0 -->
            </div>
        </div>

    </div>
    <div class="fozs">
        <div class="row">
            <div class="col-xl-2 col-md-2 col-sm-6 Polaroid">
                <!-- Card -->
                <div class="dt-card text-center">
                    <!-- Card Header -->
                    <div class="dt-card__header px-5 mb-4">
                        <!-- Card Heading -->
                        <div class="dt-card__heading text-center">
                            <div class="dt-separator-h-v1 mb-2"></div>
                            <h3 class="mb-1">Level Bonus</h3>
                            <span class="d-inline-block text-primary" id="dir_income">$<?php echo $level_income['level_income']; ?></span>
                        </div>
                        <!-- /card heading -->
                    </div>
                    <!-- /card header -->
                    <!-- Card Body -->
                    <div class="dt-card__body px-5">
                        <!-- Avatar -->

                        <!-- /avatar -->
                        <div class="add-cart">
                            <!-- Button -->
                            <a href="<?php echo base_url('Dashboard/User/Income/level_income'); ?>" class="btn bg-brown text-uppercase text-white btn-sm">Details</a>
                            <!-- /button -->
                        </div>
                    </div>
                    <!-- /card body -->
                </div>
                <!-- /card -->
            </div>
            <div class="col-xl-2 col-md-2 col-sm-6 Polaroid">
                <!-- Card -->
                <div class="dt-card text-center">
                    <!-- Card Header -->
                    <div class="dt-card__header px-5 mb-4">
                        <!-- Card Heading -->
                        <div class="dt-card__heading text-center">
                            <div class="dt-separator-h-v1 mb-2"></div>
                            <h3 class="mb-1">Weekly Bonus</h3>
                            <span class="d-inline-block text-primary" id="dir_income">$<?php echo $roi_income['roi_income'];?></span>
                        </div>
                        <!-- /card heading -->
                    </div>
                    <!-- /card header -->
                    <!-- Card Body -->
                    <div class="dt-card__body px-5">
                        <!-- Avatar -->

                        <!-- /avatar -->
                        <div class="add-cart">
                            <!-- Button -->
                            <a href="<?php echo base_url('Dashboard/User/Income/roi_income'); ?>" class="btn bg-brown text-uppercase text-white btn-sm">Details</a>
                            <!-- /button -->
                        </div>
                    </div>
                    <!-- /card body -->
                </div>
                <!-- /card -->
            </div>

            <div class="col-xl-2 col-md-2 col-sm-6 Polaroid">
                <!-- Card -->
                <div class="dt-card text-center">
                    <!-- Card Header -->
                    <div class="dt-card__header px-5 mb-4">
                        <!-- Card Heading -->
                        <div class="dt-card__heading text-center">
                            <div class="dt-separator-h-v1 mb-2"></div>
                            <h3 class="mb-1">Salary Bonus</h3>
                            <span class="d-inline-block text-primary" id="dir_income">$<?php //echo $roi_income['roi_income'];?></span>
                        </div>
                        <!-- /card heading -->
                    </div>
                    <!-- /card header -->
                    <!-- Card Body -->
                    <div class="dt-card__body px-5">
                        <!-- Avatar -->

                        <!-- /avatar -->
                        <div class="add-cart">
                            <!-- Button -->
                            <a href="<?php echo base_url('Dashboard/User/Income/salary_income'); ?>" class="btn bg-brown text-uppercase text-white btn-sm">Details</a>
                            <!-- /button -->
                        </div>
                    </div>
                    <!-- /card body -->
                </div>
                <!-- /card -->
            </div>
            <div class="col-xl-2 col-md-2 col-sm-6 iPhone">
                <!-- Card -->
                <div class="dt-card text-center overflow-hidden">
                    <!-- Card Header -->
                    <div class="dt-card__header px-5 mb-4">
                        <!-- Card Heading -->
                        <div class="dt-card__heading text-center">
                            <div class="dt-separator-h-v1 mb-2"></div>
                            <h3 class="mb-0">Donation  <br>Bonus</h3>
                        </div>
                        <!-- /card heading -->
                    </div>
                    <!-- /card header -->
                    <!-- Card Body -->
                    <div class=" dt-card__body px-5">
                        <!-- Card Text -->
                        <p class="mb-5">
                            <span id="R_Bouns">$<?php echo $pool_income['pool_income']; ?></span>
                        </p>
                        <!-- /card text-->
                        <!-- Button -->
                        <a href="<?php echo base_url('Dashboard/User/Income/pool_income'); ?>" class="text-uppercase f-12 font-weight-500">More Details</a>
                        <!-- /button -->
                    </div>
                    <!-- /card body -->
                    <!-- Card Image -->

                </div>
                <!-- /card -->
            </div>
            <div class="col-xl-2 col-md-2 col-sm-6 iPhone">
                <!-- Card -->
                <div class="dt-card text-center overflow-hidden">
                    <!-- Card Header -->
                    <div class="dt-card__header px-5 mb-4">
                        <!-- Card Heading -->
                        <div class="dt-card__heading text-center">
                            <div class="dt-separator-h-v1 mb-2"></div>
                            <h3 class="mb-0">Club  <br>Donation</h3>
                        </div>
                        <!-- /card heading -->
                    </div>
                    <!-- /card header -->
                    <!-- Card Body -->
                    <div class=" dt-card__body px-5">
                        <!-- Card Text -->
                        <p class="mb-5">
                            <span id="R_Bouns">$<?php echo $club_income['club_income']; ?></span>
                        </p>
                        <!-- /card text-->
                        <!-- Button -->
                        <a href="<?php echo base_url('Dashboard/User/Income/club_income'); ?>" class="text-uppercase f-12 font-weight-500">More Details</a>
                        <!-- /button -->
                    </div>
                    <!-- /card body -->
                    <!-- Card Image -->

                </div>
                <!-- /card -->
            </div>

            <!-- <div class="col-xl-2 col-md-2 col-sm-6 iPhone">

                <div class="dt-card text-center overflow-hidden">

                    <div class="dt-card__header px-5 mb-4">

                        <div class="dt-card__heading text-center">
                            <div class="dt-separator-h-v1 mb-2"></div>
                            <h3 class="mb-0">Pool Bonus</h3>
                        </div>

                    </div>

                    <div class=" dt-card__body px-5">

                        <p class="mb-5">
                            <span id="R_Bouns">$<?php echo $pool_income['pool_income']; ?></span>
                        </p>

                        <a href="<?php echo base_url('Dashboard/User/Income/matching_bonus'); ?>" class="text-uppercase f-12 font-weight-500">More Details</a>

                    </div>


                </div>

            </div> -->


            <div class="col-xl-2 col-md-2 col-sm-4 ">
                <!-- Grid -->
                <div class="row">
                    <!-- Grid Item -->
                    <div class="col-6 col-sm-12">
                        <div class="Grid-Item">
                            <!-- Card -->
                            <div class="pratnge card dt-card__full-height bg-gradient-orange text-white">
                                <!-- Card Body -->
                                <div class="card-body p-6 ">
                                    <p class="display-3 mb-1">
                                        <span id="las_wid"></span>
                                    </p>
                                    <p class="f-12">
                                        <span id="last_down"></span>
                                    </p>
                                    <a href="/Withdrawal-Request.html" class="text-light f-12 font-weight-500 text- uppercase">Last Withdraw</a>
                                </div>
                                <!-- /card body -->
                            </div>
                            <!-- /card -->
                        </div>
                    </div>
                    <div class="col-6 col-sm-12">
                        <div class="Grid-Item">
                            <!-- Card -->
                            <div class="pratnge card dt-card__full-height bg-gradient-blue text-white">
                                <!-- Card Body -->
                                <div class="card-body p-6 ">
                                    <p class="display-3 mb-1">
                                        <span id="las_wid"></span>
                                    </p>
                                    <a href="#" class="text-light f-20 font-weight-500 text- uppercase">Self Team</a></br>
                                    <span>Total : <?php echo $team['team']; ?></span>
                                    <p class="f-20">
                                        <span id="last_down"></span>
                                    </p>
                                </div>
                                <!-- /card body -->
                            </div>
                            <!-- /card -->
                        </div>
                    </div>
                    <!-- /grid item -->
                    <!-- Grid Item -->
                    
                    <!-- /grid item -->
                </div>
                <!-- /grid -->
            </div>
            <div class="col-xl-2 col-md-2 col-sm-4 ">
                <!-- Grid -->
                <div class="row">
                    <!-- Grid Item -->
                    
                    <!-- /grid item -->
                    <!-- Grid Item -->
                    <div class="col-6 col-sm-12 jhhh">
                        <!-- Card -->
                        <div class="card dt-card__full-height bg-gradient-blue text-white">
                            <!-- Card Body -->
                            <div class="card-body p-6 jg">
                                <div class="jhhh d-flex flex-wrap mb-3">
                                    <i class="ti-dropbox text-primary f-s-18 pull-left m-r-10"></i>
                                    <a class="text-white ml-auto" href="#">
                                        <i class="ti-arrow-right text-primary f-s-18 pull-left m-r-10"></i>
                                    </a>
                                </div>
                                <p class="" id="Yo_dir">Total : <?php echo $team['team']; ?></p>
                                <p class="" id="Yo_dir">Paid Direct : <?php echo $paid_directs['paid_directs']; ?> , Unpaid Direct : <?php echo $free_directs['free_directs']; ?></p>
                                <p class="" id="Yo_dir">Indirect unpaid: <?php echo $team_unpaid['team']; //$team['team'] - ( + $team_paid['team']);   ?></p>
                                <p class="" id="Yo_dir">Indirect paid: <?php echo $team_paid['team']; //$team['team'] - ( + $team_paid['team']);   ?></p>


                                <p class="card-text">Your Directs</p>
                            </div>
                            <!-- /card body -->
                        </div>
                        <!-- /card -->
                    </div>
                    <!-- /grid item -->
                </div>
                <!-- /grid -->
            </div>

        </div>
    </div>
    <div class="row">
        <!-- BEGIN col-3 -->
        <div class="col-lg-4 col-sm-6 with-rounded-corner">
            <!-- BEGIN section-title -->
            <div class="section-title m-t-10">USER PROFILE</div>
            <!-- END section-title -->
            <!-- BEGIN widget -->
            <div class="widget widget-card dynamic inverse-mode  with-rounded-corner with-shadow text-center m-b-0">
                <div class="widget-card-cover with-rounded-corner">
                    <div class="cover-bg with-gradient"></div>
                    <img class="img-portrait" src="<?php echo base_url('NewTheme/') ?>assets/img/dashboard-cover-5.jpg" alt="">
                </div>
                <div class="widget-card-content with-rounded-corner">
                    <div class="m-b-10 m-t-10">
                        <div id="mem_rank">
                            <img width="110" class="img-circle" src="<?php echo base_url('NewTheme/') ?>assets/img/Star.png" alt="Rank">
                        </div>
                        <div id="prof_pic">
                            <img width="72" class="img-circle" src="<?php echo base_url('NewTheme/') ?>assets/img/Cropvywozcmeimw.jpg" alt="user">
                        </div>
                        <!-- <img   width="72" class="img-circle" alt=""  src="../UserProfileImg/Open_User.jpg"/>-->
                    </div>
                    <!--id="prof_pic"-->
                    <h4 class="widget-title f-s-13" id="MemID1"><?php echo $userinfo->name; ?></h4>
                    <div class="widget-desc " id="email1"><?php echo $userinfo->email; ?></div>
                </div>
                <div class="widget-card-content with-rounded-corner p-10 p-t-0">
                    <div class="widget-divider m-t-0"></div>
                    <div class="row m-b-2">
                        <div class="col-4">
                            <div class="widget-title" id="withLimit">Associate</div>
                            <div class="widget-desc" style="   white-space: nowrap;">Designation</div>
                        </div>
                        <div class="col-4">
                            <div class="widget-title" id="TOTALROI"><?php echo $userinfo->package_amount; ?></div>
                            <div class="widget-desc">Magic Account</div>
                        </div>
                        <div class="col-4">
                            <div class="widget-title" style="color: #4cd964;" id="MemSts"><?php echo $userinfo->paid_status == 0 ? 'Free' : 'Active'; ?></div>
                            <div class="widget-desc">Status</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END widget -->
            <!-- BEGIN widget -->
            <ul class="widget widget-list with-rounded-corner">
                <li>
                    <a href="#" class="widget-list-container">
                        <div class="widget-list-media square">
                            <div class="img-container">
                                <img src="<?php echo base_url('NewTheme/') ?>assets/img/team.png" alt="" class="img-portrait">
                            </div>
                        </div>
                        <div class="widget-list-content">
                            <h4 class="widget-title text-ellipsis" id="Actived_On1">
                                <b>Doj : </b><?php echo $userinfo->created_at; ?>
                            </h4>
                            <!--	<div class="widget-desc" id="TotTeam1"></div>-->
                        </div>
                        <div class="widget-list-action">
                            <div class="text-muted">
                                <i class="ti-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="widget-list-container">
                        <div class="widget-list-media square">
                            <div class="img-container">
                                <img src="<?php echo base_url('NewTheme/') ?>assets/img/business.png" alt="" class="img-portrait">
                            </div>
                        </div>
                        <div class="widget-list-content">
                            <h4 class="widget-title text-ellipsis" id="DOJ">
                                <b>Act. On : </b><?php echo $userinfo->paid_status == 0 ? 'Free' : $userinfo->topup_date; ?>
                            </h4>
                            <!--<div class="widget-desc" id="Totbussiness"></div>-->
                        </div>
                        <div class="widget-list-action">
                            <div class="text-muted">
                                <i class="ti-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- END widget -->
        </div>
        <!-- END col-3 -->
        <!-- BEGIN col-3 -->
        <div class="col-lg-4 col-sm-6 with-rounded-corner">
            <!-- BEGIN section-title -->
            <div class="section-title m-t-10">RECENT REFFERAL SIGNUP</div>
            <!-- END section-title -->
            <!-- BEGIN widget -->
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 330px;">
                <div data-scrollbar="true" data-height="330px" class=" widget with-rounded-corner " data-init="true" style="overflow: hidden; width: auto; height: 330px;">
                    <ul class="widget widget-list  with-rounded-corner" id="people-list">
                        <?PHP
                        foreach ($directs as $key => $direct) {
                            echo'<li>
                                            <a href="#" class="widget-list-container">
                                                <div class="widget-list-media">
                                                    <img src="' . base_url("NewTheme/assets/img/UserProfile_Pic.jpg") . '" alt="">
                                                </div>
                                                <div class="widget-list-content">
                                                    <div class="widget-desc">' . $direct['user_id'] . '</div>
                                                    <h4 class="widget-title text-ellipsis">' . $direct['name'] . '</h4>
                                                    <ul class="widget-rating-star"></ul>
                                                    <ul class="widget-rating-star">
                                                        <li> ' . $direct['created_at'] . '</li>
                                                    </ul>
                                                </div>
                                                <div class="widget-list-action">
                                                    <div class="widget-price">' . ($direct['paid_status'] == 1 ? "GREEN" : "FREE") . '</div>
                                                </div>
                                            </a>
                                        </li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 263.68px;"></div>
                <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
            </div>
            <!-- END widget -->
        </div>


        <div class="col-lg-12 col-md-12">
                                    <div class="card bg-white">
                                        <div class="card-body">
                                        <div style="height:787px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F; padding: 0px; margin: 0px; width: 100%;"><div style="height:767px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=full_v2&theme=light&cnt=12&pref_coin_id=1530&graph=yes" width="100%" height="763px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
                                            <div class="d-flex justify-content-between">
                                                <h6 class="card-title" style="text-transform: uppercase;font-size: 24px;color: #fff;font-weight: bold;padding:10px 0px;background: linear-gradient(180deg,#19398a,#1171ef)!important;border-radius: 5px;width: 100%;text-align: left;margin-bottom: 20px;"><img src="" style="height: 50px;">&nbsp;Salary Bonus </h6>
                                            </div>
                                            <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                                <div>
                                                    <?php
                                                    $legArr = array(
                                                      1 => array('winning_team' => '2000', 'direct_sponser' => '200 ID','checkDirect' => '1' ,'amount' => 100, 'days' => 30),
                                                      2 => array('winning_team' => '5000', 'direct_sponser' => '500 ID','checkDirect' => '2', 'amount' => 300, 'days' => 40),
                                                      3 => array('winning_team' => '10000', 'direct_sponser' => '1000 ID','checkDirect' => '3', 'amount' => 500, 'days' => 50),
                                                      4 => array('winning_team' => '20000', 'direct_sponser' => '2000 ID','checkDirect' => '4', 'amount' => 1000, 'days' => 50),
                                                      5 => array('winning_team' => '30000', 'direct_sponser' => '3000 ID','checkDirect' => '6', 'amount' => 3000, 'days' => 60),
                                                    );
                                                    // $legArr = $this->config->item('singleLeg');
                                                    ?>
                                                    <table class="table table-bordered"  rules="all" border="1" id="ctl00_ContentPlaceHolder1_gdMerchant" style="
    color: #000;
    
    font-size: 18px;">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Team Members</th>
                                                                <th>Direct Memeber</th>
                                                                <th>Total Income Monthly</th>
                                                                
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($legArr as $key => $arr) {
                                                                if($key == 1){
                                                                    $plus='';
                                                                }else{
                                                                    $plus='+';
                                                                }
                                                                echo'<tr>
                                                                <td>' . $key . '</td>
                                                                <td>' .$arr['winning_team'] . '</td>
                                                                <td>' .$arr['direct_sponser'] . '</td>
                                                                <td>' .$arr['amount'] . '</td>';

                                                                // <td>Not Achieved</td>';

                                                                // pr($team_paid);
                                                                if ($team_paid['team'] >= $arr['winning_team']) {
                                                                    echo'<td> <span style="color:green;">Achieved</span> </td>';
                                                                } else {
                                                                    echo'<td><span style="color:red;">Not Achieved</span> </td>';
                                                                }
                                                                // echo '<td >';
                                                                //     if(is_array($roi)){
                                                                //         foreach($roi as $key2 => $r){
                                                                //         // pr($r);
                                                                //             if($r['level'] == $key){
                                                                //                 if($user['directs'] < $arr['checkDirect']){
                                                                //                     $diff = strtotime('+72 hour', strtotime($r['created_at'])) - strtotime(date('Y-m-d H:i:s'));
                                                                //                     echo '<p id="demo'.$key.'"></p>';
                                                                //                     echo '<script> countdown("demo'.$key.'",'.$diff.') </script>';
                                                                //                 }else{
                                                                //                     if($r['days'] == 0){
                                                                //                         ///echo 'Level lapsed';
                                                                //                     }else{
                                                                //                         echo 'Condition cleared';
                                                                //                     }
                                                                //                 }
                                                                //             }
                                                                //         }
                                                                //     }
                                                                // echo '</td>';
                                                                echo'</tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
        <!-- END col-3 -->
        <!-- BEGIN col-3 -->
        <div class="col-lg-4 col-sm-6 with-rounded-corner" style="display:none;">
            <!-- BEGIN section-title -->
            <div class="section-title m-t-10">NETWORK SUMMARY</div>
            <!-- END section-title -->
            <!-- BEGIN widget -->
            <div class="widget  with-rounded-corner m-b-0">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-7">
                            <h4 class="widget-title">Total Bussiness:
                                <small id="Totbussiness">Rs. 17500</small>
                            </h4>
                        </div>
                        <div class="col-5">
                            <h4 class="widget-title">Total Team:
                                <small id="TotTeam1">5</small>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-body bg-white-transparent-2 p-t-20 p-b-10">
                    <iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;" src="<?php echo base_url('NewTheme/') ?>assets/img/#"></iframe>
                    <canvas id="barChart" height="128" width="341" style="display: block; width: 341px; height: 128px;"></canvas>
                </div>
            </div>
            <!-- END widget -->
            <!-- BEGIN widget -->
            <ul class="widget widget-list with-rounded-corner ">
                <li>
                    <div class="widget-list-container">
                        <div class="widget-list-media icon icon-sm">
                            <i class="ti-server bg-white-transparent-5"></i>
                        </div>
                        <div class="widget-list-content">
                            Active

                            <small id="ChartAct" style="color: #4cd964;font-weight: bolder;font-size: 13px;margin-left: 10px;">5</small>
                        </div>
                        <div class="widget-list-action">
                            <div class="switcher switcher-success pull-left">
                                <input type="checkbox" name="backup_checkbox" id="backup_checkbox" checked="" value="1">
                                <label for="backup_checkbox"></label>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="widget-list-container">
                        <div class="widget-list-media icon icon-sm">
                            <i class="ti-shield bg-white-transparent-5"></i>
                        </div>
                        <div class="widget-list-content">
                            In-Active
                            <small id="ChartInAct" style="
                                   color: #f7ae0d;
                                   font-weight: bolder;
                                   font-size: 13px;
                                   margin-left: 10px;">0</small>
                        </div>
                        <div class="widget-list-action">
                            <div class="switcher switcher-success pull-left">
                                <input type="checkbox" name="firewall_checkbox" id="firewall_checkbox" checked="" value="1">
                                <label for="firewall_checkbox"></label>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="widget-list-container">
                        <div class="widget-list-media icon icon-sm">
                            <i class="ti-email bg-white-transparent-5"></i>
                        </div>
                        <div class="widget-list-content">
                            Block
                            <small id="ChartBlock" style="
                                   color: #ff2e56;
                                   font-weight: bolder;
                                   font-size: 13px;
                                   margin-left: 10px;">0</small>
                        </div>
                        <div class="widget-list-action">
                            <div class="switcher switcher-success pull-left">
                                <input type="checkbox" name="webmail_checkbox" id="webmail_checkbox" checked="" value="1">
                                <label for="webmail_checkbox"></label>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- END widget -->
        </div>
        <!-- END col-3 -->

    </div>
    <!-- END row -->
</div>
<button type="button" class="btn btn-info btn-lg" style="display:none;" data-toggle="modal" data-target="#myModal" id="mdop">Open Modal</button>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">


        <div class="modal-content">
        <div class="modal-header">
            <h3>Welcome</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body">
            <?php if(!empty($popup['media'])) {?>
            <img src="<?php echo base_url('/uploads/'.$popup['media']) ; ?>" class="img-fluid">
        <?php }else{ ?>
            <img src="<?php echo base_url(logo) ; ?>" class="img-fluid">
        <?php } ?>
          <h1>Welcome</h1>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>

    </div>
</div>
<script>
setTimeout(function(){
    $('#mdop').click();
}, 2000);
</script>

<?php //include_once'footer.php';  ?>
