<?php include_once'header.php'; ?>
<div id="content" class="content">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
        <spna style="">Withdraw </spna> /   Transfer to W-wallet
    </h2>
    <h1 class="page-header">

        <small>Minimum Transfer Amount $25</small>
    </h1>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
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
                          <?php echo form_open('',array('id' => 'TopUpForm'));?>
                          <span class="text-danger"><?php echo $this->session->flashdata('message'); ?></span>
                          <div class="form-group">
                              <label style="font-size:20px; color:red">Available balance ($<?php echo $balance['balance'];?>)</label><br>
                          </div>
                          <div class="form-group">
                              <label>Amount</label>
                              <input type="text" class="form-control" name="amount" id="amount" onblur="calculate_net_amount();" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                              <span class="text-danger"><?php echo form_error('amount')?></span>
                          </div>
                          <div class="form-group">
                              <label>Admin Charges</label>
                              <span class="text-info">10%</span>
                          </div>
                          <div class="form-group">
                              <label>Net Amount</label>
                              <span class="text-success" id="netAmount"></span>
                          </div>
                          <div class="form-group">
                              <label>100% E-wallet Transfer</label><br>
                              <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="1" checked>Yes &nbsp;
                              <input type="radio" name="pin_transfer" onclick="calculate_net_amount();" value="0" checked >No
                          </div>
                          <div class="form-group">
                              <label>Transfer Amount to E-wallet</label>
                              $<span class="text-success" id="bankAmount"></span>
                          </div>
                          <!-- <div class="form-group">
                              <label>TDS Charges 5%</label>
                              <span class="text-success" id="tds"></span>
                          </div> -->
                          <div class="form-group">
                              <label>Net.  Amount</label>
                              $<span class="text-success" id="NetbankAmount"></span>
                          </div>
                          <div class="form-group">
                              <label>Transaction Pin</label>
                              <input type="password" class="form-control" name="master_key" placeholder="Transaction Key" value=""/>
                              <span class="text-danger"><?php echo form_error('master_key')?></span>
                          </div>
                          <div class="form-group">
                              <button type="subimt" name="save" class="btn btn-success" />Acitvate</button>
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
    <!-- END wizard -->
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
</script>
