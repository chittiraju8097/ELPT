<?php
include 'init.php';
include 'header.php';
if(empty($_POST) === false)
		{
			$required_fields = array('fusername','fpassword','fcpassword');
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
				if(user_exists($_POST['fusername']) == false)
				{
					$errors[] = 'Sorry, the username \''.$_POST['fusername'].'\' doesn\'t exists.';
				}
				if(strlen($_POST['fpassword']) < 5)
				{
					$errors[] = 'Your password must be atleast 5 characters.';
				}
				if($_POST['fpassword'] != $_POST['fcpassword'])
				{
					$errors[] = 'Your passwords does not match.';
				}
			}
			if(empty($errors) === true && empty($_POST) === false)
			{
				$email = $_POST['fusername']."@nuz.rgukt.in";
				$register_data = array(
					'npassword' 	=> $_POST['fpassword'],
				);
				if (change_password($register_data,$_POST['fusername']) == true)
				{
					echo "<center><h2 style='font-size:18px;color:#10696E;'>";
					echo "Your password successfully changed. Please login...";
					echo "</h2></center>";
				}
				else{
					echo "<center><h2 style='font-size:18px;color:#10696E;'>";
					echo "failed";
					echo "</h2></center>";
				}
			}
		}
	?>
	<?php
echo "<center><h2 style='font-size:18px;color:#10696E;'>";
echo output_errors($errors);
echo "</h2></center>";
include('body.php');
include('sidebar.php');
include 'footer.php';
?>
