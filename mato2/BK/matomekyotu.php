<?php
function pubcone(){

	$result = mysql_query('SELECT * FROM mskates');
	if (!$result) {
	    die('クエリーが失敗しました。'.mysql_error());
	}

	while ($row = mysql_fetch_assoc($result)) {
	    print('<p>');
	    print('id='.$row['id']);
	    print(',name='.$row['name']);
	    print('</p>');
	}
	// MySQLに対する処理



	if ($close_flag){
	    print('<p>seiko</p>');
	}

}


function douki(){
  sqlexe('DELETE FROM mskates');
  $keka = sqlselect('SELECT * FROM matomeword_terms');
	while ($row = mysql_fetch_assoc($keka)) {
	    print('<p>');
	    //print('id='.$row['id']);
	    print(',name='.$row['name']);
	    print('</p>');
	}
}

//ＳＱＬ取得
function sqlselect($value){
	$link = mysql_connect('localhost', 'root', '8661');
	if (!$link) {
	    die('sippai'.mysql_error());
	}


	$db_selected = mysql_select_db('cake', $link);
	mysql_query('SET NAMES utf8', $link ); // ←これ
	if (!$db_selected){
	    die('DBSippai'.mysql_error());
	}
	$result = mysql_query($value);
	if (!$result) {
	    die('クエリーが失敗しました。'.mysql_error());
	}

        $close_flag = mysql_close($link);

        return $result;
}

//ＳＱＬ実行
function sqlexe($value){
	$link = mysql_connect('localhost', 'root', '8661');
	if (!$link) {
	    die('sippai'.mysql_error());
	}


	$db_selected = mysql_select_db('cake', $link);
	if (!$db_selected){
	    die('DBSippai'.mysql_error());
	}
	mysql_query('SET NAMES utf8', $link ); // ←これ
	$result = mysql_query($value);
	if (!$result) {
	    die('クエリーが失敗しました。'.mysql_error());
	}

        $close_flag = mysql_close($link);
}

?>