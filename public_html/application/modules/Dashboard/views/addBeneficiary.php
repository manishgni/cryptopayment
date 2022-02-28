<?php include_once'header.php'; ?>
<style>
 section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
    display: inline-block;
    width: 100%;
}

</style>
<main>
  <div class="container-fluid site-width">
   <div class="content-wrapper">  
    <div class="content"> 

    <section class="content-header">
        <span style="">Add New Beneficary</span>
    </section>

    <div class="card">
      <div class="card-body">
        <!-- <h3 class="page-header">

         <small>Add New Beneficary</small>
     </h3> -->
              <!-- BEGIN tab-pane -->
              <div class="tab-pane active show" id="tabFundRequestForm">
    <div class="">
        <div class="container-fluid">
                <div class="row">
    <div class="col-lg-12">
       <div class="card">
         <div class="card-body">
         <div class="card-title">Add Beneficiary</div>
         <hr>
         <div class="col-md-12">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <?php 
            // if($status == 0){
            // if($user['netbanking'] == 1){                
                echo form_open('', array('id' => 'TopUpForm')); 
            ?>
             <div class="form-group">
                <label>Beneficiary Bank Name :</label>
                <input type="text" class="form-control" name="beneficiary_bank_name" value="<?php echo set_value('beneficiary_bank_name'); ?>"
                    placeholder="Beneficiary Bank Name." style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_bank_name') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank Account No. :</label>
                <input type="text" class="form-control" name="beneficiary_account_no" value="<?php echo set_value('beneficiary_account_no'); ?>"
                    placeholder="Beneficiary Bank Account No." style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_account_no') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank IFSC :</label>
                <input type="text" class="form-control" name="beneficiary_ifsc" value="<?php echo set_value('beneficiary_ifsc'); ?>"
                    placeholder="Beneficiary Bank IFSC" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_ifsc') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Account Holder Name :</label>
                <input type="text" class="form-control" name="beneficiary_name" value="<?php echo set_value('beneficiary_name'); ?>"
                    placeholder="Beneficiary  Account Holder Name :" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_name') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Bank Branch :</label>
                <input type="text" class="form-control" name="beneficiary_branch" value="<?php echo set_value('beneficiary_branch'); ?>"
                    placeholder="Beneficiary Bank Branch" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_branch') ?></span>
            </div>
            <div class="form-group">
                <label>Beneficiary Mobile No. :</label>
                <input type="text" class="form-control" name="beneficiary_mobile" value="<?php echo set_value('beneficiary_mobile'); ?>"
                    placeholder="Beneficiary  Mobile No :" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('beneficiary_name') ?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Add</button>
            </div>
            <?php echo form_close(); 
            // }else{
            //     echo 'Two Beneficiary already added!';
            // }
            
            ?>

        </div>
    </div>
</div>
</div>
</div>
</div></div></div></div></div>
<?php include_once'footer.php'; ?>