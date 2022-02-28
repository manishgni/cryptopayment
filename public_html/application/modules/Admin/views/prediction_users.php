<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark"><?php echo $title;?></h1>
          </div>
          <div class="col-sm-4">
            <?php echo form_open();?>
            <?php //echo form_input(['type' => 'text', 'name' => 'user_id','placeholder' => 'Enter User ID']);?>
            <?php foreach($table as $key => $tb){ 
              $option[$tb['start'].','.$tb['end']] = $tb['start'].','.$tb['end']. ' Registration Selection';
            }?>
            <?php echo form_dropdown('prediction',$option,'');?>
            <?php echo form_submit('submit','Send');?>
            <?php form_close();?>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $title;?></li>
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
                <h3 class="card-title">All users</h3>

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
                <table class="table table-hover" id="tableView">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Start ID</th>
                            <th>End ID</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                        foreach ($users as $key => $user) {
                            // echo '<pre>';
                            // print_r($key);
                            if(!empty($user['user_id'])){
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['user_id']; ?></td>
                                <td><?php echo $user['start_id'] ; ?></td>
                                <td><?php echo $user['end_id']; ?></td>
                                <td><?php echo $user['created_at']; ?></td>
                            </tr>
                            <?php
                        $i++;} }
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
<?php include'footer.php' ?>