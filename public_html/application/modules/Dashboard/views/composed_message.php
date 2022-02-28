<?php include'header.php' ?>
<div id="content" class="content">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
        <spna style="">Support </spna> /  Recent Compose Mail
    </h2>
    <h1 class="page-header">

        <small>List Tickets</small>
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
                                  <th>Title</th>
                                  <th>Message</th>
                                  <th>Status</th>
                                  <th>Remark</th>
                                  <th> Date</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              foreach ($messages as $key => $message) {
                                  ?>
                                  <tr>
                                      <td><?php echo ($key + 1) ?></td>
                                      <td><?php echo $message['title']; ?></td>
                                      <td><?php echo $message['message']; ?></td>
                                      <td><?php
                                          if($message['status'] == 0){
                                              echo'Pending';
                                          }elseif($message['status'] == 1){
                                              echo'Approved';
                                          }elseif($message['status'] == 2){
                                              echo'Rejected';
                                          }
          //                                echo $transaction['status'];
                                          ?></td>
                                      <td><?php echo $message['remark']; ?></td>
                                      <td><?php echo $message['created_at']; ?></td>
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
