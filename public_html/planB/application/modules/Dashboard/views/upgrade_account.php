<?php include_once'header.php'; ?>

<style>

</style>
<main>
    <div id="main-content">
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-content">
                <div class="">
                       <div class="page-panel-heading">
                                <h5 class="panel-title">Upgrade your Account</h5>
                          </div>
                    <div class="card">
                        <div class="card-body">
                            <h1 class="page-header">
                                <span style="font-size:20px; color:#000">  Wallet balance (<?php echo $wallet['wallet_balance']; ?>) </span>
                            </h1>
                            <div id="rootwizard" class="wizard wizard-full-width">
                                <div class="wizard-content">
                                    <div class="tab-pane active show" id="tabFundRequestForm">
                                        <div class="">
                                            <?php echo form_open('', array('id' => 'TopUpForm')); ?>
                                            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                                            <div class="form-group">
                                                <label>Choose Package</label>
                                                <select class="form-control" name="package_id" id="PackageId">
                                                    <?php
                                                    $i = 1;
                                                     foreach($packages as $key => $package){
                                                        //if($i == 1){
                                                            echo'<option value="'.$package['id'].'" data-price="'.$package['price'].'">'.$package['title'].' Rs. '.$package['price'].'</option>';
                                                            //$i++;
                                                        //}
                                                     }
                                                    ?>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label>Amount</label>
                                                <input type="text" class="form-control" name="amount" value="<?php// echo set_value('amount'); ?>" placeholder="Enter Amount" style="max-width: 400px"/>
                                                <span class="text-danger"><?php //echo form_error('amount') ?></span>
                                            </div> -->
                                            <!-- <div class="form-group">
                                                <select class="form-control" name="payment_method" id="payment_method">
                                                    <option>E-wallet</option>

                                                </select>
                                            </div> -->
                                            <!-- <div class="form-group">
                                                <label>User ID</label>
                                                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo set_value('user_id'); ?>" placeholder="User ID" style="max-width: 400px"/>
                                                <span class="text-danger"><?php echo form_error('user_id') ?></span>
                                                <span class="text-danger" id="errorMessage"></span>
                                            </div> -->
                                            <div class="form-group" id="SaveBtn">
                                                <button type="subimt" name="save" class="btn btn-success" />Upgrade</button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php include_once 'footer.php'; ?>
<script>
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure you want to Upgrade This Account')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
</script>
