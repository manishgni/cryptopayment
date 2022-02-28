<?php include'header.php' ?>
<div id="content" class="content">
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
                                        <th>Matching</th>
                                        <th>Bonus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $incomeCount = count($rewards_income);
                                    foreach ($rewards as $key => $reward) {
                                        ?>
                                        <tr>
                                            <td><?php echo $key;?></td>
                                            <td>$<?php echo $reward['matching'];?></td>
                                            <td>$<?php echo $reward['bonus'];?></td>
                                            <td>
                                                
                                                <?php
                                                if($key > $incomeCount){
                                                    echo'<span class="text-danger"> Not Achieved </span>';
                                                }else{
                                                    echo'<span class="text-success">Achieved </span>';
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
