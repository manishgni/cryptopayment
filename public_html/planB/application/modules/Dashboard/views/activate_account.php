<?php 
    include_once 'header.php';
    $none = 0; 
?>
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
<main>
<div id="main-content">
<div class="container-fluid">
    <div class="main-content">

    <div class="page-content">
        <div class="">
                <div class="page-panel-heading">
                                <h5 class="panel-title">Activate your Account</h5>
                          </div>
    
    </div>


    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <?php if($none == 0):?>
        <div class="card">
            <div class="card-body">
                <h4 class="page-header">
                    <span style=""> Wallet balance (<?php echo currency.''.$wallet['wallet_balance']; ?>)</span><br>
                </h4>
                <div class="wizard-content ">
                    <div class="tab-pane active show" id="tabFundRequestForm">
                        <div class="">
                            <?php echo form_open('', array('id' => 'TopUpForm')); ?>
                            <h3><?php echo $this->session->flashdata('message'); ?></h3>
                            <div class="form-group">
                                <label>Choose Package</label>
                                <select class="form-control" name="package_id" style="max-width: 400px">
                                    <?php
                                    foreach($packages as $key => $package){
                                        echo'<option value="'.$package['id'].'">'.$package['title'].' With'.currency.''.$package['price'].' </option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php if($none == 1): ?>
                            <div class="form-group">
                                <label>Epin</label>
                                <input type="text" class="form-control" name="epin" value="<?php echo !empty($epin)?$epin:''; ?>" placeholder="Enter Epin" style="max-width: 400px">
                            </div>
                            <?php endif;?>
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
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif;?>    
    <?php if($none == 1):?>

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
                            if($key == 0){$url = 'Dashboard/Activation';} else { $url = 'Dashboard/Activation/UpgradeAccount'; }
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
    <?php endif;?>
    </div>
</div>
</div>
</div>
</main>

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
