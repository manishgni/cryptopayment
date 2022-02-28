<?php include'header.php' ?>
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
main {
    height: 100vh;
}
.messageBox {
  padding: 1em;
  background: #002e3666;
  border: #eee solid 2px;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-right: -50%;
  transform: translate(-50%, -50%);
  text-shadow: 0px 0px 8px #000;
  color: #fff;
}
#text {
  font-family: Questrial;
  text-align: center;
}
#construction {
  font-family: "Pacifico", cursive;
}

</style>

<div class="messageBox">
  <h1 id="construction">Coming Soon!</h1>
</div>

<?php  $none = 0; ?>
<?php if($none == 0){ ?>
<main>
    <div class="container-fluid site-width">
    <!-- BEGIN breadcrumb -->
    <!--<ul class="breadcrumb"><li class="breadcrumb-item"><a href="#">FORMS</a></li><li class="breadcrumb-item active">FORM WIZARS</li></ul>-->
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <section class="content-header">
        <span style="">TRX Request  /   TRX summary</span>
    </section>

    <!-- END page-header -->
    <!-- BEGIN wizard -->
    <div class="card">
      <div class="card-body">
       
    <div id="rootwizard" class="wizard wizard-full-width">
        <!-- BEGIN wizard-header -->

        <!-- END wizard-header -->
        <!-- BEGIN wizard-form -->

            <div class="wizard-content tab-content">
                <!-- BEGIN tab-pane -->
                <div class="tab-pane active show" id="tabFundRequestForm">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-6 -->
                        <div class="col-md-12">
                           <div class="box box-solid bg-black">
                             
                               <div class="box-body">
                          <div class="table table-responsive">
                          <table class="table table-bordered table-striped dataTable" id="tableView">
                              <thead>
                                  <tr>
                                      <th>S No.</th>
                                      <th>User ID</th>
                                      <th>Block Number</th>
                                      <th>From</th>
                                      <th>Contact Address</th>

                                      <th>To</th>
                                      <th>Token Name</th>
                                      <th>Credit Date</th>
                                      <th>Action</th>

                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  foreach ($records as $key => $transaction) {
                                      ?>
                                      <tr>
                                          <td><?php echo ($key + 1) ?></td>
                                          <td><?php echo $transaction['user_id']; ?></td>
                                          <td><?php echo $transaction['blockNumber']; ?></td>

                                          <!-- <td><?php echo $transaction['timeStamp']; ?></td> -->
                                          <td><?php echo $transaction['from']; ?></td>
                                          <td><?php echo $transaction['contractAddress']; ?></td>
                                          <td><?php echo $transaction['to']; ?></td>
                                          <td><?php echo $transaction['tokenName']; ?></td>
                                          <td><?php echo $transaction['createdAt']; ?></td>
                                          <td><?php if($transaction['transfer_status'] == 0){ echo '<a href="http://176.58.124.217:3000/check_trx_balance/TDoUadHqU7MrJ5XkH9kciyffFcoonugpfx" class=" btn btn-success">Check Trx Balance</a><br><a href="" class=" btn btn-danger">Deposit Trx Balance</a><br><a href="" class=" btn btn-warning">Check Usdt Balance</a><br><a href="" class=" btn btn-info">Debit Admin Usdt</a><br>'; }?></td>

                                      </tr>
                                      <?php
                                  }
                                  ?>

                              </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                        </div>
                        <!-- END col-6 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END tab-pane -->
                <!-- BEGIN tab-pane -->

            </div>
            <!-- END wizard-content -->

        <!-- END wizard-form -->
    </div>
  </div>
    <!-- END wizard -->
</div>
</div>
</main>
<?php } ?>


<?php include'footer.php' ?>
