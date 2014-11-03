<html>
<head>
<title>mato</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	
</head>
<body>
<script src="javascript-xpath-latest.js"></script>
<?php

//ASP経由で振り分け取得
function getFuriwakeHTML(){
	//引数セット
	$data = array(
	    'str' => 'aa',
	);

	$context = stream_context_create(array('http' => array(
	'method' => 'POST',
	'header' => 'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
	'content' => http_build_query($data),
	)));
	$url = "http://localhost:2405/Service1.asmx/matotest";

	$html = file_get_contents($url, false, $context);
        return $html;
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

	echo getFuriwakeHTML();                                //Webデータ表示
?>

</textarea>

</form>
</body>
</html>