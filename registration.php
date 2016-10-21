<?php
include 'init.php';
include 'header.php';
if(empty($_POST) === false)
		{
			$required_fields = array('username','password','cpassword');
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
				if(strlen($_POST['password']) < 5)
				{
					$errors[] = 'Your password must be atleast 5 characters.';
				}
				if($_POST['password'] != $_POST['cpassword'])
				{
					$errors[] = 'Your passwords does not match.';
				}
			}
			if(empty($errors) === true && empty($_POST) === false)
			{
				$email = $_POST['username']."@nuz.rgukt.in";
				$register_data = array(
					'username' 		=> $_POST['username'],
					'email' 		=> $email,
					'password' 		=> $_POST['password']
				);
				if (register_user($register_data) == true)
				{
					echo "<center><h2 style='font-size:18px;color:#10696E;'>";
					echo "You have successfully registered. Please login...";
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
