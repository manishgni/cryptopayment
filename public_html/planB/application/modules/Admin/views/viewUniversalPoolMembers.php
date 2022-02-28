<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Universal <?php echo $poolHeader; ?> Pool Memebers</span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Universal Pool Memebers</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
     

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <!-- <th>Position</th> -->
                            <th>Fund</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                        foreach ($pool as $key => $new) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $new['user_id']; ?></td>
                                <td><?php echo $new['name']; ?></td>
                                <!-- <td><?php //echo $new['position']; ?></td> -->
                                <td><?php echo round($distribute,3); ?></td>
                                <td><?php echo $new['topup_date']; ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          </div>

        </div>
         </div>
    </div>
      </div>
   
<?php include'footer.php' ?>