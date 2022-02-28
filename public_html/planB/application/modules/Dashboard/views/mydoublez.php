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
	.doublez-box {
	    background: linear-gradient(90deg, #059969, #3daadd);
	    border: 0;	
	    color: #fff;
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
	    width: 90px;
	    height: 90px;
	    border-radius: 50%;
	    background: #fff;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    font-size: 21px;
	    border: 1px #3ba9dc solid;
	    box-shadow: 0px 0px 10px rgb(55 168 219);
	}
	@media screen and (max-width: 400px){
		.doublez-round-box {
		    margin-right: 3px;
		}
	}
</style>

<main>
	<div class="container-fluid">
		<div class="main-content pt-2">
			<section class="content-header">
	            <span>My Doublez / Package 1 star</span>
	        </section>
			<div>
				<div class="form-group">
					<select class="form-control">
							<option>Star</option>
							<option>Star</option>
							<option>Star</option>
							<option>Star</option>
							<option>Star</option>
							<option>Star</option>
					</select>
				</div>
				<div class="col-md-5 card card-body doublez-box text-center m-auto"	>
					<h4>1 Star</h4>
					<span>Live Upgrade</span>
					<h3>0000000</h3>
				</div>
				<div class="col-md-6 m-auto text-center">
					<div class="doublez-round-box">
						<div class="rounde-box">
							<span>0000</span>
						</div>
					</div>
					<div class="doublez-round-box">
						<div class="rounde-box">
							<span>0000</span>
						</div>
					</div>
					<div class="doublez-round-box">
						<div class="rounde-box">
							<span>0000</span>
						</div>
					</div>
				</div>

				<div class="card card-body mt-5">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>S No.</th>
								<th>Amount</th>
								<th>From</th>
							</tr>
							<tr>
								<td>xx</td>
								<td>xx</td>
								<td>xx</td>
							</tr>
						</table>
					</div>
				</div>
				
				</div>


			</div>	
		</div>
	</div>
</main>






<?php 
	require_once 'footer.php'
;?>