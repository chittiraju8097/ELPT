<?php
include('init.php');
if(logged_in()==true){
	if(isset($_GET['text'])){
		$text1 = $_GET['text'];
		$file = $_GET['file'];
		$score = $_GET['score'];
		$query = mysql_query("SELECT `content` from `video_desc` where `name`='$file'");
		if($row = mysql_fetch_array($query))
		  {
				$text2 = $row['content'];
				similar_text($text1,$text2,$percent);
				$_SESSION['score']=$percent;
				echo $percent;
		  }
	}
}
else{
	echo "Sorry...You are not logged in...";
}
?>
