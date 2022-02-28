<style>
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
.transaction-box {
    position: relative;
     border-radius: 5px ;
     overflow: hidden;

}
button#btnCopy {
    background: #31a5da;
    color: #fff;
    border: 0px;
    padding: 7px 13px;
    font-weight: bold;
    display: inline-block;
}
div#qrcode img {
    max-width: 100%;
}
.copy-cls{
   background: orange;
    color: #fff;
    padding: 10px 15px;
    display: inline;
}
@media screen and (max-width: 640px){
  .transaction-box{
    width: 100%;
  }
  .copy-cls{
    display: block;
  }
}

</style>

<div class="messageBox">
  <h1 id="construction">Coming Soon!</h1>
</div>

<?php  ?>
<?php if(!empty($none == 1)){ ?>
<main>
    <div id="main-content">
    <div class="container-fluid site-width">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
      <div class="col-md-12">
          <div class="page-panel-heading">
                                <h5 class="panel-title">Wallet Request / Fund Request</h5>
                          </div>
    </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="content">
    <div id="rootwizard" class="wizard wizard-full-width">

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm" >
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-12">
                        <div class="card card-body mt-0">

                            <div class="form-group m-b-10">
                                <div class="row row-space-6">

                                    <div class="col-md-6 ">

                                        <!-- <a href="Fund-Request.html?TB=tabFundRequestForm#" class="to-padding widget widget-stats"> -->
                                            <div class="widget-stats-info mm-info">
                                                <div class="widget-stats-value to-fontsize" id="FBald58"><h4>E-Wallet Balance: (<?php echo currency.''.$amount['amount'] ?>)</h4> </div>
                                                <!-- <div class="widget-desc">E-Wallet Balance </div> -->
                                            </div>
                                            
                                        <!-- </a> -->
                                    </div>
                                    </div>
                                    <div class="col-md-12 d-none">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="qr" id="qrcode">
                                </div>
                                <div class="row mt-3">
                                  <div class="col-md-3">
                                            <p> <input class="form-control" type="text" id="linkTxt" value="<?php echo $user['wallet_address']; ?>" readonly></p>
                                  </div>
                                  <div class="col-md-9"> 
                                    <div class="transaction-box">
                                      <button id="btnCopy" iconcls="icon-save" class="btncopy btn-rounded m-b-5 copy-section">
                                Copy Address
                                </button>
                                <a href="https://artisticuniversal.com/Dashboard/fund/depositHistory" class="copy-cls">Click here to See Transaction at Tronscan </a>
     
    </div></div>
                                </div>
                       
                              
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-10">
                           
                                            </div>
                                            <?php $none = 1;
                                                if($none == 1):
                                             ?>
                              <?php echo form_open_multipart();?>
                              <div class="row">
                                  <div class="col-md-6">
                                      <h2><?php echo $this->session->flashdata('message');?></h2>
                                      <div class="form-group">
                                          <label>Select Payment Mode</label>
                                          <?php
                                          echo form_dropdown('payment_method',array('bank' => 'Bank','imps' => 'IMPS','upi' => 'UPI','bank_transfer' => 'Bank Transfer','other' => 'Other'),'',array('class'=>'form-control'));
                                          ?>
                                      </div>
                                     <!--  <div class="form-group">
                                          <label>Company Bank Details</label>
                                          <p>Account Name: ROI MAKER <br>
                                          Account Number: 7112524851 <br>
                                          Bank Name: KOTAK MAHINDRA BANK <br>
                                          IFSC Code: KKBK0001906
                                        </p>
                                      </div> -->

                                      <div class="form-group">
                                          <label>Amount</label>
                                          <?php
                                          echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control'));
                                          ?>
                                      </div>
                                      <div class="form-group">
                                          <label>Transactions ID</label>
                                          <?php
                                          echo form_input(array('type' => 'text', 'name' => 'txn_id', 'class' => 'form-control'));
                                          ?>
                                      </div>
                                      <div class="form-group">
                                          <label>Upload Proof Here</label>
                                          <?php
                                          echo form_input(array('type' => 'file', 'name' => 'userfile', 'class' => 'form-control' , 'id' => 'payment_slip','size' => 20));
                                          ?>
                                      </div>
                                      <div class="form-group">
                                          <?php
                                          echo form_input(array('type' => 'submit' , 'class' => 'btn btn-success pull-right','name' => 'fundbtn','value' => 'Request'));
                                          ?>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <img src="<?php echo base_url('classic/no_image.png');?>" title="Payment Slip" id="slipImage" style="width: 100%;">
                                  </div>
                              </div>
                              <?php echo form_close();?>
                          <?php endif; ?>
                            </div>




                        </div>
                        </div>
                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END tab-pane -->
                <!-- BEGIN tab-pane -->
                <div class="tab-pane" id="tabFundRequestHistory" style="display:none">
                    <div class="card card-body panel panel-default">
                        <div class="table-responsive">
                            <div id="datatables-default_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="dataTables_length" id="datatables-default_length">
                                            <label>Show
                                                <select name="datatables-default_length" aria-controls="datatables-default" class="form-control form-control-sm">
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                </select> entries
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 text-center">
                                        <div class="dt-buttons btn-group">
                                            <a class="btn btn-default buttons-copy buttons-html5 btn-sm" tabindex="0" aria-controls="datatables-default" href="Fund-Request.html?TB=tabFundRequestForm#">
                                                <span>Copy</span>
                                            </a>
                                            <a class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0" aria-controls="datatables-default" href="Fund-Request.html?TB=tabFundRequestForm#">
                                                <span>CSV</span>
                                            </a>
                                            <a class="btn btn-default buttons-pdf buttons-html5 btn-sm" tabindex="0" aria-controls="datatables-default" href="Fund-Request.html?TB=tabFundRequestForm#">
                                                <span>PDF</span>
                                            </a>
                                            <a class="btn btn-default buttons-print btn-sm" tabindex="0" aria-controls="datatables-default" href="Fund-Request.html?TB=tabFundRequestForm#">
                                                <span>Print</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div id="datatables-default_filter" class="dataTables_filter">
                                            <label>Search:
                                                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatables-default">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="datatables-default_processing" class="dataTables_processing card" style="display: none;">Processing...</div>
                                <table class="table dataTable no-footer" id="datatables-default" style="width: 100%;" role="grid" aria-describedby="datatables-default_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatables-default" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Payment Mode: activate to sort column descending">Payment Mode</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables-default" rowspan="1" colspan="1" style="width: 0px;" aria-label="Request Date: activate to sort column ascending">Request Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables-default" rowspan="1" colspan="1" style="width: 0px;" aria-label="Transaction Number: activate to sort column ascending">Transaction Number</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables-default" rowspan="1" colspan="1" style="width: 0px;" aria-label="Request Amount: activate to sort column ascending">Request Amount</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables-default" rowspan="1" colspan="1" style="width: 0px;" aria-label="Status: activate to sort column ascending">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables-default" rowspan="1" colspan="1" style="width: 0px;" aria-label="Account detail: activate to sort column ascending">Account detail</th>
                                            <th class="sorting" tabindex="0" aria-controls="datatables-default" rowspan="1" colspan="1" style="width: 0px;" aria-label="Reciept: activate to sort column ascending">Reciept</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd">
                                            <td valign="top" colspan="7" class="dataTables_empty">No data available in table</td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                                <div class="bottom">
                                    <div class="dataTables_info" id="datatables-default_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div>
                                    <div class="dataTables_paginate paging_full_numbers" id="datatables-default_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item first disabled" id="datatables-default_first">
                                                <a href="Fund-Request.html?TB=tabFundRequestForm#" aria-controls="datatables-default" data-dt-idx="0" tabindex="0" class="page-link">First</a>
                                            </li>
                                            <li class="paginate_button page-item previous disabled" id="datatables-default_previous">
                                                <a href="Fund-Request.html?TB=tabFundRequestForm#" aria-controls="datatables-default" data-dt-idx="1" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <li class="paginate_button page-item next disabled" id="datatables-default_next">
                                                <a href="Fund-Request.html?TB=tabFundRequestForm#" aria-controls="datatables-default" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                            </li>
                                            <li class="paginate_button page-item last disabled" id="datatables-default_last">
                                                <a href="Fund-Request.html?TB=tabFundRequestForm#" aria-controls="datatables-default" data-dt-idx="3" tabindex="0" class="page-link">Last</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END wizard-content -->

        <!-- END wizard-form -->
    </div>
</div>
    <!-- END wizard -->

</div>
</div>
</main>
<?php } ?>





<?php  $this->load->view('footer');?>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
	<script type="text/javascript">
		var code = '<?php echo $user['wallet_address']; ?>';
		new QRCode(document.getElementById("qrcode"),code);
	</script>
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#slipImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#payment_slip").change(function () {
        readURL(this);
    });
    $(document).on('submit', '#paymentForm', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#savebtn').css('display', 'none');
        $('#uploadnot').css('display', 'block');
        var action = $(this).attr('action');
        $.ajax({
            url: action,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                data = JSON.parse(data);
                if (data.success === 1)
                {
                    toastr.success(data.message);
//                    swal("Thank You", data.message);
                    //window.location = "https://soarwaylife.in/Dashboard/request_money.php" + data.message;
                    location.reload();
                } else {
                    toastr.error(data.message);
                }
                $('#savebtn').css('display', 'block');
                $('#uploadnot').css('display', 'none');
            }
        });
    });


</script>
<script>
    $(document).on('click', '#btnCopy', function () {
    //linkTxt
    var copyText = document.getElementById("linkTxt");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
    alert("Copied the text: " + copyText.value);
})
</script>
