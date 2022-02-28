<?php include'header.php' ?>
<div id="content" class="main-content">
    <style>
    .text-success {
        color: #117622!important;
        font-size: 14px;
        font-weight: bold;
    }
    </style>
    <h2 class="page-titel">
        <span style="font-size:20px">Rewards Status </span>
    </h2>

    <?php
        $awardsArr = [
            '1' => ['pair' => '10','designation' => 'Star','reward' => '4000'],
            '2' => ['pair' => '30','designation' => 'Silver Star','reward' => '8000'],
            '3' => ['pair' => '80','designation' => 'Pearl Star','reward' => '20000'],
            '4' => ['pair' => '150','designation' => 'Gold Star','reward' => '70000'],
            '5' => ['pair' => '430','designation' => 'Emrald Star','reward' => '200000'],
            '6' => ['pair' => '1430','designation' => 'Platinum Star','reward' => '625000'],
            '7' => ['pair' => '4430','designation' => 'Diamond Star','reward' => '1400000'],
            '8' => ['pair' => '11930','designation' => 'Royal Diamond Star','reward' => '2500000'],
            '9' => ['pair' => '26930','designation' => 'Crown Diamond Star','reward' => '4000000'],
            '10' => ['pair' => '61930','designation' => 'Crown Ambassador Star','reward' => '10000000'],
            '11' => ['pair' => '136930','designation' => 'Double Crown Ambassador Star','reward' => '25000000'],
            '12' => ['pair' => '151930','designation' => 'Kohinoor Star','reward' => '50000000'],
        ];
    ?>
    <div id="rootwizard" class="wizard wizard-full-width">
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
                                        <th>Matching</th>
                                        <th>Designation</th>
                                        <th>Bonus</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($awardsArr as $key => $reward) {
                                        $l = $key - 1;
                                        ?>
                                        <tr>
                                            <td><?php echo $key;?></td>
                                            <td><?php echo $reward['pair'];?></td>
                                            <td><?php echo $reward['designation'];?></td>
                                            <td><?php echo $reward['reward'];?></td>
                                            <td>
                                                <?php
                                                    if(!empty($rewards[$l])){
                                                        if($rewards[$l]['status'] == 0){
                                                            echo '<span class="badge badge-primary">Pending</span>';
                                                        }elseif($rewards[$l]['status'] == 1){
                                                            echo '<span class="badge badge-success">Approved</span>';
                                                        }elseif($rewards[$l]['status'] == 2){
                                                            echo '<span class="badge badge-danger">Rejected</span>';
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if(!empty($rewards[$l]['award_id'])){
                                                        echo '<span class="badge badge-success">Achieved</span>';
                                                    }else{
                                                        echo '<span class="badge badge-primary">Not Achieved</span>';
                                                    }
                                                ?>
                                            </td>
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
