<?php
require( "common.php" );
include_once('simple_html_dom.php');
$cstrsiteHTML = pfHpGet('http://2ch-c.net/');
$html = str_get_html($cstrsiteHTML);


//Xpath��DOM�v�f�̎w�������@�Ȃ��A���[�v�����ɂȂ�̂�foreach���g��  
  foreach($html->find('div[class="bar"]') as $element){  
	if ($element->innertext > 500){

		//�܂Ƃ߃u���O�擾
		$matomehtml=str_get_html($element->parent->parent->parent->innertext);
		$cnt=0;
		foreach($matomehtml->find('a') as $matomeelement){
			if ($cnt==0){
				$cstrSAKIHTML = pfHpGet($matomeelement->href);
				if(preg_match_all('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', $cstrSAKIHTML, $result) !== false){
				    foreach ($result[0] as $value){
				        //URL�\��
				        	//print $value . 'AAAA<br>';
					if (strpos($value, "2ch.sc") !== FALSE){
						print '-----------'. '<br>';
						echo $element->parent->parent->parent->innertext ."</br>"."\n";
				        	print $value . '<br>';
						break;
					}

				    }
				}
			}
			$cnt=$cnt+1;
		}
	}
  }  

//  echo $html ;

?>