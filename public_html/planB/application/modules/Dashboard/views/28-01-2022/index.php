   <?php
include_once 'header.php';
$userinfo = userinfo();
// pr($userinfo,true);
date_default_timezone_set('asia/kolkata');
$none = 0;
?>
<style>

.card.mini-stat.bg-primary.text-white {
    min-height: 120px;
    text-align: center;
}
.outline-badge-warning {
    color: #ffffff;
    background: #ff8548;
}
.mt-3, .my-3 {
    margin-top: 0px !important;
}
.card-liner-title {
    font-size:18px;
    position: relative;
    z-index: 111;
    margin-top: 10px;
}
.card {
    margin-top: 20px;
    background: black;
}
.news {
    height: 223px;
}
.text-white-50 {
    color: #fff !important;
}
marquee {
    height: 100%;
}
tr:nth-child(even) {background-color: #f2f2f2;}

@media screen and (max-width:575px){
    .news {
        height: 100px;
    }
}
.card-liner-subtitle {
    font-size: 18px;
    margin-bottom: 0px;
    font-weight: bold;
    color: #fff !important;
    position: relative;
    z-index: 999;
    margin-bottom: 10px;
}
.card.text-center.h-130 {
    height: 120px;
    position: relative;
    padding: 11px 0;
    z-index: 9;
    border: 2px solid #ffde6a;
}
.card .card-body {
    padding: 15px;
    align-items: center;
    vertical-align: middle;
    justify-content: center;
    display: flex;
}
@media screen and (max-width:480px){
.user-name {
    display: block;
}}

    .telegram-button i {
        display: inline-block;
        height: 14px;
        width: 19px;
        vertical-align: middle;
        margin-right: 2px;
        background: url(https://telegram.org/img/oauth/tg_button_small.png) no-repeat;
    }
    h4.top-member {
        font-size: 16px;
        margin-top: 18px;
        font-weight: bold;
    }


    #clockdiv {
  font-family: sans-serif;
  color: #fff;
  display: inline-block;
  font-weight: 100;
  text-align: center;
  font-size: 24px;
}

#clockdiv > div {
    padding: 10px;
    border-radius: 3px;
    background: #3aa9dc;
    display: inline-block;
}

#clockdiv div > span {
    padding: 10px;
    border-radius: 3px;
    background: #000;
    display: inline-block;
}

.smalltext {
  padding-top: 5px;
  font-size: 15px;
}
@media screen and (max-width: 767px){
    .mob-center{
        text-align: center !important;
    }
    .timer-box{
        margin: 9px 0px 38px;
    }
}
</style>
<script>
function countdown(element, seconds) {
    // Fetch the display element
    var el = document.getElementById(element).innerHTML;

    // Set the timer
    var interval = setInterval(function() {
        if (seconds <= 0) {
            //(el.innerHTML = "level lapsed");
            $('#'+element).text('level lapsed')

            clearInterval(interval);
            return;
        }
        var time = secondsToHms(seconds)
        $('#'+element).text(time)

        seconds--;
    }, 1000);
}

function secondsToHms(d) {
    d = Number(d);
    var day = Math.floor(d / (3600 * 24));
    var h = Math.floor(d % (3600 * 24) / 3600);
    var m = Math.floor(d % 3600 / 60);
    var s = Math.floor(d % 3600 % 60);

    var dDisplay = day > 0 ? day + (day == 1 ? " day, " : " days, ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " minute, " : " minutes, ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
    var t = dDisplay + hDisplay + mDisplay + sDisplay;
    return t;
    // console.log(t)
}
</script>
<main>
    <div class="container-fluid site-width pt-3">
        <!-- START: Breadcrumbs-->
         <div class="sub-header align-self-center d-sm-flex w-100 rounded">
                    <!-- <div class="w-sm-100 mr-auto"> <p style="font-size:17px;display: inline;line-height: 30px;color:#000;font-weight: bold;margin: 0px;">Welcome <span style="color:#ffd902;"> <?php //echo ($user['name']) ?></span>
                        <p class="d-block user-name" style="font-size:17px; line-height: 30px;color:#000;font-weight: bold;margin: 0px;">User Id: <span  style="color:#ffd902;"><?php //echo ($user['user_id']) ?></span></p>
                    </p>
                    </div> -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 mob-center">
                                        <div class="w-sm-100 mr-auto"> <p style="font-size:17px;display: inline;line-height: 30px;color:#fff;font-weight: bold;margin: 0px;">Welcome <span style="color:#ffd902;"> <?php echo ($user['name']) ?></span>
                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;color:#fff;font-weight: bold;margin: 0px;">User Id: <span  style="color:#ffd902;"><?php echo ($user['user_id']) ?></span></p>

                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;color:#fff;font-weight: bold;margin: 0px;">Joining Date: <span  style="color:#ffd902;"><?php echo ($user['created_at']) ?></span></p>

                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;color:#fff;font-weight: bold;margin: 0px;">Activation Date: <span  style="color:#ffd902;"><?php if($user['topup_date'] > 0){ echo $user['topup_date'];}else{ echo 'Inactive';} ?></span></p>
                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;color:#fff;font-weight: bold;margin: 0px;">Leadership Achivers: <marquee>
                                    <?php
                                        foreach ($leaders as $key => $leader) {
                                            $totalDirect = $this->User_model->get_single_record('tbl_users', ['sponser_id' => $leader['user_id'], 'paid_status >' => 0], 'count(id) as totalDirect');
                                            if($totalDirect['totalDirect'] >= 4){
                                                echo '<span  style="color:#ffd902;">'.($key+1).'. '.$leader['user_id'].' ('.$leader['name'].'), </span>';
                                            }
                                        }
                                    ?>
                                     </marquee></p>


                                </p>
                                </div>
                            </div>

                            
                            <!-- https://t.me/ARTISTICUNIVERSALLTD -->

                            

                        </div>
                    </div>
                    <div >


<!-- <a href="https://t.me/ARTISTICUNIVERSALLTD" style="background: #32afed; padding: 12px; color:#fff;" class="telegram-button"><i class="fa fa-telegram" aria-hidden="true"></i>Join on Telegram</a>

                 <?php //$Total = $totalMemebers['ids']+ 30000; ?> <h4 class="top-member">Live Counter: <span style="color:#ffd902;"><?php //echo $Total;  ?></span></h4> -->

                    </div>

                </div>
        

        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            
        

            <div class="col-12 col-lg-12  mt-3">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                        <div class="col-12 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Total Directs : <span class="text-gray"><?php
                                                    $totalDirects = $this->User_model->get_single_record('tbl_users', ['sponser_id' => $this->session->userdata['user_id']], 'count(id) as totalDirects');
                                                    echo $totalDirects['totalDirects']; ?></span></h6>
                                                    <h6 class="card-liner-subtitle text-white">Level Team : <span class="text-gray"> <?php
                                                    $totalLevelTeam = $this->User_model->get_single_record('tbl_sponser_count', ['user_id' => $this->session->userdata['user_id'], 'level >= ' => 2, 'level <=' => 9], 'count(id) as totalLevelTeam');
                                                    echo $totalLevelTeam['totalLevelTeam']; ?></span>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                                <div class="card text-center h-130" style="background: linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class=''>
                                            <div class=''>
                                            <h6 class="card-liner-subtitle text-white mb-2">Rank<?php // echo $package['title']; ?></h6>
                                                <h6 class="card-liner-subtitle" style="color: yellow !important;"><?php echo $package['title']; ?></h6>
                                                <h2 class="card-liner-title text-white" ><span class="text-gray"><?php //echo currency.''. $userinfo->package_amount; ?></h2>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="background: linear-gradient(90deg, black, #373737) ;">
                                    <div class="card-body">
                                        <div class=''>

                                            <div class=''>
                                                <h6 class="card-liner-subtitle text-white">Directs </h6>
                                                <h2 class="card-liner-title text-white">Active : <?php echo $paid_directs['paid_directs']; ?> Inactive: <?php echo $free_directs['free_directs']; ?></h2>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">E-Wallet</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.''.$wallet_balance['wallet_balance']; ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class=''>

                                            <div class=''>
                                                <h6 class="card-liner-subtitle text-white">Total Earning</h6>
                                                <h2 class="card-liner-title text-white"> <?php echo currency.''.number_format($total_income['total_income'],2); ?></h2>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4  mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class=''>

                                            <div class=''>
                                                <h6 class="card-liner-subtitle text-white">Today Help</h6>
                                                <h2 class="card-liner-title text-white"><?php echo currency.''. $today_income['today_income']; ?></h2>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Direct Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.''.round($direct_income['direct_income'],2); ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Level Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.''.round($level_income['level_income'],2); ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Upgrade Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.' 0'; ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white"> Auto Pool Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.''.$poolIncome['pool_income']; ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                              


                              <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Royalty Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.' 0'; ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                               


                               

                             <div class="col-12 col-sm-6 col-md-4 mt-3 ">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Available Income</h6>
                                                <h2 class="card-liner-title text-white"><?php echo currency.''.number_format($income_balance['income_balance'], 2); ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--
                               <div class="col-12 col-sm-6 col-md-4 mt-3 d-none">
                <div class="card text-center h-130" style="background-color:#fff!important;">
                    <div class="card-body">
                        <div class="">

                            <div class="">
                                <h6 class="card-liner-subtitle text-white">Available Income</h6>
                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency. round($total_income['total_income'],2); ?></span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 -->


                            <div class="col-12 col-sm-6 col-md-4 mt-3 d-none">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white"> Universal Privilege</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.''.$privilege_income['privilege_income']; ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                          <!--   <div class="col-12 col-sm-6 col-md-4 mt-3" >
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Available Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray">  <?php echo currency.''.number_format($income_balance['income_balance'], 2); ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-12 col-sm-6 col-md-4 mt-3" style="display: none;">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Direct Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.''.round($direct_income['direct_income'],2); ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12 col-sm-6 col-md-4 mt-3 d-none">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #373737);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Withdrawal Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.''.$total_withdrawal['total_withdrawal']; ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>







                    </div>


                    </div>

                </div>
            </div>






            <!-- <div class="col-12 col-md-3 mt-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="media-body align-self-center ">
                                    <span class="mb-0 h5 font-w-600">Status Reports</span><br>
                                    <p class="mb-0 font-w-500 tx-s-12">Total Earning so far</p>
                                </div>

                            </div>
                            <div class="d-flex mt-4">
                                <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"></span><br/>
                               <h3></h3>
                                </div>
                                <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"></span><br/>
                               <h3> </h3>
                                </div>
                            </div>

                            <div class="d-flex mt-3">
                                <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0"></span><br/>
                                   <h3></h3>
                                </div>
                                <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0"></span><br/>
                                  <h3></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <?php if($none == 1){ ?>
            <div class="col-12 col-md-3 mt-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="media-body align-self-center ">
                                    <span class="mb-0 h5 font-w-600">E-pins</span><br>
                                    <p class="mb-0 font-w-500 tx-s-12">Total Earning so far</p>
                                </div>
                                <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><?php  //echo currency?></span></div>
                            </div>
                            <div class="d-flex mt-4">
                                <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0">Used E-pins</span><br/>
                                <?php echo $usedEpin['ids']; ?>
                                </div>
                                <div class="border-0 outline-badge-success w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">Unused E-pins</span><br/>
                                <?php echo $unusedEpin['ids']; ?>
                                </div>
                            </div>

                            <div class="d-flex mt-3">
                                <div class="border-0 outline-badge-dark w-50 p-3 rounded text-center"><span class="h5 mb-0">Transferred E-pins</span><br/>
                                  <?php echo $transferEpins['ids']; ?>
                                </div>
                                <!-- <div class="border-0 outline-badge-danger w-50 p-3 rounded ml-2 text-center"><span class="h5 mb-0">Withdrawal Income</span><br/>
                                  <?php //echo $total_withdrawal['total_withdrawal']; ?>
                                </div> -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php  } ?>
        <!-- <div class="col-12 col-md-3 mt-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="media-body align-self-center ">
                                    <span class="mb-0 h5 font-w-600"></span><br>
                                    <p class="mb-0 font-w-500 tx-s-12">Total Earning so far</p>
                                </div>
                                <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><?php  //echo currency?></span></div>
                            </div>
                            <div class="d-flex mt-4">
                                <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0">Available Amount</span><br/>
                                <h3>  </h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->

          <!--   <div class="col-12 col-md-3 mt-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="media-body align-self-center ">
                                    <span class="mb-0 h5 font-w-600">ROI Income</span><br>
                                </div>
                                <div class="ml-auto border-0 outline-badge-success circle-50"><span class="h5 mb-0"><?php  //echo currency?></span></div>
                            </div>
                            <div class="d-flex mt-4">
                                <div class="border-0 outline-badge-info w-50 p-3 rounded text-center"><span class="h5 mb-0"></span><br/>
                               <h3>   </h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-12 col-md-3 mt-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="height-235">
                                <canvas id="chartjs-other-pie"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->

                <div class="col-md-12 mb-5">
                <div class="row">
            <div class="col-12 col-md-6 mt-12">
                    <div class="card card-body p-2 border-0"  style="background: linear-gradient(1deg, black, #3daadd);color: #fff;">
                        <!-- <a href="https://telegram.me/Vishal">Message me on Telegram</a> -->
                        <h6 class="card-title m-0">Share Link</h6>

                    </div>
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="row">
                              <div class="col-xl-12">
                                <div class="card">
                                  <div class="card-body">

                                    <div class="copyrefferal box box-body pull-up bg-hexagons-white w-100">
                                      <input style="width:100%; margin-bottom: 10px;     background: white; float:left" type="text" id="linkTxt"
                                      value="<?php echo base_url('Dashboard/User/Register/?sponser_id='.$userinfo->user_id); ?>"
                                      class="form-control">
                                      <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section" style="background:#33db9e;
                                      margin-top: -3px;
                                      padding: 10px 0px;
                                      font-size: 15px;
                                      color: #fff;
                                      font-weight: bold;
                                      border-radius: 10px;
                                      border: navajowhite;
                                      float: left;
                                      width: 37%;
                                      cursor: pointer;
                                      margin-left: 5px;
                                      letter-spacing:2px;
                                      ">
                                      Copy link
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>


                <?php


                    $rewards = [
                        1 => ['team' => 4, 'pair' => 4],
                        2 => ['team' => 20, 'pair' => 16],
                        3 => ['team' => 84, 'pair' => 64],
                        4 => ['team' => 340, 'pair' => 256],
                        5 => ['team' => 1364, 'pair' => 1024],
                        6 => ['team' => 5460, 'pair' => 4096],
                    ];
                    $poolArra = [
                        1 => ['name' => 'DREAMER', 'amount' => 20],
                        2 => ['name' => 'IRON', 'amount' => 60],
                        3 => ['name' => 'BRONZE', 'amount' => 180],
                        4 => ['name' => 'SILVER', 'amount' => 540],
                        5 => ['name' => 'GOLD', 'amount' => 1620],
                    ];

                   for ($i=1; $i <=5 ; $i++) {
                    $data = $poolArra[$i];
                    if($i == 1){
                        $table = 'tbl_pool';
                    }else{
                        $table = 'tbl_pool'.$i;
                    }

                    $pool = $this->User_model->get_single_record($table, ['user_id' => $this->session->userdata['user_id']], '*');
                    if(!empty($pool)){
                        $status = '<span class="btn btn-success btn-sm">Activated</span>';
                    }else{
                        $status = '<span class="btn btn-danger btn-sm">Not Activated</span>';
                    }

                ?>
                <div class="row" style="display:none">
                   <div class="col-12">
                        <div class="table-responsive">
                            <div class="card card-body p-2 border-0" style="background: linear-gradient(1deg, black, #3daadd);color: #fff;">
                                <h6 class="card-title m-0"><?php echo $data['name']; ?> AUTOPOOL <?php echo $status; ?></h6>
                            </div>
                           <table class="table table-bordered table-striped dataTable">
                                <thead>
                                    <th>#</th>
                                    <th>Team</th>
                                    <th>Amount</th>
                                    <th>Total Amount</th>
                                    <th>Received Amount</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $team = 4;
                                    $num =4;
                                    for ($k=1; $k <=6 ; $k++) {
                                        $check_status3 = $this->User_model->get_single_record($table, ['user_id' => $this->session->userdata['user_id'], 'team >=' => $num], '*');
                                        $check_status = $this->User_model->get_single_record($table, ['user_id' => $this->session->userdata['user_id']], '*');
                                        $user['leftBusiness'] = $check_status['team'];
                                        if($k > 1){
                                          if($user['leftBusiness'] > $rewards[$k-1]['team']){
                                               $Achived_team = $user['leftBusiness']-$rewards[$k-1]['team'];
                                                if($user['leftBusiness'] > $rewards[$k]['team']){
                                                    $st = $rewards[$k]['pair'];
                                                }else{
                                                    $st =  $Achived_team;
                                                   }
                                           }else{
                                                //$st = $check_status2['team']$rewards[$k-1]['team'];
                                              $st =  0;
                                           }
                                        }else{
                                           if($user['leftBusiness'] > $rewards[$k]['team']){
                                                 $st =  $rewards[$k]['team'];

                                             }else{
                                                if(!empty($user['leftBusiness'])){
                                                  $st =  $user['leftBusiness'];
                                             }else{
                                                 $st =  0;
                                              }
                                           }
                                        }

                                        // $teamData = $this->Main_model->get_pool_team($table,$team,$this->session->userdata['user_id']);
                                        // echo $num;
                                    ?>
                                    <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php
                                        $check_status2 = $this->User_model->get_single_record($table, ['user_id' => $this->session->userdata['user_id']], '*');
                                        // if($check_status2['team'] >= $team){
                                                echo $team.'/<span class="text-success">'.$st.'</span>';
                                        //         $team2 = $team;
                                        // }else{
                                        //     if(!empty($team2) AND $team2 > $check_status2['team']){
                                        //         echo $team.'/<span class="text-danger">'.$check_status2['team'].'</span>';
                                        //     }elseif($check_status2['team'] < $team){
                                        //         echo $team.'/<span class="text-danger">'.$check_status2['team'].'</span>';
                                        //     }else{
                                        //         echo $team.'/<span class="text-danger">0</span>';
                                        //     }
                                        // }
                                         ?></td>
                                        <td><?php echo $data['amount']; ?></td>
                                        <td><?php echo $team*$data['amount']; ?></td>
                                        <td><?php

                                        if(!empty($check_status3)){
                                            echo $team*$data['amount'];
                                        }else{
                                            echo '<span class="btn btn-danger btn-sm">Not Achived</span>';
                                        }
                                         ?></td>
                                    </tr>
                                    <?php
                                        $count = $team*= 4;
                                        $num +=$count;
                                        }
                                    ?>
                                </tbody>

                           </table>
                       </div>
                   </div>

                </div>

            <?php

            } ?>


              <div class="row">
                   <div class="col-12">
                    <?php
                        $arrayhelp = [
                            4 => ['help' => 200,'totalhelp' => 800],
                            16 => ['help' => 50,'totalhelp' => 800],
                            64 => ['help' => 20,'totalhelp' => 1280],
                            256 => ['help' => 10,'totalhelp' => 2560],
                            1024 => ['help' => 10,'totalhelp' =>10240],
                            4096 => ['help' => 10,'totalhelp' => 40960],
                            16384 => ['help' => 10,'totalhelp' => 163840],
                            65536 => ['help' => 10,'totalhelp' => 655360],
                            262144 => ['help' => 10,'totalhelp' => 2621440],
                            1048576=> ['help' => 10,'totalhelp' => 10485760],
                            4194304 => ['help' => 5,'totalhelp' => 20971520],
                            16777216 => ['help' => 5,'totalhelp' => 83886080],
                        ];
                    ?>
                        <div class="table-responsive" style="display:none">
                            <div class="card card-body p-2 border-0" style="background: linear-gradient(1deg, black, #3daadd);color: #fff;">
                                <h6 class="card-title m-0">Level Chart</h6>
                            </div>
                           <table class="table table-bordered table-striped dataTable" id="tableView">
                                <thead>

                                <tr>
                                    <th>Level</th>
                                    <th>Required Team</th>
                                    <th>Active Team</th>
                                    <th>Help</th>
                                    <th>Total Help</th>
                                    <th>Received Help</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php
                                    $i = 4;
                                    foreach ($levels as $key => $level) {
                                    ?>
                                    <tr>
                                        <td><?php echo $level['level']; ?></td>
                                        <td><?php echo $i; ?></td>

                                        <td>
                                            <?php
                                                if($level['level_count'] < $i):
                                                    //echo $level['level_count'];
                                                    echo $levelCount = $level['level_count'];

                                                    // change

                                                    $totalCount = $level['level_count'];
                                                else:
                                                   // echo $i;
                                                    echo $totalCount = $level['level_count'];
                                                    $levelCount = $i;
                                                endif;
                                             ?>

                                            </td>
                                        <td><?php echo $arrayhelp[$i]['help']; ?></td>
                                        <td><?php echo $i*$arrayhelp[$i]['help'];//echo $arrayhelp[$i]['totalhelp']; ?></td>
                                        <td><?php echo $level['level_count']*$arrayhelp[$i]['help'];?></td>
                                        <!-- <td><?php //echo $level['teamBusiness']; ?></td>  -->
                                        <td>
                                            <?php
                                                $getPaidTeam = getPaidTeam($this->session->userdata['user_id']);
                                                if($level['level_count'] < $i):
                                                    echo '<span class="text-danger">Not Achieved</span>';
                                                else:
                                                    //var_dump($getPaidTeam);
                                                    if($level['level'] == 3 && $getPaidTeam == true){
                                                        echo '<span class="text-success">Achieved</span>';
                                                    } elseif($level['level'] != 3) {
                                                        echo '<span class="text-success">Achieved</span>';
                                                    } else {
                                                        echo '<span class="text-danger">Not Achieved</span>';
                                                    }
                                                endif;
                                             ?>
                                        </td>
                                        <!-- <td><?php// echo $level['active_team']['active_team']; ?></td> -->
                                        <!-- <td><?php //echo $level['level_count'] - $level['active_team']['active_team']; ?></td> -->
                                        <!-- <td><a href="<?php //echo base_url('Dashboard/User/Downline/'.$level['level']);?>" style="color:blue;">View</a></td> -->
                                    </tr>
                                    <?php
                                    $i*=4;
                                }
                                ?>

                                </tbody>

                           </table>
                       </div>
                   </div>

                </div>

            </div>



        </div>
        <!-- END: Card DATA-->
    </div>
</main>

<?php include_once 'footer.php';  ?>
<script>


$(document).on('click', '#btnCopy', function () {
    //linkTxt
    var copyText = document.getElementById("linkTxt");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
$(document).on('click', '#btnCopy1', function () {
    //linkTxt
    var copyText = document.getElementById("linkTxt1");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
</script>
<?php if($popup['status'] == 0):?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $popup['caption'];?></h4>
            </div>
            <div class="modal-body">

                <?php
                if(!empty($popup['media'])){
                    if($popup['type'] == 'video')
                        echo '<iframe width="100%" height="400px" src="https://www.youtube.com/embed/'.$popup['media'].'"></iframe>';
                    else
                        echo '<img style="max-width:100%" src="'.base_url('uploads/'.$popup['media']).'">';
                }else{
                    echo '<p>Welcome TO '.base_url().'</p>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<script>
$('#myModal').modal('show');

function getTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  const days = Math.floor(total / (1000 * 60 * 60 * 24));

  return {
    total,
    days,
    hours,
    minutes,
    seconds
  };
}

function initializeClock(id, endtime) {
  const clock = document.getElementById(id);
  const daysSpan = clock.querySelector(".days");
  const hoursSpan = clock.querySelector(".hours");
  const minutesSpan = clock.querySelector(".minutes");
  const secondsSpan = clock.querySelector(".seconds");

  function updateClock() {
    const t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ("0" + t.hours).slice(-2);
    minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
    secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
     document.getElementById("clockdiv").style.display = "none";
    }
  }

  updateClock();
  const timeinterval = setInterval(updateClock, 1000);
}

const deadline = 'Fri Dec 02 2021 17:45:16 GMT+0530';//new Date(Date.parse(new Date()) + 1 * 24 * 60 * 60 * 1000);
initializeClock("clockdiv", deadline);


// const deadline2 = new Date(Date.parse('Fri Dec 03 2021 15:13:35') + 0 * 24 * 60 * 60 * 1000);

console.log(deadline);


$(document).ready( function () {
    $('#tableView').DataTable();
} );
</script>
