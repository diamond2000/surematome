﻿<?php
	//inctioのライブラリ呼び出し
	include_once('IXR_Library.php');
	include_once('matookikae.php');
	include_once('simple_html_dom.php');

	//echo $_POST['url'].'</br>';
	//var_dump($_POST['gazo']);

	//タイトル取得

	//まとめ
	$match = getmatookikae($_POST['url']);
	$count = 0;
	$honbun = '';
	while ($count < count($match[0])){
		//BR置き換え(ワードプレス特有)
		$pattern= '/<\/div><br \/>/';
		$match[0][$count]= preg_replace($pattern, '</div>'."\n".'&nbsp;'."\n", $match[0][$count]);
		$pattern= '/<br \/>/';
		$match[0][$count] = preg_replace($pattern, "\n", $match[0][$count]);
		$honbun =$honbun . $match[0][$count];
	    	$count=$count+1;
	}
//HTML補正
$doc = new DOMDocument();
$doc->loadHTML('<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head><body>'.$honbun.'</body></html>');
$honbun = $doc->saveHTML();
$pattern= '/<html><head><meta http\-equiv="Content\-Type" content="text\/html; charset=UTF\-8"><\/head><body>/';
$honbun = preg_replace($pattern,'', $honbun);
$pattern= '/<!DOCTYPE html PUBLIC "\-\/\/W3C\/\/DTD HTML 4.0 Transitional\/\/EN" "http:\/\/www\.w3\.org\/TR\/REC\-html40\/loose\.dtd">/';
$honbun = preg_replace($pattern,'', $honbun);
$pattern= '/<\/body><\/html>/';
$honbun = preg_replace($pattern,'', $honbun);


//広告
$honbun = '<!-- admax --><script type="text/javascript" src="http://adm.shinobi.jp/s/d96c3ead9b9957ce6a0326740eeae745"></script><!-- admax --><script type="text/javascript">var nend_params = {"media":12307,"site":81811,"spot":193791,"type":1,"oriented":1};</script><script type="text/javascript" src="http://js1.nend.net/js/nendAdLoader.js"></script>'."\n".$honbun."\n".'<!-- admax --><script type="text/javascript" src="http://adm.shinobi.jp/s/d96c3ead9b9957ce6a0326740eeae745"></script><!-- admax --><script type="text/javascript">var nend_params = {"media":12307,"site":81811,"spot":193791,"type":1,"oriented":1};</script><script type="text/javascript" src="http://js1.nend.net/js/nendAdLoader.js"></script>';

	//■ここから投稿処理■example.comは投稿先アドレスに変える
	$client = new IXR_Client("http://eversoku.ever.jp/bunbun/xmlrpc.php");

	  $wp_username='bunbun'; // ユーザー名
	  $wp_password='49faez22'; // パスワード

	$status = $client->query(
	  "wp.newPost", //使うAPIを指定（wp.newPostは、新規投稿）
	  1, // blog ID: 通常は１、マルチサイト時変更
	  $wp_username, // ユーザー名
	  $wp_password, // パスワード
	  array(
	    'post_author' => 'bunbun', // 投稿者ID 未設定の場合投稿者名なしになる。
	    'post_status' => 'publish', // 投稿状態
	    'post_title' => urldecode($_POST['title']), // タイトル
	    'post_content' => $honbun, //　本文
	    //'terms' => array('category' => '未分類'),　// カテゴリ追加
	  )
	);
	if(!$status){
	  die('Something went wrong - '.$client->getErrorCode().' : '.$client->getErrorMessage());
echo 'a';
	} else {
	  $post_id = $client->getResponse(); //返り値は投稿ID
echo $post_id;
	}
?>