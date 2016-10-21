<?php
include('init.php');
if(logged_in()==true){
	if(isset($_GET['file'])){
		$text1 = $_GET['text'];
		$file = $_GET['file'];
		$score = $_GET['score'];
		$name = $user_data['username'];
		$date=$_GET['date'];
		$file = sanitize($file);
		$score = sanitize($score);
		$date = sanitize($date);
		$query = mysql_query("SELECT `content` from `audio_desc` where `name`='$file'");
		if($row = mysql_fetch_array($query))
		  {
				$text2 = $row['content'];
				$text2 = sentence_case($text2);
				if($text2[strlen($text2)-1]!='.'){
					$text2 = $text2.'.';
				}
				similar_text($text1,$text2,$percent);
				if(score_exists($name,$file)===false){
					mysql_query("INSERT INTO `audio`(`userid`, `audio_name`,`entered_text`,`score`,`date`) VALUES ('$name','$file','$text1','$percent','$date')");
					$r=mysql_query("select `score` from `audio` where `userid`='$name' and `audio_name`='$file'");
					$max=0;
					$sum=0;
					$cou=0;
					while($row=mysql_fetch_array($r)){
						if($row['score']>$max)
							$max=$row['score'];
						$cou=$cou+1;
						$sum=$sum+$row['score'];
					}
					$avg=$sum/$cou;
					$avg=(int)$avg;
					$percent = (int)$percent;
					echo "<table class='result_table'>";
					echo "<tr><td class='re_tab_td' style='padding:10px;min-width:35%;border:1px solid white;border-collapse:collapse;'>Your written text </td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'> $text1</td></tr>";
					echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>Number of attempts </td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>$cou</td></tr>";
					echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>Current Score </td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>$percent %</td></tr>";
					echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>Max Score </td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>$max %</td></tr>";
					echo "<tr><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'>Average Score</td><td class='re_tab_td' style='padding:10px;border:1px solid white;border-collapse:collapse;'> $avg %</td></tr>";
					echo "</table><br>";
					if(strcmp($text1,$text2)!=0){
						echo "<h3 style='float:left;color:yellow;'>Mistakes:</h3><br>";
						$lenstr1 = strlen($text1);
						$lenstr2 = strlen($text2);
						$min = $lenstr1;
						$max = $lenstr1;
						if($lenstr2<$min)
							$min = $lenstr2;
						if($lenstr2>$max)
							$max = $lenstr2;
						$tempstr = sentence_case($text1);
						echo "<div style='text-align:left;'></div>";
						if($tempstr[0]!=$text1[0]){
							echo "<p style='text-align:left;padding-left:10px;'> *) First letter of the sentece should be capital.</p>";
						}
						if($text1[$lenstr1-1]!='.'){
							echo "<p style='text-align:left;padding-left:10px;'> *) Every sentence should end with full-stop.</p>";
						}
						if(strcmp($tempstr,$text1)!=0){
							echo "<p style='text-align:left;padding-left:10px;'> *) The original syntax of your text : <font color='yellow'>$tempstr</font></p>";
						}
						$inc=0;
						$resstr="";
						while($inc<$min){
							if($text1[$inc]==$text2[$inc]){
								$resstr.=$text1[$inc];
								$inc++;
							}
							else
								break;
						}
						$cou=$inc;
						if($inc>=0 && $inc<$lenstr2){
							echo "<p style='text-align:left;padding-left:10px;'> *) $resstr";
							while($inc<$lenstr1){
								echo "<del style='color:yellow'>$text1[$inc]</del>";
								$inc++;
							}
							echo "</p><br>";
						}
						if($inc==$lenstr2 && $inc<$lenstr1){
							echo "<p style='text-align:left;padding-left:10px;'> *) Your text is correct. But you have written extra.</p>";
						}
						echo "<h3 style='float:left;color:yellow;'>Hints:</h3><br>";
						if($cou>=0 && $cou<$lenstr2){
							echo "<p style='text-align:left;padding-left:10px;'> *) Next correct letter is : \"$text2[$cou]\"</p>";
						}
						echo "</div>";
					}
				}
				else{
					if(mysql_query("INSERT INTO `audio`(`userid`, `audio_name`,`entered_text`,`score`,`date`) VALUES ('$name','$file','$text1','$percent','$date')")){
						echo "Thank you";
					}
					else{
						echo "<p style='position:relative;top:40%;'>Sorry...Problem occured..Try again..</p>";
					}
			}
		  }
	}
	else{
		echo "failed";
	}
}
else{
	echo "Sorry...You are not logged in....";
}
?>
