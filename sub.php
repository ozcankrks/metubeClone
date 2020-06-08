<?php 
include 'connect.php';
$channel_id = $_POST["channel"];
$user = $_POST["user"];
echo $channel_id;
echo $user;
$subSet = mysql_query("INSERT INTO sublist (channel_id,user_id,stats) VALUES ('".$channel_id."','".$user."',1)");
if ($subSet) {
	echo "string";
}
 ?>