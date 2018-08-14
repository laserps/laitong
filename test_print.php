
<html>
<head>
<script type="text/javascript">
function printit(){ 
    var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>'; 
    document.body.insertAdjacentHTML('beforeEnd', WebBrowser); WebBrowser1.ExecWB(6, -1); 
    WebBrowser1.outerHTML = ""; 
}

</script>

</head>
<body >
test
<input type="button" value="Print" onclick="printit();">
</body>
</html>