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
	  
	<div class="col-md-10">
			<center>
				<img src="img/owee.gif" width="450">
				<h4><strong>Aradığınız Şey Bu Evrende Yok</strong></h4>
				<h5><strong>Başka Birşey dene !</strong></h5>
			</center>
				
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
