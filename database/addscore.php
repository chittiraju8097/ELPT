<?php
include('../init.php');
if(logged_in()==true){
	if(isset($_SESSION['score']))
		$score=$_SESSION['score'];
	else
		$score=0;
	if(isset($_GET['file'])){
		$file = $_GET['file'];
		$text = $_GET['text'];
		$date = $_GET['date'];
		$name = $user_data['username'];
		$file=sanitize($file);
		$score=sanitize($score);
		$text=sanitize($text);
		$time = date("H:i:s");
		$time2 = "03:30:00";
		$secs = strtotime($time2)-strtotime("00:00:00");
		$date = date("m/d/Y H:i:s",strtotime($time)+$secs);
		if(score_exists($name,$file)===false){
			mysql_query("INSERT INTO `video`(`userid`, `video_name`,`entered_text`,`score`,`date`) VALUES ('$name','$file','$text','$score','$date')");
			echo "<p style='position:relative;top:40%;'>You have successfully completed....Go for another one...</p>";
		}
		else{
			if(mysql_query("INSERT INTO `video`(`userid`, `video_name`,`entered_text`,`score`,`date`) VALUES ('$name','$file','$text','$score','$date')")){
				$r=mysql_query("select `score` from `video` where `userid`='$name' and `video_name`='$file'");
				$count = mysql_num_rows($r);
				$max=0;
				$sum=0;
				while($row=mysql_fetch_array($r)){
					$sum = $sum + $row['score'];
					if($row['score']>$max)
						$max = $row['score'];
				}
				$avg = $sum / $count;
				$score = (int)$score;
				$avg = (int)$avg;
				$temp = sentence_case($text);
				$file_name="";
				$res = mysql_query("select `title` from `video_desc` where name='$file'");
				while($row=mysql_fetch_array($res))
					$file_name=$row['title'];
				echo "<br>";
				echo "<table class='result_table'>";
				echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>File name </td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>$file_name</td></tr>";
				echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>Number of attempts </td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>$count</td></tr>";
				echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>Current Score </td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>$score %</td></tr>";
				echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>Max Score </td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>$max %</td></tr>";
				echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>Average Score</td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'> $avg %</td></tr>";
				echo "</table><br>";
			}
			else{
				echo "<p style='position:relative;top:40%;'>Score is not updated</p>";
			}
		}
	}
}
else{
	echo "Sorry...You are not logged in...";
}
?>
