<?php 
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// Control usage demonstration file
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// $Revision: 1.6 $, $Date: 2004/12/30 09:38:27 $
// ================================================

// this part determines the physical root of your website
// it's up to you how to do this
if (!ereg('/$', $HTTP_SERVER_VARS['DOCUMENT_ROOT']))
  $_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'].'/';
else
  $_root = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];

define('DR', $_root);
unset($_root);

// set $spaw_root variable to the physical path were control resides
// don't forget to modify other settings in config/spaw_control.config.php
// namely $spaw_dir and $spaw_base_url most likely require your modification
$spaw_root = DR.'wysiwyg/spaw/';

// include the control file
include $spaw_root.'spaw_control.class.php';

// here we add some styles to styles dropdown
$spaw_dropdown_data['style']['default'] = 'No styles';
$spaw_dropdown_data['style']['style1'] = 'Style no. 1';
$spaw_dropdown_data['style']['style2'] = 'Style no. 2';

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>SPAW Editor แบบที่ 5</title>
</head>
<body>
<h2> แบบที่ 5</h2>
<form name="spawdemo" method="post" action="output_spaw5.php">
<?php 
$sw = new SPAW_Wysiwyg('spaw5' /*name*/,isset($HTTP_POST_VARS['spaw5'])?stripslashes($HTTP_POST_VARS['spaw5']):'' /*value*/,
                       'en' /*language*/, 'mini' /*toolbar mode*/, '' /*theme*/,
                       '250px' /*width*/, '90px' /*height*/, 'scripts/demo_red.css' /*stylesheet file*/);
$sw->show();
?>
<INPUT TYPE="submit">
</form>
</body>
</html>
