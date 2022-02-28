<?php include'header.php' ?>
<style>
    .panel-heading {
        background: #e0e0e0;
        color: #000;
        padding: 8px 16px;
        border-radius: 10px;
    }
</style>
<main>
<div class="col-md-12 kt-content  kt-grid__item kt-grid__item--fluid pt-3" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                  
                </h3>
            </div>
        </div>
        <div class="panel-heading">
                                      <h5 class="panel-title"> Air Drop Withdraw Request ($<?php echo $balance['balance'];?>)</h5>
                                                                        </div>
        <div class="card card-body">
        <div class="kt-portlet__body">
            <h3><?php echo $this->session->flashdata('message');?></h3>
            <?php echo form_open(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Air Drop</label>
                        <input type="text" class="form-control" name="coin" placeholder="Amount" required="required">
                    </div>
                    <!-- <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" id="otpbtn" class="btn btn-success">Generate OTP</button>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="otp" placeholder="One Time Password" required="required">
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <button type="submit" name="withdraw_request" class="btn btn-success pull-right">Submit</button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        </div>
    </div>
</div>
</main>
<?php include'footer.php' ?>
<script>
    $(document).on('click', '#otpbtn', function () {
        var url = '<?php echo base_url('Dashboard/AjaxController/Generate_otp'); ?>';
        $.get(url, function (res) {
            alert(res.message)
        }, 'json')
    })
</script>