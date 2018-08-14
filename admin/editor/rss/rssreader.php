<?
class rss {

	var $rssdoc;
	
	var $rssuri = "http://192.168.1.253/nbms/rss/rss.xml";
	
	// �ӹǹ���Ƿ���ͧ����ʴ�
	var $rowcount = 6;
	
	// �ʴ� item description �������
	var $item_descr = 0;
	
	// Directory ����Ѻ���ٻ����
	var $imagedir = "./img/rssimages/";
	
	// ���֧ rss ����ء� ����Թҷ�
	var $cachetime = 3600;
	
	// Directory ����Ѻ ����� RSS cache
	var $cachedir = "./img/rssimages/";
	
	// $viewas �ٻẺ�ͧ����ʴ���
	// "list" �ʴ�����¡�����§ŧ������ tag <li>
	// "column" �ʴ��繤���������� <td></td> ��Т�鹺�÷Ѵ������� <tr></tr>
	// "horz" �ʴ����ǹ͹
	var $viewas = "column";
	
	// �ҡ�ٻẺ����ʴ����� "column" ��� $tabletag ���繵�ǡ�˹���ҵ�ͧ�������ʴ� tag <table border=0> ��� </table> �������
	// true �ʴ�
	// false ����ͧ�ʴ� ** �ҡ�к��� false �س��ͧ��� tag <table> ����͹���¡�� function feed() ��� </table> ��ѧ function feed()
	// ����ù��������������س����ö�Ѵ����ٻẺ����ʴ��Ţͧ���ҧ�ͧ��
	var $tabletag = true;
	
	// �ҡ�ٻẺ����ʴ����� "list" ��� $ultag ���繵�ǡ�˹���ҵ�ͧ�������ʴ� tag <ul> ��� </ul> �������
	// true �ʴ�
	// false ����ͧ�ʴ�
	// ����ù��������������س����ö�Ѵ����ٻẺ����ʴ��Ţͧ�ٻẺ List <li> �ͧ�����ͧ��
	var $ultag = false;
	
	// �ҡ�ٻẺ����ʴ����� "column" ��� $columncount �кبӹǹ column ����ͧ����ʴ������
	var $columncount = 1;
	

	
	// $imagecount �ӹǹ���Ƿ���ͧ�������ʴ��ٻ����
	// �ҡ $viewas �� list bullet �ж١᷹�����ٻ����
	var $imagecount = 0;

	// �ҡ��˹���� �����ٻ���᷹�ٻ���Ƿ�����
	var $imageuri = "";

	// �ҡ�ա�á�˹��ӹǹ�ٻ����($imagecount) �����ҡѺ�ӹǹ���Ƿ���ʴ� �ٻ���Ƿ������ͨж١�ʴ������ٻ imagealter
	var $imagealter = "";
	
	// ��˹���ҧ���ҧ��Ф����٧�ͧ�ٻ
	var $imagewidth = "75";
	var $imageheight = "79";
	
	// �ŧ��Ҵ�������ҧ����٧�ͧ�ٻ������ imagewidth ��� imageheight
	// true �ŧ��Ҵ�ٻ  ---- ����ŧ��Ҵ�ٻ PHP ��ͧ�ͧ�Ѻ GD 2.0
	// false ����ŧ��Ҵ�ٻ
	var $imageresize = true;
	
	// $imagealign ��èѴ���˹觢ͧ�ٻ���� �ҡ�ա���ʴ��ٻ����
	// "left" �Ѵ�ٻ���ҧ���¢ͧ����
	// "center" �Ѵ�ٻ����ҹ�� �ç��ҧ�ͧ����
	// "right" �Ѵ�ٻ���ҧ��Ңͧ����
	// "absmiddle" �Ѵ����ͤ���������Т�� �����觡�ҧ�ͧ�ٻ
	var $imagealign = "left";
	
	// style sheet class ����Ѻ tag <a> �ͧ title
	var $linkclass = "";
	
	// ��˹� target ������ա�ä����ԧ��
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