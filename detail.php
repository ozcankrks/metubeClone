<?php 
include 'connect.php';
$videoid = $_GET["vidid"]; 
				 session_start();
				$mysqlquery2 =mysql_query("SELECT * FROM video where video_id like '".$videoid."' ");
				$getVideoTitle = mysql_fetch_assoc($mysqlquery2);
				if (!isset($getVideoTitle["video_title"])) {
					header("location:404NotFound.php");
				}
				 ?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://kit.fontawesome.com/cf2ef1f16d.js" crossorigin="anonymous"></script>

<title> <?php echo $getVideoTitle["video_title"] ?> | MeTube</title>
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

<style>
	.expand {
  display: block;
  text-decoration: none;
  color: #555;
  cursor: pointer;
  width:100%;
  height:auto;
  background:#eee;

  padding:10px;
}

.phil {
  margin: 0px 0 0 0;
  display: none;
  line-height: 22px;
  width:100%;
  height:auto;
  background:##DCDCDC;
  padding:10px;
  
}
	a{
		color: black;
		text-decoration: none;;
	}
</style>
<?php include 'navbar.php'?>
<div class="container">
		<?php $videoid = $_GET["vidid"]; 
				 session_start();date_default_timezone_set('Europe/Istanbul');
				$mysqlquery =mysql_query("SELECT * FROM video where video_id like '".$videoid."' ");
				$getVideodetail = mysql_fetch_assoc($mysqlquery);
				$yukleyen = $getVideodetail["uploaderID"];
				$izlenme = $getVideodetail["video_view"];
				$guncelG = $izlenme + 1;
				$sqlizlenmearttır = mysql_query("UPDATE video SET video_view ='".$guncelG."' WHERE video_id= '".$videoid."'");
				$_SESSION["videoisim"] = $getVideodetail["video_title"];
				$videoCategory = $getVideodetail["category_id"];
				$tariha=$getVideodetail["video_date"];

				
			?>
  <div class="col-md-8 img-responsive">
		<div class="embed-video">
			<!--<video src="../../Public/Videos/Sample Videos/Wildlife.wmv" height="500" width="100%"></video> 
			<img src="../../Public/Pictures/Sample Pictures/Koala.jpg" style="height: auto;max-height: 450px; width: 100%" />-->
			<?php 
			$videosecenek = $getVideodetail["video_videooriframe"];
			
			if ($videosecenek == 0) { ?>
				<video src="dosyalar/<?php echo $getVideodetail["video_link"] ?>" style="height: auto;max-height: 450px; width: 100%" controls></video>
			<?php  }  elseif ($videosecenek == 1) {?>
				<iframe src="<?php echo $getVideodetail["video_IframeLink"] ?>" style=" min-height: 450px; width: 100%" allowfullscreen></iframe>
			<?php } ?>
			
			

			

		</div>
		<div class="title-video">

			<h3><?php echo $getVideodetail["video_title"]; ?></h3>
			

		</div>
	
	  <div class="more-video">
			<span style="color: #A3A3A3;"><?php echo $guncelG. " Görüntülenme " ."|  Yayın T. " .$getVideodetail["video_date"] ; ?></span>
		  <a href="#" style="float: right; margin-right: 5px;"><i class="fas fa-flag"></i></a>

			<?php 
			$sqlbegenisorgu = mysql_query("select * from reaction where video_id like '".$videoid."' and stats = 1 ");
			$begenisayisi = mysql_num_rows($sqlbegenisorgu);

			$sqlbegenisorgu = mysql_query("select * from reaction where video_id like '".$videoid."' and stats = 0 ");
			$begenemesayisi = mysql_num_rows($sqlbegenisorgu);

			$sqlbegenisorgu2 = mysql_query("select * from reaction where video_id like '".$videoid."' and user_id like '".$_SESSION["id"]."' and stats like 1 ");
			$begendimi = mysql_num_rows($sqlbegenisorgu2);

			$sqlbegenisorgu3 = mysql_query("select * from reaction where video_id like '".$videoid."' and user_id like '".$_SESSION["id"]."' and stats like 0 ");
			$begenemesayisi2 = mysql_num_rows($sqlbegenisorgu3);
			 ?>


			  <?php
			  if (isset($_SESSION["id"])) {
			   if ($begenemesayisi2 <=0) {?>
		    <a href="#" style="float: right; margin-right: 5px;" id="diss"><i class="far fa-thumbs-down" id="likeD"></i> <?php echo $begenemesayisi ?> </a>
		  	<?php }if ($begenemesayisi2 > 0){?>
		  		  <a href="#" style="float: right; margin-right: 5px;" id="diss"><i class="fas fa-thumbs-down" id="likeD"></i> <?php echo $begenemesayisi ?> </a>
		  	<?php } ?>
		


		  <?php if ($begendimi <=0) {?>
		  	<a href="#" style="float: right; margin-right: 5px;" id="like"><i class="far  fa-thumbs-up" id="likeB"></i> <span id="countL"><?php echo $begenisayisi; ?></span></a>
		  	<?php }if ($begendimi > 0){?>
		  		<a href="#" style="float: right; margin-right: 5px;" id="like"><i class="fas  fa-thumbs-up" id="likeB"></i> <span id="countL"><?php echo $begenisayisi; ?></span></a>
		  	<?php } } if (!isset($_SESSION["id"])) {?>
		  		 <a href="#" data-toggle="modal" data-target="#needlogin" style="float: right; margin-right: 5px;"><i class="far fa-thumbs-up"></i> <?php echo $begenisayisi ?> </a>
		  	    <a href="#" data-toggle="modal" data-target="#needlogin" style="float: right; margin-right: 5px;"><i class="far fa-thumbs-down"></i> <?php echo $begenemesayisi ?> </a>
		  	<?php } ?>
		  	 
		</div>
	    <hr>
	    <?php 
	    	$Subcount = mysql_query("SELECT * FROM sublist where channel_id like '".$yukleyen."' ");
	    	$adet = mysql_num_rows($Subcount);
	    	$SuborNot = mysql_query("SELECT * FROM sublist where channel_id like '".$yukleyen."' and user_id like '".$_SESSION["id"]."' ");
	    	$Subsornotadet = mysql_num_rows($SuborNot);
	     ?>
	    <?php 
	    	$Uploa = mysql_query("Select * from user where user_id like '".$yukleyen."'");
	    	$getUpload = mysql_fetch_assoc($Uploa);
	    	$yukleyeninId = $getUpload["user_id"];
	     ?>
		<div class="uploader  col-md-12">
			<div class="img-uploader col-md-2">
				<img src="dosyalar/img/<?php echo $getUpload["user_profileimg"] ?>" width="70" height="70" class="img-circle" style="border: solid 2px #BB0003">
			</div>
			<div class="col-md-9 col-lg-10">
				<div class="title-uploader col-md-12">
					<a href="channels.php?channelsid=<?php echo $getUpload["user_id"] ?>"><h5><strong><?php echo $getUpload["user_username"] ?></strong></h5></a>
		  		</div>
		  <div class="more-uploader col-md-12"><span style="color: #A3A3A3;"><?php echo $adet; ?> Abone</span>
		  
		  	<?php if ($Subsornotadet > 0) { ?>
				<button style="float: right; background-color: #c7c7c7;color: white"  onclick="resetButton()" id="iptal" class="btn btn-sm" > Abone Olundu</button> 
		<?php } elseif ($Subsornotadet <= 0) {
				if (isset($_SESSION["id"])) {?>
			<button style="float: right; background-color: #D40003;color: white" onclick="subButton()" id="gonder" class="btn btn-sm" > Abone Ol</button> 
		<?php } else{ ?>
			<a href="#" data-toggle="modal" data-target="#needlogin"><button style="float: right; background-color: #D40003;color: white" class="btn btn-sm" > Abone Ol</button> </a>
		<?php }} ?>
			</div>
			</div>
		
		</div>
		<div class="col-md-12" style="margin-top: 30px;">
			
				<div id="integration-list">

    <div class="expand">
    <?php echo substr($getVideodetail["video_desc"],0,250);?> <strong>devamını oku...</strong>
    </div>    
    <div class="phil">
  			<?php echo $getVideodetail["video_desc"]; ?>
    </div>
</div>
			<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://metube-2.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
		</div>
	  <hr>
	</div>
  	<div class="col-md-4" style="padding-bottom: 5px;">
  		<?php 
  			$sqlYanVideo = mysql_query("SELECT * FROM video where category_id = '".$videoCategory."' order by RAND() limit 12");
  			while ($getMoreVideo = mysql_fetch_assoc($sqlYanVideo)) {?>
		<a href="detail.php?vidid=<?php echo $getMoreVideo["video_id"] ?>"><div class="col-md-12 tumbpost">
				<div class="img-tumb col-md-4">
					<img src="dosyalar/img/<?php echo $getMoreVideo["video_img"] ?>" class="img-responsive"/>
				</div>
				<div class="img-tumb col-md-8 ">
					<div class="row">
						<div class="tumb-detail" style="">
							<span style="height: 5px;overflow: hidden;"><?php echo substr($getMoreVideo["video_title"], 0,45) ; ?></span>
						</div>
					<div class="tumb-view ">
						<span style="font-size: 10px;color: #B3B3B3"><?php echo $getMoreVideo["video_view"] ?> görüntülenme</span>
					</div>
					</div>
					
				</div>
			</div></a>
		<?php } ?>
		
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
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
  

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
 <script>
  $('#like').click(function(){
      var post_edilecek_veriler = 'videoid='+ <?php echo $videoid ?> + '&user='+<?php echo $_SESSION["id"] ?>; 
      $.ajax({
          type:'POST',
          url:'like.php', 
          data:post_edilecek_veriler, 
          success:
        function(cevap){
           
        } 
      });
     
      var button = document.getElementById("likeB");
      var button2 = document.getElementById("likeD");
		button.style.background="#c7c7c7";
		button.style.color="#000";
		button.style.backgroundColor = "white";
		button.disabled = true;
		button.setAttribute("class","fas fa-thumbs-up");
		button2.setAttribute("class","far fa-thumbs-down");

		
  });
  
  </script> 
  <script>
  $('#diss').click(function(){
      var post_edilecek_veriler = 'videoid='+ <?php echo $videoid ?> + '&user='+<?php echo $_SESSION["id"] ?>; 
      $.ajax({
          type:'POST',
          url:'diss.php', 
          data:post_edilecek_veriler, 
          success:
        function(cevap){
             //alert(cevap);
        }
      });
      var button = document.getElementById("likeD");
      var button2 = document.getElementById("likeB");
		button.style.background="#c7c7c7";
		button.style.color="#000";
		button.style.backgroundColor = "white";
		button.disabled = true;
		button.setAttribute("class","fas fa-thumbs-down");
		button2.setAttribute("class","far fa-thumbs-up");
  })
  
  </script> 
 <script>
  $('#gonder').click(function(){
      var post_edilecek_veriler = 'channel='+ <?php echo $yukleyeninId ?> + '&user='+<?php echo $_SESSION["id"] ?>; 
      $.ajax({
          type:'POST',
          url:'sub.php', 
          data:post_edilecek_veriler, 
          success:
        function(cevap){
             
        }
      });
      var button = document.getElementById("subButton");
		button.style.background="#c7c7c7";
		button.style.color="#000";
		button.innerText ="Abone Olundu";
		button.disabled = true;
  })
  </script> 
  <script>
  $('#iptal').click(function(){
      var post_edilecek_veriler = 'channel='+ <?php echo $yukleyeninId ?> + '&user='+<?php echo $_SESSION["id"] ?>; 
      $.ajax({
          type:'POST',
          url:'subd.php', 
          data:post_edilecek_veriler, 
          success:
        function(cevap){
             alert(cevap);
        }
      });
      var button = document.getElementById("subButton");
		button.style.background="#c7c7c7";
		button.style.color="#000";
		button.innerText ="Abone Olundu";
		button.disabled = "true";
  })
  </script> 
  <script id="dsq-count-scr" src="//metube-2.disqus.com/count.js" async></script>
<script type="text/javascript">
	var a=0;
	function subButton(){
		var button = document.getElementById("gonder");
		button.style.background="#c7c7c7";
		button.style.color="#000";
		button.innerText ="Abone Olundu";
  		button.setAttribute("id", "#iptal"); 
  		button.setAttribute("onclick", "resetButton()"); 
		button.disabled = true;

	}

</script>
<script type="text/javascript">
	var a=0;
	function resetButton(){
		var button = document.getElementById("iptal");
		button.style.background="#D40003";
		button.style.color="#fff";
		button.innerText ="Abone Ol";
  		button.setAttribute("id", "gonder"); 
  		button.setAttribute("onclick", "subButton()"); 
		button.disabled = true;
	}

</script>
<script src="http://code.jquery.com/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
