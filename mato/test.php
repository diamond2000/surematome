<html>
<head>
<title>Webデータ取得</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
<form action="" method="POST" style="width:100%;text-align:center">
Webデータ取得<br>
<textarea cols="80" rows="20">

<?php
$context = stream_context_create(array('http' => array(
'method' => 'GET',
'header' => 'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
)));
$url = "https://crowdworks.jp/public/jobs/group/development.rss";
$html = file_get_contents($url, false, $context);


    echo $html;                                //Webデータ表示
?>

</textarea>

</form>


2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
<?php
try {
  $dbh = new PDO('mysql:host=localhost;dbname=cake;unix_socket=/tmp/mysql.sock;charset=utf8','root','8661');
} catch(PDOException $e) {
  var_dump($e->getMessage());
  exit;
}

$rss = simplexml_load_file( 'https://crowdworks.jp/public/jobs/group/development.rss' );
 
$list = '<ul>';
 
foreach ( $rss->channel->item as $item ) {
    $list .= '<li><a href="';
    $list .=  $item->link;
    $list .= '">';
    $list .=  $item->title;
    $list .=  '</a>';
    $list .=  $item->description;
    $list .=  $item->pubDate;
    $list .=  '</li>';
    //格納
    $stmt = $dbh->prepare("insert into crowds (title,link,description,pubdate) values (?,?,?,?)");
    $stmt->execute(array($item->title,$item->link,$item->description,$item->pubDate));
}
 
$list .= '</ul>';

//切断
$dbh = null;
 
echo $list;
?>

<?php
$num = 5;//RSS取得件数

date_default_timezone_set('Asia/Tokyo');
  
$rssUrl=array(
'https://crowdworks.jp/public/jobs/group/development.rss',//サイトurl
'http://x6xo.hatenablog.com/rss',

);
  
//magpierss
require_once('magpierss-0.72/rss_fetch.inc');
define('MAGPIE_OUTPUT_ENCODING','UTF-8');//encode
define('MAGPIE_CACHE_AGE','30');//cache
 
foreach ($rssUrl as $no => $rss_url) {
    if ($rss_url != '') {
    //URLからRSSを取得
    $rss   = @fetch_rss($rss_url);

      if ($rss != NULL) {
            for ($i=0; $i<count($rss->items); $i++) {
          $rss->items[$i]["site_title"] = $rss->channel["title"];
          $rss->items[$i]["site_link"] = $rss->channel["link"];
        }
        //itemsを格納
        $rssItemsArray[] = $rss->items;
        }
    }
}

$concatArray = array();
if (is_array($rssItemsArray)) {
    for($i=0;$i<count($rssItemsArray);$i++){
    $concatArray = array_merge($concatArray,$rssItemsArray[$i]);//配列を統合する
  }

    foreach ($concatArray as $no => $values) {

        //RSSの種類によって日付を取得
        if($values['published']){$date = $values['published'];}
        elseif($values['created']){$date = $values['created'];}
        elseif($values['pubdate']){$date = $values['pubdate'];}
        elseif($values['dc']['date']){$date = $values['dc']['date'];}
        $date=date("Y-m-d H:i:s",strtotime($date));

        //Filter
        $nowtime = date("Y-m-d H:i:s",strtotime( "now" ));//現在時刻の取得
        if($date > $nowtime){//未来記事の排除
        }elseif(preg_match("/AD/", $values["title"])){//広告記事の排除
        }elseif(preg_match("/PR/", $values["title"])){
        }else{
        
            //値の定義
            $title=$values["title"];
            $link=$values["link"];
            $site_title=$values["site_title"];
            $site_link=$values["site_link"];

            //記事ごとに必要な項目を抽出
            $rssArray[]=array($date, $title, $link, $site_title, $site_link);
        }//
    }//

    //ソート
    function cmp($a, $b) {
        if ($a[0] == $b[0]) return 0;
        return ($a[0] > $b[0]) ? -1 : 1;
    }
    if($rssArray) { usort($rssArray, 'cmp'); }
    if(count($rssArray) > $num){$count=$num;}
    else{$count=count($rssArray);}

    for ($i=0; $i<$count; $i++) {
        $date=date("Y-m-d H:i:s",strtotime($rssArray[$i][0]));
        $title=$rssArray[$i][1];
        $link=$rssArray[$i][2];
        $site_title=$rssArray[$i][3];
        $site_link=$rssArray[$i][4];
        $datelink = "<div>$date";
      $titlelink = "<a href='$link'>$title</a>";
      $site_titlelink = "<a href='$site_link'>[$site_title]</a></div>";
      echo "$datelink$titlelink$site_titlelink</div>";//(確認用)
    }
}
?>
</body>
</html>