
<div class="content-bg">
<div class="wrap">
<div class="main">
<div class="content" id="content1">
			<form action="registration.php" method="post">
	<h2 style="color:#FFF;"><center>Registration Page</center></h2>
		<?php
		if(empty($_POST) === false)
		{
			$required_fields = array('username','first_name','password','cpassword','email');
			foreach($_POST as $key => $value)
			{
				if(empty($value) && in_array($key , $required_fields) === true)
				{
					$errors[] = 'Fields marked with an asterik are required.';
					break 1;
				}
			}
			if(empty($errors) === true)
			{
				if(user_exists($_POST['username']) == true)
				{
					$errors[] = 'Sorry, the username \''.$_POST['username'].'\' already taken.';
				}
				if(preg_match("/\\s/" , $_POST['username']) == true)
				{
					$errors[] = 'Your username must not contain any spaces.';
				}
				if(strlen($_POST['password']) < 6)
				{
					$errors[] = 'Your password must be atleast 6 characters.';
				}
				if($_POST['password'] != $_POST['cpassword'])
				{
					$errors[] = 'Your passwords does not match.';
				}
				if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL) === false)
				{
					$errors[] = 'Valid Emailaddress is required';
				}
				if(email_exists($_POST['email']) == true)
				{
					$errors[] = 'Sorry, the Emailaddress \''.$_POST['email'].'\' is already in use.';
				}
			}
			if(empty($errors) === true && empty($_POST) === false)
			{
			?>
			<center><br><div style="color:#10696E;font-size:20px;background: none repeat scroll 0px 0px #EEF0F1;border: 1px solid #D4D0D0;border-radius:5px;width:70%;margin-top:8px;margin-bottom:20px;">
			<?php
				$register_data = array(
					'username' 		=> $_POST['username'],
					'first_name' 	=> $_POST['first_name'],
					'last_name' 	=> $_POST['last_name'],
					'email' 		=> $_POST['email'],
					'password' 		=> $_POST['password'],
					'email_code'	=> md5($_POST['username']+microtime())
				);
				if (register_user($register_data) == true)
					echo "You have successfully registered, Please check your email to activate your account.";
				
			?>
			</div></center>
			<?php
			}
			else if(empty($errors) === false){
			?>
			<center><br><div style="color:#10696E;font-size:20px;background: none repeat scroll 0px 0px #EEF0F1;border: 1px solid #D4D0D0;border-radius:5px;width:70%;margin-top:8px;margin-bottom:20px;">
			<?php
				// register the user
				
				echo output_errors($errors);
			?>
			</div></center>
			<?php
			}
		}
		?>
	<center><div style="background: none repeat scroll 0px 0px #EEF0F1;border: 1px solid #D4D0D0;border-radius:5px;width:70%;margin-top:8px;margin-bottom:20px;">
		<table>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Firstname*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="first_name" size="50" placeholder="Provide your Firstname"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Lastname</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="last_name" size="50" placeholder="Provide your Lastname"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Username*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="username" size="50" placeholder="Ex : N110080"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Password*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="password" name="password" size="50" placeholder="Provide your Password"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Password Again*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="password" name="cpassword" size="50" placeholder="Provide your Password again"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Email Address*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="email" size="50" placeholder="Ex : N110080@nuz.rgukt.in"></td>
		</tr>
		
		<tr>
			<td><br></td>
		</tr>

	</table>
	<input type="submit" value="Register" style="margin-bottom:7px; width:74%;height:5%;background: linear-gradient(to bottom, #0BA3AD 0%, #0C9FA8 19%, #10696E 100%) repeat scroll 0% 0% transparent;padding: 1%;border-radius: 5px;margin-top: 7px;text-align: center;color:#FFF;font-weight:bold;">
	</div>
</form>


</div>
