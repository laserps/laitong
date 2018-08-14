<?
$row  = $sys->dataList($tbl,null,20,"number_sort"," desc","
left join tb_category on tb_torrent.id_category = tb_category.id_category
left join tb_member  on tb_torrent.id_member = tb_member.id_member 
where tb_torrent.status ='1' and tb_torrent.status_tran = '1'
group by tb_torrent.id_torrent");



	echo $sys->fnc->confirm();
	echo $sys->fnc->checkall();
    
	if($_POST[id]){
	$sys->Delete_all($_POST[id],$tbl,$fiel_id,$page_admin);
	}
	if($_GET[del] != ""){
	 $sys->Del($_GET[del],$tbl,$page_admin,$fiel_id);
	}
	
	if($_GET['status']=="1"){
	$data_update = array("status"=>1,"last_date"=>$date_update);
	$sys->db->update($tbl, $data_update,"id_torrent = '".$_GET['id']."'");
	$sys->fnc->redirect("main.php?op=".$_GET['op']."&act=".$_GET['act']."");
	}
	if($_GET['status']=="0"){
	$data_update = array("status"=>0);
	$sys->db->update($tbl, $data_update,"id_torrent = '".$_GET['id']."'");
	$sys->fnc->redirect("main.php?op=".$_GET['op']."&act=".$_GET['act']."");
	}

	if($_GET['status_tran']=="1"){
	$data_update = array("status_tran"=>1,"last_date"=>$date_update);
	$sys->db->update($tbl, $data_update,"id_torrent = '".$_GET['id']."'");
	$sys->fnc->redirect("main.php?op=".$_GET['op']."&act=".$_GET['act']."");
	}
	if($_GET['status_tran']=="0"){
	$date_time = date("d-m-Y H:i");
	$data_update = array("status_tran"=>0,"date_tran"=>$date_time);
	$sys->db->update($tbl, $data_update,"id_torrent = '".$_GET['id']."'");
	$sys->fnc->redirect("main.php?op=".$_GET['op']."&act=".$_GET['act']."");
	}

	if($_GET['sort']=="up"){
	$rs = $sys->sortup($tbl,"number_sort",$_GET['id'],$_GET['id2']);
	$sys->fnc->redirect("main.php?op=".$_GET['op']."&act=".$_GET['act']."");
	}

	if($_GET['sort']=="down"){
	$rs = $sys->sortdown($tbl,"number_sort",$_GET['id'],$_GET['id2']);
	$sys->fnc->redirect("main.php?op=".$_GET['op']."&act=".$_GET['act']."");
	}

	if($_GET['download']=="download"){
	$sys->download($_GET['id_category'],$_GET['total_plate'],$_GET['id_torrent'],$page_admin,$_GET['torrent'],$_GET['stock'],$_GET['id_member']);
	}



?>

<FORM name="myForm" METHOD="POST" ACTION="">
<table width="100%" cellspacing="0" cellpadding="1" border="0" >
    <tr>
        <td align="center"><table width="100%" cellpadding="0" cellspacing="0"><tr>
          <td bgcolor="#BBD8EC" align="center" height="40" class="th">Content System</td>
        </tr></table></td>
    </tr>

    <tr>
        <td align="left"> <a href="main.php?op=<?=$_GET['op']?>&act=add&status_menu=<?=$_GET['status_menu']?>&status_tran_menu=<?=$_GET['status_tran_menu']?>"><img src="images/b_add.gif" /></a></td>
    </tr>
    <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="0" style="border:1px solid #BBD8EC">
    <tr  bgcolor="#BBD8EC">
	  <td class="th">ลำดับ</td>
	  
	  <?if($_SESSION['id_position']==1){?>
	  <td width = "84"><IMG SRC="Admin_files/true.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" style = "display:none;"  id = "check_true" onclick = "handler();"><IMG SRC="Admin_files/false.gif" WIDTH="14" HEIGHT="14" BORDER="0" ALT="" onclick="handler();" id = "check_false"></td>
	  <td  align="center" bgcolor="#BBD8EC" class="th">Download</td> 
	  <?}?>

      <td  align="center" bgcolor="#BBD8EC" class="th">ID JOB.</td>
      <td align="center" bgcolor="#BBD8EC" class="th">ชื่อไฟร์งาน</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">จำนวนเพลทที่คาดว่าจะใช้</td>
	  <!-- <td align="center" bgcolor="#BBD8EC" class="th">&nbsp;&nbsp;&nbsp;&nbsp;Screent shot</td> -->
	  <td align="center" bgcolor="#BBD8EC" class="th">ลักษณะของเพลท</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ผู้ทีทำการอัพโหลด</td>
	   <td align="center" bgcolor="#BBD8EC" class="th">Comment</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">งานเสร็จหรือไม่</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">ปรู๊ฟ</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">สถานะรับสินค้า</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Order_Date</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">Complete_Date</td>
	  <td align="center" bgcolor="#BBD8EC" class="th">เครื่องยิงเพลท</td>
	  <?if($_SESSION['id_position']==1){?>
      <td  align="center" bgcolor="#BBD8EC" class="th">Manage</td>
	  <?}?>
    </tr>

<?



if($_GET['p']!=""){
$i=((20*$_GET['p'])-20)+1;
}else{
$i=0;
}

if(!$row):
?>
    <tr height="30" bgcolor="#eeeeee">
      <td align="center" colspan="5" class="th2">No Data</td>
    </tr>
    <?
else:



foreach($row as $rs):
$bgc=($i++ % 2) ? '#FFFFFF' : '#E0F0F0';
?>
    <tr height="25" bgcolor="<?=$bgc?>" align="center" class="tb">
	  <td><?=$i?></td>
	  <?if($_SESSION['id_position']==1){?>
	  <td><A HREF="main.php?op=<?=$_GET['op']?>&act=<?=$_GET['act']?>&id=<?=$rs->number_sort?>&sort=down&id2=<?=$rs->id_torrent?>&status_menu=<?=$_GET['status_menu']?>&status_tran_menu=<?=$_GET['status_tran_menu']?>"><IMG SRC="images/other/asc.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></a><INPUT TYPE="checkbox" NAME="id[]" value = "<?=$rs->id_torrent?>">
	  <A HREF="main.php?op=<?=$_GET['op']?>&act=<?=$_GET['act']?>&id=<?=$rs->number_sort?>&sort=up&id2=<?=$rs->id_torrent?>&status_menu=<?=$_GET['status_menu']?>&status_tran_menu=<?=$_GET['status_tran_menu']?>"><IMG SRC="images/other/desc.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
	  </TD>
	 
	  <td align="center" bgcolor="<?=$bgc?>" style="color:#666">
	  <A HREF="main.php?op=<?=$_GET['op']?>&act=<?=$_GET['act']?>&download=download&torrent=<?=$rs->torrent_name?>&id_torrent=<?=$rs->id_torrent?>&total_plate=<?=$rs->qty_plate?>&id_category=<?=$rs->id_category?>&stock=<?=$rs->total_stock?>&id_member=<?=$_SESSION['id_member']?>&status_menu=<?=$_GET['status_menu']?>&status_tran_menu=<?=$_GET['status_tran_menu']?>">
	  <IMG SRC="Admin_files/start-button.png" WIDTH="30" HEIGHT="30" BORDER="0" ALT="">
	  </A></td>
	 <?}?>
      <td align="center" bgcolor="<?=$bgc?>" style="color:#666">TR<?=$fnc->number_pad($rs->id_torrent,5,"left");?></td>
      <td align="center" style="color:#666"><?=$rs->title_torrent;?></td>
	  <td align="center" style="color:#666"><?=$rs->qty_plate;?> แผ่น <br>รวม <?=($rs->qty_plate*$rs->price_unit)+$rs->plus_price;?> ฿</td>
	  <!-- <td align="center" style="color:#666"><img src="../thumb/<?=$rs->thumb_pic;?>" border="0" title="<?=strip_tags($rs->detail_torrent);?>" /></td> -->
	  <td align="center" style="color:#666">
	  <?php if($rs->name_category!=""){?>
	  <img src="../img_product/<?=$rs->pic_category;?>" border="0" /> 
	  <?php }else{
		echo '<font size="1" color="#ff0000">ชนิดplate ถูกลบแล้ว</font>';  
	  }
		  ?>

	  <br><?=$rs->name_category;?></td>
	  <td align="center" style="color:#666"><?=$rs->username;?></td>
	  <td align="center" style="color:#666"><?=nl2br($rs->detail_torrent);?></td>

	  <td align="center" style="color:#666">
	  <?if(($rs->status==1)and($_SESSION['id_position']==1)){?>
	  <A HREF="main.php?op=<?=$_GET['op']?>&act=<?=$_GET['act']?>&id=<?=$rs->id_torrent?>&status=0&status_menu=<?=$_GET['status_menu']?>&status_tran_menu=<?=$_GET['status_tran_menu']?>"><IMG SRC="images/status_on.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT=""></A>
	  <?}
	  else if(($rs->status==0) and($_SESSION['id_position']==1)){?>
	  <A HREF="main.php?op=<?=$_GET['op']?>&act=<?=$_GET['act']?>&id=<?=$rs->id_torrent?>&status=1&status_menu=<?=$_GET['status_menu']?>&status_tran_menu=<?=$_GET['status_tran_menu']?>"><IMG SRC="images/status_off.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT=""></A>
	  <?}?>

	  <?if(($rs->status==1)and($_SESSION['id_position']==2)){?>
	  <IMG SRC="images/status_on.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT="">
	  <?}
	  else if(($rs->status==0) and($_SESSION['id_position']==2)){?>
	  <IMG SRC="images/status_off.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT="">
	  <?}?>
	  </td>



	  <td align = "center">   <?=$fnc->status($rs->status_fast,"Yes","No");?>     </td>
		
	  <td align="center" style="color:#666">
	  <?if(($rs->status_tran==1)and($_SESSION['id_position']==1)){?>
	  <A HREF="main.php?op=<?=$_GET['op']?>&act=<?=$_GET['act']?>&id=<?=$rs->id_torrent?>&status_tran=0"><IMG SRC="images/status_on.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT=""></A>
	  <?}
	  else if(($rs->status_tran==0) and($_SESSION['id_position']==1)){?>
	  <A HREF="main.php?op=<?=$_GET['op']?>&act=<?=$_GET['act']?>&id=<?=$rs->id_torrent?>&status_tran=1"><IMG SRC="images/status_off.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT=""></A>
	  <?}?>

	  <?if(($rs->status_tran==1)and($_SESSION['id_position']==2)){?>
	  <IMG SRC="images/status_on.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT="">
	  <?}
	  else if(($rs->status_tran==0) and($_SESSION['id_position']==2)){?>
	  <IMG SRC="images/status_off.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT="">
	  <?}?><br>
	  <?$fnc->plus_date($rs->date_tran,"hour",0,"d-m-Y H:i")?>
	  </td>
	
	  <?
	  $date_time = strtotime('+0 hour', strtotime($rs->order_date));
	  $day = date("d-m-Y", $date_time);
      $time = date("H:i", $date_time);
	  $date_time_new = $day."<br>".$time;

	  
	  
	  $date_time2 = strtotime('+0 hour', strtotime($rs->last_date));
	  $day2 = date("d-m-Y", $date_time2);
      $time2 = date("H:i", $date_time2);
	  $date_time_new2 = $day2."<br>".$time2;
	  $date_check = strlen($rs->last_date);	
	  ?>

	  <td align="center" style="color:#666"><?//=$rs->order_date?><br><?=$date_time_new;?></td>
	  <td align="center" style="color:#666"><?//=$rs->last_date?><br>
	  <?if($date_check>10){echo $date_time_new2;}?></td>
	
	  <td>
	  <?php if($rs->machine_plate!="0"){echo "เครื่อง".$rs->machine_plate;}?>
	  </td>
	  
	  <?if($_SESSION['id_position']==1){?>
	  <td>&nbsp; 
	  <a href="main.php?op=<?=$_GET['op']?>&amp;id=<?=$rs->id_torrent?>&act=add&status_menu=<?=$_GET['status_menu']?>&status_tran_menu=<?=$_GET['status_tran_menu']?>"><img src="images/file_edit.png" border="0" title="Edit" /></a>&nbsp;
	  <a href="main.php?op=<?=$_GET[op];?>&act=list&amp;rd=<?=rand(1,99999); ?>&amp;del=<?=$rs->id_torrent?>&status_menu=<?=$_GET['status_menu']?>&status_tran_menu=<?=$_GET['status_tran_menu']?>"><img src="images/file_delete.png" border="0" title="Delete" onClick="return Conf('<?=$rs->title_torrent?>')" /></a> </td>
	  <?}?>
    </tr>
<?
endforeach;
endif;

function check_day($h){
if($h>24){
$h = $h-24;
return $h;
}else{
return $h;
}
}

function check_h($h,$d){
if($h>24){
$d = $d+1;
return $d;
}else{
return $d;
}
}
?>

<tr>
	<td>
	<INPUT TYPE="submit" value = "Delete All">
	</td>
	</tr>
</table>
<div align="left"></div>       
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
	  </td>
    </tr>
    <tr>
        <td><? echo $sys->db->render('main.php?op='.$_GET[op].'&act='.$_GET[act].'&last='.$i.'&status_menu='.$_GET['status_menu'].'&status_tran_menu='.$_GET['status_tran_menu'].'&'); ?></td>
    </tr>
    <tr>
    <td height="40" align="center">
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="th2">
  <tr height="30">
    <td height="40" colspan="2" align="center" bgcolor="#BBD8EC" class="th"></td>
  </tr>
</table>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        </td>
    </tr>
</table>
<?
if($_GET['file']!=""){
$sys->fnc->redirect("../torrent/".$_GET['file']."");
}	
?>