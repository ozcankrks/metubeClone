<?php 
include 'connect.php';
$channel_id = $_POST["channel"];
$user = $_POST["user"];




$subSet = mysql_query("DELETE from sublist  where channel_id= '".$channel_id."' and user_id = '".$user."'");
if ($subSet) {
	echo "Abonelikten Çıktınız";
}
 ?>