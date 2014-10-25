<?php
App::uses('AppModel', 'Model');
App::uses('MtrSex', 'Model');
App::uses('MtrAge', 'Model');
App::uses('MtrFavolite', 'Model');

class Contact extends AppModel {

	public $belongsTo = array(
		'MtrSex', 
		'MtrAge', 
	);
	
	public $hasAndBelongsToMany = array(
		'MtrFavolite', 
	);
	
	public $validate = array(
		'name' => array(
			array(
				'rule' => 'notEmpty', 
				'message' => '何も入力されていません', 
			), 
			array(
				'rule' => array('maxLength', 255), 
				'message' => '文字数が多すぎます', 
			), 
		), 
		'email' => array(
			array(
				'rule' => 'notEmpty', 
				'message' => '何も入力されていません', 
			), 
			array(
				'rule' => array('maxLength', 255), 
				'message' => '文字数が多すぎます', 
			), 
			array(
				'rule' => 'email', 
				'message' => '正しくないメールアドレスです', 
			), 
		), 
		'mtr_sex_id' => array(
			array(
				'rule' => 'notEmpty', 
				'message' => '何も入力されていません', 
			), 
		), 
		'mtr_age_id' => array(
			array(
				'rule' => 'notEmpty', 
				'message' => '何も入力されていません', 
			), 
		), 
		'title' => array(
			array(
				'rule' => 'notEmpty', 
				'message' => '何も入力されていません', 
			), 
			array(
				'rule' => array('maxLength', 255), 
				'message' => '文字数が多すぎます', 
			), 
		), 
		'content' => array(
			array(
				'rule' => 'notEmpty', 
				'message' => '何も入力されていません', 
			), 
			array(
				'rule' => array('maxLength', 4000), 
				'message' => '文字数が多すぎます', 
			), 
		), 
	);
}
