<html>
<head>
<title>まとめ</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
<script src="javascript-xpath-latest.js"></script>
<?php
require( "common.php" );
?>


<?php

$cstrsiteHTML = pfHpGet($_GET['name']);

//XpathでDOM要素の指定をする　なお、ループ処理になるのでforeachを使う  
  foreach($cstrsiteHTM->find('/html/body/div[3]/article/nav/ul/li[2]/ul/li[3] a') as $element){  
  echo $element->href . '<br>';  
  }  

?>

</body>
</html>