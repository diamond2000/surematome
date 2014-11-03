﻿
<?php

include_once( "common.php" );
include_once('simple_html_dom.php');

//ASP経由で振り分け取得
function getFuriwakeHTML($mainurl){
	//引数セット
	$data = array(
	    'str' => $mainurl,
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
	$url = "http://192.168.11.150/matoweb/Service1.asmx/matotest";

	$html = file_get_contents($url, false, $context);
        return htmlspecialchars_decode ($html);
}

//正規表現用文字列置き換え
function getSeikiOkikae($strOkikae){
	$strOkikae=str_replace("\\", "\\",$strOkikae);
	$strOkikae=str_replace(".", "\.",$strOkikae);
	$strOkikae=str_replace("*", "\*",$strOkikae);
	$strOkikae=str_replace("+", "\+",$strOkikae);
	$strOkikae=str_replace("?", "\?",$strOkikae);
	$strOkikae=str_replace("{", "\{",$strOkikae);
	$strOkikae=str_replace("}", "\}",$strOkikae);
	$strOkikae=str_replace("(", "\(",$strOkikae);
	$strOkikae=str_replace(")", "\)",$strOkikae);
	$strOkikae=str_replace("[", "\[",$strOkikae);
	$strOkikae=str_replace("]", "\]",$strOkikae);
	$strOkikae=str_replace("^", "\^",$strOkikae);
	$strOkikae=str_replace("$", "\$",$strOkikae);
	$strOkikae=str_replace("-", "\-",$strOkikae);
	$strOkikae=str_replace("|", "\|",$strOkikae);
	$strOkikae=str_replace("/", "\/",$strOkikae);
	return $strOkikae;
}


//本文格納
function getHONBUNHTML($html){
	$honbunhtml = str_get_html($html);
	return $honbunhtml;
}
?>


<?php
function getmatookikae($mainurl){
	$cstrsiteHTML =  getFuriwakeHTML($mainurl) ;

	$string = $cstrsiteHTML;
	//アンカー置き換え
	$pattern= '/(<a href="\.\.)(.*?)(&gt;&gt;)/is';
	$string = preg_replace($pattern, '<span style="color:mediumblue;" class="anchor">&gt;&gt;', $string);
	$pattern= '/&gt;&gt;(.+?)<\/a>/';
	$string = preg_replace($pattern, '&gt;&gt;$1</span>', $string);
	//BR置き換え
	$pattern= '/<br>  <br> /';
	$string = preg_replace($pattern, '<br />', $string);
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
	$string = preg_replace($pattern, '<div class="t_h t_i" >$1</span></div>'."\n".'<div class="t_b t_i" >' , $string);
	$pattern= '/<dt>(.+?)<dd>/';
	$string = preg_replace($pattern, '<div class="t_h" >$1</span></div>'."\n".'<div class="t_b" >' , $string);
	//名前ランGRAY処理
	$pattern= '/<\/span>：/';
	$string = preg_replace($pattern,'</span> <span style="color: gray;"> ', $string);
	//文末処理
	$pattern= '/<br \/>\r\n<di/';
	$string = preg_replace($pattern,'</div><br />'."\n".'<di', $string);
	$pattern= '/<br \/><\/dt>/';
	$string = preg_replace($pattern,'</div><br />'."\n", $string);
	//文末調整
	$pattern= '/<br \/> <\/dt>/';
	$string = preg_replace($pattern,'</div><br />'."\n", $string);
	//画像URL加工
	$pattern= '/http:\/\/2ch.io/';
	$string = preg_replace($pattern,'http:/', $string);
	//色付け処理
		//１レス目のID退避
		preg_match('/<div class="t_h" >1 ：(.*?)(ID:)(.*?)<\/span><\/div>/is',$string,$retArr);
		$resid=getSeikiOkikae($retArr[3]);
		//マトメクスタグ修正
		$pattern= '/<br \/><!-- Generated by 2chまとめくす \(http:\/\/2mtmex\.com\/\) --><\/dt>/';
		$string = preg_replace($pattern,'</div><br />'."\n".'<!-- Generated by 2chまとめくす (http://2mtmex.com/) -->', $string);
		//すれぬし色変え
		$pattern= '/<div class="t_h" >(.+?)'.$resid.'(.+?)\n<div class="t_b" >/';
		$string = preg_replace($pattern, '<div class="t_h" >$1'.$retArr[3].'$2</span></div>'."\n".'<div class="t_b" style="font-weight:bold;color:#0000cd;" >' , $string);
		$pattern= '/<div class="t_h t_i" >(.+?)'.$resid.'(.+?)\n<div class="t_b t_i" >/';
		$string = preg_replace($pattern, '<div class="t_h t_i" >$1'.$retArr[3].'$2'."\n".'<div class="t_b t_i" style="font-weight:bold;color:#0000cd;" >' , $string);
		//アカ文字偶数列
		//アレイリスト
		$pattern= '/(<div class=)(.*?)(<\/div><br \/>)/is';
		preg_match_all($pattern, $string , $match);
		$gusuhantei=0;
		$count = 0;
		while ($count < count($match[0])){
		    if ($gusuhantei>=3){
			$pattern= '/<div class="t_b" >/';
			$match[0][$count] = preg_replace($pattern, '<div class="t_b"  style="color:#ff0000;">' , $match[0][$count]);
			$pattern= '/<div class="t_b t_i" >/';
			$match[0][$count] = preg_replace($pattern, '<div class="t_b t_i" style="color:#ff0000;">' , $match[0][$count]);
			$gusuhantei=0;
		    }
		    $gusuhantei = $gusuhantei + 1;
		    $count=$count+1;
		}


	return $match;
}
//echo $string;
?>

