<?php
require 'init.php';
include 'header.php';
if(logged_in() === false){
	if(empty($_POST) == false){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(empty($username) == true || empty($password) == true)
		{
			$errors[] = 'You need to enter a Username/Password.';
		}
		else if(user_exists($username) == false){
			$errors[] = 'We can\'t find that username. Have you registered?';
		}else if(user_active($username) == false){
			$errors[] = 'You haven\'t activated your account.';
		}
		else{
			if(strlen($password) > 32)
			{
				$errors[] = 'Password too long.';
			}
			$login = login($username,$password);
			if($login === false){
				$errors[] = 'That username/password combination is incorrect.';
			}
			else{
				$_SESSION['user_id'] = $login;
				$sql=mysql_query("SELECT * FROM read_score WHERE userid='$username'");
				if(mysql_num_rows($sql)==0){
					mysql_query("INSERT INTO `read_score` (`userid`) VALUES ( '".$username."')");
				}
				echo "<script>window.location.href='index.php';</script>";
				exit();
			}
		}
	}
	else{
		$errors[] = 'No data recieved.';
	}
	if(empty($errors) === false)
	{
		?>
		<center><h2 style='font-size:25px;color:#10696E;'>We tried to log you in, but...</h2></center>
		<?php
	}
	echo "<center><h2 style='font-size:18px;color:#10696E;'>";
	echo output_errors($errors);
	echo "</h2></center>";
}
include('body.php');
include('sidebar.php');
include 'footer.php';
?>
