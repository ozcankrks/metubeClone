<?php 
include 'connect.php';
$channel_id = $_POST["videoid"];
$user = $_POST["user"];


$likesorgu = mysql_query("select * from reaction where video_id like '".$channel_id."' and user_id like '".$user."' ");
$likevarmi = mysql_num_rows($likesorgu);
if ($likevarmi < 1) {
	$subSet = mysql_query("INSERT INTO reaction (video_id,user_id,stats) VALUES ('".$channel_id."','".$user."',0)");
	if ($subSet) {
		#echo "bu videoyu Beğenmiyorsunuz";
	}
}else{
	$sqlguncelle = mysql_query("UPDATE reaction SET stats = 0 WHERE video_id like '".$channel_id."' and user_id like '".$user."' ");
	#echo "ARtık Beğenmiyorsunuz";
}




 ?>