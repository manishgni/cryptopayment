<?php include_once'header.php'; ?>
<div id="content" class="content">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
   <spna style="">Upgrade your Account</span>
    </h2>
    <h1 class="page-header">
          <spna style="">  Wallet balance ($<?php echo $wallet['wallet_balance']; ?>)
        <small>You can see fund requests list and check fund request status.</small>
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
                    <div class="col-md-12">
                        <!-- BEGIN col-6 -->
                        <?php echo form_open('', array('id' => 'TopUpForm')); ?>
                        <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                        <div class="form-group">
                            <label>Choose Package</label>
                            <select class="form-control" name="package_id" id="PackageId">
                                <?php
                                foreach($packages as $key => $package){
                                    echo'<option value="'.$package['id'].'" data-price="'.$package['price'].'">'.$package['title'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="payment_method" id="payment_method">
                                <option>E-wallet</option>
                                <option>BTC</option>
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <label>User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo set_value('user_id'); ?>" placeholder="User ID" style="max-width: 400px"/>
                            <span class="text-danger"><?php echo form_error('user_id') ?></span>
                            <span class="text-danger" id="errorMessage"></span>
                        </div> -->
                        <div class="form-group" id="SaveBtn">
                            <button type="subimt" name="save" class="btn btn-success" />Upgrade</button>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <input type="button" name="updateProfileBtn" value="Pay With BTC" id="PayBtcBtn"  style="display:none;" class="btn btn-primary">
                        </div>
                        <?php echo form_close(); ?>
                       
                        <!-- END col-6 -->
                        <form id="BtcForm" style="display:none;" action="https://www.coinpayments.net/index.php"  method="post" style="text-align:center;">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="amount" style="color:#fff;">Deposited Amount <span class="text-red">*</span></label>
                                    <input type="hidden" name="amountf" value="100" id="Payamount" required="" class="form-control">
                                    <div class="error"></div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $user_info->user_id; ?>">
                            <input type="hidden" name="cmd" value="_pay">
                            <input type="hidden" name="reset" value="1">
                            <input type="hidden" name="want_shipping" value="0">
                            <input type="hidden" name="merchant" value="d9481e195615de09cd4d4857104a52ed">
                            <input type="hidden" name="currency" value="USD">
                            <input type="hidden" name="item_name" value="Pins Purchase">
                            <input type="hidden" name="user_id" value="<?php echo $user_info->user_id; ?>">
                            <input type="hidden" name="first_name" value="<?php echo $user_info->user_id; ?>">
                            <input type="hidden" name="last_name" value="<?php echo $user_info->name; ?>">
                            <input type="hidden" name="email" value="<?php echo $user_info->email; ?>">
                            <input type="hidden" name="allow_extra" value="1">
                            <!-- <input type="image" src="https://www.coinpayments.net/images/pub/buynow-white.png" alt="Buy Now with CoinPayments.net"> -->

                            <input type="hidden" name="success_url" value="<?php echo base_url('Dashboard/payment_response/success'); ?>">
                            <input type="hidden" name="cancel_url" value="<?php echo base_url('Dashboard/payment_response/failure'); ?>">
                            <!-- <div class="col-md-12 text-center">  <img src="payment-mode.jpeg" class="img-responsive" style="max-width:100%"></div> -->
                            <div class="form-row text-center">
                                
                            </div>
                        </form>  
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
    // $(document).on('blur', '#user_id', function () {
    //     var user_id = $('#user_id').val();
    //     if (user_id != '') {
    //         var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
    //         $.get(url, function (res) {
    //             $('#errorMessage').html(res);
    //             $('#user_id').val(user_id);
    //         })
    //     }
    // })
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure U want to Topup This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
    $(document).on('change','#PackageId',function(){
        var package_price = parseInt($(this).children("option:selected").data('price'));
        $('#Payamount').val(package_price);
        // alert(package_price)
    })
    $(document).on('change','#payment_method',function(){
        $('#SaveBtn').toggle();
        $('#PayBtcBtn').toggle();
    })
    $(document).on('click','#PayBtcBtn',function(e){
        var formData = $(this).serialize();
        var user_id = $('#user_id').val();
        console.log(formData);
        if(user_id == ''){
            alert('Please Fill User ID');
            return;
        }
        $('#BtcForm').submit();
    })
</script>
