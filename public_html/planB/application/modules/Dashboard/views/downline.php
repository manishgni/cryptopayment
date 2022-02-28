<?php include'header.php' ?>
<style>
 section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
</style>
<main>
    <div class="container-fluid site-width">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <section class="content-header">
    <span>My Partners </span>
   </section>
   <div class="card">
    <div class="card-body">
   <!-- <div class="col-md-12">
    <h4 class="page-header">
        <small>You can see all of your all Downline</small>
    </h4>
  </div> -->
    <!-- END page-header -->
    <!-- BEGIN wizard -->
     <div class="col-md-12">
                  <div class="box box-solid bg-black">
     
      <div class="box-body">
        <div class="table-responsive">
    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="table-responsive">

                      <table class="table table-bordered table-striped dataTable" >
                          <thead>
                              <tr>
                                  <th>S No.</th>
                                  <th>Name</th>
                                  <th>User ID</th>
                                  <!-- <th>Mobile No.</th> -->
                                  <th>Package</th>
                                  <!-- <th>Sponser ID</th> -->
                                  <!-- <th>Joining Date</th> -->
                                    <!-- <th>Activation Date</th> -->
                                  <!-- <th>Level</th> -->
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              // $i = $segment +1;
                              foreach ($users as $key => $user) {
                                  ?>
                                  <tr>
                                      <td><?php echo ($key+1) ?></td>
                                      <td><?php echo $user['user']['name']; ?></td>
                                      <td><?php echo $user['user']['user_id']?></td>
                                      <!-- <td><?php //echo $user['user']['phone']?></td> -->
                                      <td><?php echo $user['user']['package_amount']?></td>
                                      <!-- <td><?php //echo $user['user']['sponser_id']; ?></td> -->
                                      <!-- <td><?php// echo $user['user']['created_at']; ?></td> -->
                                      <!-- <td><?php //echo $user['user']['topup_date']; ?></td> -->
                                      <!-- <td><?php //echo $user['level']; ?></td> -->
                                  </tr>
                                  <?php
                                  //$i++;
                              }
                              ?>

                          </tbody>
                      </table>
                      <?php echo $this->pagination->create_links();?>
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
    </div>
    </div>
    <!-- END wizard -->
</div>
</div>
</div>
</div>
</main>






<?php include'footer.php' ?>
