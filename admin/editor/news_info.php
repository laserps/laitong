<?php 
  require_once '../conf.php';
  header('Content-Type: text/html; charset=utf-8');

  $result_news = mysql_query("select * from ".DB_PREFIX."news where news_id ='$newsid' && news_status='1'") ;
  $row_news = mysql_fetch_assoc($result_news);
  $description = strip_tags($row_news[news_body]);
  $description = iconv_substr($description,0,180, "UTF-8"); 
  $news_title = $row_news[news_title];

  $url = $_GET["file"];
  //แทนที่ช่องว่างใน URL ของไฟล์ด้วย %20 ตามข้อกำหนดในการเขียนค่า URL
  $url = str_replace(" ", "%20", $url);
  //หาขนาดของภาพ
  $dimension = GetImageSize($url);
  //เก็บความกว้างของภาพไว้ในตัวแปร $width
  $width = $dimension[0]-10;

  //ดึงเฉพาะชื่อไฟล์ออกมาจาก URL แล้วเปลี่ยน %20 กลับมาเป็นช่องว่างตามเดิม ก่อนเก็บลงตัวแปร $imageInfo โดยใส่ข้อความกำกับข้างหน้าด้วย
  $imageInfo = "<table width=\"".$width."\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><b>$news_title</b><br>".$description."<br><b>ลงเมื่อ  : </b>$row_news[news_created]</td></tr></table>";


  echo $imageInfo;  //ส่งค่าของ $imageInfo กลับไปให้บราวเซอร์
?>
