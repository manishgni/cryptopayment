<?php include_once 'header.php' ?>
<style>
section.content-header {
    background-color: #e0e0e0;
    padding: 10px;
    font-size: 20px;
    margin: 21px 0px;
    border-radius: 10px;
}
.active-box {
    background: #36a8db;
    color: #fff;
    box-shadow: 0px 0px 6px rgb(0 149 215);
}

.active-head{
    background: #fff;
    color: #34a7db;
}
.active-head h4{
    margin: 0px;
    padding: 5px 0;
}
.active-box ul {
    padding: 0px;
    margin-top: 10px;
}
.active-box ul li {
    list-style: none;
    border-bottom: 1px #fff solid;
    padding: 9px 0;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 14px;
}
.active-btm a {
    background: #1e3d73;
}/*
.col-md-12.fund-tree span {
    display: inline-block;
    width: 20%;
}*/
.cal{

    display: inline-block;
}
.result-box{
    color: #ffffff;
    background: #38a8dc;
    display: block;
    max-width: 72px;
    margin: auto;
    font-size: 20px;
    margin-top: 10px;
    border-radius: 3px;
}
.doublez-box {
        background: linear-gradient(90deg, black, #3daadd);
        border: 0;  
        color: #fff;
    }
    .doublez-box h4{
        font-weight: bold;
        color: yellow;
        font-size: 33px;
        text-transform: uppercase;
    }
    .doublez-box h3 {
        font-size: 21px;
    }
    .doublez-box span {
        margin-top: 20px;
        text-transform: uppercase;
        font-weight: 600;
    }
    .doublez-round-box {
        display: inline-block;
        margin-right: 20px;
        margin-top: 30px;
    }
    .rounde-box {
    width: 110px;
    height: 110px;
    margin:0px 10px;
    border-radius: 50%;
    background:gray;
    display: flex;
    font-weight: bold;
    color: #fff;
    align-items: center;
    justify-content: center;
    font-size: 21px;
  
    margin-top: 20px;
}
li.rounde-box.active {
    background: #1e3d73;

}
li.rounde-box h6 {
    font-size: 14px;
    font-weight: bold;
}
.rounde-box a{
    color: #fff !important;
}
.gradient-active.active{
    background:#0000ff75!important;
}
h3#totalIDs span {
    font-size: 30px;
    color: #fff;
}
h3#totalIDs {
    justify-content: space-between;
    display: flex;
}
/*
 #triangle-up {
    width: 0;
    height: 0;
    border-left: 50px solid transparent;
    border-right: 50px solid transparent;
    border-bottom: 100px solid #32a6da;
}
div#triangle-up span {
    color: #fff;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    align-items: center;
    font-size: 24px;
    font-weight: bold;
    padding: 43px 0px;
}*/
    @media screen and (max-width: 400px){
        .doublez-round-box {
            margin-right: 3px;
        }
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
    <div class="container-fluid">
        <div class="main-content pt-4">
            <div class="page-content">
                
                    <section class="content-header">
                        <span>Pool Status</span>
                    </section>
                   
             
                <div class="card" style="display: none;">
                    <div class="card-body">
                        <div class="wizard-content tab-content">
                            <div class="tab-pane active show" id="tabFundRequestForm">
                                <div class="col-md-12 fund-tree">
                                    <?php
                                        // $i = 1;
                                        // foreach($users as $user):
                                        //     if(!empty($user['org'])){
                                        //         $orgCheck = orgCheck($user['org']);
                                        //         echo '<p><span>'.$i.'</span>';
                                        //         echo '<span>'.$orgCheck['newValue'][1].'</span>';
                                        //         echo '<span>'.$orgCheck['newValue'][2].'</span>';
                                        //         echo '<span>'.$orgCheck['newValue'][3].'</span></p>';
                                        //         $i++;
                                        //     }else{
                                        //         echo 'Inactive';
                                        //     }
                                        // endforeach; 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-body">
                    <div class="form">
                         <!-- <form action="<?php echo base_url('Dashboard/Network/')?>"method="get"> -->
            <select onchange="myLocations(this)" name="org" class="form-control d-inline-block w-auto">
                <?php for($i=1;$i<=10;$i++):?>
                <option value="<?php echo $i;?>" <?php echo (!empty($_GET['org']) &&$_GET['org'] == $i)?'selected ':'';?>>Pool <?php echo $i;?></option>
                <?php endfor;?>
            </select>
            <!-- <button class="btn btn-primary" type="submit">submit</button>  -->
        <!-- </form> -->

                    </div>
                    <div class="col-md-5 card card-body doublez-box text-center m-auto" >
                    <h4><?php echo $poolName;?></h4>
                    <span>Activation Counter</span>
                    <h3 id="totalIDs">0000000</h3>
                </div>
                <div class="col-md-10 m-auto text-center">
                    
                   <?php 
                        $totalPoolId1 = $totalUsers1['record']; 
                        $totalPoolId2 = $totalUsers2['record']; 
                        $totalPoolId3 = $totalUsers3['record']; 
                        //$roundArr = [1 => 1,1 => 2];
                        if(!empty($users)){ 
                            $i = 1; 
                            foreach($users as $user): //pr($user); 
                            if($user['position'] == 1){$plus = 1;}else{ $plus = (($user['position'])+($user['position']-1));}
                            $val = $user['position'] + $plus;
                            $newValue = [];
                            for($j=1;$j<=3;$j++){
                                $newValue[$j] = $val;
                                $val += 1;
                            }
                            if($user['org'] == 1){
                                $limit = $totalPoolId1;
                                $token1 = ($newValue[1] <= $totalPoolId1)?'rounde-box gradient-active active':'rounde-box';
                                $token2 = ($newValue[2] <= $totalPoolId1)?'rounde-box gradient-active active':'rounde-box';
                                $token3 = ($newValue[3] <= $totalPoolId1)?'rounde-box gradient-active active':'rounde-box';
                            }elseif($user['org'] == 2) {
                                $limit = $totalPoolId2;
                                $token1 = ($newValue[1] <= $totalPoolId2)?'rounde-box gradient-active active':'rounde-box';
                                $token2 = ($newValue[2] <= $totalPoolId2)?'rounde-box gradient-active active':'rounde-box';
                                $token3 = ($newValue[3] <= $totalPoolId2)?'rounde-box gradient-active active':'rounde-box';
                            }elseif($user['org'] == 3) {
                                $limit = $totalPoolId3;
                                $token1 = ($newValue[1] <= $totalPoolId3)?'rounde-box gradient-active active':'rounde-box';
                                $token2 = ($newValue[2] <= $totalPoolId3)?'rounde-box gradient-active active':'rounde-box';
                                $token3 = ($newValue[3] <= $totalPoolId3)?'rounde-box gradient-active active':'rounde-box';
                            }
                            if($newValue[3] > $limit){
                    ?>
                    <p>
                         <ul class="nav nav-list text-center m-auto" style="justify-content: center;">
                <li class="rounde-box active">
                    <a href="#">
                        <h6>Round</h6>
                        <div class="">
                           <span><?php echo $user['org'];?></span>
                        </div>
                    </a>
                </li>
                <li class="rounde-box gradient-active active">
                    <a href="#">
                         <h6>Your No.</h6>
                        <div class="">
                           <span><?php echo $user['position'];?></span>
                        </div>
                    </a>
                </li>
                <li class="<?php echo $token1;?>">
                    <a href="#">
                        <h6>Token No.1</h6>
                        <div class="">
                            <span><?php echo $newValue[1];?></span>
                        </div>
                    </a>
                </li>
                <li class="<?php echo $token2;?>">
                    <a href="#">
                        <h6>Token No.2</h6>
                        <div class="">
                           <span><?php echo $newValue[2];?></span>
                        </div>
                    </a>
                </li>
                <li class="<?php echo $token3;?>">
                    <a href="#">
                         <h6>Token No.3</h6>
                        <div class="">
                             <span><?php echo $newValue[3];?></span>
                        </div>
                    </a>
                </li>
               
            </ul>
                  
           
                  
                        </p>
                    <?php $i++; } endforeach; }else{ echo "You are not active in this club" ; }?>
                </div>
                </div>
                <div class="shape">
                    
                </div>
            </div>
        </div>
    </div>
</main>
<?php } ?>
<?php include_once 'footer.php'; ?>
<script>
    document.getElementById('totalIDs').innerHTML = "<?php echo '<span>R1-'.$totalPoolId1.'</span>  <span>R2-'.$totalPoolId2.'</span>  <span> R3-'.$totalPoolId3;?></span>";


    function myLocations(params) {
       var org = params.value;
       window.location.href = "<?php echo base_url('Dashboard/Network/?org='); ?>"+org;
    }
</script>
<script>
$(document).ready(function () {
    $('.nav li').click(function(e) {

        $('.nav li').removeClass('active');

        var $this = $(this);
        if (!$this.hasClass('active')) {
            $this.addClass('active');
        }
        //e.preventDefault();
    });
});
</script>