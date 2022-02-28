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
        <span style="">Withdraw Request  /  Send Money to Bank</span>
    </section>



    <div class="card">
      <div class="card-body">
        <h3 class="page-header">

         <small>Send Money to Bank</small>
     </h3>
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Withdraw</h1>
            <span>Minimum Withdrawal Amount Rs.500</span>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Withdrawal Management</li>
              <li class="breadcrumb-item active">Withdraw</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div style="background: #e7fff3;
    padding: 20px;">
      <div class="container-fluid">
        <div class="row" >
          <div class="col-md-12">
            
            <?php
            echo $date = date('H:i');
             if( $date >= '10:00' && $date <= '12:00'){

                echo form_open('',array('id' => 'TopUpForm'));?>
            <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
            <div class="form-group">
                <label style="font-size:20px; color:red">Available balance (Rs.<?php echo $balance['balance'];?>)</label><br>
            </div>
            <div class="form-group">
                <label>Benficiary ID</label>
                <input type="text" class="form-control" name="beneficiary_id" placeholder="Beneficiary ID" value="<?php echo $beneficiary_id;?>"/>
                <span class="text-danger"><?php echo form_error('beneficiary_id')?></span>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                <span class="text-danger"><?php echo form_error('amount')?></span>
            </div>
            <div class="form-group">
                <label>Transaction Pin</label>
                <input type="password" class="form-control" name="master_key" placeholder="Master Key" value=""/>
                <span class="text-danger"><?php echo form_error('master_key')?></span>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label>OTP</label>
                    <input type="text" class="form-control" name="otp" placeholder="OTP" value=""/>
                    <span class="text-danger"><?php echo form_error('otp')?></span>
                  </div>
                  <div class="col-md-3">
                    <br>
                    <button class="btn btn-danger" type="button" id="otpBtn">
                      Generate OTP
                    </button>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="save" class="btn btn-success" />WithDraw Now</button>
            </div>
            <?php echo form_close();
            }else{
                 echo '<span class="text-danger">Withdraw Between 10Am to 12 pm</span>';
            }

            ?>
          </div>  </div>
        </div>
    </div>
</div>
</div></main>
<?php include_once'footer.php'; ?>
<script>
$(document).on('click','#otpBtn',function(){
  var url = '<?php echo base_url('Dashboard/Withdraw/generate_otp/'.$user['user_id'])?>';
  $.get(url,function(res){
    alert(res.message);
  },'json')
})
</script>
