<?php include_once'header.php'; ?>
<div id="content" class="content">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h2 class="page-titel">
   <spna style="">Prediction Table</span>
    </h2>
    <!-- <h1 class="page-header">
          <spna style="">  Wallet balance ($<?php echo $wallet['wallet_balance']; ?>)
        <small>You can see fund requests list and check fund request status.</small>
    </h1> -->
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
                    <div class="col-md-6">
                        <!-- BEGIN col-6 -->
                        <?php echo form_open('', array('id' => 'addForm')); ?>
                        <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                        <div class="form-group">
                            <label>Select Prediction</label>
                            <select class="form-control" name="prediction" id="PackageId">
                                <?php
                                foreach($ids as $key => $id){
                                    echo '<option value="'.$id['start'].','.$id['end'].'">' .$id['start'].','.$id['end'].' Registeration </option>';
                                }
                                // $options = [
                                //     '100,150' => '100-150 Registeration',
                                //     '150,200' => '150-200 Registeration',
                                //     '200,250' => '200-250 Registeration',
                                //     '250,300' => '250-300 Registeration',
                                //     '300,350' => '300-350 Registeration',
                                //     '350,400' => '350-400 Registeration',
                                //     '400,450' => '400-450 Registeration',
                                //     '450,500' => '450-500 Registeration',
                                //     '500,550' => '500-550 Registeration',
                                //     '550,600' => '550-600 Registeration',
                                //     '600,650' => '600-650 Registeration',
                                //     '650,700' => '650-700 Registeration',
                                //     '700,750' => '700-750 Registeration',
                                //     '750,800' => '750-800 Registeration',
                                //     '800,850' => '800-850 Registeration',
                                //     '850,900' => '850-900 Registeration',
                                //     '900,950' => '900-950 Registeration',
                                //     '950,1000' => '950-1000 Registeration',
                                // ];
                                //echo form_dropdown('prediction', $options,'' ,'class = "form-control"');
                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="SaveBtn">
                            <button type="subimt" name="save" class="btn btn-success" />Submit</button>
                        </div>
                        <?php echo form_close(); ?>
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
<?php include_once'footer.php'; ?>

