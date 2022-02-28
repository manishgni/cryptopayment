<?php include'header.php' ?>

<main>
<div id="main-content">
<div class="container-fluid site-width">
    <div class="container-fluid content-header">
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
            <!-- <h4 class="page-title">Directs</h4> -->
            <!-- <ol class="breadcrumb"> -->
                <!-- <li class="breadcrumb-item"><a href="/">Home</a></li> -->
                <!-- <li class="breadcrumb-item"><a href="<?php// echo base_url('Dashboard'); ?>">Dashboard</a></li> -->
                <!-- <li class="breadcrumb-item active" aria-current="page">Downline</li> -->
            <!-- </ol> -->
        </div>
    </div>
     <div class="page-panel-heading">
          <h5 class="panel-title"><?php echo $header; ?></h5>
      </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
          
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable" id="tableView">
                            <thead>
                                <tr>
                                    <th>S No.</th>
                                    <th>Level</th>
                                    <th>Team</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($levels as $key => $level) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1) ?></td>
                                        <td><?php echo $level['level']; ?></td>
                                        <td><?php echo $level['level_count']; ?></td>
                                        <!-- <td><?php// echo $level['active_team']['active_team']; ?></td> -->
                                        <!-- <td><?php //echo $level['level_count'] - $level['active_team']['active_team']; ?></td> -->
                                        <td><a href="<?php echo base_url('Dashboard/User/Downline/'.$level['level']);?>" style="color:blue;">View</a></td>
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
    <div class="overlay toggle-menu"></div>
    </div>
</div>

</div>
</main>



<?php include'footer.php' ?>
