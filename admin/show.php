<?php require "../module/database.php";

	if($_GET['op']==""){include '__include/logo.php';}

////////////////member/////////////////////////////////////////

	if(($_GET['op']=='member') and ($_GET[act]=="list")){
		include "../system/member.php";
		$sys  = new member($db,$fnc);
		include '__include/member_list.php';
		}
	if(($_GET['op']=='member') and ($_GET[act]=="add")){	
		include "../system/member.php";
		$sys  = new member($db,$fnc);
		include '__include/add_member.php';
		}
	if(($_GET['op']=='member') and ($_GET[act]=="permission")){
		include "../system/member.php";
		$sys  = new member($db,$fnc);
		include '__include/add_permission.php';
	    }
	
///////////////////////////////////////////////////////////////



///////////////qc/////////////////////////////////////////////
if(($_GET['op']=='qc') and ($_GET[act]=="list")){
	include "../system/product.php";
	$sys  = new product($db,$fnc);

	include "__include/qc_list.php";
}
if(($_GET['op']=='qc') and ($_GET[act]=="add")){
	include "__include/add_qc.php";
} 
/////////////////////////////////////////////////////////////



/////////////Color//////////////////////////////////////////
if(($_GET['op']=='color') and ($_GET[act]=="list")){
	include "../system/color.php";
	$sys = new color($db,$fnc);
	include '__include/color_list.php';
}
if(($_GET['op']=='color') and ($_GET[act]=="add")){
	include "../system/color.php";
	$sys = new color($db,$fnc);
	include '__include/add_color.php';
}

////////////////////////////////////////////////////////////

/////////////type_accessories//////////////////////////////////////////
if(($_GET['op']=='type_accessories') and ($_GET[act]=="list")){
	include "../system/type_accessories.php";
	$sys = new type_accessories($db,$fnc);
	include '__include/type_accessories_list.php';
}
if(($_GET['op']=='type_accessories') and ($_GET[act]=="add")){
	include "../system/type_accessories.php";
	$sys = new type_accessories($db,$fnc);
	include '__include/add_type_accessories.php';
}

////////////////////////////////////////////////////////////


////////////////งานแฟร์//////////////////////////////////////
if(($_GET['op']=='fare') and ($_GET[act]=="list")){
	    include '../system/stock.php';
		$sys = new stock($db,$fnc);
		include '__include/fare_list.php';
	    }

if(($_GET['op']=='fare') and ($_GET[act]=="add")){
		include '../system/stock.php';
		$sys = new stock($db,$fnc);
		include '__include/fare_add.php';
	    }
/////////////////////////////////////////////////////////////



/////////////ข้อมูลหลัก/////////////////////////////////////////////////

	if(($_GET['op']=='branch') and ($_GET[act]=="list")){	
		$sys  = new branch($db,$fnc);
		include "../system/branch.php";
		include '__include/branch_list.php';
		}

	if(($_GET['op']=='branch') and ($_GET[act]=="add")){
		$sys  = new branch($db,$fnc);
		include "../system/branch.php";
		include '__include/add_branch.php';
		}

	if(($_GET['op']=='section') and ($_GET[act]=="list")){	
		$sys  = new stock($db,$fnc);
		include "../system/stock.php";
		include '__include/section_list.php';
		}

	if(($_GET['op']=='section') and ($_GET[act]=="add")){
		$sys  = new stock($db,$fnc);
		include "../system/stock.php";
		include '__include/add_section.php';
		}
	
	if(($_GET['op']=='type') and ($_GET[act]=="list")){	
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/type_list.php';
		}

	if(($_GET['op']=='type_sub') and ($_GET[act]=="list")){	
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/type_sub_list.php';
		}

	if(($_GET['op']=='type2') and ($_GET[act]=="list")){	
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/type2_list.php';
		}

	if(($_GET['op']=='type2_sub') and ($_GET[act]=="list")){	
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/type2_sub_list.php';
		}
	

	if(($_GET['op']=='type3') and ($_GET[act]=="list")){	
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/type3_list.php';
		}

	if(($_GET['op']=='type3_sub') and ($_GET[act]=="list")){	
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/type3_sub_list.php';
		}

	if(($_GET['op']=='type') and ($_GET[act]=="add")){
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/add_type.php';
		}
	
	if(($_GET['op']=='type2') and ($_GET[act]=="add")){
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/add_type2.php';
		}

	if(($_GET['op']=='type3') and ($_GET[act]=="add")){
		include "../system/type.php";
		$sys  = new type($db,$fnc);
		include '__include/add_type3.php';
		}

	if(($_GET['op']=='medicine') and ($_GET[act]=="list")){	
		include "../system/medicine.php";
		$sys  = new medicine($db,$fnc);
		include '__include/medicine_list.php';
		}
	if(($_GET['op']=='medicine') and ($_GET[act]=="add")){
		include "../system/medicine.php";
		$sys  = new medicine($db,$fnc);
		include '__include/add_medicine.php';
		}

	if(($_GET['op']=='backmunk') and ($_GET[act]=="list")){	
		$sys  = new backmunk($db,$fnc);
		include "../system/backmunk.php";
		include '__include/backmunk_list.php';
		}

	if(($_GET['op']=='backmunk') and ($_GET[act]=="add")){
		$sys  = new backmunk($db,$fnc);
		include "../system/backmunk.php";
		include '__include/add_backmunk.php';
		}

	if(($_GET['op']=='special') and ($_GET[act]=="list")){	
		$sys  = new special($db,$fnc);
		include "../system/special.php";
		include '__include/special_list.php';
		}

	if(($_GET['op']=='special') and ($_GET[act]=="add")){
		$sys  = new special($db,$fnc);
		include "../system/special.php";
		include '__include/add_special.php';
		}

	if(($_GET['op']=='step_') and ($_GET[act]=="list")){	
		$sys  = new step_($db,$fnc);
		include "../system/step_.php";
		include '__include/step__list.php';
		}

	if(($_GET['op']=='step_') and ($_GET[act]=="add")){
		$sys  = new step_($db,$fnc);
		include "../system/step_.php";
		include '__include/add_step_.php';
		}

	if(($_GET['op']=='diamond') and ($_GET[act]=="list")){	
		$sys  = new diamond($db,$fnc);
		include "../system/diamond.php";
		include '__include/diamond_list.php';
		}

	if(($_GET['op']=='diamond') and ($_GET[act]=="add")){
		$sys  = new diamond($db,$fnc);
		include "../system/diamond.php";
		include '__include/add_diamond.php';
		}

	if(($_GET['op']=='setting_') and ($_GET[act]=="list")){	
		$sys  = new setting_($db,$fnc);
		include "../system/setting_.php";
		include '__include/setting__list.php';
		}

	if(($_GET['op']=='setting_accessories') and ($_GET[act]=="list")){	
		$sys  = new setting_($db,$fnc);
		include "../system/type.php";
		include '__include/setting_accessories__list.php';
		}

	if(($_GET['op']=='setting_accessories_si') and ($_GET[act]=="list")){	
		$sys  = new setting_($db,$fnc);
		include "../system/type.php";
		include '__include/setting_accessories__si_list.php';
		}


	if(($_GET['op']=='category') and ($_GET[act]=="list")){	
		include "../system/category.php";
		$sys  = new category($db,$fnc);
		include '__include/category_list.php';
		}

	

	if(($_GET['op']=='category') and ($_GET[act]=="list_subcategory")){	
		include "../system/category.php";
		$sys  = new category($db,$fnc);
		include '__include/category_sub_list.php';
		}
	if(($_GET['op']=='category') and ($_GET[act]=="add_subcategory")){	
		include "../system/category.php";
		$sys  = new category($db,$fnc);
		include '__include/category_sub_add.php';
		}


	if(($_GET['op']=='category') and ($_GET[act]=="add")){
		include "../system/category.php";
		$sys  = new category($db,$fnc);
		include '__include/add_category.php';
		}

	
	if(($_GET['op']=='gold_price') and ($_GET[act]=="list")){	
		$sys  = new stock($db,$fnc);
		include "../system/stock.php";
		include '__include/gold_price_list.php';
		}

	if(($_GET['op']=='gold_price2') and ($_GET[act]=="list")){	
		$sys  = new stock($db,$fnc);
		include "../system/stock.php";
		include '__include/gold_price2_list.php';
		}

////////////////////////////////////////////////////////////////////




//////////////Stock On  Hand////////////////////////////////////////
if(($_GET['op']=='product') and ($_GET[act]=="list")){
		include "../system/product.php";
		$sys  = new product($db,$fnc);
		include '__include/product_list.php';
		}
if(($_GET['op']=='product') and ($_GET[act]=="add")){
		include "../system/product.php";
		$sys  = new product($db,$fnc);
		include '__include/add_product.php';
		}

if(($_GET['op']=='product') and ($_GET[act]=="fare")){
		include "../system/product.php";
		$sys  = new product($db,$fnc);
		include '__include/product_list_fare.php';
		}
/////////////////////////////////////////////////////////////////


//////////////เช็คสินค้า///////////////////////////////////////////
if(($_GET['op']=='check_product') and ($_GET[act]=="add")){
	include "../system/product.php";
	$sys  = new product($db,$fnc);
	include '__include/check_product.php';
}
///////////////////////////////////////////////////////////////



//////////////สั่งซื้อสินค้า////////////////////////////////////////
if(($_GET['op']=='buy') and ($_GET[act]=="list")){	
	    $sys  = new invoice($db,$fnc);
		include '__include/add_buy.php';
		}
if(($_GET['op']=='buy_data') and ($_GET[act]=="list")){	
	    $sys  = new invoice($db,$fnc);
		include '__include/invoice_list.php';
		}

/////////////////////////////////////////////////////////////////






////////////////คืนสต๊อก/////////////////////////////////////////

	if(($_GET['op']=='_return') and ($_GET[act]=="list")){	
		$sys = new product_return($db,$fnc);
		include "../system/product_return.php";
		include '__include/_return_list.php';
		}

    if(($_GET['op']=='_return') and ($_GET[act]=="add")){	
		$sys = new product_return($db,$fnc);
		include "../system/product.php";
		include '__include/_return_add.php';
		}
///////////////////////////////////////////////////////////////


////////////////ยืมสต๊อก/////////////////////////////////////////

	if(($_GET['op']=='rent') and ($_GET[act]=="list")){	
		$sys = new rent($db,$fnc);
		include "../system/rent.php";
		include '__include/rent_list.php';
		}
    if(($_GET['op']=='rent') and ($_GET[act]=="add")){	
		$sys = new rent($db,$fnc);
		include "../system/rent.php";
		include '__include/add_rent.php';
		}
////////////////////////////////////////////////////////////////////////////


/////////////// เพิ่มสต๊อก ///////////////////////////////////////////

if(($_GET['op']=='add_stock') and ($_GET[act]=="list")){	
		$sys = new add_stock($db,$fnc);
		include "../system/add_stock.php";
		include '__include/add_stock_list.php';
		}

if(($_GET['op']=='add_stock') and ($_GET[act]=="add")){	
		$sys = new add_stock($db,$fnc);
		include "../system/add_stock.php";
		include '__include/add_stock_add.php';
		}
//////////////////////////////////////////////////////////////////

?>
