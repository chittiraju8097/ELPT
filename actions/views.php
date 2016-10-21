<?php
include '../init.php';
if(logged_in()==true){
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$query = mysql_query("SELECT `views` FROM `notices` WHERE `s.no`='$id'");
		if($row=mysql_fetch_array($query)){
			$result = $row['views']+1;
			$query = mysql_query("UPDATE `notices` SET `views`=$result WHERE `s.no`='$id'");
			echo $result;
		}
	}
}
else{
	echo "Sorry..You are not logged in...";
}
?>
