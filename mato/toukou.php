<?php
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
		$honbun =$honbun . $match[0][$count];
	    	$count=$count+1;
	}

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