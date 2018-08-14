<?php
// --------------------------------------------------------------------------------
// Rsscreator Library By CHINAKRON
// --------------------------------------------------------------------------------

function rsscreator($cid) {
	$feed .="<rss version=\"2.0\" xml:lang=\"th-TH\">\n";
	$feed .="<channel>\n";
	$feed .="	<title>News Broadcast Management System</title>\n";
	$feed .="	<link>".DOMAIN_NAME."</link>\n";
	$feed .="	<description><![CDATA[ระบบจัดการศูนย์กระจายข่าวด้วยเทคโนโลยี RSS]]></description>\n\n";

	$rescategories  = mysql_query("select * from ".DB_PREFIX."categories ") ;
	while ($categories = mysql_fetch_object($rescategories)) {
		$category[$categories->category_id] = $categories->category_name;
		$rsscid[$categories->category_id] = $categories->category_sefriendly;
	}
	if($cid=='0'){
		$res = mysql_query("select * from ".DB_PREFIX."news where news_status = '1'  ORDER BY news_id DESC limit 0,30") ;
	}else{
		$res = mysql_query("select * from ".DB_PREFIX."news where news_status = '1' && category_id = '$cid' ORDER BY news_id DESC limit 0,20") ;
	}
	while ($data = mysql_fetch_object($res)) {
	
		$rs_img = mysql_query("select * from ".DB_PREFIX."news_pic where pic_news = '".$data->news_id."' ORDER BY RAND() LIMIT 1") ;
		$totalimg = mysql_num_rows($rs_img) ;
		if($totalimg=='0')
			$arrimg[pic_url]="noimage.jpg";
		else
			$arrimg = mysql_fetch_assoc($rs_img);

		$feed .="	<item>\n";
		$feed .="		<title><![CDATA[$data->news_title]]></title>\n";
		$feed .="		<link>".DOMAIN_NAME."review.php?news=$data->news_id</link>\n";
		$feed .="		<description>\n";
		$feed .="			<![CDATA[".iconv_substr(strip_tags($data->news_body),0,300, "UTF-8")."]]>\n";
		$feed .="		</description>\n";
		$feed .="		<category><![CDATA[".$category[$data->category_id]."]]></category>\n";
		$feed .="		<pubDate>$data->news_created+0700</pubDate>\n";
		$feed .="		<enclosure url=\"".DOMAIN_NAME."img/news/thumb_$arrimg[pic_url]\" type=\"image/jpeg\" />\n";
		$feed .="	</item>\n\n";
	}

	$feed .="	</channel>\n";
	$feed .="</rss>\n";
	if($cid=='0'){
		$filename = "rss.xml";
	}else{
		$filename = $rsscid[$cid].".xml";
	}
	$handle = fopen("../rss/".$filename, 'w');
	fwrite($handle,$feed);
	fclose($handle);
}
?>