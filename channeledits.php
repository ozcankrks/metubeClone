
<?php include 'connect.php'; session_start(); ?>
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
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<style type="text/css">
	a{
		text-decoration: none;
		color:black;
	}
</style>
<?php include 'navbar.php' ?>
<div class="container-fluid">
		
	<div class="col-md-2">
		
	<?php include 'category.php' ?>

	</div>
	<?php 
      $sqlquery = mysql_query("SELECT * FROM user where user_id like '".$_SESSION["id"]."' ");

      while ($verciek = mysql_fetch_assoc($sqlquery)) {
        
     
   ?>
	
  <div class="col-md-8">
  
    <div class="form-group">
    <button class="btn btn-xs btn-primary"><i class="fas fa-check-circle"></i> Doğrulanma İsteği Gönder</button><br>
    <small id="emailHelp" class="form-text text-muted">Eğer bir Kurum kuruluş veya Büyük bir Topluluğa hitap etmeniz taktirde Doğrulama Rozeti alacaksınız.</small>
  </div>
	 <form method="post" action="function.php" enctype="multipart/form-data">
		 <div class="form-group">
    <label for="exampleInputPassword1">Profil Resimi</label>
    <input type="file" class="form-control" name="img" id="exampleInputPassword1"  >
    <small id="emailHelp" class="form-text text-muted">Resminizi değiştirmek istemiyorsanız dokunmayın.</small>
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Cover Resimi</label>
    <input type="file" class="form-control" name="cover" id="exampleInputPassword1"  >
    <small id="emailHelp" class="form-text text-muted">Resminizi değiştirmek istemiyorsanız dokunmayın.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Kullanıcı Adı</label>
    <input type="text" class="form-control" name="username"value="<?php echo $verciek["user_username"]; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="kullanıcı Adı">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo $verciek["user_email"]; ?>" id="exampleInputPassword1" placeholder="E mail adresinizi giriniz." readonly>
     <small id="emailHelp" class="form-text text-muted">Burayı Değiştiremezsiniz</small>
  </div>
	  <div class="form-group">
    <label for="exampleInputPassword1">Hakkında</label>
    <textarea class="form-control" rows="8" name="story"><?php echo $verciek["user_story"]; ?></textarea>
     <small id="emailHelp" class="form-text text-muted">Burayı Değiştiremezsiniz</small>
  </div>

  <button type="submit" name="chanelsave" class="btn btn-success"><i class="far fa-save"></i> Kaydet</button>
</form>

	  </div>
  <?php } ?>
  </div>
	
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
  <?php if ($_GET["stats"] == "ok") {?>
<script type="text/javascript">
$.notify("Bilgileriniz Güncellendi", "success");  

</script>
<?php } ?>
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
