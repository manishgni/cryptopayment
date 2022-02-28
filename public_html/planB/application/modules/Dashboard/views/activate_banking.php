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

      <section class="content-header">
          <span style="">Withdraw Request  /   Activate Banking</span>
      </section>

      <div class="card">
        <div class="card-body">
          <h3 class="page-header">

           <small>Activate Banking</small>
       </h3>
              <!-- BEGIN tab-pane -->
              <div class="tab-pane active show" id="tabFundRequestForm">
            <h3 class="text-danger"><?php echo $this->session->flashdata('message'); ?></h3>
            <?php
            // if($user['netbanking'] == 0){

                echo form_open('', array('id' => 'TopUpForm'));
            ?>
            <div class="form-group">
                <label>OTP</label>
                <input type="text" class="form-control" name="otp" value="<?php echo set_value('otp'); ?>"
                    placeholder="OTP" style="max-width: 400px" />
                <span class="text-danger"><?php echo form_error('otp') ?></span>
            </div>
            <div class="form-group">
                <button type="subimt" name="save" class="btn btn-success" />Activate</button>
            </div>
            <?php echo form_close();
            echo'<a class="btn btn-success" href="">Resend OTP</a>';
            // }else{
            //     echo'Banking is Activate';
            // }

            ?>

        </div></div>
    </div>
</div>
</main>
<?php include_once'footer.php'; ?>
