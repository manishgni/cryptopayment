<?php include_once'header.php'; ?>

<main>
  <div id="main-content">
  <div class="container-fluid site-width">
 <div class="page-panel-heading">
          <h5 class="panel-title">Withdraw Request  /  Beneficiary List</h5>
      </div>

    

    <div class="card">
      <div class="card-body">
              <!-- BEGIN tab-pane -->
              <div class="tab-pane active show" id="tabFundRequestForm">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                <h3><?php echo $this->session->flashdata('message');?></h3>
                    <div id="some_div"></div>
                    <?php
                foreach($beneficiary as $ben){
                    ?>
                    <div class="card" style="width:400px">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $ben['beneficiary_name'];?></h4>
                            <p class="card-text">
                                Account Number : <?php echo $ben['beneficiary_account_no'];?> <br>
                                IFSC Code : <?php echo $ben['beneficiary_ifsc'];?><br>
                                Bank : <?php echo $ben['beneficiary_bank'];?><br>
                                Bank Branch : <?php echo $ben['beneficiary_branch'];?> <br>
                                Benficiary ID : <?php echo $ben['account_ifsc'];?>
                            </p>
                            <a class="btn btn-primary" href="<?php echo base_url('Dashboard/SecureWithdraw/withdrawAmount/'.$ben['account_ifsc']);?>">Send
                                Money</a>
                        </div>
                    </div>

                    <?php
                }
                if(empty($beneficiary)){
                    echo '<h4>Click here for Add new Beneficiary <a href="'.base_url('Dashboard/SecureWithdraw/addBeneficiary').'"> Click here</a></h4>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</main>

<?php include_once'footer.php'; ?>