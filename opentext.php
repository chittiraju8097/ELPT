<?php
if(isset($_GET['file']) && isset($_GET['dir']))
{
	$file = $_GET['file'];
	$dir	= $_GET['dir'];
	$value = $dir."/".$file;
	$fileo = fopen("$value","r");
	$file = $file - '.txt';
	echo "<br><h3 style='font-size:25px;text-align:center;color:#10696E;'>$file</h3><hr>";
	$file = $file + '.txt';
	while(!feof($fileo))
	{
		echo "<br><p  style='white-space: normal;width:100%;color:#10696E;display:inline;font-size:15px;margin:2% 2% 2% 2%;auto-scroll:default;'>".fgets($fileo)."</p>";
	}
}
else
?>
