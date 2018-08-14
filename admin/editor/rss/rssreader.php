<?
class rss {

	var $rssdoc;
	
	var $rssuri = "http://192.168.1.253/nbms/rss/rss.xml";
	
	// จำนวนข่าวที่ต้องการแสดง
	var $rowcount = 6;
	
	// แสดง item description หรือไม่
	var $item_descr = 0;
	
	// Directory สำหรับเก็บรูปข่าว
	var $imagedir = "./img/rssimages/";
	
	// ให้ดึง rss ใหม่ทุกๆ กี่วินาที
	var $cachetime = 3600;
	
	// Directory สำหรับ เก็บไฟล์ RSS cache
	var $cachedir = "./img/rssimages/";
	
	// $viewas รูปแบบของการแสดงผล
	// "list" แสดงเป็นรายการเรียงลงมาโดยใช้ tag <li>
	// "column" แสดงเป็นคอลัมน์โดยใช้ <td></td> และขึ้นบรรทัดใหม่ด้วย <tr></tr>
	// "horz" แสดงผลแนวนอน
	var $viewas = "column";
	
	// หากรูปแบบการแสดงผลเป็น "column" ค่า $tabletag จะเป็นตัวกำหนดว่าต้องการให้แสดง tag <table border=0> และ </table> หรือไม่
	// true แสดง
	// false ไม่ต้องแสดง ** หากระบุเป็น false คุณต้องใส่ tag <table> ไว้ก่อนเรียกใช้ function feed() และ </table> หลัง function feed()
	// ตัวแปรนี้มีไว้เพื่อให้คุณสามารถจัดการรูปแบบการแสดงผลของตารางเองได้
	var $tabletag = true;
	
	// หากรูปแบบการแสดงผลเป็น "list" ค่า $ultag จะเป็นตัวกำหนดว่าต้องการให้แสดง tag <ul> และ </ul> หรือไม่
	// true แสดง
	// false ไม่ต้องแสดง
	// ตัวแปรนี้มีไว้เพื่อให้คุณสามารถจัดการรูปแบบการแสดงผลของรูปแบบ List <li> ของข่าวเองได้
	var $ultag = false;
	
	// หากรูปแบบการแสดงผลเป็น "column" ค่า $columncount ระบุจำนวน column ที่ต้องการแสดงต่อแถว
	var $columncount = 1;
	

	
	// $imagecount จำนวนข่าวที่ต้องการให้แสดงรูปข่าว
	// หาก $viewas เป็น list bullet จะถูกแทนด้วยรูปข่าว
	var $imagecount = 0;

	// หากกำหนดค่า จะใช้รูปนี้แทนรูปข่าวทั้งหมด
	var $imageuri = "";

	// หากมีการกำหนดจำนวนรูปข่าว($imagecount) ไม่เท่ากับจำนวนข่าวที่แสดง รูปข่าวที่เหลือจะถูกแสดงด้วยรูป imagealter
	var $imagealter = "";
	
	// กำหนดควางกว้างและความสูงของรูป
	var $imagewidth = "75";
	var $imageheight = "79";
	
	// แปลงขนาดความกว้างและสูงของรูปตามค่า imagewidth และ imageheight
	// true แปลงขนาดรูป  ---- การแปลงขนาดรูป PHP ต้องรองรับ GD 2.0
	// false ไม่แปลงขนาดรูป
	var $imageresize = true;
	
	// $imagealign การจัดตำแหน่งของรูปข่าว หากมีการแสดงรูปข่าว
	// "left" จัดรูปไว้ทางซ้ายของข่าว
	// "center" จัดรูปไว้ด้านบน ตรงกลางของข่าว
	// "right" จัดรูปไว้ทางขวาของข่าว
	// "absmiddle" จัดให้ข้อความซ้ายและขวา อยู่กึ่งกลางของรูป
	var $imagealign = "left";
	
	// style sheet class สำหรับ tag <a> ของ title
	var $linkclass = "";
	
	// กำหนด target เมื่อมีการคลิ๊กลิงค์
	var $target = "_blank";
	
	function parse() 
	{
			$success = false;
			
			if (!defined('DOMIT_RSS_INCLUDE_PATH')) {
				define('DOMIT_RSS_INCLUDE_PATH', (dirname(__FILE__) . "/"));
			}

		    	require_once(DOMIT_RSS_INCLUDE_PATH . 'xml_domit_rss.php');
			$this->rssdoc =& new xml_domit_rss_document($this->rssuri,$this->cachedir,$this->cachetime);
			
			$this->displayFeed();
	} //parse
	
	function displayFeed() 
	{
		$totalChannels = $this->rssdoc->getChannelCount();
		for ($i = 0; $i < $totalChannels; $i++) 
		{

			$currChannel =& $this->rssdoc->getChannel($i);
			
			$totalItems = $this->rowcount;
			if ($currChannel->getItemCount() < $this->rowcount) $totalItems = $currChannel->getItemCount();
			
			if ($this->imagecount < 0) $this->imagecount = 0;
			if ($currChannel->getItemCount() < $this->imagecount ) $this->imagecount = $currChannel->getItemCount();
			if ($this->imageuri != "") $this->imagecount = $currChannel->getItemCount();
			
			if ($this->viewas=="column" && $this->tabletag==true) echo "<table border=0>";
			if ($this->viewas=="list" && $this->ultag==true)
			{
				if ($this->imageuri != "")
				{
					echo "<ul style=\"list-style-image: url(".$this->imageuri.");\">";
				}
				else
				{
					echo "<ul>";
				}
				
			}
			
			for ($j = 0; $j < $totalItems; $j++) 
			{
				$currItem =& $currChannel->getItem($j);
				
				$txtNews = "<a href=\"" . $currItem->getLink() . "\" target=\"". $this->target ."\" class=\"". $this->linkclass ."\">" .$currItem->getTitle() . "</a>";
				
				if ($this->item_descr)
				{
					$txtNews .= "<br>".$currItem->getDescription();
				}
				
				switch($this->viewas)
				{
					case "list":
						echo "<li>".$txtNews."\n";
						break;
					case "horz":
					
						if ($j <= ($this->imagecount - 1)) 
						{
							echo "<img src=\"". $this->getimage($currItem->getLink(),$this->imageuri,$this->imagedir,$this->imageresize,$this->imagewidth,$this->imageheight) ."\" align=\"absmiddle\" width=\"".$this->imagewidth."\" height=\"".$this->imageheight."\">";
						}
						else if ($this->imagealter != "")
						{
							echo "<img src=\"". $this->imagealter ."\" align=\"absmiddle\">";
						}
						
						echo $txtNews." ";
						
						break;
					case "column":
						
						if ($j % $this->columncount == 0) echo "<tr>";
						
						if ($this->imagealign == "center") echo "<td valign=\"top\">";
						else echo "<td valign=\"top\">";
						
						if ($j <= ($this->imagecount - 1)) 
							{
								if ($this->imagealign == "center") echo "<center>";
								echo "<img src=\"". $this->getimage($currItem->getLink(),$this->imageuri,$this->imagedir,$this->imageresize,$this->imagewidth,$this->imageheight) ."\" align=\"".$this->imagealign."\" width=\"".$this->imagewidth."\" height=\"".$this->imageheight."\">";
								if ($this->imagealign == "center") echo "<br>";
							}
						else if ($this->imagealter != "")
							{
								if ($this->imagealign == "center") echo "<center>";
								echo "<img src=\"". $this->imagealter ."\" align=\"".$this->imagealign."\">";
								if ($this->imagealign == "center") echo "<br>";
							}
						
						echo $txtNews;
						if ($this->imagealign == "center") echo "</center>";
						echo "</td>";
						if ($j % $this->columncount == ($this->columncount -1)) echo "</tr>\n";
						break;
				}

			}
			if ($viewas=="list" && $this->tabletag==true) echo "</ul>";
			if ($this->viewas=="column" && $this->tabletag==true) echo "</table>";
		}
		
		//echo $this->rssdoc->toNormalizedString(true);
	} //displayFeed
	
	
	function getimage($itemlink,$imageuri,$imagedir,$imageresize,$imagewidth,$imageheight)
	{
		if ($imageuri != "") return $imageuri;
		$parsedlink = parse_url($itemlink);
		list($tx,$rx) = split("&",$parsedlink["query"]);
		list($t,$type) = split("=",$tx);
		list($r,$rid) = split("=",$rx);
		$urlquery = "http://192.168.1.253/nbms/img/?id=$type";
		if (! (strpos($itemlink,"mreader.php") === false)) $urlquery = "http://192.168.1.253/nbms/img/?id=$type";
		
		if (! file_exists($imagedir))
		{
			mkdir($imagedir);
		}
		
		$imagefilename = $imagedir.$type."_".$rid."_" . $imagewidth . "x" . $imageheight .".jpg";
		
		if (! file_exists($imagefilename))
		{
			$imgContents = null;
			
			$fileHandle = @fopen($urlquery, "r");
			$fileuri = fread($fileHandle, 8192);
			fclose($fileHandle);

			$fileHandle = @fopen($fileuri, "rb");
	
			if($fileHandle)
			{
				while (!feof($fileHandle)) 
				{
				  $imgContents .= fread($fileHandle, 8192);
				}
	
				fclose($fileHandle);
				
				if ($imgContents)
				{
					if ($imageresize==false || function_exists("imagecreatefromstring")==false)
					{
						$handle = fopen($imagefilename, "wb");
						fwrite($handle, $imgContents);
						fclose($handle);
					}
					else
					{
						$source = imagecreatefromstring($imgContents);
						$imageX = imagesx($source);
						$imageY = imagesy($source);
						if ($imagewidth >= $imageX)
						{
							$handle = fopen($imagefilename, "wb");
							fwrite($handle, $imgContents);
							fclose($handle);
						}
						else
						{
							$thumbX = $imagewidth;
							$thumbY = (int)(($thumbX*$imageY) / $imageX );
							$dest   = imagecreatetruecolor($thumbX, $thumbY);
							imagecopyresampled ($dest, $source, 0, 0, 0, 0, $thumbX, $thumbY, $imageX, $imageY);
							imagejpeg($dest,$imagefilename,75);
							imagedestroy($dest);
						}
						imagedestroy($source);
					}
				}
			}
			
		}

		return $imagefilename;
		
	}
	
	function feed()
	{
		$this->parse();
	}
}


?>