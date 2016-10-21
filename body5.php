
<div class="content-bg">
<div class="wrap">
<div class="main">
<div class="content" id="content1">
			<form action="edit.php" method="post">
	<h2 style="color:#FFF;"><center><?php echo $user_data['username']."'s profile";?></center></h2></center>
	<div id="changebar" class="changebar" style="margin:10px;margin-bottom:20px;color:#10696E;">
	<div class="leftchange" style="float:left;"><a href="" onclick="return loadeditprof();">Edit Profile</a></div>
	<div class="rightchange" style="float:right;"><a href="" onclick="return loadchangepass();">Change Password</a></div>
</div>
		<?php
		if(empty($_POST) == false)
			{
				$required_fields = array('first_name','last_name','gender','year','class');
				foreach($_POST as $key => $value)
					{
						if(empty($value) && in_array($key , $required_fields) === true)
						{
							$errors[] = 'All fields are mandatory.';
							break 1;
						}
					}
			}
			if(empty($errors) === true && empty($_POST) === false)
			{
			?>
			<center><br><div style="color:#10696E;font-size:20px;background: none repeat scroll 0px 0px #EEF0F1;border: 1px solid #D4D0D0;border-radius:5px;width:70%;margin-top:8px;margin-bottom:20px;">
			<?php
					$first_name 	= $_POST['first_name'];
					$last_name 	= $_POST['last_name'];
					$gender 	= $_POST['gender'];
					$year 	= $_POST['year'];
					$branch 	= $_POST['branch'];
					$classofuser 	= $_POST['class'];
				if (change_profile($first_name,$last_name,$gender,$year,$branch,$classofuser,$_SESSION['user_id']) === true)
					echo "Your account has been updated.";
				else
					echo "Some problem occured";
				
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
		?><br>
	<center><div id="profcontent" style="background: none repeat scroll 0px 0px #EEF0F1;border: 1px solid #D4D0D0;border-radius:5px;width:70%;margin-top:8px;margin-bottom:20px;">
		<center><br>
		<table>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Firstname*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="first_name" value="<?php if($user_data['first_name']!='') echo $user_data['first_name'];?>" size="50" placeholder="<?php if($user_data['first_name'] !='') echo $user_data['first_name'];else echo "Provide your firstname"; ?>" ></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Lastname*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="last_name" size="50" value="<?php if($user_data['last_name']!='') echo $user_data['last_name'];?>" placeholder="<?php if($user_data['last_name'] !='') echo $user_data['last_name'];else echo "Provide lastname"; ?>"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Gender*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="gender" size="50" placeholder="<?php if($user_data['gender'] !='') echo $user_data['gender'];else echo "Ex: M"; ?>" value="<?php if($user_data['gender']!='') echo $user_data['gender'];?>" ></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Year*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="year" size="50" placeholder="<?php if($user_data['year'] !='') echo $user_data['year'];else echo "Ex: E3"; ?>" value="<?php if($user_data['year']!='') echo $user_data['year'];?>"></td>
		</tr>
		<tr>
			<td><br></td
		</tr>
		<tr>
			<td>Branch(optional)</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="branch" size="50" placeholder="<?php if($user_data['branch'] !='') echo $user_data['branch'];else echo "Ex: CSE"; ?>" value="<?php if($user_data['branch']!='') echo $user_data['branch'];?>"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td>Class*</td><td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </td><td><input type="text" name="class" size="50" value="<?php if($user_data['class']!='') echo $user_data['class'];?>" placeholder="<?php if($user_data['class'] !='') echo $user_data['class'];else echo "Ex: SF-9"; ?>"></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
	</table>
	<input type="submit" value="Update" style="margin-bottom:7px; width:74%;height:7%;background: linear-gradient(to bottom, #0BA3AD 0%, #0C9FA8 19%, #10696E 100%) repeat scroll 0% 0% transparent;padding: 1%;border-radius: 5px;margin-top: 7px;text-align: center;color:#FFF;font-weight:bold;">
</form>
</div>
</div>
