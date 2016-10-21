<?php
include('../init.php');
if(logged_in() === true){
	if(isset($_GET['feedback'])){
		$mydate=getdate(date("U"));
		$date = $mydate['mday'].'/'.$mydate['mon'].'/'.$mydate['year'];
		$question = $_GET['feedback'];
		$question= sanitize($question);
		$user = $user_data['username'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$result = mysql_query("INSERT INTO `pqueries`(`userid`, `question`,`ip`,`date`) VALUES ('$user','$question','$ip','$date')");
		echo "<center><p style='color:#10696E;'>You have successfully submitted your Question...</p></center>";
	}
}
else{
	echo "<script>alert('got');</script>";
}
?>
