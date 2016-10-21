<?php
include('../init.php');
if(logged_in()==true){
	if(has_access($session_user_id,1) || has_access($session_user_id,2)){ 
		if(isset($_GET['title']) && isset($_GET['notice'])){
			$mydate=getdate(date("U"));
			$date = $mydate['mday'].'/'.$mydate['mon'].'/'.$mydate['year'];
			$title = $_GET['title'];
			$notice = $_GET['notice'];
			$title = sanitize($title);
			$notice = sanitize($notice);
			$user = $user_data['username'];
			if(has_access($session_user_id,2))
				$user = 'Admin';
			if(has_access($session_user_id,1))
				$user = "Faculty";
			$ip = $_SERVER['REMOTE_ADDR'];
			$result = mysql_query("INSERT INTO `notices`(`title`, `notice`,`ip`,`date`,`posted_by`) VALUES ('$title','$notice','$ip','$date','$user')");
		}
		else{
			echo "<script>alert('not entered');</script>";
		}
	}
	else{
		echo "Sorry...You are not allowed to post notifications...";
	}
}
else{
	echo "Sorry...You are not logged in...";
}
?>
