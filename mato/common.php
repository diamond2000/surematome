<?php

//URL指定し、HTML文返却
function pfHpGet($strurl){

	$context = stream_context_create(array('http' => array(
	'method' => 'GET',
	'header' => 'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
	)));
	$html = file_get_contents($strurl, false, $context);

    return $html;                                //Webデータ返却
}


?>