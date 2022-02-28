<?php include'header.php' ?>
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
    <style>
    .text-success {
    color: #117622!important;
    font-size: 14px;
    font-weight: bold;
}
    </style>
       <div class="page-panel-heading">
          <h5 class="panel-title">Bonus  /  <?php echo $header; ?> <?php echo currency.''.round($total_income['total_income'],3);?></h5>
      </div>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
      <div class="card-body">
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
                            <div class="box box-solid bg-black">
                              <div class="box-header with-border">
                              <div class="col-md-3">
                     <!--  <a href="?export=csv" class="export-btn btn btn-success"><img style ="max-width:30px;" src="https://theroyalfuture.com/NewDashboard/assets/images/csv.png">Export to cvs</a> -->
                   
                  </div>
                                <div class="box-tools pull-right" style="top: 4px;">
                                  <form method="GET" action="<?php echo base_url($path);?>">
                                    <input type="date" name="start" value="<?php echo $start;?>">
                                    <input type="date" name="end" value="<?php echo $end;?>">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </form>
                                </div>
                         
                    <!-- <div class="col-md-3">
                      <a href="<?php //echo $base_url.'?export=xls'; ?>" class="export-btn btn-primary"><img src="https://theroyalfuture.com/NewDashboard/assets/images/xls.png">Export to xls</a>
                    </div> -->

                   
                                <!-- <?php if($header == 'Income Ledgar'):?>
                                <div class="export-table">
                                    <?php if(!empty($_GET['start'])){?>
                                      <a href="<?php //echo base_url('Dashboard/User/income_ledgar?start='.$start.'&end='.$end.'&export=xls');?>" class="export-btn btn-primary"><img src="https://theroyalfuture.com/NewDashboard/assets/images/xls.png">Export to xls</a>
                                      <a href="<?php //echo base_url('Dashboard/User/income_ledgar?start='.$start.'&end='.$end.'&export=csv');?>" class="export-btn btn-success"><img src="https://theroyalfuture.com/NewDashboard/assets/images/csv.png">Export to csv</a>
                                      <a href="<?php //echo base_url('Dashboard/User/income_ledgar?start='.$start.'&end='.$end.'&export=txt');?>" class="export-btn btn-info "><img src="https://theroyalfuture.com/NewDashboard/assets/images/txt.png">Export to txt</a>
                                    <?php }else{ ?>
                                      <a href="<?php //echo base_url('Dashboard/User/income_ledgar?export=xls');?>" class="export-btn btn-primary" width="20px" ><img src="https://theroyalfuture.com/NewDashboard/assets/images/xls.png">Export to xls</a>
                                      <a href="<?php //echo base_url('Dashboard/User/income_ledgar?export=csv');?>" class="export-btn btn-success"><img src="https://theroyalfuture.com/NewDashboard/assets/images/csv.png">Export to csv</a>
                                      <a href="<?php //echo base_url('Dashboard/User/income_ledgar?export=txt');?>" class="export-btn btn-info "><img src="https://theroyalfuture.com/NewDashboard/assets/images/txt.png">Export to txt</a>
                                    <?php } ?>
                                </div>
                                <?php endif;?> -->
                              </div>
                               <div class="box-body">
                          <div class="table-responsive">
                          <table class="table table-bordered table-striped dataTable" id="">
                              <thead>
                                  <tr>
                                      <th>S No.</th>
                                      <th>User ID</th>
                                      <th>Amount</th>
                                      <!-- <th>Type</th> -->
                                      <th>Description</th>
                                      <th>Credit Date</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $i = $segment+1;
                                  foreach ($user_incomes as $key => $income) {
                                      ?>
                                      <tr>
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $income['user_id']; ?></td>
                                          <td><?php echo $income['amount'] > 0 ? '<span class="text-success">'. currency.''.$income['amount'] . '</span>' : '<span class="text-danger">R' .currency.''. $income['amount'] . '</span>'; ?></td>
                                          <!-- <td><?php echo  get_income_name($income['type']); ?></td> -->
                                          <td><?php echo $income['description']; ?></td>
                                          <td><?php echo $income['created_at']; ?></td>
                                      </tr>
                                      <?php
                                  $i++; }
                                  ?>

                              </tbody>
                          </table>
                          <?php echo $this->pagination->create_links();?>
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
    <!-- END wizard -->
  </div>
</div>
</div>
</div>
</main>
<?php } ?>






<?php include'footer.php' ?>
