<?php
include("init.php");
if(isset($_GET['word']))
	{
		$word=mysql_real_escape_string($_GET['word']);
		echo "<h3 style=\"color:white;align:center;font-size:21px;\">Meanings of \"".$word."\"</h3><br>";
		$result=mysql_query("SELECT * from `entries` WHERE `word`='".$word."'");
		$check=1;
		while($row=mysql_fetch_array($result))
			{
				echo "<article class='uk-comment'><header class='uk-comment-header'><div style='font-family:Times New Roman'>".$row['definition']."</div></header></article>\n";
				$check=0;
			}
		if ($check)
		{
			echo "<h3 style=\"color:white;align:center;\">No Meanings Found</h2>";
		}
	}
?>
