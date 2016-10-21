<?php
include('../init.php');
if(logged_in()==true){
	if(has_access($session_user_id,1) || (has_access($session_user_id,2))){
		if(isset($_GET['reply'])){
			$reply = $_GET['reply'];
			$to = $_GET['user'];
			$question = sanitize($question);
			$ip = $_SERVER['REMOTE_ADDR'];
			$result = mysql_query("UPDATE `queries` SET `answer`='$reply',`status`=1 WHERE `s.no`=$to");
			echo "<center><p style='color:#10696E;'>You have successfully submitted your Question...</p></center>";
		}
		else{
			echo "<script>alert('failed');</script>";
		}
	}
	else{
		echo "Sorry...You are not allowed to give replies...";
	}
}
else{
	echo "Sorry...You are not logged in...";
}
?>
