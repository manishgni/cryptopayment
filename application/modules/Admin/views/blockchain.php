<?php include_once'header.php'; ?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $header; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/Management/index')?>">Home</a></li>
             <!--  <li class="breadcrumb-item">Fund Management</li>
              <li class="breadcrumb-item active">Send Fund Personally</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <?php if($form == 'blockchain'){ ?>
          <div class="col-md-6">
            <?php echo form_open('',array('id' => ''));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Blockchain Name</label>
                <input type="text" class="form-control" name="blockchain" value="<?php echo set_value('blockchain');?>" id="" placeholder="Enter Blockchain Name"/>
                <span class="text-danger"><?php echo form_error('blockchain')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" name="slug" placeholder="Slug" value="<?php echo set_value('slug');?>"/>
                <span class="text-danger"><?php echo form_error('amount')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Submit</button>
            </div>
            <?php echo form_close();?>
          </div>
        <?php 
            }elseif($form == 'token'){ 
        ?>
          <div class="col-md-6">
            <?php echo form_open('',array('id' => ''));?>
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <div class="form-group">
                <label>Blockchain ID</label>
                <input type="text" class="form-control" name="blockid" value="<?php echo set_value('blockid');?>" id="" placeholder="Enter Block ID"/>
                <span class="text-danger"><?php echo form_error('blockid')?></span>
                <span id="errorMessage"></span>
            </div>
            <div class="form-group">
                <label>Token Name</label>
                <input type="text" class="form-control" name="token_name" placeholder="Token Name" value="<?php echo set_value('token_name');?>"/>
                <span class="text-danger"><?php echo form_error('token_name')?></span>
            </div>
             <div class="form-group">
                <label>Token Slug</label>
                <input type="text" class="form-control" name="token_slug" placeholder="Token Slug" value="<?php echo set_value('token_slug');?>"/>
                <span class="text-danger"><?php echo form_error('token_slug')?></span>
            </div>
             <div class="form-group">
                <label>Symbol</label>
                <input type="text" class="form-control" name="symbol" placeholder="Symbol" value="<?php echo set_value('symbol');?>"/>
                <span class="text-danger"><?php echo form_error('symbol')?></span>
            </div>
             <div class="form-group">
                <label>Contract Address</label>
                <input type="text" class="form-control" name="contract_address" placeholder="Contract Address" value="<?php echo set_value('contract_address');?>"/>
                <span class="text-danger"><?php echo form_error('contract_address')?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Submit</button>
            </div>
            <?php echo form_close();?>
          </div>
        <?php  } ?>
        </div>
      </div>
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
      if (confirm('Do you want to Send Fund on This Account?')) {
           yourformelement.submit();
       } else {
           return false;
       }
  })
</script>