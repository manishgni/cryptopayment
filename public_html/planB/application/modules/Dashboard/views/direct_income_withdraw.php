<?php
    include_once 'header.php';
    date_default_timezone_set('Asia/Kolkata');
?>
<style>
 section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
.messageBox {
  padding: 1em;
  background: #002e3666;
  border: #eee solid 2px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  text-shadow: 0px 0px 8px #000;
  color: #fff;
}
#text {
  font-family: Questrial;
  text-align: center;
}
#construction {
  font-family: "Pacifico", cursive;
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

<!-- <div class="messageBox">
    <div class="col-md-12 text-center timer-box mob-center">
         <h4>Withdraw Open In</h4>
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
    </div> -->
  <!-- <h1 id="construction">Coming Soon!</h1> -->
<!-- </div> -->

<?php  $none = 0; ?>
<?php if($none == 0){ ?>
    <main>
    <div id="main-content">
    <div class="container-fluid site-width">
        <div class="page-panel-heading">
        <h5 class="panel-title"> Withdraw</h5>
      </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
          <div class="card-body">
      <h3 class="page-header">

        <small><?php echo $des; ?></small>
    </h3>
    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-6">
                            <?php
                                // echo 'Time: '.date('H:i').'<br>';
                                 if(date('H:i') >= '00:00' && date('H:i') <= '19:00'){
                                    if($user['withdraw_status'] == 0){
                                       // if($user['directs'] >= 4){
                            ?>
                            <?php echo form_open('',array('id' => 'TopUpForm'));?>
                            <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                            <div class="form-group">
                                <label style="font-size:20px; color:red">Available balance (<?php echo currency .''.round($balance['balance'],2);?>)</label><br>
                                <!-- <label style="font-size:20px; color:green">Today Withdrawal Income (<?php //echo currency .''.round($balance['balance']*20/100,2);?>)</label><br> -->
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                                <span class="text-danger"><?php echo form_error('amount')?></span>
                            </div>
                            <div class="form-group">
                                <label>Service Charges</label>
                                <span class="text-info">10%</span>
                            </div>
                            <div class="form-group" style="display:none">
                                <label>Net Amount</label>
                                <span class="text-success" id="netAmount"></span>
                            </div>
                            <div class="form-group" style="display:none">
                                <label>100% E-wallet Transfer</label><br>
                                <!-- <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="1" checked>Yes &nbsp; -->
                                <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="0" checked >No
                            </div>
                            <div class="form-group" style="display:none">
                                <label>Transfer Amount to Topup-wallet</label>
                                <?php echo currency ;?><span class="text-success" id="bankAmount"></span>
                            </div>
                            <!-- <div class="form-group">
                                <label>TDS Charges 5%</label>
                                <span class="text-success" id="tds"></span>
                            </div> -->
                            <div class="form-group">
                                <label>Net.  Amount </label> <?php echo currency ;  ?>
                                <span class="text-success" id="NetbankAmount"></span>
                            </div>
                            <div class="form-group">
                                <label>Transaction Pin</label>
                                <input type="password" class="form-control" name="master_key" placeholder="Transaction Key" value=""/>
                                <span class="text-danger"><?php echo form_error('master_key')?></span>
                            </div>
                          <!--   <div class="form-group">
                                <label>Enter Address</label>
                                <input type="text" class="form-control" name="trust_wallet_address1" placeholder="Enter  Address" value=""/>
                                <span class="text-danger"><?php echo form_error('trust_wallet_address')?></span>
                            </div> -->
                            <div class="form-group">
                                <label>Credit in</label>
                                <select name="trust_wallet_address" class="form-control">
                                    <option value="<?php echo $bank['tron'];?>">TRX <?php echo $bank['tron']?></option>
                                    <option value="<?php echo $bank['usdt'];?>">USDT <?php echo $bank['tron']?></option>

                                    <!-- <option>Etherum</option>
                                    <option>Tron</option>
                                    <option>Litecoin</option>
                                    <option>Bitcoin Cash</option> -->
                                </select>
                                <span class="text-danger"><?php echo form_error('trust_wallet_address')?></span>
                            </div>
                            


                            <div class="form-group">
                                <h3 id="submit_otp" style="display:none;"></h3>
                                <label>OTP</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="otp" placeholder="Enter OTP" value=""/>
                                        <span class="text-danger"><?php echo form_error('otp')?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-warning" onclick="generateOtp()">GET OTP</button>
                                    </div>
                                    
                                </div>
                                
                            </div> 


                            
                            <div class="form-group">
                                <button type="subimt" name="save" class="btn btn-success" />Withdrawal Now</button>
                            </div>
                            <?php echo form_close();?>
                            <?php
                                    // }else{
                                    //     echo '<span class="badge badge-danger">Total 4 Directs Required for Withdraw!</span>';
                                    // }
                                }else{
                                        echo '<span class="badge badge-danger">Withdraw Closed!</span>';
                                    }
                                }else{
                                    echo '<span class="badge badge-danger">Withdraw Timming between 4PM to 7PM</span>';
                                }
                            ?>
                        </div>
                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END tab-pane -->
                <!-- BEGIN tab-pane -->

            </div>
            <!-- END wizard-content -->

        <!-- END wizard-form -->
    </div>
  </div>
    <!-- END wizard -->
</div></div>
</div>
</div></main>
<?php } ?>

<?php include_once'footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<script>
    $(document).on('blur','#user_id',function(){
        var user_id = $('#user_id').val();
        if(user_id != ''){
            var url  = '<?php echo base_url("Dashboard/get_app_user/")?>'+user_id;
            $.get(url,function(res){
                if(res.success == 1){
                    $('#errorMessage').html(res.user.name);
                }else{
                    $('#errorMessage').html(res.message);
                }

            },'json')
        }
    })
    $(document).on('submit','#TopUpForm',function(){
        if (confirm('Are You Sure U want to Withdraw This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('blur','#amount',function(){
      var amount = $(this).val();
    //   var netAmount = amount * 90 /100;
    //   $('#netAmount').text(netAmount);
    })
    function calculate_net_amount(){
        var amount = $('#amount').val();
        var bankAmount;
        var tds = 0;
        var transfer_wallet = $("input[name='pin_transfer']:checked").val();
        console.log(transfer_wallet);
        if(transfer_wallet == 0){
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }else{
            bankAmount = amount * 90 /100;
            // tds = amount * 5 /100;
        }

        var NetbankAmount = (bankAmount);
        $('#NetbankAmount').text(NetbankAmount);
        $('#bankAmount').text(bankAmount);
        $('#tds').text(tds);
    }



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

// function initializeClock(id, endtime) {
//   const clock = document.getElementById(id);
//   const daysSpan = clock.querySelector(".days");
//   const hoursSpan = clock.querySelector(".hours");
//   const minutesSpan = clock.querySelector(".minutes");
//   const secondsSpan = clock.querySelector(".seconds");

//   function updateClock() {
//     const t = getTimeRemaining(endtime);

//     daysSpan.innerHTML = t.days;
//     hoursSpan.innerHTML = ("0" + t.hours).slice(-2);
//     minutesSpan.innerHTML = ("0" + t.minutes).slice(-2);
//     secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);

//     if (t.total <= 0) {
//       clearInterval(timeinterval);
//      document.getElementById("clockdiv").style.display = "none"; 
//     }
//   }

//   updateClock();
//   const timeinterval = setInterval(updateClock, 1000);
// }

// const deadline = 'Fri Dec 05 2021 16:30:16 GMT+0530';//new Date(Date.parse(new Date()) + 1 * 24 * 60 * 60 * 1000);
// initializeClock("clockdiv", deadline);

    function generateOtp() {
        fetch("<?php echo base_url(); ?>Dashboard/generateOtp", {
           method: "GET",
           headers: {
             "X-Requested-With": "XMLHttpRequest"
           },
           // body: formData,
       })
       .then(response => response.json())
       .then(result => {
           if(result.success == '1'){
            // alert(result.success)
             document.getElementById("submit_otp").style.display = "block"; 
              toastr.success(result.message, {timeOut: 5000})
           }else{
              toastr.error(result.message, {timeOut: 5000})
           };
        });
    }
d
</script>
