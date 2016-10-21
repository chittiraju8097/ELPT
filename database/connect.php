<?php
$error = 'Sorry we are experiencing connection problems.';
mysql_connect('localhost','root','rgukt123') or die($error);
mysql_select_db('english') or die($error);
?>
