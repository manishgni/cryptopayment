<?php include'header.php' ?>
<div id="content" class="content">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
        <spna style="">Withdraw Request </spna> /   Withdraw summary
    </h2>
    <h1 class="page-header">

        <small>Withdrawal summary</small>
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
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-12">
                          <table class="table table-bordered table-striped dataTable" id="tableView">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>User ID</th>
                                      <th>Amount</th>
                                      <th>Type</th>
                                      <th>Status</th>

                                      <th>Admin Charges</th>
                                      <th>Fund</th>
                                      <th>Payable Amount</th>
                                      <th>Description</th>
                                      <th>Credit Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  foreach ($transactions as $key => $transaction) {
                                      if($transaction['status'] == 0)
                                          $status = '<span style="color:blue; font-weight:bold">Pending</span>';
                                      elseif($transaction['status'] == 1)
                                          $status = '<span style="color:green; font-weight:bold">Approved</span>';
                                      elseif($transaction['status'] == 2)
                                          $status = '<span style="color:red; font-weight:bold">Rejected</span>';
                                      ?>
                                      <tr>
                                          <td><?php echo ($key + 1) ?></td>
                                          <td><?php echo $transaction['user_id']; ?></td>
                                          <td>$<?php echo $transaction['amount']; ?></td>
                                          <td><?php echo ucwords(str_replace('_', ' ', $transaction['type'])); ?></td>
                                          <td><?php echo $status; ?></td>

                                          <td>$<?php echo $transaction['admin_charges']; ?></td>
                                          <td><?php echo $transaction['fund_conversion']; ?></td>
                                          <td>$<?php echo $transaction['payable_amount']; ?></td>
                                          <td><?php echo $transaction['remark']; ?></td>
                                          <td><?php echo $transaction['created_at']; ?></td>
                                      </tr>
                                      <?php
                                  }
                                  ?>

                              </tbody>
                          </table>
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
    <!-- END wizard -->
</div>



<?php include'footer.php' ?>
