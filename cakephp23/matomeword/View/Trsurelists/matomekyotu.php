<?php
function pubcone(){

	$result = mysql_query('SELECT * FROM mskates');
	if (!$result) {
	    die('�N�G���[�����s���܂����B'.mysql_error());
	}

	while ($row = mysql_fetch_assoc($result)) {
	    print('<p>');
	    print('id='.$row['id']);
	    print(',name='.$row['name']);
	    print('</p>');
	}
	// MySQL�ɑ΂��鏈��



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

//�r�p�k�擾
function sqlselect($value){
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('sippai'.mysql_error());
	}


	$db_selected = mysql_select_db('matomeword', $link);
	mysql_query('SET NAMES utf8', $link ); // ������
	if (!$db_selected){
	    die('DBSippai'.mysql_error());
	}
	$result = mysql_query($value);
	if (!$result) {
	    die('�N�G���[�����s���܂����B'.mysql_error());
	}

        $close_flag = mysql_close($link);

        return $result;
}

//�r�p�k���s
function sqlexe($value){
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('sippai'.mysql_error());
	}


	$db_selected = mysql_select_db('matomeword', $link);
	if (!$db_selected){
	    die('DBSippai'.mysql_error());
	}
	mysql_query('SET NAMES utf8', $link ); // ������
	$result = mysql_query($value);
	if (!$result) {
	    die('�N�G���[�����s���܂����B'.mysql_error());
	}

        $close_flag = mysql_close($link);
}

?>