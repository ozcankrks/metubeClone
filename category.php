<?php include 'connect.php' ?>
<ul class="nav nav-tabs nav-stacked sol-nav" id="#defaultNavbar11">
              <li><a href="index.php"><i class="fas fa-home"></i> Anasayfa</a></li>
              <?php 
                 $sql = mysql_query("select * from category");
                while ($getCategory = mysql_fetch_assoc($sql)) {

               ?>
              
              <li><a href="categorylistener.php?catid=<?php echo $getCategory["id"] ?>"><i class="<?php echo $getCategory["category_icon"] ?>"></i> <?php echo $getCategory["category_name"]; ?></a></li>
            
              <?php } ?>
            </ul>

<?php if (isset($_SESSION["id"])) {
 ?>
            <ul class="nav nav-tabs nav-stacked sol-nav" style="margin-top: 20px" id="#defaultNavbar11">
              <span style="margin-left: 15px;margin-top: 20px"> <strong>Abonelikler</strong></span>
              <?php 
              session_start();
                 $sql = mysql_query("select * from sublist where user_id like '".$_SESSION["id"]."' order by id desc");
                while ($getCategory = mysql_fetch_assoc($sql)) {
                	
 				$sqlVideolar = mysql_query("select * from user where user_id like '".$getCategory["channel_id"]."' order by user_id desc");
 				while ($getir = mysql_fetch_assoc($sqlVideolar)) {?>
              
              <li><a href="channels.php?channelsid=<?php echo $getir["user_id"] ?>"><img src="dosyalar\img\<?php echo $getir["user_profileimg"] ?>" height="25" width="25" class="img-circle"/> <?php echo $getir["user_username"]; ?></a></li>
            
              <?php } }?>
            </ul>
            <?php } ?>