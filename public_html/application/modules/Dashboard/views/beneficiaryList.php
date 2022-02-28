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
        <span style="">Beneficiary List</span>
    </section>

    <div class="card">
      <div class="card-body">
        
              <!-- BEGIN tab-pane -->
              <div class="tab-pane active show" id="tabFundRequestForm">
    <div class="">
        <div class="container-fluid">
            <div class="row">
    <div class="col-lg-12">
       <div class="">
         <div class="">
         <div class="card-title">Beneficiary List</div>
         <hr>
         <div class="col-md-12">
                <h3><?php echo $this->session->flashdata('message');?></h3>
                    <div id="some_div"></div>
                    <?php
                foreach($beneficiary as $ben){
                    ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $ben['beneficiary_name'];?></h4>
                            <p class="card-text">
                                Account Number : <?php echo $ben['beneficiary_account_no'];?> <br>
                                IFSC Code : <?php echo $ben['beneficiary_ifsc'];?><br>
                                Bank : <?php echo $ben['beneficiary_bank'];?><br>
                                Bank Branch : <?php echo $ben['beneficiary_branch'];?> <br>
                                Benficiary ID : <?php echo $ben['account_ifsc'];?>
                            </p>
                            <a
                                href="<?php echo base_url('Dashboard/DirectIncomeWithdraw/'.$ben['id']);?>">Send
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
<?php include_once'footer.php'; ?>