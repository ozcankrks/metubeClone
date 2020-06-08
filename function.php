<?php 
include 'connect.php';
date_default_timezone_set('Europe/Istanbul');
if (isset($_POST['signup_submit'])) {
	

$username = $_POST["username"];
$email = $_POST["email"];
$password= $_POST["password"];
$img = "asddds.jpg";
$cover = "def.jpg";
$bugün = "Katılma Tarihi ".date("d-m-Y");
$varmi = mysql_query("SELECT * from user where user_email like '".$email."' ");
$VarmiSayac = mysql_num_rows($varmi);
echo $VarmiSayac;
if ($VarmiSayac < 1) {
	$sql = mysql_query("INSERT INTO user (user_username, user_email,user_password, user_subcount,user_profileimg,user_cover,user_story) VALUES ('".$username."', '".$email."', '".$password."',0,'".$img."','".$cover."','".$bugün."')");
	if ($sql) {
		echo "başarılı";
		header("location: signip.php");
	}
	else {
		echo "olmadı";
	}
}else{
	header("location: signup.php?stats=no");
}





}

if (isset($_POST["social-signin"])) {
	$email = $_POST["email"];
	$password= $_POST["password"];
	$sql_baglan= mysql_query("SELECT * FROM user WHERE user_email = '".$email."' and user_password = '".$password."' "); 
	$uye=mysql_num_rows($sql_baglan);
	session_start();
	echo $uye;
	if ($uye==1) {
		while ($vericekM = mysql_fetch_assoc($sql_baglan)) {
				$_SESSION['username'] = $vericekM["user_username"];    
		   		$_SESSION['email'] = $vericekM["user_email"];     
		   		$_SESSION['imgs'] = $vericekM["user_profileimg"]; 
		    	$_SESSION['id'] = $vericekM["user_id"];   
				$_SESSION['sub'] =$vericekM["user_subcount"];   
				$_SESSION['password'] = $password;
			
				
				}
		
		
		
		header("location: index.php");
	}
	elseif (uye==0) {
		header("location: signip.php?stats=no");
	}

}

if (isset($_POST["upload-btn"])) {
	session_start();date_default_timezone_set('Europe/Istanbul');
	echo "string";
	$VideoYukle = $_FILES['videoyolu']['name'];
	$VideoIframe = $_POST["videoframe"];
	$Checkbox = $_POST["select"];
	$VideoBaslik = $_POST["videotitle"];
	$VideoDesc = $_POST["videodesc"];
	$VideoCategory = $_POST["category"];
	$VideoDate = date('Y-m-d');
	$VideoImg = $_FILES['videoimg']['name'];
	$VideoUploader = $_SESSION["id"];
	

	$dizin = 'dosyalar/';
	$dizin2 = 'dosyalar/img/';
	if (isset($Checkbox)) {
		$kod =1;
	}
	elseif (!isset($Checkbox)) {
		$kod =0;
	}
	
	$yuklenecek_dosya2 = $dizin2 . basename($_FILES['videoimg']['name']);
	if (move_uploaded_file($_FILES['videoimg']['tmp_name'], $yuklenecek_dosya2))
		{
  	 
 
		} else {
		    echo "Dosya yüklenemedi!\n";
		}


	$yuklenecek_dosya = $dizin . basename($_FILES['videoyolu']['name']);
	if (isset($_FILES['videoyolu'])) {
		if (move_uploaded_file($_FILES['videoyolu']['tmp_name'], $yuklenecek_dosya))
		{
  	 
 
		} else {
		    echo "Dosya yüklenemedi!\n";
		    $VideoYukle ="yok";
		}
	}else {
		    echo "Dosya yok!\n";
		    $VideoYukle ="yok";
		}
		$pattern_page = array("+",",",".","-","'",'&','!',"?",":",";",'#',"~","=","/","$","£","^","(",")","_","<",">");

	$VideoBaslik = str_replace($pattern_page, ' ',$VideoBaslik);
	$VideoDesc = str_replace($pattern_page, ' ',$VideoDesc);
	$sqlAdd = mysql_query("INSERT INTO video (video_title, video_date, uploaderID, video_desc, video_img, video_link, video_videooriframe, video_IframeLink,category_id) VALUES ('".$VideoBaslik."', '".$VideoDate."','".$VideoUploader."', '".$VideoDesc."','".$VideoImg."','".$VideoYukle."','".$kod."','".$VideoIframe."','".$VideoCategory."')");

header("location:mychannel.php?sksks=ok");
}
if (isset($_POST["btnsave"])) {
	session_start();
	$oldpw = $_POST["pwolds"];
	$newpw = $_POST["pwnew"];
	$newpw2 = $_POST["pwnew2"];
	$suankiSifre = $_SESSION["id"];
	$sqlqueryy= mysql_query("SELECT * from user where user_id = '".$_SESSION["id"]."' ");
	while ($gelenveri = mysql_fetch_assoc($sqlqueryy)) {
	 	$sifre = $gelenveri["user_password"];
	 } 
	if ($newpw = $newpw2) {
		if ($oldpw = $sifre) {
			$sql = "UPDATE user SET user_password ='".$newpw."' WHERE user_id= '".$_SESSION["id"]."'";
			mysql_query($sql);
		}
	}
	header("location:mychannel.php?stats=ok");
}
if (isset($_POST["chanelsave"])) {
	session_start();
	$img= $_FILES["img"];
	$story = $_POST["story"];
	$imgcover = $_FILES["cover"];
	$usern = $_POST["username"];
	$dizin = 'dosyalar/img/';
	$yol = 'dosyalar/cover/';
	$id = $_SESSION["id"];
	$yuklenecek_dosya = $dizin . basename($_FILES['img']['name']);
	$yuklenecek_dosya2 = $yol . basename($_FILES['cover']['name']);
	
	if (move_uploaded_file($_FILES['cover']['tmp_name'], $yuklenecek_dosya2))
		{
  	 $sql2 = "UPDATE user SET user_cover = '".$_FILES["cover"]["name"]."'  WHERE user_id= '".$id."'";
 mysql_query($sql2);
		} else {
			
		    echo "cover yüklenemedi!\n";
		}


	if (move_uploaded_file($_FILES['img']['tmp_name'], $yuklenecek_dosya))
		{
  	 $sql = "UPDATE user SET user_username ='".$usern."' , user_profileimg = '".$_FILES["img"]["name"]."'  WHERE user_id= '".$id."'";
 
		} else {
			 $sql = "UPDATE user SET user_username ='".$usern."' WHERE user_id= '".$id."'";
		    echo "Dosya yüklenemedi!\n";
		}
		

	echo $_FILES["cover"]["name"];
	mysql_query($sql);
	mysql_query("UPDATE user SET user_story ='".$story."' WHERE user_id= '".$id."'");
	header("location: channeledits.php?stats=ok");
}

 ?>

