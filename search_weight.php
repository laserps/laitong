<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language = "JavaScript">
var objRequest = createRequestObject () ;
function createRequestObject () {
					var objTemp = false ;
					if (window.XMLHttpRequest) {
					objTemp = new XMLHttpRequest () ;
					}else if (window.ActiveXObject) {
					objTemp = new ActiveXObject ("Microsoft.XMLHTTP") ;	
					}
					return objTemp ;
				}
function fnc_search(){
	     var postBody = '';
		objRequest.open('POST', 'test_shell.php?'+ Math.random(), true);
		objRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		objRequest.onreadystatechange = fnc_show_search;
		objRequest.send(postBody);
	}



function fnc_show_search() {
		
		if (objRequest.readyState == 4 && objRequest.status ==200) {
			var data	=	objRequest.responseText;
			document.getElementById('weight').value = data;

	    
		}

	}

</script>
<input type="text" id="weight" style = "width:600px;"><input type="button" value="ขอน้ำหนัก" onclick="fnc_search();">