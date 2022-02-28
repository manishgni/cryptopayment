<?php include_once'header.php'; ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Prediction</h1>
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
            <?php echo form_open('',array('id' => 'walletForm'));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Start ID</label>
                <input type="number" class="form-control" name="start" value="<?php echo set_value('start');?>" placeholder="Start ID"/>
                <span class="text-danger"><?php echo form_error('start')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>End ID</label>
                <input type="number" class="form-control" name="end" placeholder="End ID" value="<?php echo set_value('end');?>"/>
                <span class="text-danger"><?php echo form_error('end')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Create</button>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
        <?php echo $this->session->flashdata('error');?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th><th>Start ID</th><th>End ID</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($prediction as $key => $p):?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo $p['start'];?></td>
                    <td><?php echo $p['end'];?></td>
                    <td><a href="<?php echo base_url('Admin/Settings/DeletePrediction/'.$p['id']);?>">Delete</a>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
  </div>
<?php include_once'footer.php'; ?>
<script>
//   $(document).on('blur','#user_id',function(){
//     var user_id = $(this).val();
//     var url  = '<?php echo base_url("Admin/Management/get_user/")?>'+user_id;
//     $.get(url,function(res){
//       $('#errorMessage').html(res);
//     })
//   })
//   $(document).on('submit','#walletForm',function(){
//       if (confirm('Do you want to Send Fund on This Account?')) {
//            yourformelement.submit();
//        } else {
//            return false;
//        }
//   })
</script>