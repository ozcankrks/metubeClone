<?php 
include 'connect.php';
$channel_id = $_POST["videoid"];
$user = $_POST["user"];


$likesorgu = mysql_query("select * from reaction where video_id like '".$channel_id."' and user_id like '".$user."' ");
$likevarmi = mysql_num_rows($likesorgu);
if ($likevarmi < 1) {
	$subSet = mysql_query("INSERT INTO reaction (video_id,user_id,stats) VALUES ('".$channel_id."','".$user."',1)");
	if ($subSet) {
		#echo "bu videoyu Beğeniyorsunuz";
	}
}else{
	$sqlguncelle = mysql_query("UPDATE reaction SET stats = 1 WHERE video_id like '".$channel_id."' and user_id like '".$user."' ");
	#echo "sd";
}




 ?>