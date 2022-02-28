<?php
include_once'header.php';
$userinfo = userinfo();
// pr($userinfo,true);
date_default_timezone_set('asia/kolkata')
?>
<style>
.card.mini-stat{
    min-height: 120px;
    background: transparent !important;
    text-align: right;
    border-radius:10px;
    /*overflow: hidden;*/
    /**/
    border: 2px #fff solid;
}
.card {
    box-shadow: 0 0.1rem 0.7rem rgb(0 0 0 / 18%);
    /*border: 1px solid rgba(0, 0, 0, 0);*/
    margin-bottom: 30px;
    background-color:#fff;
}
.mini-stat .mini-stat-img {
    width: 58px;
    height: 58px;
    line-height: 58px;
    background: #ffffff;
    border-radius: 4px;
    z-index: 111;
    text-align: center;
    margin: auto;
    position: absolute;
    top: 0px;
    left: 12px;

}
marquee {
    background: #fff;
    color: #000;
    font-size: 20px;
    padding: 7px 0;
}
.news {
    height: 223px;
}
.text-white-50 {
    color: #fff !important;
}
.footer {
    color: #f1f1f1;
    background: #000;
}
/*.card.mini-stat.text-white::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #000;
    top: 0;
    left: 0;
    opacity: .6;
}*/
.breadcrumb-item.active {
    color: #00587c;
    font-weight: bold;
    font-size: 23px;
    text-transform: capitalize;
}
table.table.table-bordered{
    color: #fff;
    font-size: 18px;
}
h6.card-title.table-title {
    background: #fd6d03

}
thead {
    background: #00587c;
}
td {
    color: #000;
}
.dashboard-main-heading p {
    display: inline-block;
    padding: 0 3px;
    font-size: 22px;
    margin: 0px;
}
table.table.table-bordered.reward td {
    color: #fff;
}
table.table.table-bordered.reward td:nth-child(4) {
    background: #fff;
}
.table td, .table th {
    font-weight: bold;
}
img.share-whtsp.img-fluid {
    max-width: 300px;
}
.card.mini-stat.text-white.epin p {
    display: inline-block;
    padding: 1px 22px;
    font-size: 16px;
    margin: 0px;
}
/*tr:nth-child(even) {background-color: #f2f2f2;}*/

@media screen and (max-width:421px){
    .mini-stat .mini-stat-img{
        display: none;
    }
}
@media screen and (max-width:575px){
    .news {
        height: 100px;
    }
    img.share-whtsp.img-fluid{
        max-width: 100%;
    }
}

/*@media screen and (min-width: 1024px) and (max-width: 1368px){
    .card.mini-stat{
        min-height: 167px;
    }
}*/
@media screen and (max-width: 992px){
    body[data-sidebar=dark] .vertical-menu {
        background: rgb(0 0 0 / 100%);
    }
}

h4.font-weight-medium.font-size-24 {
    color: #ebe929;
    font-weight: bold;
}
#imageDiv img {
    max-width: 100%;
    height: 200px;
}
#video-background {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      width: auto;
      height: auto;
      z-index: -100;
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

<video autoplay="" loop="" class="fillWidth fadeIn animated" poster="https://www.youtube.com/watch?v=B7iyeI_AlN4" id="video-background">
        <source src="https://www.youtube.com/watch?v=B7iyeI_AlN4" type="video/mp4">
    </video>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content" style="background:url(https://media.moddb.com/images/mods/1/19/18208/ss00880.jpg) !important">

                <div class="page-content">
                  <div class="latest-news">
                        <marquee direction="left" scrollamount="2"><?php echo $news['news']; ?></marquee>
                      </div>
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row align-items-center mt-4">

                            <div class="col-sm-12">
                                <div class="">
                                <div class="">
                                        <!-- <h4 class="text-white text-uppercase">Dashboard</h4> -->
                                        <div class="row">
                                            <div class="col-md-4 text-center dashboard-main-heading">
                                              <div class="col-md-12" style="background:#33db9e;
                                              margin-top: -3px;
                                              padding: 10px 0px;
                                              font-size: 15px;
                                              color: #fff;
                                              font-weight: bold;
                                              border-radius: 10px;
                                              border: navajowhite;
                                              float: left;
                                              width: 100%;
                                              margin-bottom: 10px;
                                              cursor: pointer;
                                              margin-left: 5px;
                                              letter-spacing:2px;
                                              text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 21px;
                                              ">
                                              <div class="row imageDiv">
                                                  <div class="col-sm-12" id="imageDiv" onclick="gettask()">

                                                  </div>
                                                  <div style="    text-align: center;
    width: 100%;
    margin-top: 15px;">Rs. 2.5 Per Add</div>
                                              </div>
                                            </div>

                                            </div>
                                            <div class="col-md-8">
        <div class="">
          <div class="row">

                            <div class="col-md-6" style="display:none">
                                <div class="card mini-stat text-white" style="background:#172b4d">
                                    <div class="card-body" >
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/01.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">E-Wallet</h5>
                                            <h4 class="font-weight-medium font-size-24"><?php echo currency.''.$wallet_balance['wallet_balance'];?>  </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6" style="display: none;">
                                <div class="card mini-stat text-white" style="background:#16a086">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/02.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Package Status</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.$userinfo->package_amount; ?> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="display: none;">
                              <div class="card mini-stat text-white" style="background:#515252">
                                  <div class="card-body" >
                                      <div class="" style="position: relative;">
                                          <div class="mini-stat-img" >
                                              <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                          </div>
                                          <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Today Income</h5>
                                          <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.$today_income['today_income']; ?> </span> </h4>

                                      </div>

                                  </div>
                              </div>
                          </div>



                             <div class="col-md-6">
                              <div class="card mini-stat text-white" style="background:#ec428b">
                                  <div class="card-body" >
                                      <div class="" style="position: relative;">
                                          <div class="mini-stat-img">
                                              <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                          </div>
                                          <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Ads View Income</h5>
                                          <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php
                                          $task_income = $this->User_model->get_single_record('tbl_income_wallet', array('user_id' => $this->session->userdata['user_id'],'type' => 'task_income'), 'ifnull(sum(amount),0) as taskIncome');

                                          echo currency.''.$task_income['taskIncome']; ?></span> </h4>

                                      </div>

                                  </div>
                              </div>
                          </div>


                            <div class="col-md-6" style="display: none">
                                <div class="card mini-stat text-white" style="background:#e66e69">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Direct Sponsor Income</h5>
                                            <h4 class="font-weight-medium font-size-20">Active : <?php echo $paid_directs['paid_directs']; ?> , Inactive : <?php echo $free_directs['free_directs']; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display: none;">
                                <div class="card mini-stat text-white" style="background:#172b4d">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Self Team</h5>
                                            <h4 class="font-weight-medium font-size-20">Active : <?php echo $paid_self_team['0']['total']; ?> , Inactive : <?php echo $team['team'] - $paid_self_team['0']['total'];

                                                // pr($paid_self_team['0']['total']);
                                             ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display:none">
                                <div class="card mini-stat text-white" style="background:#297fb8">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img" >
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Available Income</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.number_format($income_balance['income_balance'], 2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="card mini-stat text-white" style="background:#ff8a65" >
                                   <div class="card-body">
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img" >
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Direct Sponsor Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.number_format($direct_income['direct_income'], 2); ?></span></h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                           <div class="col-md-6">
                              <div class="card mini-stat text-white" style="background:#00587c" >
                                  <div class="card-body">
                                      <div class="" style="position: relative;">
                                          <div class="mini-stat-img" >
                                              <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                          </div>
                                          <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Team Ads view Income</h5>
                                          <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.number_format($level_income['level_income'], 2); ?></span></h4>

                                      </div>

                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="card mini-stat text-white" style="background:#62cb7f">
                                  <div class="card-body">
                                      <div class="" style="position: relative;">
                                          <div class="mini-stat-img" >
                                              <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                          </div>
                                          <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Total Team & Direct Income</h5>
                                          <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.round($total_income['total_income'],2); ?> </span></h4>

                                      </div>

                                  </div>
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="card mini-stat text-white" style="background:#ec428b">
                                  <div class="card-body" >
                                      <div class="" style="position: relative;">
                                          <div class="mini-stat-img">
                                              <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                          </div>
                                          <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Total Withdraw</h5>
                                          <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php
                                          $totalWithdraw = $this->User_model->get_single_record('tbl_money_transfer', array('user_id' => $this->session->userdata['user_id'], 'status !=' => 'FAILED'), 'ifnull(sum(payable_amount),0) as totalWithdraw');

                                          echo currency.''.$totalWithdraw['totalWithdraw']; ?></span> </h4>

                                      </div>

                                  </div>
                              </div>
                          </div>




            <div class="col-md-12 row copyrefferal box box-body pull-up bg-hexagons-white">
              <input style="width:60%; margin-bottom: 10px; float:left" type="text" id="linkTxt"
              value="<?php echo base_url('Dashboard/Register/?sponser_id='.$userinfo->user_id); ?>"
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
                                        <p class="breadcrumb-item"><?php
                                        //print_r($silver);
                                        // if(empty($silver)){
                                        //     $diff = strtotime('+3 days', strtotime($user['topup_date'])) - strtotime(date('Y-m-d H:i:s'));
                                        //     echo '<p class="timer-bg">Time Left for one left and one right :- <span id="demo" style="color:#fff;font-weight:bold;"></span></p>';
                                        //     echo'<script> countdown("demo",'.$diff.') </script>';
                                        // }

                                        // if(empty($gold)){
                                        //     $diff = strtotime('+30 days', strtotime($user['topup_date'])) - strtotime(date('Y-m-d H:i:s'));
                                        //     echo '<p class="timer-bg">GOLD CLUB Time Left :- <span id="demo1" style="color:#fff;font-weight:bold;"></span></p>';
                                        //     echo'<script> countdown("demo1",'.$diff.') </script>';
                                        // }

                                        ?>

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
                                    </p>
                                </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-sm-6" style="display:none">
                                <div class="float-right d-none d-md-block">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle waves-effect waves-light"
                                            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-settings mr-2"></i> Settings
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">




                            <!-- <div class="col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(87deg,#172b4d,#1a174d)!important">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php //echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Business in PV</h5>
                                            <h4 class="font-weight-medium font-size-20">Left PV: <?php //echo $userinfo->leftPower; ?>  Right PV: <?php //echo $userinfo->rightPower; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(87deg,#172b4d,#1a174d)!important">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php //echo base_url('NewDashboard/');?>assets/images/services-icon/03.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Total Business</h5>
                                            <h4 class="font-weight-medium font-size-20">Left: <?php //echo $userinfo->leftPower * 25; ?>  Right: <?php //echo $userinfo->rightPower * 25; ?>
                                                </h4>

                                        </div>

                                    </div>
                                </div>
                            </div> -->



                            <!-- <div class="col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(135deg, #ffc480, #ff763b)">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php //echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Matching Bonus</h5>
                                            <h4 class="font-weight-medium font-size-24"> <span class="text-gray"><?php //echo currency.''.round($matching_bonus['matching_bonus'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div> -->



                            <!-- <div class="col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background:linear-gradient(to bottom, #0e4cfd, #6a8eff)">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php //echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Rewards incentive</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php //echo currency.''.round($rewards_income['reward_income'],2); ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div> -->







                             <!-- <div class="col-md-6">
                                <div class="card mini-stat bg-primary text-white" style="background: #754242 !important;">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php //echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Today Matching Income</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php //echo currency.''.$today_matching_bonus['today_matching_bonus']; ?></span> </h4>

                                        </div>

                                    </div>
                                </div>
                            </div> -->



                            <div class="col-md-6" style="display: none;">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Alliance Club B</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.$daily_growth_income['daily_growth_income']; ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <!-- <div class="col-lg-12">
                                <h1 style="background:#e4e41f;
                                padding: 10px;
                                color: #000;
                                font-size: 25px;
                                font-weight: bold;
                                border-radius:5px;
                                margin: 15px 0px;">Team Summary</h1>
                            </div> -->

                            <div class="col-md-6 d-none">
                                <div class="card mini-stat text-white" style="background:#49689e">
                                    <div class="card-body" >
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Total Downline</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo $total_downline['total_downline'] ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-none">
                                <div class="card mini-stat text-white" style="background:#6e4ff6">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img">
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Active Downline</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo $total_user_after_paid['total_user_after_paid']; ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 d-none">
                                <div class="card mini-stat text-white" style="background:#f0466b">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img" >
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Current Level</h5>
                                            <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo $level['single_leg_status']; ?></span></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="display:none">
                                <div class="card mini-stat text-white epin" style="background:green">
                                    <div class="card-body">
                                        <div class="" style="position: relative;">
                                            <div class="mini-stat-img" >
                                                <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                            </div>
                                            <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Epin</h5>
                                            <p>Used pins:</p>
                                            <p>Transferred:</p>
                                            <p>Available:</p>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-lg-12">
                                <h1 style="background:#e4e41f;
                                padding: 10px;
                                color: #000;
                                font-size: 25px;
                                font-weight: bold;
                                border-radius:5px;
                                margin: 15px 0px;">Income Summary</h1>
                            </div> -->


                           <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#236ec5">
                                   <div class="card-body">
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Level Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.$level_income['level_income']; ?></span> </h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                            <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#6a4cec">
                                   <div class="card-body">
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Auto Pool Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.round($pool_income['pool_income'],2); ?></span>
                                           </h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                           <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#172b4d">
                                   <div class="card-body" >
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Single Leg Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.round($single_leg['single_leg'],2); ?></span></h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                            <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#62cb7f">
                                   <div class="card-body" >
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Booster Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.round($booster_income['booster_income'],2); ?></span></h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                            <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#40ca7f">
                                   <div class="card-body" >
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Double Booster </br>Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.round($booster_income2['booster_income2'],2); ?></span></h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                            <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#6a9cea">
                                   <div class="card-body" >
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Club Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.round($club_income['club_income'],2); ?></span></h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                           <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#ec428b">
                                   <div class="card-body" >
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Reward Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.''.round($reward_income['reward_income'],2); ?></span> </h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                           <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#236ec5">
                                   <div class="card-body">
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Upgrade Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.'0'; ?></span> </h4>

                                       </div>

                                   </div>
                               </div>
                           </div>


                            <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#236ec5">
                                   <div class="card-body">
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Ads View Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.'0'.$ad_view_income['ad_view_income']; ?></span> </h4>

                                       </div>

                                   </div>
                               </div>
                           </div>
                           <div class="col-md-6 d-none">
                               <div class="card mini-stat text-white" style="background:#ec428b">
                                   <div class="card-body">
                                       <div class="" style="position: relative;">
                                           <div class="mini-stat-img">
                                               <img src="<?php echo base_url('NewDashboard/');?>assets/images/services-icon/04.png" alt="">
                                           </div>
                                           <h5 class="font-size-22 text-uppercase mt-0 text-white-50">Upgrade Level</br> Income</h5>
                                           <h4 class="font-weight-medium font-size-24"><span class="text-gray"><?php echo currency.'0'; ?></span> </h4>

                                       </div>

                                   </div>
                               </div>
                           </div>











                        </div>
    <!-- <div class="row">

       <div class="col-xl-6">
        <div class="card" style="background: #f4516c;">
          <div class="card-body">
            <h4 class="card-title mb-4 text-white">News</h4>

          </div>
        </div>
      </div>
    </div> -->
    <div class="col-lg-12 col-md-12 text-center d-none">
                                <div class="card d-none">
                                    <div class="card-body" style="background:#67d27a">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="card-title table-title" style="text-transform: uppercase;font-size: 24px;color: #fff;font-weight: bold;padding:10px 0px;width: 100%;text-align: center;margin-bottom: 20px;"><img src="" style="height: 50px;">&nbsp;Plan Presentation</h6>
                                        </div>
                                        <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                            <div>
                                                <?php
                                                $legArr = $this->config->item('singleLeg');
                                                ?>
                                                <table class="table table-bordered"  rules="all" border="1" id="ctl00_ContentPlaceHolder1_gdMerchant" style="color: #fff;font-size: 18px;">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Team Members</th>
                                                            <th>Directs</th>
                                                            <th>Income</th>
                                                            <th>Days</th>
                                                            <th>Total Income</th>
                                                            <th>Status</th>
                                                            <!-- <th>Time Left</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($legArr as $key => $arr) {
                                                            echo'<tr>
                                                            <td>' . $key . '</td>
                                                            <td>' . $arr['team'] . '</td>
                                                            <td> ' . $arr['direct_sponser'] . ' </td>
                                                            <td> ' . $arr['amount'] . ' </td>
                                                                <td> ' . $arr['days'] . ' </td>

                                                            <td>' . $arr['amount'] * $arr['days']. '</td>';
                                                            if ($user['single_leg_status'] >= $key) {
                                                                echo'<td> <span style="color:green;">Qualify</span> </td>';
                                                            } else {
                                                                echo'<td><span style="color:red;font-weight:bold;">Not Qualify</span> </td>';
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
                                                            //                         echo 'Level lapsed';
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
                               <div class="card d-none">
                                    <div class="card-body" style="background:#1dc9b7">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title table-title  text-danger" style="text-transform: uppercase;font-size: 24px;font-weight: bold;color: #fff !important;width: 100%;padding: 8px 12px;margin-bottom: 20px;">
                                        <img src="" style="height: 50px;">&nbsp;Star Pool </h6>
                                    </div>
                                    <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                        <table class="table table-bordered" style="color: #fff;font-size: 18px;">
                                            <thead>
                                                <tr style="color:white">
                                                    <th>Level</th>
                                                    <th>Team</th>
                                                    <th>Amount</th>
                                                    <th>Total Income</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $starpoolArr = [
                                                    1 => ['team' => 2 , 'amount' => 50,'achieve' => 2],
                                                    2 => ['team' => 4 , 'amount' => 75,'achieve' => 6],
                                                    3 => ['team' => 8 , 'amount' => 100,'achieve' => 14],
                                                    4 => ['team' => 16 , 'amount' => 100,'achieve' => 30],
                                                    5 => ['team' => 32 , 'amount' => 100,'achieve' => 32],
                                                ];
                                                if(!empty($starpoolArr)){
                                                    foreach($starpoolArr as $k => $pool){
                                                        echo'<tr>';
                                                        echo'<td>'.$k.'</td>';
                                                        echo'<td>'.$pool['team'].'</td>';
                                                        echo'<td>'.$pool['amount'].'</td>';
                                                        echo'<td>'.$pool['amount']*$pool['team'].'</td>';
                                                        echo'<td >'.($star['team'] >= $pool['achieve'] ? 'Qualify' : '<p style="color:red;font-weight:bold;">Pending</p>' ).'</td>';
                                                        echo'</tr>';
                                                    }
                                                }else{
                                                echo'<tr>';
                                                echo'<td rowspan="7"><p style="color:red;font-weight:bold;">Not Qualify</p></td>';
                                                echo'</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <p style="text-align: center;font-size: 20px;color: #fff;font-weight: bold;letter-spacing: 1px;background: #172b4d;padding: 5px 14px;border-radius: 5px;">Rs.3000 withdrawal and Rs.3000 Automatic Deduct for next auto pool.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card d-none">
                                <div class="card-body"  style="background:#1dc9b7">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title table-title  text-danger" style="text-transform: uppercase;font-size: 24px;font-weight: bold;color: #fff !important;width: 100%;padding: 8px 12px;margin-bottom: 20px;">
                                        <img src="" style="height: 50px;">&nbsp;Silver Pool </h6>
                                    </div>
                                    <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                        <table class="table table-bordered">
                                            <thead >
                                                <tr style=" color:white">
                                                    <th>Level</th>
                                                    <th>Team</th>
                                                    <th>Amount</th>
                                                    <th>Total Income</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $silverpoolArr = [
                                                    1 => ['team' => 2 , 'amount' => 100,'achieve' => 2],
                                                    2 => ['team' => 4 , 'amount' => 300,'achieve' => 6],
                                                    3 => ['team' => 8 , 'amount' => 400,'achieve' => 14],
                                                    4 => ['team' => 16 , 'amount' => 500,'achieve' => 30],
                                                    5 => ['team' => 32 , 'amount' => 700,'achieve' => 32],
                                                ];
                                                if(!empty($silverpoolArr)){
                                                    foreach($silverpoolArr as $k => $pool){
                                                        echo'<tr>';
                                                        echo'<td>'.$k.'</td>';
                                                        echo'<td>'.$pool['team'].'</td>';
                                                        echo'<td>'.$pool['amount'].'</td>';
                                                        echo'<td>'.$pool['amount']*$pool['team'].'</td>';
                                                        echo'<td>'.($silver['team'] >= $pool['achieve'] ? 'Qualify' : '<p style="color:red;font-weight:bold;">Pending</p>' ).'</td>';
                                                        echo'</tr>';
                                                    }
                                                }else{
                                                echo'<tr>';
                                                echo'<td rowspan="7"><p style="color:red;font-weight:bold;">Not Qualify</p></td>';
                                                echo'</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <p style="text-align: center;font-size: 20px;color: #fff;font-weight: bold;letter-spacing: 1px;background: #172b4d;padding: 5px 14px;border-radius: 5px;">Rs.20,000 withdrawal and Rs.15,000 Automatic Deduct for next auto pool.</p>
                                    </div>
                                </div>
                                </div>
                                 <div class="card d-none">
                                 <div class="card-body"  style="background:#1dc9b7">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title table-title  text-danger" style="text-transform: uppercase;font-size: 24px;font-weight: bold;color: #fff !important;width: 100%;padding: 8px 12px;margin-bottom: 20px;">
                                        <img src="" style="height: 50px;">&nbsp;Gold Pool </h6>
                                    </div>
                                    <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="color:white">
                                                    <th>Level</th>
                                                    <th>Team</th>
                                                    <th>Amount</th>
                                                    <th>Total Income</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $goldpoolArr = [
                                                    1 => ['team' => 2 , 'amount' => 800,'achieve' => 2],
                                                    2 => ['team' => 4 , 'amount' => 1000,'achieve' => 6],
                                                    3 => ['team' => 8 , 'amount' => 1200,'achieve' => 14],
                                                    4 => ['team' => 16 , 'amount' => 1400,'achieve' => 30],
                                                    5 => ['team' => 32 , 'amount' => 1600,'achieve' => 32],
                                                ];
                                                if(!empty($goldpoolArr)){
                                                    foreach($goldpoolArr as $k => $pool){
                                                        echo'<tr>';
                                                        echo'<td>'.$k.'</td>';
                                                        echo'<td>'.$pool['team'].'</td>';
                                                        echo'<td>'.$pool['amount'].'</td>';
                                                        echo'<td>'.$pool['amount']*$pool['team'].'</td>';
                                                        echo'<td>'.($gold['team'] >= $pool['achieve'] ? 'Qualify' : '<p style="color:red;font-weight:bold;">Pending</p>' ).'</td>';
                                                        echo'</tr>';
                                                    }
                                                }else{
                                                echo'<tr>';
                                                echo'<td rowspan="7"><p style="color:red">Not Qualify</p></td>';
                                                echo'</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <p style="text-align: center;font-size: 20px;color: #fff;font-weight: bold;letter-spacing: 1px;background: #172b4d;padding: 5px 14px;border-radius: 5px;">Rs.50400 withdrawal and Rs.30,000 Automatic Deduct for next auto pool.
                                             </p>
                                    </div>
                                </div>
                                </div>
                                 <div class="card d-none">
                                <div class="card-body"  style="background:#1dc9b7">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title table-title text-danger" style="text-transform: uppercase;font-size: 24px;font-weight: bold;color: #fff !important;width: 100%;padding: 8px 12px;margin-bottom: 20px;">
                                        <img src="" style="height: 50px;">&nbsp;Ruby Pool </h6>
                                    </div>
                                    <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style=" color:white">
                                                    <th>Level</th>
                                                    <th>Team</th>
                                                    <th>Amount</th>
                                                    <th>Total Income</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $rubypoolArr = [
                                                    1 => ['team' => 2 , 'amount' => 1800,'achieve' => 2],
                                                    2 => ['team' => 4 , 'amount' => 2000,'achieve' => 6],
                                                    3 => ['team' => 8 , 'amount' => 2200,'achieve' => 14],
                                                    4 => ['team' => 16 , 'amount' => 2400,'achieve' => 30],
                                                    5 => ['team' => 32 , 'amount' => 2600,'achieve' => 32],
                                                ];
                                                if(!empty($rubypoolArr)){
                                                    foreach($rubypoolArr as $k => $pool){
                                                        echo'<tr>';
                                                        echo'<td>'.$k.'</td>';
                                                        echo'<td>'.$pool['team'].'</td>';
                                                        echo'<td>'.$pool['amount'].'</td>';
                                                        echo'<td>'.$pool['amount']*$pool['team'].'</td>';
                                                        echo'<td>'.($ruby['team'] >= $pool['achieve'] ? 'Qualify' : '<p style="color:red;font-weight:bold;">Pending</p>' ).'</td>';
                                                        echo'</tr>';
                                                    }
                                                }else{
                                                echo'<tr>';
                                                echo'<td rowspan="7"><p style="color:red;font-weight:bold;">Not Qualify</p></td>';
                                                echo'</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                         <p style="text-align: center;font-size: 20px;color: #fff;font-weight: bold;letter-spacing: 1px;background: #172b4d;padding: 5px 14px;border-radius: 5px;">Rs.90800 withdrawal and Rs.60000 Automatic Deduct for next auto pool.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card d-none">
                                <div class="card-body"  style="background:#1dc9b7">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title table-title  text-danger" style="text-transform: uppercase;font-size: 24px;font-weight: bold;color: #fff !important;width: 100%;padding: 8px 12px;margin-bottom: 20px;">
                                        <img src="" style="height: 50px;">&nbsp;Pearl Pool </h6>
                                    </div>
                                    <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                         <table class="table table-bordered">
                                            <thead>
                                                <tr style="color:white">
                                                    <th>Level</th>
                                                    <th>Team</th>
                                                    <th>Amount</th>
                                                    <th>Total Income</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $pearlpoolArr = [
                                                    1 => ['team' => 2 , 'amount' => 3000,'achieve' => 2],
                                                    2 => ['team' => 4 , 'amount' => 3200,'achieve' => 6],
                                                    3 => ['team' => 8 , 'amount' => 3400,'achieve' => 14],
                                                    4 => ['team' => 16 , 'amount' => 3600,'achieve' => 30],
                                                    5 => ['team' => 32 , 'amount' => 4000,'achieve' => 32],
                                                ];
                                                if(!empty($pearlpoolArr)){
                                                    foreach($pearlpoolArr as $k => $pool){
                                                        echo'<tr>';
                                                        echo'<td>'.$k.'</td>';
                                                        echo'<td>'.$pool['team'].'</td>';
                                                        echo'<td>'.$pool['amount'].'</td>';
                                                        echo'<td>'.$pool['amount']*$pool['team'].'</td>';
                                                        echo'<td>'.($pearl['team'] >= $pool['achieve'] ? 'Qualify' : '<p style="color:red;font-weight:bold;">Pending</p>' ).'</td>';
                                                        echo'</tr>';
                                                    }
                                                }else{
                                                echo'<tr>';
                                                echo'<td rowspan="7"><p style="color:red;font-weight:bold;">Not Qualify</p></td>';
                                                echo'</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <p style="text-align: center;font-size: 20px;color: #fff;font-weight: bold;letter-spacing: 1px;background: #172b4d;padding: 5px 14px;border-radius: 5px;">Rs.141600 withdrawal and Rs.90000  Automatic Deduct for next auto pool.</p>
                                    </div>
                                </div>
                                </div>
                                <div class="card d-none">
                                <div class="card-body"  style="background:#1dc9b7">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-title table-title text-danger" style="text-transform: uppercase;font-size: 24px;font-weight: bold;color: #fff !important;width: 100%;padding: 8px 12px;margin-bottom: 20px;">
                                        <img src="" style="height: 50px;">&nbsp;Diamond Pool </h6>
                                    </div>
                                    <div class="table-responsive" tabindex="1" style="overflow: scroll; outline: none;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr style="color:white">
                                                    <th>Level</th>
                                                    <th>Team</th>
                                                    <th>Amount</th>
                                                    <th>Total Income</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $diamondpoolArr = [
                                                    1 => ['team' => 2 , 'amount' => 4000,'achieve' => 2],
                                                    2 => ['team' => 4 , 'amount' => 5500,'achieve' => 6],
                                                    3 => ['team' => 8 , 'amount' => 6500,'achieve' => 14],
                                                    4 => ['team' => 16 , 'amount' => 7500,'achieve' => 30],
                                                    5 => ['team' => 32 , 'amount' => 8500,'achieve' => 32],
                                                ];
                                                if(!empty($diamondpoolArr)){
                                                    foreach($diamondpoolArr as $k => $pool){
                                                        echo'<tr>';
                                                        echo'<td>'.$k.'</td>';
                                                        echo'<td>'.$pool['team'].'</td>';
                                                        echo'<td>'.$pool['amount'].'</td>';
                                                        echo'<td>'.$pool['amount']*$pool['team'].'</td>';
                                                        echo'<td>'.($diamond['team'] >= $pool['achieve'] ? 'Qualify' : '<p style="color:red;font-weight:bold;">Pending</p>' ).'</td>';
                                                        echo'</tr>';
                                                    }
                                                }else{
                                                echo'<tr>';
                                                echo'<td rowspan="7"><p style="color:red;font-weight:bold;">Not Qualify</p></td>';
                                                echo'</tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                          <p style="text-align: center;font-size: 20px;color: #fff;font-weight: bold;letter-spacing: 1px;background: #172b4d;padding: 5px 14px;border-radius: 5px;">Grand Total = 4,74,000</p>
                                    </div>
                                </div>
                                </div>








                                </div>
    <!-- <div class="col-md-12"> -->
      <!-- <marquee direction="up" scrollamount="2"> -->
        <!-- <?php //foreach($news as $n):?> -->
          <!-- <p><?php //echo $n['news'];?></p> -->
        <!-- <?php// endforeach;?> -->
      <!-- </marquee> -->
    <!-- <div> -->


<!-- </div> -->
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
<?php if(popupbtn == 1):?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
               <!--   <h4 class="modal-title"><?php //echo $popup['caption'];?></h4>-->
            </div>
            <div class="modal-body">
              <p>Buy Fund by Paying Online G Pay, Phone Pay, Paytm, Credit Card and Debit Card</p>
              <a href="#" style="    font-size: 20px;
    font-weight: bold;
    text-align: center;
    display: table;
    background: orange;
    color: #fff;
    margin: 0px auto;
    padding: 10px 15px;">Buy Fund</a>
              <div style="display:none">
                <?php
                if(!empty(popupImage)){
                    // if($popup['type'] == 'video')
                    //     echo '<iframe width="100%" height="400px" src="https://www.youtube.com/embed/'.$popup['media'].'"></iframe>';
                    // else
                        echo '<img style="max-width:100%" src="'.base_url(popupImage).'">';
                }else{
                    echo '<p>Welcome TO '.base_url().'</p>';
                }
                ?>
            </div></div>
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

gettaskdata();

function gettaskdata(){
    var url = "<?php echo base_url('Dashboard/Task/gettaskdata');?>";
    $.get(url,function(res){
        if(res.success == 1){
            $('#imageDiv').append('<a href=""><img src="<?php echo base_url('uploads/');?>'+res.tasks.link+'" ></a>');
        }else{
            alert(res.message);
            $('#imageDiv').text(res.message);
        }
        console.log(res);
    },'json');
}

function gettask(){
    $('#imageDiv').text('');
    var url = "<?php echo base_url('Dashboard/Task/getTask');?>";
    $.get(url,function(res){
        if(res.success == 1){
            alert('Ads Income Credited');
            $('#imageDiv').append('<a href=""><img src="<?php echo base_url('uploads/');?>'+res.tasks.link+'" ></a>');
        }else{
            $('#imageDiv').text(res.message);
        }
        console.log(res);
    },'json');
}

</script>
