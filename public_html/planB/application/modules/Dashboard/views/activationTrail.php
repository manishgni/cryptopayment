<?php include_once'header.php'; ?>
<style>
section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
.active-box {
    background: #36a8db;
    color: #fff;
    box-shadow: 0px 0px 6px rgb(0 149 215);
}

.active-head{
    background: #fff;
    color: #34a7db;
}
.active-head h4{
    margin: 0px;
    padding: 5px 0;
}
.active-box ul {
    padding: 0px;
    margin-top: 10px;
}
.active-box ul li {
    list-style: none;
    border-bottom: 1px #fff solid;
    padding: 9px 0;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 14px;
}
.active-btm a {
    background: #1e3d73;
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

</style>

<!-- <div class="messageBox">
  <h1 id="construction">Coming Soon!</h1>
</div> -->

<?php  $none = 0; ?>
<?php if($none == 0){ ?>
<main>
<div class="container-fluid">
<div class="main-content pt-4">

    <div class="page-content">
        <div class="container-fluid">

    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->

        <section class="content-header">
            <span>Activate your Account</span>
        </section>
    
    </div>


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card" style="display: none;">
                                   <div class="card-body">
      <h4 class="page-header">
        <span style=""> Wallet balance (<?php echo currency.''.$wallet['wallet_balance']; ?>)</span><br>


    </h4>
  
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
                    <h3><?php echo $this->session->flashdata('message'); ?></h3>
                    <div class="form-group">
                        <label>Choose Package</label>
                        <select class="form-control" name="package_id" style="max-width: 400px">
                            <?php
                            foreach($packages as $key => $package){
                                // if($user['package_amount'] != $package['price']){
                                    echo'<option value="'.$package['id'].'">'.$package['title'].' With'.currency.''.$package['price'].' </option>';
                                // }
                                    
                            }
                            ?>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" name="amount"
                            value="<?php //echo set_value('amount'); ?>" placeholder="Enter Amount"
                            style="max-width: 400px" />
                        <span class="text-danger"><?php //echo form_error('amount') ?></span>
                    </div> -->
                    <div class="form-group">
                        <label>User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id"
                            value="<?php echo set_value('user_id'); ?>" placeholder="User ID"
                            style="max-width: 400px" />
                        <span class="text-danger"><?php echo form_error('user_id') ?></span>
                        <span class="text-danger" id="errorMessage"></span>
                    </div>
                    <div class="form-group" id="SaveBtn">
                        <button type="subimt" name="save" class="btn btn-success">Activate</button>
                    </div>
                    <div class="form-group">
                        <label></label>
                        <input type="button" name="updateProfileBtn" value="Pay With BTC" id="PayBtcBtn"
                            style="display:none;" class="btn btn-primary">
                    </div>
                    <?php echo form_close(); ?>

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

    <div class="col-md-12">
        <span class="text-danger"> Wallet balance (<?php echo currency.''.$wallet['wallet_balance']; ?>)</span><br>
        <h3><?php echo $this->session->flashdata('message'); ?></h3>
        <div class="row">
        <?php foreach($packages as $key => $package):?>
            <div class="col-lg-4 col-md-6">
                <div class="card card-body active-box">
                    <div class="active-head text-center">
                        <h4><?php echo $package['title'];?></h4>
                    </div>
                    <ul>
                        <li>Package : <span><?php echo currency.''.$package['price'];?></span></li>
                    </ul>
                    <div class="active-btm">
                        <?php
                            if($user['upgrade_id'] < $package['id']):
                            if($key == 0){$url = 'Dashboard/Activation/activationTrail';} else { $url = 'Dashboard/Activation/UpgradeAccountTrail'; }
                            echo form_open($url);
                            echo form_hidden('package_id',$package['id']);
                            echo form_submit(['type' => 'submit','class' => 'btn btn-success d-block border-0 w-100','value' => 'Active']);
                            echo form_close(); 
                            else:
                                echo '<a href="#" class="btn btn-danger d-block border-0">Activated</a>';
                            endif;      
                        ?>
                    </div>   
                </div>
            </div>
        <?php endforeach;?>
        </div>
    </div>



  </div></div>
  </div>
</main>
<?php } ?>






<?php include_once'footer.php'; ?>
<script>
$(document).on('blur', '#user_id', function() {
    var user_id = $('#user_id').val();
    if (user_id != '') {
        var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
        $.get(url, function(res) {
            $('#errorMessage').html(res);
            $('#user_id').val(user_id);
        })
    }
})
$(document).on('submit', '#TopUpForm', function() {
    if (confirm('Are You Sure U want to Topup This Account')) {
        yourformelement.submit();
    } else {
        return false;
    }
})
$(document).on('change', '#PackageId', function() {
    var package_price = parseInt($(this).children("option:selected").data('price'));
    $('#Payamount').val(package_price);
    // alert(package_price)
})
$(document).on('change', '#payment_method', function() {
    $('#SaveBtn').toggle();
    $('#PayBtcBtn').toggle();
})
$(document).on('click', '#PayBtcBtn', function(e) {
    var formData = $(this).serialize();
    var user_id = $('#user_id').val();
    console.log(formData);
    if (user_id == '') {
        alert('Please Fill User ID');
        return;
    }
    $('#BtcForm').submit();
})
</script>
