<html>
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

	$match = getmatookikae($_GET["url"]);

	//画像置き換え
	$count = 0;
	while ($count < count($match[0])){
		//$pattern= '/<a href="(.*?).jpg" target="_blank">(.*?)<\/a>/';
		//$match[0][$count] = preg_replace($pattern, '<a href="$1.jpg"><img src="$1.jpg">$2</img></a>' , $match[0][$count]);
		//$pattern= '/<a href="(.*?).png" target="_blank">(.*?)<\/a>/';
		//$match[0][$count] = preg_replace($pattern, '<a href="$1.png"><img src="$1.png">$2</img></a>' , $match[0][$count]);
		//$pattern= '/<a href="(.*?).gif" target="_blank">(.*?)<\/a>/';
		//$match[0][$count] = preg_replace($pattern, '<a href="$1.gif"><img src="$1.gif">$2</img></a>' , $match[0][$count]);

		echo $match[0][$count];


		$pattern = '/(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpg|gif|png)/';
		preg_match_all($pattern, $match[0][$count], $matches);
		if(count($matches)){
		    foreach($matches[0] as $i=>$url) {
		        //$replace = "<img src='h{$url}'>";
		        //$images[] = $replace;
		        //$body = str_replace($url, $replace, $body);
			echo '<input type="checkbox" name="gazo[]" value="'.$url.'" />';
			echo '<img src="http://127.0.0.1/project/surematome3/surematome/mato/gazosyori.php?url='.$url.'"></br>';
		    }
		}


	    $count=$count+1;
	}
	//print_r($match);
?>
<input type="submit" name="button" />
</form>
</body>
</html>