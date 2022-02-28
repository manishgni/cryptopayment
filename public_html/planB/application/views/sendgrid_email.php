<!DOCTYPE html>
<html>
<head>
	<title><?php echo $info['title'];?></title>
	 <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	

 <style >
 	body{
 		padding: 0px;
 		margin: 0px;
 	}
 	.bg-dark{
 		background-color:#0000;
 	}
 	.img {
	    background: #fff;
	    border-radius: 4px;
	    display: inline-block;
	}
 	img{
 		width: 100%;
 	}
 	.card-body{
 		box-shadow: 0px 0px 19px 1px #DCDCDC;
 		margin-top: 70px;
 		border-radius: 15px;
 	}	
 	h3{
 		text-align: center;
 		margin-top: 10px;
 	}
 	
 	p{
 		padding: 0px;
 		white-space: pre;
 		word-wrap: break-word;
 	}
 	.mail-head h3 {
	}
	.mail-detail h3 {
	    
	}
 	
 </style>
</head>
<body>
	<div class="container">
		<div class="card-body bg-dark" style="background-color: #000;padding:50px 0px;">
			<div class="row" >
				<div class="col-md-12 " >
					<div class="text-center" style="text-align: center;">
					<div class="img">
						<img src="<?php echo base_url(logo); ?>" style="max-width: 200px;">
					</div>
					</div>
				</div>
				<div class="col-md-12 " >
					<div class="mail-head">
						<h3 style=" font-size: 18px;
	    color: #fff;
	    text-align: center;"><?php echo $info['title'];?></h3>
					</div>
				</div>	
				<div class="col-md-6 m-auto text-center" style="text-align:center;margin: 0px auto;">
					<div class="mail-content text-white" style="color: #fff;">Dear <?php echo $info['name'];?>,<br>
						<br>
						<?php echo $info['description'];?><br>
						<br>
					
					</div>
                    <div class="mt-0 mail-detail ">
                        <h3 style="color: #fff;"><?php echo $info['message'];?></h3>
                    </div>	
                    <div class="login-btn mt-4">
                    	<p class="text-white" style="color:white">Login Link: <a class="btn btn-primary" href="<?php echo base_url('Dashboard/User/MainLogin');?>">Click Here</a>
                    		</p>
                    </div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>