<?php

/* ================================
 * ���U�C�N�摜�����
 *
 * @create  2010/09/05
 * @author  pentan
 * @url     http://pentan.info/
 *
 * Copyright (c) 2010 pentan.info All Rights Reserved.
 * ���쌠�\�������̕ύX�폜�͋֎~�ł�
 * ================================
 */

////////// �����ݒ肱������ //////////
// ���U�C�N�̍r��
$mosaic = 5;

// �摜�̃p�X
//$path = 'http://pentan.info/img/sample/mosaic/before.gif';
$path ='http://i.imgur.com/etTqjGz.jpg';
////////// �����ݒ肱���܂� //////////

// �摜�t�@�C���̏��𓾂�
list($img_width,$img_height,$type)=@getimagesize($path);

// �摜�t�@�C���ɉ������֐���ݒ肷��
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

// �摜��ǂݍ���
if(!($src=@$img_input_func($path))){
  header("Content-Type: " . $img_contenttype);
  readfile($path);
  exit;
}

// �摜����������k������
$img_width_m = intval($img_width/$mosaic);
$img_height_m = intval($img_height/$mosaic);

$dst_m=$img_create_func($img_width_m,$img_height_m);
$img_resize_func($dst_m,$src,0,0,0,0,$img_width_m,$img_height_m,$img_width,$img_height);

// �摜�����̃T�C�Y�Ɋg�傷��
$dst=$img_create_func($img_width,$img_height);
$img_resize_func($dst,$dst_m,0,0,0,0,$img_width,$img_height,$img_width_m,$img_height_m);

// �摜���o�͂���
header("Content-Type: " . $img_contenttype);
$img_output_func($dst);

imagedestroy($src);
imagedestroy($dst);
imagedestroy($dst_m);
