<?php
require( "common.php" );
include_once('simple_html_dom.php');
$cstrsiteHTML = pfHpGet('http://2ch-c.net/');
$html = str_get_html($cstrsiteHTML);

//Xpath��DOM�v�f�̎w�������@�Ȃ��A���[�v�����ɂȂ�̂�foreach���g��  
  foreach($html->find('div[class="bar"]') as $element){  
  	echo $element->parent->parent->parent->innertext ."</br>"."\n";
//print_r  ($element->parent);
  }  

//  echo $html ;

?>