<?php include_once'header.php'; ?>
<style>
main {
    height: 100vh;
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
    <div id="main-content">
    <div class="container-fluid site-width">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <div class="page-panel-heading">
          <h5 class="panel-title">Withdraw /   Transfer Income to Another User</h5>
      </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
        <div class="card-body">
       <h3 class="page-header">
        <small>Minimum Transfer Amount Rs. 100</small>
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
                                <label style="font-size:20px; color:red">Available balance (Rs. <?php echo $balance['balance'];?>)</label><br>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo set_value('amount');?>"/>
                                <span class="text-danger"><?php echo form_error('amount')?></span>
                            </div>
                            <div class="form-group">
                                <label>User ID</label>
                                <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID" value="<?php echo set_value('user_id');?>"/>
                                <span class="text-danger" id="errorMessage"><?php echo form_error('user_id')?></span>
                            </div>

                            <div class="form-group">
                                <h3 id="submit_otp" style="display:none;"></h3>
                                <label>OTP</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="otp" placeholder="Enter OTP" value=""/>
                                        <span class="text-danger"><?php echo form_error('otp')?></span>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-warning" onclick="generateOtp()">GET OTP</button>
                                    </div>
                                    
                                </div>
                                
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
<?php } ?>





<?php include_once'footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

      function generateOtp() {
        fetch("<?php echo base_url(); ?>Dashboard/generateOtp", {
           method: "GET",
           headers: {
             "X-Requested-With": "XMLHttpRequest"
           },
           // body: formData,
       })
       .then(response => response.json())
       .then(result => {
           if(result.success == '1'){
            // alert(result.success)
             document.getElementById("submit_otp").style.display = "block"; 
              toastr.success(result.message, {timeOut: 5000})
           }else{
              toastr.error(result.message, {timeOut: 5000})
           };
        });
    }
</script>
