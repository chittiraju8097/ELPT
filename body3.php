
<div class="content-bg">
<div class="wrap">
<div class="main">
<div class="content" id="content1">
			<form action="change.php" method="post">
	<h2 style="color:#FFF;"><center><?php echo $user_data['username']."'s profile";?></center></h2></center>
	<div id="changebar" class="changebar" style="margin:10px;margin-bottom:20px;color:#10696E;">
	<div class="leftchange" style="float:left;"><a href="" onclick="return loadeditprof();">Edit Profile</a></div>
	<div class="rightchange" style="float:right;"><a href="" onclick="return loadchangepass();">Change Password</a></div>
</div>
		<?php
		if(empty($_POST) == false)
			{
				$required_fields = array('cpassword','npassword','cnpassword');
				foreach($_POST as $key => $value)
					{
						if(empty($value) && in_array($key , $required_fields) === true)
						{
							$errors[] = 'Fields marked with an asterik are required.';
							break 1;
						}
					}
				if(md5($_POST['cpassword']) === $user_data['password'])
				{
					if(trim($_POST['npassword']) !== trim($_POST['cnpassword']))
					{
						$errors[] = 'Your passwords does not match.';
					}
					else if(strlen($_POST['npassword']) < 5) 
					{
						$errors[] = 'Your password must be atleast 5 characters.';
					}
				}
				else{
					$errors[] = 'Your current password is incorrect';
				}
			}
			if(empty($errors) === true && empty($_POST) === false)
			{
			?>
			<center><br><div style="color:#10696E;font-size:20px;background: none repeat scroll 0px 0px #EEF0F1;border: 1px solid #D4D0D0;border-radius:5px;width:70%;margin-top:8px;margin-bottom:20px;">
			<?php
				$register_data = array(
					'npassword' 	=> $_POST['npassword'],
				);
				if (change_password($register_data,$_SESSION['user_id']) == true)
					echo "Password successfully changed.";
				
			?>
			</div></center>
			<?php
			}
			else if(empty($errors) === false){
			?>
			<center><br><div id="error_bar" style="color:#10696E;font-size:20px;background: none repeat scroll 0px 0px #EEF0F1;border: 1px solid #D4D0D0;border-radius:5px;width:70%;margin-top:8px;margin-bottom:20px;">
			<?php
				// register the user
				
				echo output_errors($errors);
			?>
			</div></center>
			<?php
			}
		?>
	<center><div id="profcontent" style="background: none repeat scroll 0px 0px #EEF0F1;border: 1px solid #D4D0D0;border-radius:5px;width:70%;margin-top:8px;margin-bottom:20px;">
		<table>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Current Password*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="password" name="cpassword" size="50" placeholder="Provide your Current password"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>New Password*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="password" name="npassword" size="50" placeholder="Provide your New password"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Confirm new password*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="password" name="cnpassword" size="50" placeholder="Provide your Username"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>

	</table>
	<input type="submit" value="Change your Password" style="margin-bottom:7px; width:74%;height:5%;background: linear-gradient(to bottom, #0BA3AD 0%, #0C9FA8 19%, #10696E 100%) repeat scroll 0% 0% transparent;padding: 1%;border-radius: 5px;margin-top: 7px;text-align: center;color:#FFF;font-weight:bold;">
	</div>
</form>
</div>
