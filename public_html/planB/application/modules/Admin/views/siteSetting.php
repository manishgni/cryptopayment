<?php include_once'header.php'; ?>
  <div class="content-wrapper main-content page-content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $header;?></h1>
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
                <?php echo form_open_multipart();?>
                <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
                <?php foreach($field as $kf => $fi):?>
                <div class="form-group" style="<?php echo $fi['style'];?>" id="<?php echo $fi['id'];?>">
                    <label><?php echo $fi['label'];?></label>
                    <input type="<?php echo $fi['type'];?>" class="form-control" name="<?php echo $fi['name'];?>" value="<?php echo !empty($fi['value'])? $fi['value'] : set_value($fi['name']);?>" placeholder="<?php echo $fi['placeholder'];?>">
                    <span class="text-danger"><?php echo form_error($fi['name'])?></span>
                    <span id="errorMessage"></span>
                </div>
                <?php endforeach;?>
                <?php if(!empty($textarea)):?>
                <div class="form-group">
                    <?php echo $textarea;?>
                </div>
                <?php endif;?>
                <?php if(!empty($textarea1)):?>
                <div class="form-group">
                    <?php echo $textarea1;?>
                </div>
                <?php endif;?>
                <?php if(!empty($textarea2)):?>
                <div class="form-group">
                    <?php echo $textarea2;?>
                </div>
                <?php endif;?>
                <?php if(!empty($textarea3)):?>
                <div class="form-group">
                    <?php echo $textarea3;?>
                </div>
                <?php endif;?>
                <?php if(!empty($textarea4)):?>
                <div class="form-group">
                    <?php echo $textarea4;?>
                </div>
                <?php endif;?>
                <?php if(!empty($select)){ echo $select;}?>
                <div class="form-group">
                    <button type="subimt" name="save" class="btn btn-success" /><?php echo $submit;?></button>
                </div>
                <?php echo form_close();?>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <?php foreach($thead as $tk => $th): ?>
                                <th><?php echo $th;?></th>
                                <?php endforeach;?>
                            </tr>
                        </thead>
                        <?php 
                            foreach($tbody as $key => $tb){
                                echo $tb;
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once 'footer.php'; ?>
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script type="text/javascript">
  CKEDITOR.replace('long_desc',{
    width: "500px",
    height: "200px"
  }); 

  CKEDITOR.replace('long_desc1',{
    width: "500px",
    height: "200px"
  }); 

  CKEDITOR.replace('long_desc2',{
    width: "500px",
    height: "200px"
  }); 

  CKEDITOR.replace('long_desc3',{
    width: "500px",
    height: "200px"
  }); 

  CKEDITOR.replace('long_desc4',{
    width: "500px",
    height: "200px"
  }); 
</script>
<script>
    function loadDoc(){
        let selection = document.getElementById('selectval').value;
        if(selection == 2){
            document.getElementById('file').style.display = 'none';
            document.getElementById('link').style.display = 'block'; 
        }else{
            document.getElementById('file').style.display = 'block';
            document.getElementById('link').style.display = 'none';
        }
    }
</script>
