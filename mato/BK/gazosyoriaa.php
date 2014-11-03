<?php

/* ================================
 * モザイク画像を作る
 *
 * @create  2010/09/05
 * @author  pentan
 * @url     http://pentan.info/
 *
 * Copyright (c) 2010 pentan.info All Rights Reserved.
 * 著作権表示部分の変更削除は禁止です
 * ================================
 */

////////// 初期設定ここから //////////
// モザイクの荒さ
$mosaic = 5;

// 画像のパス
//$path = 'http://pentan.info/img/sample/mosaic/before.gif';
$path ='http://i.imgur.com/etTqjGz.jpg';
////////// 初期設定ここまで //////////

// 画像ファイルの情報を得る
list($img_width,$img_height,$type)=@getimagesize($path);

// 画像ファイルに応じた関数を設定する
switch( $type ){
  case 1:
    $img_create_func ="imagecreate";
    $img_resize_func ="imagecopyresampled";
    $img_input_func ="imagecreatefromgif";
    $img_output_func="imagegif";
    $img_contenttype="image/gif";
    break;
  case 2:
    $img_create_func ="imagecreatetruecolor";
    $img_resize_func ="imagecopyresampled";
    $img_input_func ="imagecreatefromjpeg";
    $img_output_func="imagejpeg";
    $img_contenttype="image/jpeg";
    break;
  case 3:
    $img_create_func ="imagecreatetruecolor";
    $img_resize_func ="imagecopyresampled";
    $img_input_func ="imagecreatefrompng";
    $img_output_func="imagepng";
    $img_contenttype="image/png";
    break;
  default:
    readfile($path);
    exit;
    break;
}

// 画像を読み込む
if(!($src=@$img_input_func($path))){
  header("Content-Type: " . $img_contenttype);
  readfile($path);
  exit;
}

// 画像をいったん縮小する
$img_width_m = intval($img_width/$mosaic);
$img_height_m = intval($img_height/$mosaic);

$dst_m=$img_create_func($img_width_m,$img_height_m);
$img_resize_func($dst_m,$src,0,0,0,0,$img_width_m,$img_height_m,$img_width,$img_height);

// 画像を元のサイズに拡大する
$dst=$img_create_func($img_width,$img_height);
$img_resize_func($dst,$dst_m,0,0,0,0,$img_width,$img_height,$img_width_m,$img_height_m);

// 画像を出力する
header("Content-Type: " . $img_contenttype);
$img_output_func($dst);

imagedestroy($src);
imagedestroy($dst);
imagedestroy($dst_m);
