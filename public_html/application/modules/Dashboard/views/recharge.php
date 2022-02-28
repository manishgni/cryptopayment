<?php include_once 'header.php'; ?>
<div id="content" class="content">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
   <spna style="">Recharge Portal</span>
    </h2>
    <h1 class="page-header">
        <spna style="">  Wallet balance ($<?php echo round($balance['sum'],2); ?>)
        <!-- <small>You can see fund requests list and check fund request status.</small> -->
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
                            <label>Mobile Number</label>
                            <input type="number" class="form-control" name="phoneNumber" value="<?php echo set_value('phoneNumber'); ?>" placeholder="Mobile Number" style="max-width: 400px"/>
                            <span class="text-danger"><?php echo form_error('phoneNumber') ?></span>
                            <span class="text-danger" id="errorMessage"></span>
                        </div>
                        <div class="form-group">
                            <label>Select Operator</label>
                            <select class="form-control" name="operator" style="max-width: 400px">
                                <option value="">Select Operator</option>
                                <option value="3">Airtel</option>
                                <option value="5">BSNL Special Traiff</option>
                                <option value="4">BSNL Talktime</option>
                                <option value="12">Idea</option>
                                <option value="116">Reliance Jio</option>
                                <option value="37">Vodafone</option>
                                <option value="51">Airtel Digital TV (DTH)</option>
                                <option value="53">Dish TV DTH</option>
                                <option value="54">Sun DTH</option>
                                <option value="55">TATA Sky DTH</option>
                                <option value="56">Videocon DTH</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount In INR</label>
                            <input type="number" class="form-control" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="Enter Amount" style="max-width: 400px"/>
                            <span class="text-danger"><?php echo form_error('amount') ?></span>
                            <span class="text-danger" id="errorMessage"></span>
                        </div>
                        <div class="form-group">
                            <label>Transaction Password</label>
                            <input type="password" class="form-control" name="transactionPass" value="<?php echo set_value('transactionPass'); ?>" placeholder="Enter Transaction Password" style="max-width: 400px"/>
                            <span class="text-danger"><?php echo form_error('transactionPass') ?></span>
                            <span class="text-danger" id="errorMessage"></span>
                        </div>
                        <div class="form-group" id="SaveBtn">
                            <button type="subimt" name="save" class="btn btn-success" />Recharge</button>
                        </div>
                        <?php echo form_close(); ?>
                       
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
<?php include_once 'footer.php'; ?>
