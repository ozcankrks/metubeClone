<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/cf2ef1f16d.js" crossorigin="anonymous"></script>
<title>MeTube - Video Paylaşım</title>
<link href="https://fonts.googleapis.com/css?family=Heebo&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
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
<?php include 'yapimasamasinda.html'; ?>
<?php include 'navbar.php' ?>
</nav>
<div class="container-fluid">
		
	<div class="col-md-2">
		
		<?php include 'category.php' ?>

	</div>
	
	
  <div class="col-md-10">
<div class="owl-carousel owl-theme">
    <div class="item"><h4>sas</h4></div>
    <div class="item"><h4>2</h4></div>
    <div class="item"><h4>3</h4></div>
    <div class="item"><h4>4</h4></div>
    <div class="item"><h4>5</h4></div>
    <div class="item"><h4>6</h4></div>
    <div class="item"><h4>7</h4></div>
    <div class="item"><h4>8</h4></div>
    <div class="item"><h4>9</h4></div>
    <div class="item"><h4>10</h4></div>
    <div class="item"><h4>11</h4></div>
    <div class="item"><h4>12</h4></div>
</div>
	<div class="col-md-12">
			 <div class="grid-title">
			<span>Aboneliklerde Son Yüklenenler</span>
			</div>
		<?php session_start();
			$sql = mysql_query("Select * from video ORDER BY video_id desc");
			while ($veriler = mysql_fetch_assoc($sql)) {
				$sqlSub = mysql_query("Select * from sublist where user_id like '".$_SESSION["id"]."' and channel_id like '".$veriler["uploaderID"]."' ");
				$adet = mysql_num_rows($sqlSub);
				if ($adet > 0) {
					# code...
				
		
		 ?>
		<a href="detail.php?vidid=<?php echo $veriler["video_id"] ?>"><div class="video-blok" style="height: 140px">
			<img src="dosyalar/img/<?php echo $veriler["video_img"] ?>" class="img-resize" style="min-height: 100px;max-height: 100px;>
			<span style="width: 100%"><?php echo $veriler["video_title"] ?></span>
		</div></a>
		<?php }} ?>
				
	</div>
			
		
		
		
	
		
	
  </div>
	
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script type="text/javascript">
	$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>
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
