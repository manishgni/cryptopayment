<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                  <form method="GET" action="<?php echo base_url('Admin/Management/users/');?>">
                      <div class="row">
                        <div class="col-2">
                      <input type="date" name="startDate" class="form-control float-right" value="<?php echo $startDate;?>" placeholder="Enter Start Date">
                    </div>
                    <div class="col-2">
                      <input type="date" name="endDate" class="form-control float-right" value="<?php echo $endDate;?>" placeholder="Enter End Date">
                    </div>
                          <div class="col-2">
                              <select class="form-control" name="type">
                                  <option value="name" <?php echo $type == 'name' ? 'selected' : '';?>>
                                      Name</option>
                                  <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>
                                      User ID</option>
                                  <option value="phone" <?php echo $type == 'phone' ? 'selected' : '';?>>Phone
                                  </option>
                                  <option value="email" <?php echo $type == 'email' ? 'selected' : '';?>>Email
                                  </option>
                                 
                              </select>
                          </div>
                          <div class="col-2">
                              <input type="text" name="value" class="form-control float-right"
                                  value="<?php echo $value;?>" placeholder="Search">
                          </div>

                          <div class="col-4">
                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                              </div>
                          </div>
                      </div>
                  </form>
                <!-- <h3 class="card-title">All users</h3> -->

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Password</th>
                            <th>Transaction Pin</th>
                            <th>Sponsor ID</th>
                           <!--  <th>Package</th>
                            <th>E-wallet</th>
                            <th>Income</th> -->
                            <th>Joining Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                     $i = ($segament) + 1;
                        foreach ($users as $key => $user) {
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['name'] ; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                                <td><?php echo $user['password']; ?></td>
                                <td><?php echo $user['master_key']; ?></td>
                                <td><?php echo $user['sponser_id']; ?></td>
                                <!-- <td><?php //echo $user['package_amount']; ?></td>
                                 <td><?php //echo $user['e_wallet']['e_wallet']; ?></td>
                                 <td><?php //echo $user['income_wallet']['income_wallet']; ?></td> -->
                                 <td><?php echo $user['created_at']; ?></td>
                                 <td>
                                  <a href="<?php echo base_url('Admin/Management/user_login/'.$user['user_id']);?>" target="_blank">Login</a>/
                                  <!-- <a href="<?php echo base_url('Admin/Settings/EditUser/'.$user['user_id']);?>" target="_blank">Edit</a>/ -->
                                  <?php
                                  // if($user['disabled'] == 0)
                                  //   echo'<a class="blockUser" data-status="1" data-user_id="'.$user['user_id'].'">Block Now</a>';
                                  // else
                                  //   echo'<a class="blockUser" data-status="0" data-user_id="'.$user['user_id'].'">UnBlock Now</a>';
                                  
                                  ?>
                                  
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
              </div>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                      <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">
                          Showing <?php echo ($segament + 1) .' to  '.($i -1);?> of
                          <?php echo $total_records;?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                          <?php
                          echo $this->pagination->create_links();
                          ?>
                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>
<script>
$(document).on('click','.blockUser',function(){
  var status = $(this).data('status');
  var user_id = $(this).data('user_id');
  var url = "<?php echo base_url('Admin/Management/blockStatus/');?>"+user_id + '/' + status;
  $.get(url,function(res){
    alert(res.message)
    if(res.success == 1)
      location.reload()
  },'json')
})
</script>