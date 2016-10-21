<?php
include('../init.php');
if(isset($_GET['file'])){
	$file = $_GET['file'];
	$text = $_GET['text'];
	if(mysql_query("UPDATE `video_desc` SET `content`='$text' WHERE `name`='$file'"))
		echo "Subtitles has been updated...";
}
else{
	echo "Something went wrong....";
}
?>
