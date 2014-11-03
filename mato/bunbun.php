<html>
<head>
<title>ぶんぶんまとめ</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
include_once('matookikae.php');
include_once('simple_html_dom.php');

	$match = getmatookikae($_GET["url"]);


	//画像置き換え
	$count = 0;
	while ($count < count($match[0])){
		$pattern= '/<a href="(.*?).jpg" target="_blank">(.*?)<\/a>/';
		$match[0][$count] = preg_replace($pattern, '<a href="$1.jpg"><img src="$1.jpg">$2</img></a>' , $match[0][$count]);
		$pattern= '/<a href="(.*?).png" target="_blank">(.*?)<\/a>/';
		$match[0][$count] = preg_replace($pattern, '<a href="$1.png"><img src="$1.png">$2</img></a>' , $match[0][$count]);
		$pattern= '/<a href="(.*?).gif" target="_blank">(.*?)<\/a>/';
		$match[0][$count] = preg_replace($pattern, '<a href="$1.gif"><img src="$1.gif">$2</img></a>' , $match[0][$count]);
	    $count=$count+1;
	}
	print_r($match);
?>

</body>
</html>