App::import('Vendor', 'request2', array('file'=>'HTTP/Request2.php'));

$id = 'kwsk9849kwsk'; /* livedoorID */
$key = 'bzsujzbG7U';        /* API Key */
$url = "http://livedoor.blogcms.jp/atom/blog/".$id.'/image';

$img_dir = dirname(dirname(dirname(dirname(__FILE__)))).DS.'files'.DS;
$imgfile  = $img_dir.'before.gif';
$created = date('Y-m-d\TH:i:s\Z');
$nonce = pack('H*', sha1(md5(time())));
$pass_digest = base64_encode(pack('H*', sha1($nonce.$created.$key)));
$wsse =
            'UsernameToken Username="'.$id.'", '.
            'PasswordDigest="'.$pass_digest.'", '.
            'Nonce="'.base64_encode($nonce).'", '.
            'Created="'.$created.'"';
$imgdata = file_get_contents($imgfile);
$content_type = image_type_to_mime_type(exif_imagetype($imgfile));
$headers = array(
                        'X-WSSE: ' . $wsse,
                        'Content-Type: ' . $content_type,
                        'Expect:'
);

try{
    $req = new HTTP_Request2();
    $req->setUrl($url);
    $req->setMethod(HTTP_Request2::METHOD_POST);
    $req->setHeader($headers);
    $req->setBody($imgdata);
    $response = $req->send();
    $xml = simplexml_load_string($response->getBody());
    $src = $xml->content['src'];
    $thumbnail = $xml->content['thumbnail'];
} catch (HTTP_Request2_Exception $e) {
    die($e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}