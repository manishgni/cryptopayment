<?php include 'header.php' ?>
<div id="content" class="content">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
   <spna style="">My All Downline</span>
    </h2>
    <h1 class="page-header">

        <small>You can see all of your all Downline</small>
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
                      <table class="table table-bordered table-striped dataTable" id="tableView">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>User ID</th>
                                  <th>Sponser ID</th>
                                  <th>Position</th>
                                  <th>Joining Date</th>
                                  <th>Level</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              foreach ($users as $key => $user) {
                                  ?>
                                  <tr>
                                      <td><?php echo ($key + 1) ?></td>
                                      <td><?php echo $user['user']['name']; ?></td>
                                      <td><?php echo $user['user']['user_id']?></td>
                                      <td><?php echo $user['user']['sponser_id']; ?></td>
                                      <td><?php echo ($user['position'] == 'R')? 'Right' : 'Left'; ?></td>
                                      <td><?php echo $user['user']['created_at']; ?></td>
                                      <td><?php echo $user['level']; ?></td>
                                      <td><?php echo ($user['user']['paid_status'] > 0)? 'Paid':'Free' ; ?></td>
                                  </tr>
                                  <?php
                              }
                              ?>

                          </tbody>
                      </table>
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






<?php include 'footer.php' ?>
