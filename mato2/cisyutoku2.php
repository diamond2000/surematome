﻿<?php
require( "common.php" );
include_once('simple_html_dom.php');
$cstrsiteHTML = pfHpGet('http://2ch-c.net/');
$html = str_get_html($cstrsiteHTML);


//XpathでDOM要素の指定をする　なお、ループ処理になるのでforeachを使う  
  foreach($html->find('div[class="bar"]') as $element){  
	if ($element->innertext > 500){

		//まとめブログ取得
		$matomehtml=str_get_html($element->parent->parent->parent->innertext);
		$cnt=0;
		foreach($matomehtml->find('a') as $matomeelement){
			if ($cnt==0){
				$cstrSAKIHTML = pfHpGet($matomeelement->href);
				if(preg_match_all('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', $cstrSAKIHTML, $result) !== false){
				    foreach ($result[0] as $value){
				        //URL表示
				        	//print $value . 'AAAA<br>';
					if (strpos($value, "2ch.sc") !== FALSE){
						print '-----------'. '<br>'."\n";
						echo $element->parent->parent->parent->innertext ."</br>"."\n";
				        	print $value . '<br>'."\n";
						//タイトル取得
						$cstrTITLEHTML = pfHpGet($value);
						$htmlTITLE=str_get_html($cstrTITLEHTML);
						foreach($htmlTITLE->find('title') as $titleelement){ 
							echo mb_convert_encoding($titleelement->innertext, "UTF-8", "SJIS");
							echo '</br>';
						}

						//投稿用リンク
						echo '<a href="./bunbun.php?title='.urlencode(mb_convert_encoding($titleelement->innertext, "UTF-8", "SJIS")).'&url='.$value.'">ブンブン</a></br>'."\n";
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