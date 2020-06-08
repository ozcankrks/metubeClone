<nav class="navbar navbar-default">
  <?php session_start(); include 'connect.php';?>
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
     <a  class="navar-brand" href="index.php" style="margin-top: 7px;" href="#">
        <img alt="Brand" src="https://i.hizliresim.com/LGdYPz.png" style="margin-top: 7px;" width="60">
      </a>


    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav">
        <li class=""><a href="trends.php"><i class="fas fa-fire" style="color: red"></i> Trend</a></li>
        <?php if (isset($_SESSION["id"])) { ?>
        <li><a href="subscribers.php"><i class="fas fa-stream" style="color: orange"></i> Abonelikler</a></li>
      <?php }else{?>
        <li><a href="#"  data-toggle="modal" data-target="#needlogin"><i class="fas fa-stream" style="color: orange"></i> Abonelikler</a></li>
      <?php } ?>
        <li><a href="#"><i class="fas fa-globe-europe" style="color: #209FB4"></i> Keşfet</a></li>
        <?php 
          $sqlsorgu = mysql_query("Select * from user where user_id like '".$_SESSION["id"]."'");
          while ($sqlcek = mysql_fetch_assoc($sqlsorgu)) {
           $imguzanti = $sqlcek["user_profileimg"];
             $usern = $sqlcek["user_username"];
          }
         ?>
      </ul>
      <form class="navbar-form navbar-left"  role="search" method="GET" action="search.php">
        <div class="form-group"style="width: 350px">
          <input type="text" class="form-control" name="icerik" required="" placeholder="Kanal veya Video arayın..." style="width: 100%">
        </div>
        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="upload.php"><span style="color: red"><i class="fas fa-upload"></i> Yükle</span></a></li>
        <?php 
          if (isset($_SESSION["email"])) { ?>
            <li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
    <img src='<?php echo "dosyalar/img/$imguzanti"?>' width="20" height="20" class="img-circle">  <?php echo $usern ?> <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" style="margin-left: 15px;">
      <a href="mychannel.php" ><li><i class="fas fa-tv"></i> Kanalım </li></a>
      <a href="channeledits.php" ><li> <i class="fas fa-cogs"></i> Hesap Ayarlarım</li></a>
      <a href="#" data-toggle="modal" data-target="#myModal"><li> <i class="fas fa-key"></i> Şifremi Değiştir</li></a>
    <a href="logout.php" ><li><i class="fas fa-sign-in-alt"></i> Çıkış</li></a>
    </ul>
 
            
         <?php  } ?>
         <?php if (!isset($_SESSION["email"])) { ?>
        <li><a href="signip.php">Giriş Yap</a></li>
       <?php } ?>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fas fa-key"></i> Şifre Değiştir</h4>
      </div>
      <div class="modal-body">

    <form action="function.php" method="post">
    
  <div class="form-group">
    <label for="oldpw">Mevcut Şifre</label>
    <input type="password" class="form-control" name="pwolds"  id="oldpw" aria-describedby="emailHelp" placeholder="Mevcut Şifreniz">
   
  </div>
  <div class="form-group">
    <label for="newpw">Yeni Şifre</label>
    <input type="password" class="form-control" name="pwnew" value="" required="" id="newpw" placeholder="Yeni Şifre" >
     <small id="emailHelp" class="form-text text-muted">Burayı Değiştiremezsiniz</small>
  </div>
   <div class="form-group">
    <label for="newpw2">Yeni Şifre Tekrar</label>
    <input type="password" class="form-control" name="pwnew2" value="" required="" id="newpw2" placeholder="Yeni Şifreniz giriniz." >
    <span class="label label-danger" id="demo"></span>
  </div>
  

  <button type="submit" id="btnsave" name="btnsave" class="btn btn-success"><i class="far fa-save" disables></i> Kaydet</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
      </div>
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
        <h5>Abonelikleri Görmek için Giriş Yapmanız yada Kayıt olmanız gerekiyor</h5>
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
<script>
document.addEventListener("keyup", function(){
  var newpw = document.getElementById("newpw");
  var newpw2 = document.getElementById("newpw2");
if (newpw.value == newpw2.value)
 {
document.getElementById("demo").innerHTML ="";
  document.getElementById("btnsave").disabled = false;
 }
 else{
  document.getElementById("demo").innerHTML ="<i class='fas fa-star'></i> Şifreler Uyuşmuyor";
  document.getElementById("btnsave").disabled = true;
 }
 

  
});
</script>