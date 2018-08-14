<?php
$text = $_POST[data];
echo wordwrap($text, 20, "<br />\n");


?>

<form id="form1" name="form1" method="post" action="">
  <label>
  <textarea name="data" wrap="physical"></textarea>
  <br />
  <br />
  <input type="submit"/>
  </label>
</form>
