<?php include'header.php' ?>
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

</style>

<!-- <div class="messageBox">
  <h1 id="construction">Coming Soon!</h1>
</div> -->

<?php  $none = 1; ?>
<?php if($none == 1){ ?>
<main>
    <div id="main-content">
    <div class="container-fluid site-width">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <div class="page-panel-heading">
                                <h5 class="panel-title">Wallet Request List  /  Fund Request List</h5>
                          </div>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="content">
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
                        <div class="col-md-12">
                        <div class="card card-body">
                            <p class="desc m-b-20" style="margin-top:0px;font-size: 18px;">Make sure to use a valid input, you'll need to verify it before you can submit request.</p>
                            <div class="form-group m-b-10">

                            </div>
                            <div class="form-group m-b-10">
                               <div class="box box-solid bg-black">
                               <div class="box-body">
                              <div class="table-responsive">
                              <table class="table table-bordered table-striped dataTable" id="tableView">
                                  <thead>
                                      <tr>
                                          <th>S No.</th>
                                          <th>User ID</th>
                                          <th>Amount</th>
                                          <th>Transaction ID</th>
                                          <th>Image</th>
                                          <th>Status</th>
                                          <th>Remark</th>
                                          <th>CreatedAt</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      foreach ($requests as $key => $request) {
                                          ?>
                                          <tr>
                                              <td><?php echo ($key + 1) ?></td>
                                              <td><?php echo $request['user_id']; ?></td>
                                              <td><?php echo $request['amount']; ?></td>
                                              <td><?php echo $request['transaction_id']; ?></td>
                                              <td><img src="<?php echo base_url('uploads/' . $request['image']); ?>" height="100px" width="100px"></td>
                                              <td><?php
                                                  if ($request['status'] == 0) {
                                                      echo'<span class="btn btn-primary">Pending</span>';
                                                  } elseif ($request['status'] == 1) {
                                                      echo'<span class="btn btn-success">Approved</span>';
                                                  } elseif ($request['status'] == 2) {
                                                      echo'<span class="btn btn-danger">Rejected</span>';
                                                  }
                                                  ?></td>
                                              <td><?php echo $request['remarks']; ?></td>
                                              <td><?php echo $request['created_at']; ?></td>
                                          </tr>
                                          <?php
                                      }
                                      ?>

                                  </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

</div>

                        </div>
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
</main>
<?php } ?>





<?php include'footer.php' ?>
