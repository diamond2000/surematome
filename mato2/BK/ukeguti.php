<html>
<head>
<title>まとめ</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
<script src="javascript-xpath-latest.js"></script>
<?php
require( "common.php" );
include_once('simple_html_dom.php');
?>


<?php

$cstrsiteHTML = pfHpGet($_GET['name']);
$html = str_get_html($cstrsiteHTML);

//XpathでDOM要素の指定をする　なお、ループ処理になるのでforeachを使う  
  foreach($html->find('/html/body/div[3]/article/nav/ul/li[2]/ul/li a') as $element){  
  echo $element->href ;
  }  

?>

</body>
</html>