<?php header('Content-type: application/xml; charset="utf8"',true);  ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<!-- Ne Yazılım Özelleştirilmiş Seo Url Sitemap -->


<?php
date_default_timezone_set('Europe/Istanbul');
$username="root";
$password="ozcanbey98";
$sunucu="localhost";
$dbname="metube";

$site = $_SERVER["HTTP_HOST"];
$tarih=date("Y-m-d");


function seo($url){
$url = trim($url);
$url = strtolower($url);
$find = array('<b>', '</b>');
$url = str_replace ($find, '', $url);
$url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);
$find = array(' ', '&quot;', '&amp;', '&', '\r\n', '\n', '/', '\\', '+', '<', '>');
$url = str_replace ($find, '-', $url);
$find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
$url = str_replace ($find, 'e', $url);
$find = array('í', 'ı', 'ì', 'î', 'ï', 'I', 'İ', 'Í', 'Ì', 'Î', 'Ï');
$url = str_replace ($find, 'i', $url);
$find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
$url = str_replace ($find, 'o', $url);
$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
$url = str_replace ($find, 'a', $url);
$find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
$url = str_replace ($find, 'u', $url);
$find = array('ç', 'Ç');
$url = str_replace ($find, 'c', $url);
$find = array('ş', 'Ş');
$url = str_replace ($find, 's', $url);
$find = array('ğ', 'Ğ');
$url = str_replace ($find, 'g', $url);
$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
$repl = array('', '-', '');
$url = preg_replace ($find, $repl, $url);
$url = str_replace ('--', '-', $url);
return $url;
}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,'utf8');


?>


<!-- Tekil Sayfalar -->

<url>
  <loc>http://<?php echo $site; ?></loc>
  <lastmod><?php echo $tarih; ?></lastmod>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>

<url>
  <loc>http://<?php echo $site; ?>/icerikid=36</loc>
  <lastmod><?php echo $tarih; ?></lastmod>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>


<!-- Haberler Sitemap -->

<?php 
$sql = "SELECT * FROM video";
$result = $conn->query($sql);

while($habercek = $result->fetch_assoc()) { ?>


<url>
  <loc>http://<?php echo $site; ?>/detail.php?vidid=<?php echo seo($habercek["video_id"]); ?></loc>
  <lastmod><?php echo $tarih; ?></lastmod>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>

<?php } ?>

<?php 
$sql2 = "SELECT * FROM user";
$result2 = $conn->query($sql2);

while($habercek2 = $result2->fetch_assoc()) { ?>


<url>
  <loc>http://<?php echo $site; ?>/channels.php?channelsid=<?php echo seo($habercek2["user_id"]); ?></loc>
  <lastmod><?php echo $tarih; ?></lastmod>
  <changefreq>daily</changefreq>
  <priority>1.00</priority>
</url>

<?php } ?>


<?php
$conn->close();


?>

</urlset>

