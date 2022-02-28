<?php include_once'header.php';?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pool Entry</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?php echo form_open('Admin/Management/AdminPoolEntry',array('id' => 'walletForm'));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control" name="pool_id" value="<?php echo set_value('pool_id');?>" placeholder="Enter User ID"/>
                <span class="text-danger"><?php echo form_error('pool_id')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Send</button>
            </div>
            <?php echo form_close();?>
          </div>
          <div class="col-md-6">
            <?php echo form_open('Admin/Management/SendPoolIncome',array('id' => 'walletForm2'));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message2'); ?></h3>
            <!-- <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control" name="user_id" value="<?php echo set_value('user_id');?>" placeholder="Enter User ID"/>
                <span class="text-danger"><?php echo form_error('title')?></span>
                <span id="errorMessage"></span>
            </div> -->
            <div class="form-group">
                <label>Amount</label>
                <input type="number" class="form-control" name="amount" placeholder="Enter Amount" value="<?php echo set_value('amount');?>"/>
                <span class="text-danger"><?php echo form_error('amount')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Send</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
        <h3 class="text-danger"><?php echo $this->session->flashdata('message3'); ?></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th><th>User ID</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($users as $key => $u):?>
                <tr>
                    <td><?php echo $key + 1;?></td>
                    <td><?php echo $u['user_id'];?></td>
                    <td><a href="<?php echo base_url('Admin/Management/DeletePoolUser/'.$u['id']);?>">Delete</a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
  </div>
  </div>
<?php include_once'footer.php'; ?>
<script>
  $(document).on('blur','#user_id',function(){
    var user_id = $(this).val();
    var url  = '<?php echo base_url("Admin/Management/get_user/")?>'+user_id;
    $.get(url,function(res){
      $('#errorMessage').html(res);
    })
  })
  $(document).on('submit','#walletForm',function(){
      if (confirm('Do you want to Send This User ID to pool')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>