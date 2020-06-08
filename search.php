<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/cf2ef1f16d.js" crossorigin="anonymous"></script>
<title>MeTube - Video Paylaşım</title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico" />
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<style>
	.card-container{
		width: 100%;
		background-color: whitesmoke;
		height: 170px;
		border-bottom: solid 1px gray;border-right: solid 1px gray;
		margin-bottom: 5px;
	}
	.upload-container{
		width: 100%;
		background-color: whitesmoke;
		height: 170px;
		border-bottom: solid 1px gray;
		margin-bottom: 5px;
	}
	.image-post{
		width: 30%;
		background-color: whitesmoke;
		height: 170px;
		overflow:hidden;
		float: left;border-bottom: solid 1px gray;
	}
	.detail-post{
		width: 70%;
		background-color: whitesmoke;
		height: 170px;
		overflow: hidden;
		float: left;border-bottom: solid 1px gray;
	}
	.detail-upload{
		width: 70%;
		
		background-color: whitesmoke;
		height: 170px;
		overflow: hidden;
		float: left;border-bottom: solid 1px gray;border-right: solid 1px gray;
	}
	.post-title{
		padding-left: 5px;
		background-color: whitesmoke;
		height: 50px;
		overflow: hidden;
		margin-top: 10px;
	}
	.post-uploader{
		width: 100%;
		background-color: whitesmoke;
		height: 20px;
		color: gray;
		margin-top: 0;
	}
	.post-desc{
		height: 100px;
		background-color: whitesmoke;
		padding: 7px;
	}
	a{
		color: black;
	}
	a:hover{
		text-decoration: none;
	}
	.img-uploader{
		text-align: center;
		width: 30%;
		background-color: whitesmoke;
		height: 170px;
		overflow:hidden;
		float: left;
		border-bottom: solid 1px gray;

	}
</style>

<?php include 'navbar.php' ?>
<div class="container-fluid">
		
	<div class="col-md-2">
		
		<?php include 'category.php' ?>

	</div>
	
	
  <div class="col-md-10">
	 <div class="col-md-8">
	 	<h4>Sonuçlar gösteriliyor.</h4>
	  <?php 
	  $deger=1;
	  	$istenen = $_GET["icerik"];
	  	if (!isset($istenen)) {
	  		echo "string";
	  		header("location:404NotFound.php");
	  	}
	  	$sorguK = mysql_query("SELECT * FROM user WHERE user_username like '%".$istenen."%' ");
	  	
	  	while ($getQueryUser = mysql_fetch_assoc($sorguK)) {?>
		
		<a href="channels.php?channelsid=<?php echo $getQueryUser["user_id"] ?>"><div class="upload-container">
			<div class="img-uploader">
				<img src="dosyalar/img/<?php echo $getQueryUser["user_profileimg"] ?>" width="120" height="120" class="img-circle"style="margin-top:8%;border: solid 2px #BB0003;">
			</div>
			<div class="detail-upload">
				<div class="post-title">
					<h4><?php echo $getQueryUser["user_username"] ?> <i class="fas fa-check-circle" style="color: blue;"></i></h4>
				</div>
				<div class="post-uploader">
					<?php 
						$sqlsorgusu = mysql_query("select * from sublist where channel_id like '".$getQueryUser["user_id"]."'");
						$abonesayisi = mysql_num_rows($sqlsorgusu);
						$sqlsorgusu2 = mysql_query("select * from sublist where channel_id like '".$getQueryUser["user_id"]."' and user_id like '".$_SESSION["id"]."'");
						$abonesayisi2 = mysql_num_rows($sqlsorgusu2);
					 ?>
					<small style="margin-top: 0;width: auto;"><?php echo $abonesayisi ?> Abone </small>
					<?php if ($abonesayisi2 > 0) { ?>
				<button style="float: right; background-color: #c7c7c7;color: white" disabled="" onclick="subButton()" id="gonder" class="btn btn-sm" > Abone Olundu</button> 
		<?php } elseif ($abonesayisi2 <= 0) {
				if (isset($_SESSION["id"])) {?>
			<a href="channels.php?channelsid=<?php echo $getQueryUser["user_id"] ?>" ><button style="float: right; background-color: #D40003;color: white" class="btn btn-sm" > Abone Ol</button> </a>
		<?php } else{ ?>
			<a href="#" data-toggle="modal" data-target="#needlogin"><button style="float: right; background-color: #D40003;color: white" class="btn btn-sm" > Abone Ol</button> </a>
		<?php }} ?>
					
				</div>
				<div class="post-desc" style="height: 70px;">
					<span><?php echo $getQueryUser["user_story"] ?></span>
				</div>
				
			</div>
		</div></a>
<?php }   ?>


		 <?php 
	  	$istenen = $_GET["icerik"];
	  	$sorgu = mysql_query("SELECT * FROM video WHERE video_title like '%".$istenen."%' order by video_view desc ");
	  	
	  	while ($getQuery = mysql_fetch_assoc($sorgu)) {?>
		<a href="detail.php?vidid=<?php echo $getQuery["video_id"] ?>">
			<div class="card-container">
				<div class="image-post">
					<img src="dosyalar/img/<?php echo $getQuery["video_img"] ?>" style="height: 100%;width: 100%;object-fit: cover">
					
				</div>
				<div class="detail-post">
					<div class="post-title">
						<h4><?php echo $getQuery["video_title"]; ?> </h4>
					</div>
					<?php $UserDetail = mysql_query("SELECT * FROM user WHERE user_id like '".$getQuery["uploaderID"]."'");
						$getUserDetail = mysql_fetch_assoc($UserDetail);
					?>
					
					<div class="post-uploader">
						<h6 style="margin-top: 0;padding-left: 5px;"><?php echo $getQuery["video_view"] ?> Görüntülenme <a href="channels.php?channelsid=<?php echo $getUserDetail["user_id"] ?>" style="color: red;"><?php echo $getUserDetail["user_username"] ?></a></h6>
					</div>
					<div class="post-desc">
						<span><?php echo $getQuery["video_desc"] ?></span>
					</div>
				</div>
			</div>
		</a>
	<?php } ?>
	
				
	</div>

  </div>
	
</div>
<div id="needlogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fas fa-key"></i> Giriş Yapmanız Gerekiyor</h4>
      </div>
      <div class="modal-body">
      	<h5>Abone Olmak için Giriş Yapmanız yada Kayıt olmanız gerekiyor</h5>
      	<a href="signip.php" class="btn btn-sm btn-success"><i class="fas fa-sign-in-alt"></i> Giriş Yap</a>
   		<a href="signup.php" class="btn btn-sm btn-primary"><i class="fas fa-user-plus"></i> Kayıt Ol</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
      </div>
    </div>

  </div>
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
	$(function() {
  $(".expand").on( "click", function() {
    $(this).next().slideToggle(400);
    $expand = $(this).find(">:first-child");
  });
});

</script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
