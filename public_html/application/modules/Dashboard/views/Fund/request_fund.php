<div id="content" class="content">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
        <spna style="">Wallet Request </spna> /  Fund Request
    </h2>
    <h1 class="page-header">
        Fund Request
        <small>You can send fund request and check fund request status.</small>
    </h1>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->
        <div class="wizard-header">
            <ul class="nav nav-pills">
                <li>
                    <a id="tab1" href="#tabFundRequestForm" data-toggle="tab" class="active show">FUND REQUEST</a>
                </li>
                <li>
                    <a id="tab2" href="#tabFundRequestHistory" data-toggle="tab">FUND REQUEST STATUS</a>
                </li>

            </ul>
        </div>
        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-11 offset-md-1">
                            <p class="desc m-b-20">Make sure to use a valid input, you'll need to verify it before you can submit request.</p>
                            <div class="form-group m-b-10">
                                <div class="row row-space-6">

                                    <div class="col-md-6">
                                        <a href="Fund-Request.html?TB=tabFundRequestForm#" class="to-padding widget widget-stats">
                                            <div class="widget-stats-info mm-info">
                                                <div class="widget-stats-value to-fontsize" id="FBald58">$ 0</div>
                                                <div class="widget-desc">F-Wallet Balance </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-md-4">
								<img style="width:100%;" src="<?php echo base_url('uploads/barcode.jpg');?>">
							
							
							
							</div>
                            <div class="form-group m-b-10">
                              <?php echo form_open_multipart();?>
                              <div class="row">
							  
							  
							  
							  
							  
							  
                                  <div class="col-md-6">
                                      <h2><?php echo $this->session->flashdata('message');?></h2>
                                      <div class="form-group">
                                          <label>Select Payment Mode</label>
                                          <?php
                                          $option = [
                                              '' => 'Select Address',
                                              'USDT' =>' USDT',
                                              'TRX' => 'TRX',
                                              'BNB' => 'BNB',
                                              'Ripple' => 'Ripple',
                                              'ETH' => 'ETH',
                                          ];
                                          echo form_dropdown('payment_method',$option,'',array('class'=>'form-control','onchange' => 'callAddress()','id' => 'address'));
                                          ?>
                                      </div>
                                      <div class="form-group">
                                          <label>Address</label>
                                          <span class="text-danger" id="addressdisplay"></span>
                                      </div>
                                      <div class="form-group">
                                          <label>Amount</label>
                                          <?php
                                          echo form_input(array('type' => 'number', 'name' => 'amount', 'class' => 'form-control'));
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
                            </div>
							
							




                        </div>
                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END tab-pane -->
                <!-- BEGIN tab-pane -->
                <div class="tab-pane" id="tabFundRequestHistory">
                    <div class="panel panel-default">
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
    <!-- END wizard -->
</div>






<?php  $this->load->view('footer');?>
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

    function callAddress(){
        let address = '';
        const symbol = document.getElementById('address').value;
        if(symbol == 'USDT'){
            address = '0x1ab4d5db3a989bf12f14e79b80f234420982a6e6';
        }else if(symbol == 'TRX'){
            address = 'TSo6HQtjLY3YJtGm51zwagGxGebbkTGTxT';
        }else if(symbol == 'BNB'){
            address = 'bnb14kktnh6n20efy4kfh0u5xy38rw53j8q5gkzuzv';
        }else if(symbol == 'Ripple'){
            address = 'rNxCw7HUbd51dvUMUyC7ju5XivXmCM1Bvr';
        }else if(symbol == 'ETH'){
            address = '0x1ab4d5db3a989bf12f14e79b80f234420982a6e6';
        }else{
            address = 'No Address Found';
        }
        document.getElementById('addressdisplay').innerHTML = address;
    }

</script>
