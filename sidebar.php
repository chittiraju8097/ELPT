
 <div class="sidebar ">
<div class="sidebar-list">
	<?php
	if(logged_in() == false){
		?>			
				<div class="log_body">
					<span class="na" style="width:93%;font-weight:700;font-size:18px;height:25px;font-weight:normal;">Login</span>
						<div style="border:1px solid #4C689C;">
							<div class="log_body1">
								<p style="font-weight:500;color:#4C689C;margin-top:30px;">Please log in to use this tool</p>
								<form action="login.php" method="post">
									<p class="usr_na">
										<span class="na">Userid</span>
										<input class="log_inp" id="username" tabindex="50" class="form-control" type="text" name="username" title="Enter your id" placeholder="Enter your ID" autofocus=""></input>
									</p>
									<p class="usr_p">
										<span class="na">Password</span>
										<input class="log_inp" id="password" tabindex="50" class="form-control" type="password" name="password" title="Enter your password" placeholder="Enter password"></input>
									</p>
									
									<div class="clearfix">
										<button class="log_b" type="submit" onmouseover="return ch_but();">Login</button>
										<span class="nap" onclick="return load_rege();">Register here</span><br>
										<span class="nap" onclick="return loadforgot();" style="margin-top:10px;margin-left:33%;">Forgot password?</span>
									</div>
									<br><br>
								</form>
							</div>
					</div>
				</div>
				<div class="reg_body" style="text-align:left;display:none">
					<span class="na" style="width:93%;font-size:18px;height:25px;font-weight:normal;text-align:center;">Registration</span>
					<div style="border:1px solid #4C689C;">
					<div class="reg_body1">
								<p style="font-weight:500;color:#4C689C;margin-top:30px;">Please register in to use this tool</p>
								<form action="registration.php" method="post">
									<p class="usr_na">
										<span class="na">Userid</span>
										<input class="log_inp" id="username" tabindex="50" class="form-control" type="text" name="username" title="Enter your id" placeholder="Enter your ID" autofocus=""></input>
									</p>
									<p class="usr_p">
										<span class="na">Password</span>
										<input class="log_inp" id="password" tabindex="50" class="form-control" type="password" name="password" title="Enter your password" placeholder="Enter password"></input>
									</p>
									<p class="usr_p">
										<span class="na">Confirm Password</span>
										<input class="log_inp" id="password" tabindex="50" class="form-control" type="password" name="cpassword" title="Enter your password again" placeholder="Enter password"></input>
									</p>
									<div class="clearfix">
										<button class="log_b" type="submit" onmouseover="return ch_but();">Register</button>
										<span class="nap" onclick="return load_logi();">Back to login form</span><br>
									</div>
									<br><br>
								</form>
							</div>
					</div>
				</div>
				<div class="forg_body" style="text-align:left;display:none">
					<span class="na" style="width:93%;font-size:18px;height:25px;font-weight:normal;text-align:center;">Forgot Password</span>
					<div style="border:1px solid #4C689C;">
					<div class="forg_body1" style="margin-top:40px;">
								<form action="forgot.php" method="post">
									<p class="usr_na">
										<span class="na">Userid</span>
										<input class="log_inp" id="username" tabindex="50" class="form-control" type="text" name="fusername" title="Enter your id" placeholder="Enter your ID" autofocus=""></input>
									</p>
									<p class="usr_p">
										<span class="na">Password</span>
										<input class="log_inp" id="password" tabindex="50" class="form-control" type="password" name="fpassword" title="Enter your password" placeholder="Enter password"></input>
									</p>
									<p class="usr_p">
										<span class="na">Confirm Password</span>
										<input class="log_inp" id="password" tabindex="50" class="form-control" type="password" name="fcpassword" title="Enter your password again" placeholder="Enter password"></input>
									</p>
									<div class="clearfix">
										<button class="log_b" type="submit" onmouseover="return ch_but();">Continue</button>
										<span class="nap" onclick="return load_logi();">Back to login form</span><br>
										<span class="nap" onclick="return load_rege();" style="margin-top:10px;margin-left:33%;">Register here</span><br>
									</div>
									<br><br>
								</form>
							</div>
						</div>
					</div>
	<?php
	}
	else{
		include 'loggedin.php';
	}
	
	?>
</div>
</div>

<div class="clear"></div>
<script>
	function ch_but(){
		$('.log_b').css('border','1px solid #4C689C');
		return false;
	}
</script>
<style>
	.clearfix:before, .clearfix:after {
		content: " ";
		display: block;
		overflow: hidden;
		visibility: hidden;
		width: 0px;
		height: 0px;
	}
	.log_b{
		line-height: 25px;
		text-transform: uppercase;
		width: 100px;
		padding-bottom:20px;
		text-align: center;
		color: #FFF;
		border: 0px none;
		margin: 0px;
		font-weight: 700;
		font-size: 15px;
		display: block;
		position: relative;
		height: 40px;
		z-index: 20000;
		cursor: pointer;
		outline: medium none;
		background-color: #002873 !important;
		float: left !important;
		text-rendering: optimizelegibility !important;
	}
	.log_inp{
			color: #002873;
			height: 40px;
			line-height: 40px !important;
			padding: 0px 20px;
			display: block;
			font-size: 15px;
			font-weight: 500;
			width:200px;
			background-color: #FFF !important;
			border: 1px solid #4C689C !important;
			clear: both;
		}
	.log_body1,.reg_body1,.forg_body1{
		padding: 20px 0px;
		padding-left:20px;
		padding-right:20px;
		position: relative;
		text-align: left;
	}
	.log_body,.reg_body,.forg_body{
		margin-top:40%;
	}
	.user_na{
		margin-bottom: 20px !important;
		margin-top: 20px !important;
	}
	.na{
		display: block;
		background-color: #4C689C;
		color: #FFF;
		float: left;
		padding: 2px 10px;
		font-weight: 700;
		font-size: 12px;
		text-transform: uppercase;
	}
	.nap{
		display: block;
		background-color: #FFF;
		color: #4C689C;
		float:right;
		padding: 2px 10px;
		font-weight: 700;
		font-size: 12px;
		text-transform: uppercase;
	}
	.nap:hover{
		cursor:pointer;
	}
	.user_p{
		margin-bottom: 20px !important;
	}
</style>
</div>
</div>
</div>
