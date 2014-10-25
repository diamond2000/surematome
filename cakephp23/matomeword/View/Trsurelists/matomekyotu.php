<?php
function pubcone(){

	$result = mysql_query('SELECT * FROM mskates');
	if (!$result) {
	    die('ÉNÉGÉäÅ[Ç™é∏îsÇµÇ‹ÇµÇΩÅB'.mysql_error());
	}

	while ($row = mysql_fetch_assoc($result)) {
	    print('<p>');
	    print('id='.$row['id']);
	    print(',name='.$row['name']);
	    print('</p>');
	}
	// MySQLÇ…ëŒÇ∑ÇÈèàóù



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

//ÇrÇpÇkéÊìæ
function sqlselect($value){
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('sippai'.mysql_error());
	}


	$db_selected = mysql_select_db('matomeword', $link);
	mysql_query('SET NAMES utf8', $link ); // Å©Ç±ÇÍ
	if (!$db_selected){
	    die('DBSippai'.mysql_error());
	}
	$result = mysql_query($value);
	if (!$result) {
	    die('ÉNÉGÉäÅ[Ç™é∏îsÇµÇ‹ÇµÇΩÅB'.mysql_error());
	}

        $close_flag = mysql_close($link);

        return $result;
}

//ÇrÇpÇké¿çs
function sqlexe($value){
	$link = mysql_connect('localhost', 'root', '');
	if (!$link) {
	    die('sippai'.mysql_error());
	}


	$db_selected = mysql_select_db('matomeword', $link);
	if (!$db_selected){
	    die('DBSippai'.mysql_error());
	}
	mysql_query('SET NAMES utf8', $link ); // Å©Ç±ÇÍ
	$result = mysql_query($value);
	if (!$result) {
	    die('ÉNÉGÉäÅ[Ç™é∏îsÇµÇ‹ÇµÇΩÅB'.mysql_error());
	}

        $close_flag = mysql_close($link);
}

?>