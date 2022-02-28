<?php include 'header.php' ?>
 <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <section class="content-header">
            <span class="">Withdraw Request </span>
          </section>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Withdraw Request</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <h3><?php echo $this->session->flashdata('message');?></h3>
            <div class="card">
              <div class="card-header">
                  <form method="GET" action="<?php echo base_url('Admin/Withdraw/withdrawHistory/'.$status.'/');?>">
                      <div class="row">
                          <div class="col-3">
                              <select class="form-control" name="type">
                                  <option id="selectchangetext" value="name" <?php echo $type == 'name' ? 'selected' : '';?>>
                                      Name</option>
                                  <option id="selectchangetext" value="user_id" <?php echo $type == 'user_id' ? 'selected' : '';?>>
                                      User ID</option>
                                  <option id="selectchangetext" value="phone" <?php echo $type == 'phone' ? 'selected' : '';?>>Phone
                                  </option>
                                  <option id="selectchange" value="created_at" <?php echo $type == 'created_at' ? 'selected' : '';?>>Request Date
                                  </option>

                                  <option id="selectchangenumber" value="amountgreter" <?php echo $type == 'amountgreter' ? 'selected' : '';?>>Amount Greter Then or Equal >=
                                  </option>

                                  <option id="selectchangenumber" value="amountless" <?php echo $type == 'amountless' ? 'selected' : '';?>>Amount Less Then or Equal <=
                                  </option>
                              </select>
                          </div>
                          <div class="col-3">
                              <input type="text" id="type" name="value" class="form-control float-right"
                                  value="<?php echo $value;?>" placeholder="Search">
                          </div>

                          <div class="col-3">
                              <div class="input-group-append">
                                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                              </div>
                          </div>
                          <div class="col-3">
                              
                          </div>
                      </div>
                  </form>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>INR Amount</th>
                            <th>Amount</th>
                            <th>Payable Amount</th>
                            <th>Status</th>
                            <th style="width:500px">Bank Details</th>
                            <th>PAN Number</th>
                            <th>Remark</th>
                            <th>Request Date</th>
                            <th>Credit IB</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = $segament+1;
                        foreach ($requests as $key => $request) {
                            ?>
                            <tr>
                                <td><?php echo ($i) ?></td>
                                <td><?php echo $request['user_id']; ?></td>
                                <td><?php echo $request['name']; ?></td>
                                <td><?php echo $request['phone']; ?></td>
                                <td><?php echo $request['payable_amount']*dollar_price; ?></td>
                                <td><?php echo $request['amount']; ?></td>
                                <td><?php echo $request['payable_amount']; ?></td>
                                <td><?php
                                    if ($request['status'] == 0)
                                        echo'<span class="badge badge-primary">Pending</span>';
                                    elseif ($request['status'] == 1)
                                        echo'<span class="badge badge-success">Approved</span>';
                                    elseif ($request['status'] == 2)
                                        echo '<span class="badge badge-danger">Rejected</span>';
                                    ?></td>
                                <td>
                                    <?php

                                        if($request['credit_type'] == 'BlockChain'){
                                          echo $request['kyc_status']['btc'].'<br>';

                                        }else{
                                          if ($request['kyc_status']['kyc_status'] == 0)
                                              $kyc_status = '<span class="badge badge-warning">Not Applied</span>';
                                          elseif ($request['kyc_status']['kyc_status'] == 1)
                                              $kyc_status = '<span class="badge badge-primary">Pending</span>';
                                          elseif ($request['kyc_status']['kyc_status'] == 2)
                                              $kyc_status = '<span class="badge badge-success">Approved</span>';
                                          elseif ($request['kyc_status']['kyc_status'] == 3)
                                              $kyc_status =  '<span class="badge badge-danger">Rejected</span>';
                                          echo 'Bank Name :'. $request['bank']['beneficiary_bank'].'<br>';
                                          echo 'Bank Account Number :'. $request['bank']['beneficiary_account_no'].'<br>';
                                          echo 'Account Holder Name :'. $request['bank']['beneficiary_name'].'<br>';
                                          echo 'Ifsc Code :'. $request['bank']['beneficiary_ifsc'].'<br>';
                                          echo 'Kyc Status :'. $kyc_status.'<br>';

                                        }
                                    ?>
                                </td>
                                <td><?php echo $request['kyc_status']['pan']; ?></td>
                                <td><?php echo $request['remark']; ?></td>
                                <td><?php echo $request['created_at']; ?></td>
                                <td><?php echo $request['credit_type']; ?></td>
                                <td>
                                    <?php if($request['status'] == 0){ ?>
                                      <a class="btn btn-warning" href="<?php echo base_url('Admin/Withdraw/instantWithdraw/' . $request['id']); ?>" target="_blank">Proceed
                                  <?php }?></a>

                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </tbody>
                </table>
               
              </div>
              <div class="row">
                  <div class="col-sm-12 col-md-5">
                      <div class="dataTables_info" id="tableView_info" role="status" aria-live="polite">
                          Showing <?php echo ($segament + 1) .' to  '.($i -1);?> of
                          <?php echo $total_records;?> entries</div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="tableView_paginate">
                          <?php
                          echo $this->pagination->create_links();
                          ?>
                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php' ?>
<script>
  

    $("#selectchange").click(function() {
      $("#type").attr("type", "date")
    });

    $("#selectchangetext").click(function() {
      $("#type").attr("type", "text")
    });

    $("#selectchangenumber").click(function() {
      $("#type").attr("type", "number")
    });
</script>