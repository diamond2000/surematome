﻿<html>
<head>
<title>ぶんぶんまとめ</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
<form action="toukou.php" method="post">
<input type="submit" name="button" />
<?php
include_once('matookikae.php');
include_once('simple_html_dom.php');

	echo '<input type="hidden" name="url" value="'.$_GET["url"].'"/>';
	echo '<input type="hidden" name="title" value="'.$_GET["title"].'"/>'."\n";

	$match = getmatookikae($_GET["url"]);
$string='';
	//画像置き換え
	$count = 0;
	while ($count < count($match[0])){
		//$pattern= '/<a href="(.*?).jpg" target="_blank">(.*?)<\/a>/';
		//$match[0][$count] = preg_replace($pattern, '<a href="$1.jpg"><img src="$1.jpg">$2</img></a>' , $match[0][$count]);
		//$pattern= '/<a href="(.*?).png" target="_blank">(.*?)<\/a>/';
		//$match[0][$count] = preg_replace($pattern, '<a href="$1.png"><img src="$1.png">$2</img></a>' , $match[0][$count]);
		//$pattern= '/<a href="(.*?).gif" target="_blank">(.*?)<\/a>/';
		//$match[0][$count] = preg_replace($pattern, '<a href="$1.gif"><img src="$1.gif">$2</img></a>' , $match[0][$count]);

//		echo $match[0][$count]."\n";
$string=$string.$match[0][$count]."\n";


		$pattern = '/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpg|gif|png)/';
		preg_match_all($pattern, $match[0][$count], $matches);
		if(count($matches)){
		    foreach($matches[0] as $i=>$url) {
		        //$replace = "<img src='h{$url}'>";
		        //$images[] = $replace;
		        //$body = str_replace($url, $replace, $body);
		//	echo '<input type="checkbox" name="gazo[]" value="'.$url.'" />';
		//	echo '<a href='.$url.'><img src="http://127.0.0.1/project/surematome3/surematome/mato/gazosyori.php?url='.$url.'"></a></br>';
		    }
		}


	    $count=$count+1;
	}
	//print_r($match);
//HTML補正
$doc = new DOMDocument();
$doc->loadHTML('<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head><body>'.$string.'</body></html>');
$string = $doc->saveHTML();
$pattern= '/<html><head><meta http\-equiv="Content\-Type" content="text\/html; charset=UTF\-8"><\/head><body>/';
$string = preg_replace($pattern,'', $string);
$pattern= '/<!DOCTYPE html PUBLIC "\-\/\/W3C\/\/DTD HTML 4.0 Transitional\/\/EN" "http:\/\/www\.w3\.org\/TR\/REC\-html40\/loose\.dtd">/';
$string = preg_replace($pattern,'', $string);
$pattern= '/<\/body><\/html>/';
$string = preg_replace($pattern,'', $string);
echo $string."\n";
?>
<input type="submit" name="button" />
</form>
</body>
</html>