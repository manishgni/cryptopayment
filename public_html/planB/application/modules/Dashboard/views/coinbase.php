<?php include_once'header.php'; ?>

<style>
.fund-box h1 {
    text-transform: capitalize;
    font-size: 50px;
    font-weight: bold;
    margin-bottom: 30px;
}
.fund-box span {
    color: #23c4bf;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input.form-control {
    padding-right: 150px;
    height: 60px;
    background: #0c1a32;
    border-color: rgba(255,255,255,.12);
}
select.form-control {
    height: 60px;
    padding: 0 47px;
}
.form-control:focus {
    color: #fff;
    background-color: transparent;
    border-color: #23c4bf;

}
option {
    color: #000 !important;
}
form#TopUpForm {
    margin-top: 43px;
}
@media screen and (max-width: 480px){
    input.form-control{
        padding: 0px 11px;
    }
}

</style>

<div class="main-content page-content">
    <div class="">
        <div class="container-fluid">
            <div class="content-header">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="m-0 text-white text-uppercase"><?php echo $header;?></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Fund Management</li>
                        <li class="breadcrumb-item active"><?php echo $header;?></li>
                    </ol>
                </div><!-- /.col -->
            </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
        <div class="card card-body" style="background: #0b1323;box-shadow: 0px 0px 10px;">
        <div class="col-md-10 m-auto fund-box text-center text-white">
            <h1>Add <span>fund</span> into <span>Wallet</span></h1>
            <h4>Choose any currency and make payment <br> by scaning QR code</h4>

            <?php echo form_open('', array('id' => 'TopUpForm')); ?>
            <h3 class="text-success"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group d-inline-block">
                <!-- <label>Amount</label>   -->
                <input type="number" class="form-control" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="Enter Amount"/>
                <span class="text-success"><?php echo form_error('amount') ?></span>
                <span class="text-success" id="errorMessage"></span>
                <!-- <select class="form-control" name="package_id" style="max-width: 400px">
                    <?php
                    // foreach($packages as $key => $package){
                    //     echo'<option value="'.$package['id'].'">'.($package['price']/packagePrice).'</option>';
                    // }
                    ?>
                </select> -->
            </div>
            <div class="form-group d-inline-block">
                <select class="form-control" name="currency" >
                    <?php
                    $currency = [
                        //'BTC' => 'BTC',
                        //'TRX' => 'TRX',
                        'USDT.TRC20' => 'USDT',
                        //'SHIB' => 'SHIBA',
                    ];
                    foreach($currency as $key => $c){
                        echo'<option value="'.$key.'">'.$c.'</option>';
                    }
                    ?>
                </select>
            </div>
            <!-- <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="<?php //echo set_value('user_id'); ?>" placeholder="User ID" style="max-width: 400px"/>
                <span class="text-success"><?php //echo form_error('user_id') ?></span>
                <span class="text-success" id="errorMessage"></span>
            </div> -->
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success px-3 text-uppercase" />Submit</button>
            </div>
            <?php echo form_close(); ?>

        </div>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).on('blur', '#user_id', function () {
        var user_id = $('#user_id').val();
        if (user_id != '') {
            var url = '<?php echo base_url("Dashboard/User/get_user/") ?>' + user_id;
            $.get(url, function (res) {
                $('#errorMessage').html(res);
            })
        }
    })
    $(document).on('submit', '#TopUpForm', function () {
        if (confirm('Are You Sure for this action')) {
            yourformelement.submit();
        } else {
            return false;
        }
    })
</script>
<?php include_once 'footer.php'; ?>
