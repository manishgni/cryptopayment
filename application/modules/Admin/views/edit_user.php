<?php include'header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                Personal Details
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open();?>
                    <div class="form-group">
                        <label>Name</label>
                         <input type="text" name="name" class="form-control" value="<?php echo $user['name'];?>"/>
                        <label class="text-danger"><?php echo form_error('name');?></label>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                         <input type="text" name="phone" class="form-control" value="<?php echo $user['phone'];?>"/>
                        <label class="text-danger"><?php echo form_error('phone');?></label>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                         <input type="email" name="email" class="form-control" value="<?php echo $user['email'];?>"/>
                        <label class="text-danger"><?php echo form_error('email');?></label>
                        <input type="hidden" name="form_type" class="form-control" value="personal"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                <?php echo form_close();?>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                Bank Details
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open();?>
                    <div class="form-group">
                        <label>Account Holder Name</label>
                         <input type="text" name="account_holder_name" class="form-control" value="<?php echo $user['bank']['account_holder_name'];?>"/>
                        <label class="text-danger"><?php echo form_error('account_holder_name');?></label>
                    </div>
                    <div class="form-group">
                        <label>Bank Name</label>
                         <input type="text" name="bank_name" class="form-control" value="<?php echo $user['bank']['bank_name'];?>"/>
                        <label class="text-danger"><?php echo form_error('bank_name');?></label>
                    </div>
                    <div class="form-group">
                        <label>Bank Account Number</label>
                         <input type="text" name="bank_account_number" class="form-control" value="<?php echo $user['bank']['bank_account_number'];?>"/>
                        <label class="text-danger"><?php echo form_error('bank_account_number');?></label>
                    </div>
                    <div class="form-group">
                        <label>IFSC Code</label>
                         <input type="text" name="ifsc_code" class="form-control" value="<?php echo $user['bank']['ifsc_code'];?>"/>
                         <input type="hidden" name="form_type" class="form-control" value="bank_details"/>
                        <label class="text-danger"><?php echo form_error('ifsc_code');?></label>
                    </div>
                    <div class="form-group">
                        <label>BTC</label>
                         <input type="text" name="btc" class="form-control" value="<?php echo $user['bank']['btc'];?>"/>
                        <label class="text-danger"><?php echo form_error('btc');?></label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                <?php echo form_close();?>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                Password Manager
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open();?>
                    <div class="form-group">
                        <label>New Passowrd</label>
                         <input type="text" name="password" class="form-control" value="<?php echo $user['password'];?>"/>
                        <label class="text-danger"><?php echo form_error('password');?></label>
                        <input type="hidden" name="form_type" class="form-control" value="password"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                <?php echo form_close();?>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                Transaction Password Manager
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <h3><?php echo $this->session->flashdata('message');?></h3>
                <?php echo form_open();?>
                    <div class="form-group">
                        <label>New Transaction Passowrd</label>
                         <input type="text" name="master_key" class="form-control" value="<?php echo $user['master_key'];?>"/>
                        <label class="text-danger"><?php echo form_error('master_key');?></label>
                        <input type="hidden" name="form_type" class="form-control" value="master_key"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                <?php echo form_close();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include'footer.php' ?>