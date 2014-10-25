<?php
App::uses('AppModel', 'Model');
App::uses('MtrSex', 'Model');
App::uses('MtrAge', 'Model');
App::uses('MtrFavolite', 'Model');

class Admns extends AppModel {

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
		'password' => array(
			array(
				'rule' => 'notEmpty', 
				'message' => '何も入力されていません', 
			), 
		), 
	);
}
