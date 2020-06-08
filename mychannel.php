
<?php include 'connect.php'; session_start();
session_start();
if (!isset($_SESSION["id"])) {
  header("location:signip.php");
 } ?>
<?php 
  $sqlsorgu = mysql_query("Select * from user where user_id like '".$_SESSION["id"]."'");
          while ($sqlcek = mysql_fetch_assoc($sqlsorgu)) {
           $imguzanti = $sqlcek["user_profileimg"];
           $isim = $sqlcek["user_username"];  $imgcover = $sqlcek["user_cover"];
           $hakkimda = $sqlcek["user_story"];
}         
 ?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/cf2ef1f16d.js" crossorigin="anonymous"></script>
<title>MeTube - Video Paylaşım</title>
<link rel="shortcut icon" href="favicon.ico" />
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

  <div class="col-md-10">
	  <div class="col-md-12">
		<img src="dosyalar/cover/<?php echo $imgcover; ?>" style="width: 100%;object-fit:cover; " height="250">
		<div class="uploader  col-md-12" style="margin-top: 10px;margin-bottom: 10px">
			<div class="img-uploader col-md-2">
				<img src="dosyalar/img/<?php echo $imguzanti; ?>" width="70" height="70" class="img-circle" style="border: solid 2px #BB0003">
			</div>
			<div class="col-md-10">
				<div class="title-uploader col-md-12">
					<h5><strong><?php echo $isim; ?></strong> <i style="color:blue" class="fas fa-check-circle"></i></h5>
		  		</div>
		  <div class="more-uploader col-md-12">
		  	<?php $sqlsrg = mysql_query("select * from sublist where channel_id like '".$_SESSION["id"]."'");
		  	$abonesayisi = mysql_num_rows($sqlsrg); ?>
				<span style="color: #A3A3A3;"><?php echo $abonesayisi; ?> ABONE</span>
				<button style="float: right; background-color: #c7c7c7;color: white" disabled="" onclick="subButton()" id="gonder" class="btn btn-sm" > Abone Ol</button> 
			</div>
			</div>
		
		</div>
		 <div class="row"> <ul class="nav nav-tabs" style="margin-top: 15px;">
    <li class="active"><a data-toggle="tab" href="#home">

    Videolarım
   


</a></li>
    <li><a data-toggle="tab" href="#menu1">Beğendiklerim</a></li>
    <li><a data-toggle="tab" href="#menu2">Hakkımda</a></li>
    
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Videolarım</h3>
      <div class="col-md-12">
    	<?php 
    			session_start();
    			$user_id = $_SESSION["id"];
    			
    		   $sqlQUERY = mysql_query("select * from video where uploaderID like '".$user_id ."' order by video_id desc ");
                while ($getvideos = mysql_fetch_assoc($sqlQUERY)) {
    	 ?>
    	 <a href="detail.php?vidid=<?php echo $getvideos["video_id"]; ?>"><div class="video-blok">
			<img src="dosyalar/img/<?php echo  $getvideos["video_img"]?>" class="img-resize" style="min-height: 100px;max-height: 100px;">
			<span style="width: 100%"><?php echo $getvideos["video_title"]; ?></span>
		</div></a>
	<?php } ?>
    </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Beğendiklerim</h3>
      <?php $sqlbegenilenSorgu = mysql_query("select * from reaction where user_id like '".$user_id."' and stats like 1 order by id desc");
      while ($sqlBegenilenler = mysql_fetch_assoc($sqlbegenilenSorgu)) {
       
        $videolars = mysql_query("select * from video where video_id like '".$sqlBegenilenler["video_id"]."' ");
        while ( $begendigiVideoları = mysql_fetch_assoc($videolars)) {
          # code...
      
       ?>
      
      <a href="detail.php?vidid=<?php echo $begendigiVideoları["video_id"] ?>"><div class="video-blok">
      <img src="dosyalar/img/<?php echo $begendigiVideoları["video_img"] ?>" class="img-resize" style="min-height: 100px;max-height: 100px;">
      <span style="width: 100%"><?php echo $begendigiVideoları["video_title"] ?></span>
    </div></a>
    <?php   }} ?>
    </div>



    <div id="menu2" class="tab-pane fade">
      <h3>Hakkımda</h3>
      <p><?php echo $hakkimda ?> </p>
    </div>
  
  </div>
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
