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
    <span><?php echo $header;  ?></span>
   </section>
   <div class="card">
    <div class="card-body">
   <div class="col-md-12">
    <h4 class="page-header">
        <small>You can see all of your <?php echo $header;  ?></small>
    </h4>
  </div>
    <!-- END page-header -->
    <!-- BEGIN wizard -->
     <div class="col-md-12">
                  <div class="box box-solid bg-black">
      <div class="box-header with-border">
        <div class="box-tools pull-right" style="top: 4px;">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
          <i class="fa fa-times"></i></button>
        </div>
      </div>
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

                      <table class="table table-bordered table-striped dataTable" id="myTable">
                          <thead>
                              <tr>
                                   <?php 
                                foreach($thead as $th):
                                    echo '<th>'.$th.'</th>';
                                endforeach;
                            ?>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                               //$i = $segment +1;
                               foreach($tbody as $tb): 
                                echo $tb;
                            endforeach;
                                  //$i++;
                                                            ?>

                          </tbody>
                      </table>
                      <!-- <?php //echo $this->pagination->create_links();?> -->
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
