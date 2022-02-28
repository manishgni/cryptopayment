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
</style>
<main>
    <div class="container-fluid site-width">
          <div class="content-wrapper">  
    <div class="content"> 
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
  <section class="content-header">
        <span style=""><?php echo $title; ?> /   Transfer to W-wallet</span>
    </section>

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
                            // echo date('D');

                            echo 'Time: '.date('H:i').'<br>';
                            $day = date('D');
                            if($day == 'Mon' || $day == 'Wed'|| $day == 'Fri'){
                                ?>

<?php echo form_open('',array('id' => 'TopUpForm'));?>
                            <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                            <div class="form-group">
                                <label style="font-size:20px; color:red">Available balance (<?php echo currency .''.round($balance['balance'],2);?>)</label><br>
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
                            <div class="form-group">
                            <label>OTP</label>
                            <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                                value="" />
                            <span class="text-danger"><?php echo form_error('otp') ?></span>
                            <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                        </div>
                            <div class="form-group" style="display:block">
                                <label>Credit in</label>
                                <select name="credit_type" class="form-control">
                                    <option value="BTC">IMPS</option>
                                    <!-- <option value="TRON">Tron</option>
                                    <option value="USDT">USDT</option>
                                    <option value="LITE COIN">Litecoin</option>
                                    <option value="BIT COIN CASH">Bitcoin Cash</option> -->
                                    <!-- <option value="INR">INR</option> -->
                                </select>
                                <span class="text-danger"><?php echo form_error('credit_type')?></span>
                            </div>
                            <div class="form-group">
                                <button type="subimt" name="save" class="btn btn-success" />Withdrawal Now</button>
                            </div>
                            <?php echo form_close();?>
                            <?php
                                //     }else{
                                //             echo '<span class="badge badge-danger">Withdraw Timming between 4PM to 7PM</span>';
                                //     }
                                // }else{
                                //     echo '<span class="badge badge-danger">Withdraw Closed.</span>';
                                // }
                            ?>
                        </div>
                        <!-- END col-6 -->
                                <?php
                            }else{
                                echo 'withdraw is open only on Monday Wednesday FRIDAY ';
                            }
                                // if($withdraw_button['withdraw_button'] == 0){
                                //     if(date('H:i') >= '00:00' && date('H:i') <= '19:00'){

                            ?>
                            
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
</div>
</div>
</div>
</div>
</div>

<?php include_once'footer.php'; ?>
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

    $(document).on('click','#otp',function(){
        var url = '<?php echo base_url('Dashboard/Support/getOtp');?>'
        $.get(url,function(res){
            if(res.success == 1){
                $("#otp").css("display", "none");
                alert('OTP send to registered mobile number');
            }else{
                alert('Network error,please try later');
            }
        },'JSON')
    })
</script>
