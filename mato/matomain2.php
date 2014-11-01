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

//ASP経由で振り分け取得
function getFuriwakeHTML(){
	//引数セット
	$data = array(
	    'str' => 'aa',
	);
	$headers = array(
	    'Content-Type: application/x-www-form-urlencoded',
	    'Content-Length: '.strlen(http_build_query($data))
	        );


	$context = stream_context_create(array('http' => array(
	'method' => 'POST',
	'header' => implode("\r\n", $headers),
	'content' => http_build_query($data),
	)));
	$url = "http://localhost:2405/Service1.asmx/matotest";

	$html = file_get_contents($url, false, $context);
        return htmlspecialchars_decode ($html);
}

//本文格納
function getHONBUNHTML($html){
	$honbunhtml = str_get_html($html);
	return $honbunhtml;
}
?>

<form action="" method="POST" style="width:100%;text-align:center">
Webデータ取得<br>
<textarea cols="80" rows="20">
<?php
	//レス振り分け
	//$cstrsiteHTML = "<html><head></head><body>" . getFuriwakeHTML() ."</body></html>";
	$cstrsiteHTML =  getFuriwakeHTML() ;
?>
</textarea>
<?php
	$string = getFuriwakeHTML();
	//アンカー置き換え
	$pattern= '/(<a href="\.\.)(.*?)(&gt;&gt;)/is';
	$string = preg_replace($pattern, '<span style="color:mediumblue;" class="anchor">&gt;&gt;', $string);
	$pattern= '/&gt;&gt;(.+?)<\/a>/';
	$string = preg_replace($pattern, '&gt;&gt;$1</span>', $string);
	//BR置き換え
	$pattern= '/<br><br>/';
	$string = preg_replace($pattern, '<br />', $string);
	$pattern= '/<br>/';
	$string = preg_replace($pattern, '<br />', $string);

	//mailto置き換え
	$pattern= '/<a href="mailto(.+?)<\/a>/';
	$string = preg_replace($pattern, '<a href="mailto$1</span>', $string);
	$pattern= '/(<a href="mailto)(.*?)(">)/is';
	$string = preg_replace($pattern, '<span style="color: green; font-weight: bold;">', $string);
	//fontcolor置き換え
	$pattern= '/<font color=green>/';
	$string = preg_replace($pattern, '<span style="color: green; font-weight: bold;">', $string);
	$pattern= '/<\/font>/';
	$string = preg_replace($pattern,'</span>', $string);
	//不要タグ置き換え
	$pattern= '/<\/b>/';
	$string = preg_replace($pattern,'', $string);
	$pattern= '/<b>/';
	$string = preg_replace($pattern,'', $string);

	//ヘッダ、ディテイル分け、名前ランGRAY処理
	$pattern= '/<\/span>:/';
	$string = preg_replace($pattern,'</span> <span style="color: gray;">', $string);
	$pattern= '/<dt><dt>(.+?)<dd>/';
	$string = preg_replace($pattern, '<div class="t_h t_i" >$1</span></div>'."\n".'<div class="t_b t_i">' , $string);

	//アレイリスト
	$pattern= '/(<dt>)(.*?)(<\/dt>)/is';
	preg_match_all($pattern, $string , $match);
	//print_r($match);
echo $string;
?>

</body>
</html>