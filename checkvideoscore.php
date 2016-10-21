<?php
include('init.php');
if(isset($_GET['file'])){
	$file = $_GET['file'];
	if(logged_in() === true)
	{
		$name = $user_data['username'];
		if(score_exists($name,$file) === true)
			echo "success";
		else
			echo "fail";
	}
}
?>
