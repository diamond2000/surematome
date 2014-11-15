<?php
$doc = new DOMDocument();
$doc->loadHTML('<html><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><body>aaaああ<br></body></html>');
echo $doc->saveHTML();
?>
