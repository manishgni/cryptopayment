<?php include'header.php' ?>
<div class="main-content">
    <div class="page-content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Universal Pool</span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Universal Pool</li>
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
                            <th>Pool</th>
                            <th>Total Member</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                        foreach ($pool as $key => $new) {
                          
                          if($key == 1){
                            $table = 'tbl_pool';
                          }else{
                            $table = 'tbl_pool'.$key;
                          }
                         // $totalMember[$key] = $this->Main_model->get_single_record($table, [''], 'ifnull(count(id),0) as totalMember');
                          $user = $this->Main_model->get_single_record('tbl_users',['package_amount >=' => $new['amount']],'count(id) as record');
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $new['pool']; ?></td>
                                <td><?php echo $user['record']; ?></td>
                                <td><a href="<?php echo base_url('Admin/Management/viewUniversalPoolMembers/'.$key); ?>" class="btn btn-primary btn-sm">View</a></td>
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