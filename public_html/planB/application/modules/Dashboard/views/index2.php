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
    border: 6px solid #fff;
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
  font-size: 30px;
}

#clockdiv > div {
    padding: 10px;
    border-radius: 3px;
    background: #297193;
    display: inline-block;
}

#clockdiv div > span {
    padding: 15px;
    border-radius: 3px;
    background: #3caadc;
    display: inline-block;
}

.smalltext {
  padding-top: 5px;
  font-size: 16px;
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
                    <!-- <div class="w-sm-100 mr-auto"> <p style="font-size:17px;display: inline;line-height: 30px;color:#000;font-weight: bold;margin: 0px;">Welcome <span style="color:#35a7db;"> <?php //echo ($user['name']) ?></span>
                        <p class="d-block user-name" style="font-size:17px; line-height: 30px;color:#000;font-weight: bold;margin: 0px;">User Id: <span  style="color:#35a7db;"><?php //echo ($user['user_id']) ?></span></p>
                    </p>    
                    </div> -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                        <div class="w-sm-100 mr-auto"> <p style="font-size:17px;display: inline;line-height: 30px;color:#000;font-weight: bold;margin: 0px;">Welcome <span style="color:#35a7db;"> <?php echo ($user['name']) ?></span>
                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;color:#000;font-weight: bold;margin: 0px;">User Id: <span  style="color:#35a7db;"><?php echo ($user['user_id']) ?></span></p>
                                </p>    
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                 <h4>Launching In</h4>
                                <div id="clockdiv">
                                  <div>
                                    <span class="days"></span>
                                    <div class="smalltext">Days</div>
                                  </div>
                                  <div>
                                    <span class="hours"></span>
                                    <div class="smalltext">Hours</div>
                                  </div>
                                  <div>
                                    <span class="minutes"></span>
                                    <div class="smalltext">Minutes</div>
                                  </div>
                                  <div>
                                    <span class="seconds"></span>
                                    <div class="smalltext">Seconds</div>
                                  </div>
                                </div>       
                            </div>

                            <div class="col-md-4 text-right">
                                        <a href="https://t.me/ARTISTICUNIVERSALLTD" style="background: #32afed; padding: 12px; color:#fff;" class="telegram-button"><i class="fa fa-telegram" aria-hidden="true"></i>Join on Telegram</a>
                
                 <?php $Total = $totalMemebers['ids']+ 30000; ?> <h4 class="top-member">Live Counter: <span style="color:#35a7db;"><?php echo $Total;  ?></span></h4>
                            </div>

                        </div>
                    </div>
                    <div >
                        

<!-- <a href="https://t.me/ARTISTICUNIVERSALLTD" style="background: #32afed; padding: 12px; color:#fff;" class="telegram-button"><i class="fa fa-telegram" aria-hidden="true"></i>Join on Telegram</a>
                
                 <?php //$Total = $totalMemebers['ids']+ 30000; ?> <h4 class="top-member">Live Counter: <span style="color:#35a7db;"><?php //echo $Total;  ?></span></h4> -->

                    </div>

                </div>
        <div class="card card-body">
        <div class="row">
             <div class="col-12 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Total Directs : <span class="text-gray"><?php 
                        $totalDirects = $this->User_model->get_single_record('tbl_users', ['sponser_id' => $this->session->userdata['user_id']], 'count(id) as totalDirects');
                        echo $totalDirects['totalDirects']; ?></span></h6>
                           <h6 class="card-liner-subtitle text-white">Level Team : <span class="text-gray"> <?php 
                        $totalLevelTeam = $this->User_model->get_single_record('tbl_sponser_count', ['user_id' => $this->session->userdata['user_id'], 'level >= ' => 2, 'level <=' => 9], 'count(id) as totalLevelTeam');
                        echo $totalLevelTeam['totalLevelTeam']; ?></span></h6>
                                               
                      
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
             <div class="col-12 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Non Working Team : <?php echo ($totalMemebers['ids'] - $selfPosition['selfPosition'])?></h6>
                                                <h2 class="card-liner-title text-white ">
                                                    Estimated Income : $<?php echo ($totalMemebers['ids'] - $selfPosition['selfPosition'])*2.5?> 
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
             <div class="col-12 col-md-4">
                              <div class="card text-center h-130" style="background: linear-gradient(90deg, black, #E26A2C);border-radius: 10px;box-shadow: 0px 0px 10px rgb(230,230,230);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Artistic Airdrop</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo $coinWallet['total']; ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
        </div>
       
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
        <div class="col-12 col-md-4 mt-3" style="display: none;">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <?php $Total = $totalMemebers['ids']+ 30000; ?>
                                                <h6 class="card-liner-subtitle text-white">Total Members</h6>
                                                <h2 class="card-liner-title text-white "><span class=" text-danger"><a href="https://artisticuniversal.org/" target="_blank" class="text-white"><?php echo $Total;  ?></a> </span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
           
            <div class="col-12 col-lg-12  mt-3">
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                                <div class="card text-center h-130" style="background: linear-gradient(90deg, black, #3daadd);">
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
                            <div class="col-12 col-sm-6 col-md-4 mt-3" style="display: none;">
                              <div class="card text-center h-130" style="background: linear-gradient(90deg, black, #3daadd) ;">
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
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
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
                              <div class="card text-center h-130" style="background:  linear-gradient(90deg, black, #3daadd);">
                                    <div class="card-body">
                                        <div class=''>

                                            <div class=''>
                                                <h6 class="card-liner-subtitle text-white">Total Earning</h6>
                                                <h2 class="card-liner-title text-white"> <?php echo currency.''.round($total_income['total_income'],2); ?></h2>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
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
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white"> Pool Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray"> <?php echo currency.''.$poolIncome['pool_income']; ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 mt-3">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
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
                
                            <div class="col-12 col-sm-6 col-md-4  mt-3" style="display: none;">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
                                    <div class="card-body">
                                        <div class=''>

                                            <div class=''>
                                                <h6 class="card-liner-subtitle text-white">Today Income</h6>
                                                <h2 class="card-liner-title text-white"><?php echo currency.''. $today_income['today_income']; ?></h2>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-4 mt-3" style="display: none;">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
                                    <div class="card-body">
                                        <div class="">

                                            <div class="">
                                                <h6 class="card-liner-subtitle text-white">Available Income</h6>
                                                <h2 class="card-liner-title text-white"><span class="text-gray">  <?php echo currency.''.number_format($income_balance['income_balance'], 2); ?></span></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 mt-3" style="display: none;">
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
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
                              <div class="card text-center h-130" style="    background:  linear-gradient(90deg, black, #3daadd);">
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


            <div class="col-12 col-sm-6 col-md-4 mt-3" style="display:none">
                <div class="card text-center h-130" style="background-color:#fff!important;">
                    <div class="card-body">
                        <div class="">

                            <div class="">
                                <h6 class="card-liner-subtitle text-white">Total Income</h6>
                                <h2 class="card-liner-title text-white"><span class="text-gray">Rs. <?php echo round($total_income['total_income'],2); ?></span></h2>
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
                                      <input style="width:100%; margin-bottom: 10px; float:left" type="text" id="linkTxt"
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
  // $(document).on('click', '#btnCopy', function() {
     // linkTxt
      // var copyText = document.getElementById("linkTxt");
      // copyText.select();
      // copyText.setSelectionRange(0, 99999)
      // document.execCommand("copy");
      // alert("Copied the text: " + copyText.value);
  // })
</script>
<script>
$('#myModal').modal('show');
// $.get('<?php echo base_url('Dashboard/User/get_coin_prices')?>',function(res){
//   console.log(res)
//   // var html = '';
//   // $.each(res.success,function(key,value){
//   //   html += '<li><i class="cc BTC"></i> '+value.currency+' <span class="text-yellow"> $'+value.price+'</span></li>';
//   // })
//     console.log(res);
//   // $('#webticker-1').html(res);
// })



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

const deadline = 'Fri Dec 02 2021 16:30:16 GMT+0530';//new Date(Date.parse(new Date()) + 1 * 24 * 60 * 60 * 1000);
initializeClock("clockdiv", deadline);


// const deadline2 = new Date(Date.parse('Fri Dec 03 2021 15:13:35') + 0 * 24 * 60 * 60 * 1000);

console.log(deadline);
</script>
