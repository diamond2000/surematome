<?php
require( "common.php" );
include_once('simple_html_dom.php');
$cstrsiteHTML = pfHpGet('http://2ch-c.net/');
$html = str_get_html($cstrsiteHTML);

//XpathでDOM要素の指定をする　なお、ループ処理になるのでforeachを使う  
  foreach($html->find('div[class="bar"]') as $element){  
  	echo $element->parent->parent->parent->innertext ."</br>"."\n";
//print_r  ($element->parent);
  }  

//  echo $html ;

?>