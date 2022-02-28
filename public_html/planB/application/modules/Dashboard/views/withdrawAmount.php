<?php include_once'header.php';
date_default_timezone_set("Asia/Kolkata");
?>
<style>
 section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
    display: inline-block;
    width: 100%;
}

</style>
<main>
  <div class="container-fluid site-width">

    <section class="content-header">
        <span style="">Transfer Money</span>
    </section>

    <div class="card">
      <div class="card-body">
        <h3 class="page-header">

         <small style="color:green">Minimum withdrawal is $200</small>
     </h3>
              <!-- BEGIN tab-pane -->
              <div class="tab-pane active show" id="tabFundRequestForm">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">

                    <?php
            echo $date = date('H:i');
            //
               if($date >= '00:00' && $date <= '23:00'){

                echo form_open('',array('id' => 'TopUpForm'));?>
                    <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                    <div class="form-group">
                        <label style="font-size:20px; color:red">Available balance (
                            <?php echo currency.''.$balance['balance'];?>)</label><br>
                    </div>
                    <div class="form-group">
                        <label>Benficiary ID</label>
                        <input type="text" class="form-control" name="beneficiary_id" placeholder="Beneficiary ID"
                            value="<?php echo $beneficiary_id;?>" />
                        <span class="text-danger"><?php echo form_error('beneficiary_id')?></span>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount"
                            onblur="calculate_net_amount();" placeholder="Amount"
                            value="<?php echo set_value('amount');?>" />
                        <span class="text-danger"><?php echo form_error('amount')?></span>
                    </div>
                    <div class="form-group">
                        <label>Transaction Pin</label>
                        <input type="password" class="form-control" name="master_key" placeholder="Master Key"
                            value="" />
                        <span class="text-danger"><?php echo form_error('master_key')?></span>
                    </div>
                    <!-- <div class="form-group">
                            <label>OTP</label>
                            <input type="password" class="form-control" name="otp" placeholder="Enter OTP"
                                   value="" />
                            <span class="text-danger"><?php // echo form_error('otp') ?></span>
                            <button type="button" class="btn btn-success" id="otp">GET OTP</button>
                        </div> -->
                    <div class="form-group">
                        <button type="subimt" name="save" class="btn btn-success" />Withdraw Now</button>
                    </div>
                    <?php echo form_close();
            }else{
               echo '<span class="text-danger">Withdraw Between 10AM to 6PM daily. <br> <b style="font-size:18px">Sunday Closed</b> </span>';
            }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once'footer.php'; ?>
<script>
$(document).on('click','#otp',function(){
    var url = '<?php echo base_url('Dashboard/Support/generateKey');?>'
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
