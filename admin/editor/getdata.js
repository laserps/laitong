var objRequest = createRequestObject () ;

	function createRequestObject () {
		var objTemp = false ;

		if (window.XMLHttpRequest) {
			objTemp = new XMLHttpRequest () ;
		}

		else if (window.ActiveXObject) {
			objTemp = new ActiveXObject ("Microsoft.XMLHTTP") ;	
		}
return objTemp ;
}

function geteditcategory (id,getch) {
	if (objRequest) {
		objRequest.open("GET", "system/category_form.php?id="+id+"&ch="+getch);
		objRequest.onreadystatechange = handleResponse;
		objRequest.send(null);
		document.getElementById("dump").innerHTML=" ";
	}
}

function getcategory () {
	if (objRequest) {
		objRequest.open("GET", "system/category_form.php");
		objRequest.onreadystatechange = handleResponse;
		objRequest.send(null);
		document.getElementById("dump").innerHTML=" ";
	}
}

function delcategory (id,name) {
	if(true == confirm("การลบหมาวดข่าวดังกล่าว จำทำให้ข่าวในหมวดนี้ถูกลบไปด้วย \n คุณแน่ใจหรือไม่ที่จะลบหมวด"+name)){
		if (objRequest) {
			postBody = 'category_id=' + id
			+ '&submit_type=' + "del";
			objRequest.open('POST', 'system/category_addeditdel.php', true);
			objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			objRequest.onreadystatechange = handleResponsepage;
			objRequest.send(postBody);
		}
	}
}
function delcomment (id) {
	if(true == confirm("คุณแน่ใจหรือไม่ที่จะลบความคิดเห็นนี้")){
		if (objRequest) {
			postBody = 'delcomment=' + id;
			objRequest.open('POST', 'system/comments_action.php', true);
			objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			objRequest.onreadystatechange = function()
			{
			if(objRequest.readyState == 4)
				{
					location.href=location.href;
				}
			}
			objRequest.send(postBody);
		}
	}
}
function delnews (id,name) {
	if(true == confirm("ยืนยันการลบข่าว "+name)){
		if (objRequest) {
			postBody = 'del_id=' + id;
			objRequest.open('POST', 'system/news_action.php', true);
			objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			objRequest.onreadystatechange = function()
			{
			if(objRequest.readyState == 4)
				{
					location.href=location.href;
				}
			}
			objRequest.send(postBody);
		}
	}
}
function Submitcategory() {
	var category_id,category_name,category_sefriendly,category_public,category_status,submit_type;
	category_id=document.getElementById("category_id");
	category_name=document.getElementById("category_name");
	category_sefriendly=document.getElementById("category_sefriendly");
	category_public=document.getElementById("category_public");
	if(document.getElementById("category_status").checked==true)
	category_status="Active";
	else 
	category_status="Inactive";
	submit_type=document.getElementById("submit_type");

	postBody = 'category_name=' + category_name.value 
	+ '&category_id=' + category_id.value 
	+ '&category_sefriendly=' + category_sefriendly.value 
	+ '&category_public=' + category_public.value
	+ '&category_status=' + category_status
	+ '&submit_type=' + submit_type.value;

		objRequest.open('POST', 'system/category_addeditdel.php', true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.onreadystatechange = handleResponsepage;
		objRequest.send(postBody);
}

function handleResponse () {

	var objDiv = document.getElementById("getdata");
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		objDiv.innerHTML = objRequest.responseText;
	}
}

function handleResponsepage () {

	var objDiv = document.getElementById("getdatapage");
	if (objRequest.readyState == 4 && objRequest.status ==200) {
		objDiv.innerHTML = objRequest.responseText;
	}
}
function link(id){
      location.href="system.php?op=news&cid="+id;
}

function linkcomments(id){
      location.href="system.php?op=comments&status="+id;
}

function linkcomplain_status(id){
      location.href="system.php?op=complain&status="+id;
}

function linkcomplain_type(id){
      location.href="system.php?op=complain&type="+id;
}

function linkuser_type(id){
      location.href="system.php?op=user&type="+id;
}

function linkuser_status(id){
      location.href="system.php?op=user&status="+id;
}

function linknews_status(id){
      location.href="system.php?op=news&status="+id;
}

function newssubmit(frm)
{
	var postBody = getRequestBody( frm ); //เอาค่านี้ไปใช้งานต่อนะจ๊ะ
		objRequest.open('POST', 'system/news_action.php', true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if(objRequest.readyState == 4)
				{
					location.href=location.href;
				}
			}
  
}

function commentssubmit(frm)
{
	var postBody = getRequestBody( frm ); //เอาค่านี้ไปใช้งานต่อนะจ๊ะ
		objRequest.open('POST', 'system/comments_action.php', true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if(objRequest.readyState == 4)
				{
					location.href=location.href;
				}
			}
  
}

function complainsubmit(frm)
{
	var postBody = getRequestBody( frm ); //เอาค่านี้ไปใช้งานต่อนะจ๊ะ
		objRequest.open('POST', 'system/complain_action.php', true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if(objRequest.readyState == 4)
				{
					location.href=location.href;
				}
			}
  
}

function usersubmit(frm)
{
	var postBody = getRequestBody( frm ); //เอาค่านี้ไปใช้งานต่อนะจ๊ะ
		objRequest.open('POST', 'system/user_action.php', true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if(objRequest.readyState == 4)
				{
					location.href=location.href;
				}
			}
  
}

function getRequestBody( pForm ) {//รับ formname
  var nParams = new Array();
  var i =1;
  for ( var n = 0 ; n < pForm.elements.length ; n++ )
  {
    if ( (pForm.elements[n].checked == true && pForm.elements[n].type == "checkbox" )
	      || ( pForm.elements[n].type != "radio" && pForm.elements[n].type != "checkbox" ) ) //element อื่นๆ
    {
	var pParam = encodeURIComponent( pForm.elements[n].name );
	if(pParam=="id"){
		pParam += "[" +i + "]=";
		i++;
	}
	else
		pParam += "=";
		pParam += encodeURIComponent( pForm.elements[n].value );
		nParams.push( pParam ); //นำมาใส่ Array
    }
  }
  return nParams.join( "&" ); //แปลง Array ให้เป็น String
}
function viewpage( pv )
{ 
		var postBody = getRequestBody( pv ); //เอาค่านี้ไปใช้งานต่อนะจ๊ะ
		objRequest.open('POST', 'system/news_action.php', true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if(objRequest.readyState == 4)
				{
					location.href=location.href;
				}
			}
}

function getcomments (id) {
	if (objRequest) {
		postBody = 'getid='+id;
		objRequest.open("POST", "system/comments_action.php", true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if (objRequest.readyState == 4 && objRequest.status ==200)
				{
					var objDiv = document.getElementById("comment_edit_form_"+id);
					objDiv.innerHTML = objRequest.responseText;
				}
			}
	}
}

function delcomplain (id) {
	if (objRequest) {
		postBody = 'getid='+id;
		objRequest.open("POST", "system/complain_action.php", true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if (objRequest.readyState == 4 && objRequest.status ==200)
				{
					location.href=location.href;
				}
			}
	}
}

function complaintrue (id,status) {
	if (status!='1') {
		postBody = 'trueid='+id;
		objRequest.open("POST", "system/complain_action.php", true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if (objRequest.readyState == 4 && objRequest.status ==200)
				{
					location.href=location.href;
				}
			}
	}
}

function editcomments( id )
{
	var description;
		description=document.getElementById("comments_description");
		postBody = 'description=' + description.value 
		+ '&edit=' + id;
		objRequest.open('POST', 'system/comments_action.php', true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if (objRequest.readyState == 4 && objRequest.status ==200)
				{
					var objDiv = document.getElementById("comment_"+id);
					objDiv.innerHTML = objRequest.responseText;
				}
			}
}
function deluser (id) {
	if(true == confirm("ยืนยันการลบสมาชิก")){
		postBody = 'delid='+id;
		objRequest.open("POST", "system/user_action.php", true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.send(postBody);
			objRequest.onreadystatechange = function()
			{
			if (objRequest.readyState == 4 && objRequest.status ==200)
				{
					location.href=location.href;
				}
			}
	}
}