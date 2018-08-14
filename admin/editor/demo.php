<?php
include("fckeditor.js") ;
?>
<html>
<head>
<title>FCKeditor - Sample</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<form action="save_data.php" method="post">
<?php
$oFCKeditor = new FCKeditor('detail') ;
$oFCKeditor->BasePath = '/editor/';
$oFCKeditor->Value = 'Default text in editor';
$oFCKeditor->Create() ;
?>
<br>
<input type="submit" value="Submit">
</form>
</body>
</html>