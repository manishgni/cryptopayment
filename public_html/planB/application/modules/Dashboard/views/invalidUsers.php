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
                          <div class="col-3">
                              <select class="form-control" name="type">
                                  <option value="name" <?php echo $type == 'name' ? 'selected' : '';?>>
                                      Name</option>
                                  <option value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>
                                      User ID</option>
                                  <option value="phone" <?php echo $type == 'phone' ? 'selected' : '';?>>Phone
                                  </option>
                                  <option value="sponser_id"
                                      <?php echo $type == 'sponser_id' ? 'selected' : '';?>>Sponser ID
                                  </option>
                                  <option value="email"
                                      <?php echo $type == 'email' ? 'selected' : '';?>>Email
                                  </option>
                                  <option value="rank"
                                      <?php echo $type == 'rank' ? 'selected' : '';?>>Rank
                                  </option>
                              </select>
                          </div>
                          <div class="col-3">
                              <input type="text" name="value" class="form-control float-right"
                                  value="<?php echo $value;?>" placeholder="Search">
                          </div>

                          <div class="col-3">
                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                              </div>
                          </div>
                          <div class="col-3">
                              <div class="input-group-append">
                                  <a href="<?php echo base_url('Admin/Management/excelExport')?>" type="button" class="btn btn-default">Export Excel<i class="fa fa-download"></i></a>
                                  <!-- <a href="<?php echo base_url('Admin/Management/excelExport')?>" type="button" class="btn btn-default">Export CSV<i class="fa fa-download"></i></a> -->
                              </div>
                          </div>
                          <div class="export-table">
                            <!-- <a href="<?php echo base_url('Admin/Management/users?export=xls'); ?>" class="export-btn btn-primary"><img src="<?php echo base_url('NewDashboard/');?>assets/images/xls.png">Export to xls</a>
                            <a href="<?php echo base_url('Admin/Management/users?export=csv'); ?>" class="export-btn btn-success"><img src="<?php echo base_url('NewDashboard/');?>assets/images/csv.png">Export to csv</a>
                            <a href="<?php echo base_url('Admin/Management/users?export=txt'); ?>" class="export-btn btn-info "><img src="<?php echo base_url('NewDashboard/');?>assets/images/txt.png">Export to txt</a> -->
                        </div>
                      </div>
                  </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Rank</th>
                            <th>Sponsor ID</th>
                            <th>Package</th>
                            <th>E-wallet</th>
                            <th>Binance Balance</th>
                            <th>Income</th>
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
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $user['email'] ; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                                <td><?php echo $user['rank']; ?></td>
                                <td><?php echo $user['sponser_id']; ?></td>
                                <td><?php echo $user['paid_status'] == 0 ? '<p class="text-danger">Free</p>' : '<p class="text-success">PAID</p>'; ?></td>
                                 <td><?php echo $user['wallet_amount']; ?></td>
                                 <td>
                                   <span id="balance<?php echo $user['user_id']?>"></span>
                                   <button onclick="refreshBalance('<?php echo $user['user_id']?>')">refresh</button>
                                </td>
                                 <td><?php echo round($user['income'],2); ?></td>
                                 <td><?php echo $user['createdAt']; ?></td>
                                 <td><a href="<?php echo base_url('Admin/Settings/EditUser/'.$user['user_id']);?>">Edit<a></td>
                                
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


const refreshBalance = (user_id) => {
  let url = '<?php echo base_url("Admin/Management/get_user_balance/")?>'+user_id;
  $.get(url,function(res){
    $('#balance' + user_id).text(res.balance)
    if(res.success == 0)
      alert(res.message);
  },'json')
}

</script>
