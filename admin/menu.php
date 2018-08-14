
<link  rel="stylesheet" href="system/style.css" type="text/css">
<link  rel="stylesheet" href="system/menu.css" type="text/css">    
<link rel="stylesheet" href="../treemenu/jquery.treeview.css" />
	<script type="text/javascript" src="jquery-1.3.2.js"></script>
	<script src="../treemenu/lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="../treemenu/jquery.treeview.js" type="text/javascript"></script>
	<script type="text/javascript" src="../treemenu/menuconfig/demo.js"></script>

<div id="menu10">
 
</div>






	<ul id="navigation"></ul>
		
<?php

//echo $_SESSION[id_division];
$_SESSION[id_division]=1;
function check_menu($op,$menu){
	if($op==$menu){
		return 'style = "background-color:#ccffff;"';
	}
}

?>


<h5><img src="images/icon_online.png" width="15" height="16" border="0" alt="">&nbsp;User: <?php echo $_SESSION['username'];?>&nbsp;(Store)
<p>[<a href="login.php?do=logout">logout]&nbsp;<img src="images/icon_logout.gif" width="16" height="16" border="0" alt=""></a></p>

</h5>
<hr>
<ul id="browser" class="filetree">

<li><span class="folder">::::::::::::: เมนู  :::::::::::::</span>
	<ul>

		<li><span class="folder" style = "color:#ff0000;">ระบบหลัก</span>
			<ul>
				<li <?php echo check_menu($_GET['op'],"product");?>><span class="file"><a href="?op=product&act=list&p=<?php echo $_SESSION['p__'];?>">Stock</a></span></li>

				

				<!-- <li <?php echo check_menu($_GET['op'],"product2");?>><span class="file"><a href="?op=product2&act=list&p=<?php echo $_SESSION['p__'];?>">Stock อุปกรณ์</a></span></li> -->
				
				<!-- <li <?php echo check_menu($_GET['op'],"add_stock");?>><span class="file"><a href="?op=add_stock&act=list">ตัด-เพิ่ม สต๊อกสินค้า</a></span></li>

				<li <?php echo check_menu($_GET['op'],"check_product");?>><span class="file"><a href="?op=check_product&act=add">เช็คประวัติสินค้า</a></span></li>
 -->
			
				<li <?php echo check_menu($_GET['op'],"buy");?>><span class="file"><a href="?op=buy&act=list">ออกบิลส่งของ  </a></span></li>
			

				

				<li <?php echo check_menu($_GET['op'],"buy_data");?>><span class="file"><a href="?op=buy_data&act=list">รายการส่งของ</a></span></li>

				<!-- <li <?php echo check_menu($_GET['op'],"rent");?>><span class="file"><a href="?op=rent&act=list">ยืมสินค้า</a></span></li>

				<?php if(($_SESSION[id_division]=="1") or ($_SESSION[id_division]=="3")){?>
				<li <?php echo check_menu($_GET['op'],"_return");?>><span class="file"><a href="?op=_return&act=add">คืนสินค้า</a></span></li>
				<?php }?> -->

				<!--<li <?php echo check_menu($_GET['op'],"product_branch");?> style = "font-color:#e2e2e2;"><span class="file"><a href="?op=product_branch&act=list&p=<?php echo $_SESSION['p__'];?>">นำสินค้าเข้า(สาขา)</a></span></li>

				<li <?php echo check_menu($_GET['op'],"buy_branch");?>><span class="file"><a href="?op=buy_branch&act=list">ขายสินค้า(สาขา)</a></span></li>

				<li <?php echo check_menu($_GET['op'],"buy_data_branch");?>><span class="file"><a href="?op=buy_data_branch&act=list">รายการขาย(สาขา)</a></span></li> -->

			</ul>
		</li>



	</ul>
</li>


<li><span class="folder" style = "color:#ff0000;">ข้อมูลคลัง</span>
	<ul>
			<ul>
				<li <?php echo check_menu($_GET['op'],"section");?>><span class="file"><a href="?op=section&act=list">คลังสินค้าเก็บ</a></span></li>

				<!-- <li <?php echo check_menu($_GET['op'],"fare");?>><span class="file"><a href="?op=fare&act=list">คลังสินค้าชั่วคราว</a></span></li>
 -->
			
				
			</ul>
	</ul>
</li>


<li><span class="folder" style = "color:#ff0000;">กรอบ 90/70/75</span>
	<ul>
			<ul>
	
				 <li <?php echo check_menu($_GET['op'],"type");?>><span class="file"><a href="?op=type&act=list">ค่าแรงตั้งต้น&nbsp;ในเครือ</a></span></li>

				 <li <?php echo check_menu($_GET['op'],"type_sub");?>><span class="file"><a href="?op=type_sub&act=list">ค่าแรงตั้งต้น&nbsp;นอกเครือ</a></span></li>
				
			</ul>
	</ul>
</li>

<li><span class="folder" style = "color:#ff0000;">ตลับ</span>
	<ul>
			<ul>
	
				 <li <?php echo check_menu($_GET['op'],"type2");?>><span class="file"><a href="?op=type2&act=list">ค่าแรงตั้งต้น&nbsp;ในเครือ</a></span></li>

				 <li <?php echo check_menu($_GET['op'],"type2_sub");?>><span class="file"><a href="?op=type2_sub&act=list">ค่าแรงตั้งต้น&nbsp;นอกเครือ</a></span></li>
				
			</ul>
	</ul>
</li>

<li><span class="folder" style = "color:#ff0000;">อุปกรณ์</span>
	<ul>
			<ul>
				  <li <?php echo check_menu($_GET['op'],"type_accessories");?>><span class="file"><a href="?op=type_accessories&act=list">ประเภทอุปกรณ์</a></span></li> 

				  <li <?php echo check_menu($_GET['op'],"type3");?>><span class="file"><a href="?op=type3&act=list">ค่าแรงตั้งต้น&nbsp;ในเครือ</a></span></li>

				  <li <?php echo check_menu($_GET['op'],"type3_sub");?>><span class="file"><a href="?op=type3_sub&act=list">ค่าแรงตั้งต้น&nbsp;นอกเครือ</a></span></li>

				  <li <?php echo check_menu($_GET['op'],"setting_accessories");?>><span class="file"><a href="?op=setting_accessories&act=list">กำหนดเปอร์เซ็น</a></span></l>
				 
				  <li <?php echo check_menu($_GET['op'],"setting_accessories_si");?>><span class="file"><a href="?op=setting_accessories_si&act=list">กำหนดเค่าซิ </a></span></li> 

			</ul>
	</ul>
</li>


<?php if( ($_SESSION[id_division] == "1") or ($_SESSION[id_division] == "2") ){?>
<li><span class="folder" style = "color:#ff0000;">ข้อมูลหลัก</span>
	<ul>
			<ul>

				<li <?php echo check_menu($_GET['op'],"branch");?>><span class="file"><a href="?op=branch&act=list">สาขา</a></span></li>
				
				<li <?php echo check_menu($_GET['op'],"diamond");?>><span class="file"><a href="?op=diamond&act=list">ฝังเพชร/เปอร์เซ็น</a></span></li>

				<li <?php echo check_menu($_GET['op'],"category");?>><span class="file"><a href="?op=category&act=list">แบบพิมพ์</a></span></li>

				<!-- <li <?php echo check_menu($_GET['op'],"type");?>><span class="file"><a href="?op=type&act=list">ลักษณะกรอบ</a></span></li>
 -->
				


				

				

				 <li <?php echo check_menu($_GET['op'],"setting_");?>><span class="file"><a href="?op=setting_&act=list">กำหนดค่าซิ  - ค่าแรง</a></span></li> 


				 
				
				

				

				<!-- <li <?php echo check_menu($_GET['op'],"medicine");?>><span class="file"><a href="?op=medicine&act=list">ลงยา</a></span></li> -->
	
				<!-- <li <?php echo check_menu($_GET['op'],"backmunk");?>><span class="file"><a href="?op=backmunk&act=list">แผ่นปิดหลัง</a></span></li> -->

				<!-- <li <?php echo check_menu($_GET['op'],"special");?>><span class="file"><a href="?op=special&act=list">ลักษณะพิเศษ</a></span></li> -->

				

				<!-- <li <?php echo check_menu($_GET['op'],"diamond");?>><span class="file"><a href="?op=diamond&act=list">ฝังเพชร/เปอร์เซ็น</a></span></li> -->



				<li <?php echo check_menu($_GET['op'],"gold_price2");?>><span class="file"><a href="?op=gold_price2&act=list">ราคาทอง<br>(goldhips)</a></span></li>

				<li <?php echo check_menu($_GET['op'],"gold_price");?>><span class="file"><a href="?op=gold_price&act=list">ราคาทอง<br>(goldtraders)</a></span></li>

				<li <?php echo check_menu($_GET['op'],"member");?>><span class="file"><a href="?op=member&act=list">ข้อมูลพนักงาน</a></span></li>
		

				<!-- <a <?php if($_GET['op']=='member'){?> id="current" <?php }?> href="?op=member&act=add&id=<?php echo $_SESSION[id_member];?>">แก้ไขข้อมูลส่วนตัว&nbsp;<img src="images/icon_edit_red.gif" width="18" height="15" border="0" alt=""></a> -->
				
			</ul>
	</ul>
</li>
<?php }?>


</ul>

<hr>
 