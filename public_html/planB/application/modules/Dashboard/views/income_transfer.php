<?php include_once'header.php'; ?>
<style>
main {
    height: 100vh;
}
</style>
<main>
    <div id="main-content">
    <div class="container-fluid site-width">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
         <div class="page-panel-heading">
          <h5 class="panel-title"> Transfer Income to E-Wallet</h5>
      </div>


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
        <div class="card-body">
       <h3 class="page-header">
        <?php echo $this->config->item('') ?>
        <small>Minimum Transfer Amount Rs 100</small>
    </h3>
    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-6">
                            <?php echo form_open('',array('id' => 'TopUpForm'));?>
                            <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                            <div class="form-group">
                                <label style="font-size:20px; color:red">Available balance (Rs.<?php echo $balance['balance'];?>)</label><br>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                                <span class="text-danger"><?php echo form_error('amount')?></span>
                            </div>
                            <?php if(empty($eWallet)):?>
                            <div class="form-group">
                                <label>User ID</label>
                                <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID" value="<?php echo set_value('user_id');?>"/>
                                <span class="text-danger" id="errorMessage"><?php echo form_error('user_id')?></span>
                            </div>      <?php endif;?>
                          
                            <div class="form-group">
                                <label>Transaction Pin</label>
                                <input type="text" class="form-control" name="master_key" id="master_key" placeholder="Transaction Pin">
                                <span class="text-danger" id="errorMessage"><?php echo form_error('master_key')?></span>
                            </div>
                      
                            <div class="form-group">
                                <button type="subimt" name="save" class="btn btn-success" />Transfer Now</button>
                            </div>
                            <?php echo form_close();?>
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
</div>
</div>
</div>
</main>






<?php include_once'footer.php'; ?>
<script>
    $(document).on('blur','#user_id',function(){
        var user_id = $('#user_id').val();
        if(user_id != ''){
            var url  = '<?php echo base_url("Dashboard/User/check_sponser/")?>'+user_id;
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
        if (confirm('Are You Sure U want to Transfer This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
</script>
