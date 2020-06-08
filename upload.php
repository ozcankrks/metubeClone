<?php include 'connect.php';
session_start();
if (!isset($_SESSION["id"])) {
 	header("location:signip.php");
 } ?>
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

<?php include 'navbar.php' ?>
<div class="container-fluid">
		
	<div class="col-md-2">
		
		<?php include 'category.php' ?>
	</div>
	
	
  <div class="col-md-8"> 
	<h3>Video Yükle</h3>
	  <div class="row">
	  	<div class="col-md-12">
			<form class="form-horizontal" method="post" action="function.php" enctype="multipart/form-data">
				<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Kapak Resmi</label>
				<div class="col-sm-10">
				  <input type="file" class="form-control" id="inputEmail3" required="" name="videoimg" placeholder="video başlık">
					
				</div>
			
			  </div>
			<div class="form-group" id="video">
				<label for="inputEmail3" class="col-sm-2 control-label">Video Yükle</label>
				<div class="col-sm-10">
				  <input type="file" class="form-control" accept="video/mp4" disabled="" id="inputEmail3" name="videoyolu" placeholder="video başlık">
					
				</div>
			
			  </div>
				
			<div class="form-group" id="gizli" hidden="">
				<label for="inputEmail3" class="col-sm-2 control-label">Iframe Video Linki</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="inputEmail3" required="" name="videoframe" placeholder="video linki">
				</div>
			  </div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
				  <div class="checkbox">
					<label>
					  <input type="checkbox" name="select" id="tekte" required="" onClick="myFunction()">IFrame Olarak Video Ekle
					</label>
				  </div>
				</div>
				</div>
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Video Başlığı</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="inputEmail3" required="" name="videotitle" placeholder="video başlık">
				</div>
			  </div>
				
			  <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Video Açıklama</label>
				<div class="col-sm-10">
				  
					<textarea class="form-control" id="inputPassword3" required="" name="videodesc"></textarea>
				</div>
			  </div>
  			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Video İçerik</label>
				<div class="col-sm-10">
				 	<select name="category" required="" class="form-control">
				 		<?php 
				 			   $sql = mysql_query("select * from category");
               					 while ($getCategory = mysql_fetch_assoc($sql)) {
				 		 ?>
						<option value="<?php echo $getCategory["id"] ?>"> <?php echo $getCategory["category_name"] ?> </option>
					
					<?php } ?>
					</select>
				</div>
			  </div>
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" name="upload-btn" class="btn btn-success">Yükle</button>
				</div>
			  </div>
</form>
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
			<script type="text/javascript">
			function myFunction() {
		  // Get the checkbox
		  var checkBox = document.getElementById("tekte");
		  // Get the output text
		  var iframediv = document.getElementById("gizli");
		  var videodiv = document.getElementById("video");

		  // If the checkbox is checked, display the output text
		  if (checkBox.checked == true){
			iframediv.style.display="block";
			  videodiv.style.display="none";
		  } else {
			iframediv.style.display="none";
			videodiv.style.display="block";
		  }
		}
	</script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
