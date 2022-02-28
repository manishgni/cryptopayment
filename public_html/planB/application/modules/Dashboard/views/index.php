<?php require_once'header.php';?>
<!-- <style>
   /* .fa {
  padding: 20px;
  font-size: 30px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
}*/
.fa {
    padding: 20px;
    font-size: 30px;
    width: 70px;
    border-radius: 50%;
    text-decoration: none;
    margin: 5px 2px;
}
    .fa:hover {
    opacity: 0.7;
}
.fa-facebook {
  background: #3B5998;
  color: white;
}
</style> -->
<style>
ul.link {
    margin: 0px auto;
    padding: 0px;
    display: inherit;
}

.social .fb {
    background: url(https://mycrowdpay.com/planB/uploads//fb-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .tw {
    background: url(https://mycrowdpay.com/planB/uploads//twiiter-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .wa {
    background: url(https://mycrowdpay.com/planB/uploads//whtasppa-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social .pintrest {
    background: url(https://mycrowdpay.com/planB/uploads//linkdin-share.png) no-repeat;
    padding-left: 40px;
    background-size: 35px;
    list-style: none;
    margin: 0px;
    padding: 6px 40px;
    font-size: 15px;
}

.social {
    margin: 0px auto;
    display: inline-block;
    width: 100%;
    margin-bottom: 10px;
   
}

ul.link li {
    float: left;
    margin: 0px;
    list-style: none;
}

ul.link li img {
    width: 58px;
    margin-right: 10px;
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

    <!-- mani page content body part -->
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Dashboard</h2>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="page_action">
                               
                                <button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download report</button>
                                <button type="button" class="btn btn-secondary"><i class="fa fa-send"></i> Send report</button>
                            </div>
                            <div class="p-2 d-flex">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mob-center card card-body">
                                        <div class="w-sm-100 mr-auto"> <p style="font-size:17px;display: inline;line-height: 30px;font-weight: bold;margin: 0px;">Welcome <span style="color:#00c5f6;"> <?php echo ($user['name']) ?></span>
                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;font-weight: bold;margin: 0px;">User Id: <span  style="color:#00c5f6;"><?php echo ($user['user_id']) ?></span></p>

                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;font-weight: bold;margin: 0px;">Joining Date: <span  style="color:#00c5f6;"><?php echo ($user['created_at']) ?></span></p>

                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;font-weight: bold;margin: 0px;">Activation Date: <span  style="color:#00c5f6;"><?php if($user['topup_date'] > 0){ echo $user['topup_date'];}else{ echo 'Inactive';} ?></span></p>
                                    <p class="d-block user-name" style="font-size:17px; line-height: 30px;font-weight: bold;margin: 0px;">Leadership Achivers: <marquee>
                                    <?php
                                        foreach ($leaders as $key => $leader) {
                                            $totalDirect = $this->User_model->get_single_record('tbl_users', ['sponser_id' => $leader['user_id'], 'paid_status >' => 0], 'count(id) as totalDirect');
                                            if($totalDirect['totalDirect'] >= 4){
                                                echo '<span  style="color:#00c5f6;">'.($key+1).'. '.$leader['user_id'].' ('.$leader['name'].'), </span>';
                                            }
                                        }
                                    ?>
                                     </marquee></p>

                                     <div class="social">
                                  <ul class="link">

                                      <li>
                                          <a onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $user['user_id']) ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://mycrowdpay.com/planB/uploads/fb-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a onclick="window.open('https://twitter.com/intent/tweet?url=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $user['user_id']) ?>;original_referer=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $user['user_id']) ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://mycrowdpay.com/planB/uploads/twiiter-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a
                                              href="https://wa.me/?text=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $user['user_id']) ?>">
                                              <img src="https://mycrowdpay.com/planB/uploads/whtasppa-share.png">
                                          </a>
                                      </li>
                                      <li>
                                          <a onclick="window.open('https://www.linkedin.com/shareArticle?url=<?php echo base_url('/Dashboard/User/Register/?sponser_id=' . $user['user_id']) ?>&amp;source=<?php echo base_url() ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');"
                                              target="_parent" href="javascript: void(0)">
                                              <img src="https://mycrowdpay.com/planB/uploads/linkdin-share.png">
                                          </a>
                                      </li>
                                  </ul>


                              </div>
                                </p>
                                </div>
                            </div>


                            <!-- https://t.me/ARTISTICUNIVERSALLTD -->



                        </div>
                    </div>

            <div class="row clearfix row-deck">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase d-block">Total Directs :<h4 class="mb-0 mt-2 d-inline">
                                <?php
                                                    $totalDirects = $this->User_model->get_single_record('tbl_users', ['sponser_id' => $this->session->userdata['user_id']], 'count(id) as totalDirects');
                                                    echo $totalDirects['totalDirects']; ?>

                            </h4></span>

                            <span class="text-uppercase d-block">Level Team :  <h4 class="mb-0 mt-2 d-inline">
                                <?php
                                                    $totalLevelTeam = $this->User_model->get_single_record('tbl_sponser_count', ['user_id' => $this->session->userdata['user_id'], 'level >= ' => 2, 'level <=' => 9], 'count(id) as totalLevelTeam');
                                                    echo $totalLevelTeam['totalLevelTeam']; ?>

                            </h4></span>

                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Rank<?php // echo $package['title']; ?></span>
                            <h4 class="mb-0 mt-2">6 <?php echo $package['title']; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Directs</span>
                            <h4 class="mb-0 mt-2">Active : <?php echo $paid_directs['paid_directs']; ?> Inactive: <?php echo $free_directs['free_directs']; ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">E-Wallet</span>
                            <h4 class="mb-0 mt-2"> <?php echo currency.''.$wallet_balance['wallet_balance']; ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Total Earning</span>
                            <h4 class="mb-0 mt-2"> <?php echo currency.''.number_format($total_income['total_income'],2); ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Today Help</span>
                            <h4 class="mb-0 mt-2"> <?php echo currency.''. $today_income['today_income']; ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Direct Income</span>
                            <h4 class="mb-0 mt-2"> <?php echo currency.''.round($direct_income['direct_income'],2); ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Level Income</span>
                            <h4 class="mb-0 mt-2"> <?php echo currency.''.round($level_income['level_income'],2); ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Upgrade Income</span>
                            <h4 class="mb-0 mt-2"> <?php echo currency.' 0'; ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Auto Pool Income</span>
                            <h4 class="mb-0 mt-2">  <?php echo currency.''.$poolIncome['pool_income']; ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Royalty Income</span>
                            <h4 class="mb-0 mt-2">  <?php echo currency.' 0'; ?></h4>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card number-chart">
                        <div class="body">
                            <span class="text-uppercase">Available Income</span>
                            <h4 class="mb-0 mt-2"> <?php echo currency.''.number_format($income_balance['income_balance'], 2); ?></h4>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
            <div class="col-md-12 col-sm-12">
                        <div class="card card-body card-coin">
                            <div class=" text-center">
                                <h4 class="text-gray revenue-head">Invite Friend</h4>
                                <form>
                                    <div class="form-group">
                                      <input style="width:100%; margin-bottom: 10px; float:left" type="text" id="linkTxt"
                                      value="<?php echo base_url('Dashboard/Register/?sponser_id='.$user['user_id']); ?>"
                                      class="form-control">
                                      <button type="button" id="btnCopy" iconcls="icon-save" onclick="copyToClipboard()" class="btncopy m-b-5 copy-section"
                                       style="background:#f1bd4b;
                                      margin-top: -3px;
                                      padding: 10px 0px;
                                      font-size: 15px;
                                      color: #000;
                                      border-radius: 10px;
                                      border: navajowhite;
                                      float: left;
                                      width: 37%;
                                      cursor: pointer;
                                      margin-left: 5px;
                                      letter-spacing:2px;
                                      border-radius: 4px;
                                      ">
                                      Copy link
                                      </button>
                                    </div>


                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        
                        <div class="card card-body card-coin">
                            <div class=" text-center">
                                <h4 class="text-gray revenue-head">News</h4>
                                <marquee width="60%" direction="up" height="100px">
                                    <?php foreach($news as $ne){
                                        echo $ne['news'];
                                     } 

                                     ?>
                                </marquee>
                            </div>
                        </div>
                        </div>
                </div>
            <div class="col-md-12">
            <div class="row">
                <div class="page-panel-heading w-100">
                    <h5 class="panel-title">Starter</h5>
                </div>
                <div class="card card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Team</th>
                                    <th>Achieved Team</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=1;$i<=2;$i++): $team = $i*2;?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $team;?></td>
                                    <td>
                                        <?php
                                            echo ($pool1['team'] >= $team)?$team:((($pool1['team']-$i) > 0)?($pool1['team']-$i):0);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                         echo ($pool1['team'] >= $team) ? '<span class="text-success">Achieved</span>':'<span class="text-danger">Pending</span>';
                                        ?>
                                    </td>
                                </tr>
                                <?php endfor;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="page-panel-heading w-100">
                    <h5 class="panel-title">Achiver</h5>
                </div>
                <div class="card card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Team</th>
                                <th>Achieved Team</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($j=1;$j<=2;$j++): $team2 = $j*2;?>
                            <tr>
                                <td><?php echo $j;?></td>
                                <td><?php echo $team2;?></td>
                                <td>
                                    <?php
                                        echo ($pool2['team'] >= $team2)?$team2:((($pool2['team']-$j) > 0)?($pool2['team']-$j):0);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                     echo ($pool2['team'] >= $team2) ? '<span class="text-success">Achieved</span>':'<span class="text-danger">Pending</span>';
                                    ?>
                                </td>
                            </tr>
                            <?php endfor;?>
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="page-panel-heading w-100">
                    <h5 class="panel-title">Success</h5>
                </div>
                <div class="card card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Team</th>
                                <th>Achieved Team</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($k=1;$k<=2;$k++): $team3 = $k*2;?>
                            <tr>
                                <td><?php echo $k;?></td>
                                <td><?php echo $team3;?></td>
                                <td>
                                    <?php
                                        echo ($pool3['team'] >= $team3)?$team3:((($pool3['team']-$k) > 0)?($pool3['team']-$k):0);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                     echo ($pool3['team'] >= $team3) ? '<span class="text-success">Achieved</span>':'<span class="text-danger">Pending</span>';
                                    ?>
                                </td>
                            </tr>
                            <?php endfor;?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>

           <?php require_once'footer.php';?>
           <script>
               $(document).on('click', '#btnCopy', function () {
                    //linkTxt
                    var copyText = document.getElementById("linkTxt");
                    copyText.select();
                    copyText.setSelectionRange(0, 99999)
                    document.execCommand("copy");
                    alert("Copied the text: " + copyText.value);
                })
           </script>
