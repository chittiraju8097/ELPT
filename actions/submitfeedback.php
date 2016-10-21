<?php
include('../init.php');
if(logged_in()==true){
	if(isset($_GET['feedback'])){
		$date=time();
		$date =date("d/m/Y",$date);
		$question = $_GET['feedback'];
		$user = $user_data['username'];
		$question = sanitize($question);
		$ip = $_SERVER['REMOTE_ADDR'];
		$result = mysql_query("INSERT INTO `queries`(`userid`, `question`,`ip`,`date`) VALUES ('$user','$question','$ip','$date')");
		echo "<center><p style='color:#10696E;'>You have successfully submitted your Question...</p></center>";
	}
}
else{
	echo "Sorry...You are not logged in...";
}
?>
