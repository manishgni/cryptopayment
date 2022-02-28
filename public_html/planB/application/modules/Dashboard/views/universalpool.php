<?php 
	require_once 'header.php'
;?>
<style>
	section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
h6.card-liner-subtitle.text-white {
    font-size:20px;
    text-transform: uppercase;
    font-weight: bold;
}
.pool-box {
    background: linear-gradient(to right, rgb(46 164 218) 0%, rgb(22 3 103) 100%);
    position: relative;
    border-radius: 5px 5px 0px 0px;
    border: 0;
}
.pool-icon-box {
    background: #fff;
    width: 64px;
    padding: 7px;
    border-radius: 6px;
    position: absolute;
    right: 15px;
}
.pool-box-sub-top {
    background: linear-gradient(to right, rgb(56 44 159) 0%, rgb(22 3 103) 100%);
    align-items: center;
    justify-content: space-between;
    display: flex;
    border-top: 2px #fff solid;
    padding: 5px 0px;
    border-radius: 0px 0px 5px 5px;
}
.pool-box-sub {
    width: 30%;
    display: inline-block;
    margin: auto;
    text-align: center;
}
.pool-box-sub h6, .pool-box-sub p {
    margin: 0px;
    color: #fff;
    padding: 1px;
}
.pool-box-sub h6 {
    font-size: 14px;
}
.pool-box-sub:nth-child(2) {
    border-right: 1px #ffffff52 solid;
    border-left: 1px #ffffff52 solid;
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

<!-- <div class="messageBox">
  <h1 id="construction">Coming Soon!</h1>
</div> -->

<?php  $none = 0; ?>
<?php if($none == 0){ ?>

<main>
	<div class="container-fluid site-width">
		<section class="content-header">
            <span>Universal Pool</span>
        </section>
        <div class="row">
              <div class="col-12 col-sm-6 col-md-4">
                            <div class="card card-body pool-box">
                                <h6 class="card-liner-subtitle text-white">Total Universal Privilege</h6>
                                <h2 class="card-liner-title text-white"><?php echo $total['total']; ?></h2>
                                <!-- <div class="pool-icon-box">
                                    <img src="<?php echo base_url('uploads/diamond5.png');?>" class="img-fluid">
                                </div> -->
                            </div>
                                <div class="pool-box-sub-top">
                                    <div class="pool-box-sub">
                                        <!-- <h6>Global Pool</h6>
                                        <p>xxxx</p> -->
                                    </div>
                                    <div class="pool-box-sub">
                                        <!-- <h6>All users</h6>
                                        <p><?php echo $platinum['ids']+$Challanger['ids']+$Mastersx['ids']+$GrandMaster['ids']; ?></p> -->
                                    </div>
                                    <div class="pool-box-sub">
                                        <!-- <h6>EST.Bouns</h6>
                                        <p>xxxx</p> -->
                                    </div>
                                </div>
                        </div>
        	 <div class="col-12 col-sm-6 col-md-4">
                            <div class="card card-body pool-box">
                                <h6 class="card-liner-subtitle text-white">Platinum</h6>
                                <h2 class="card-liner-title text-white"></h2>
                                <!-- <div class="pool-icon-box">
                                    <img src="<?php echo base_url('uploads/diamond1.png');?>" class="img-fluid">
                                </div> -->
                            </div>
                                <div class="pool-box-sub-top">
                                    <div class="pool-box-sub">
                                        <h6>Global Pool</h6>
                                        <p><?php echo $distribute; ?></p>
                                    </div>
                                    <div class="pool-box-sub">
                                        <h6>Users</h6>
                                        <p><?php echo $platinum['ids']?></p>
                                    </div>
                                    <div class="pool-box-sub">
                                        <h6>EST.Bouns</h6>
                                        <p><?php if($platinum['ids'] >0){ echo round($distribute/$platinum['ids'],3); }else{ echo '0'; } ?></p>
                                    </div>
                                </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="card card-body pool-box">
                                <h6 class="card-liner-subtitle text-white">Challanger</h6>
                                <h2 class="card-liner-title text-white"></h2>
                               <!--  <div class="pool-icon-box">
                                    <img src="<?php echo base_url('uploads/diamond2.png');?>" class="img-fluid">
                                </div> -->
                            </div>
                                <div class="pool-box-sub-top">
                                    <div class="pool-box-sub">
                                        <h6>Global Pool</h6>
                                        <p><?php echo $distribute; ?></p>
                                    </div>
                                    <div class="pool-box-sub">
                                        <h6>Users</h6>
                                        <p><?php echo $Challanger['ids']; ?></p>
                                    </div>
                                    <div class="pool-box-sub">
                                        <h6>EST.Bouns</h6>
                                        <p><?php if($Challanger['ids'] >0){ echo round($distribute/$Challanger['ids'],3); }else{ echo '0'; } ?></p>
                                    </div>
                                </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="card card-body pool-box">
                                <h6 class="card-liner-subtitle text-white">Master</h6>
                                <h2 class="card-liner-title text-white"></h2>
                               <!--  <div class="pool-icon-box">
                                    <img src="<?php echo base_url('uploads/diamond3.png');?>" class="img-fluid">
                                </div> -->
                            </div>
                                <div class="pool-box-sub-top">
                                    <div class="pool-box-sub">
                                        <h6>Global Pool</h6>
                                        <p><?php echo $distribute; ?></p>
                                    </div>
                                    <div class="pool-box-sub">
                                        <h6>Users</h6>
                                        <p><?php echo $Mastersx['ids'];?></p>
                                    </div>
                                    <div class="pool-box-sub">
                                        <h6>EST.Bouns</h6>
                                        <p><?php if($Mastersx['ids'] > 0){ echo round($distribute/$Mastersx['ids'],3); }else{ echo '0'; } ?></p>
                                    </div>
                                </div>
                        </div>
                         <div class="col-12 col-sm-6 col-md-4">
                            <div class="card card-body pool-box">
                                <h6 class="card-liner-subtitle text-white">Grand Master </h6>
                                <h2 class="card-liner-title text-white"></h2>
                               <!--  <div class="pool-icon-box">
                                    <img src="<?php echo base_url('uploads/diamond4.png');?>" class="img-fluid">
                                </div> -->
                            </div>
                                <div class="pool-box-sub-top">
                                    <div class="pool-box-sub">
                                        <h6>Global Pool</h6>
                                        <p><?php echo $distribute; ?></p>
                                    </div>
                                    <div class="pool-box-sub">
                                        <h6>Users</h6>
                                        <p><?php echo $GrandMaster['ids'];?></p>
                                    </div>
                                    <div class="pool-box-sub">
                                        <h6>EST.Bouns</h6>
                                        <p><?php if($GrandMaster['ids'] >0){ echo round($distribute/$GrandMaster['ids'],3); }else{ echo '0'; } ?></p>
                                    </div>
                                </div>
                        </div>
                        
        </div>
	</div>	
</main>
<?php } ?>


<?php 
	require_once 'footer.php'
;?>