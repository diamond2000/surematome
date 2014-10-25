<?php
class User extends AppModel {

	public $validate = array(
		'username' => array(
			array(
				'rule' => 'alphaNumeric', 
				'message' => '英数字で入力してください', 
			), 
			array(
				'rule' => array('minLength', 4), 
				'message' => '短すぎます', 
			), 
			array(
				'rule' => array('maxLength', 255), 
				'message' => '長すぎます', 
			), 
			array(
				'rule' => array('isUnique'), 
				'message' => '既に登録されているユーザ名です',
			), 
		), 
		'password' => array(
			array(
				'rule' => 'alphaNumeric', 
				'message' => '英数字で入力してください', 
			), 
			array(
				'rule' => array('minLength', 4), 
				'message' => '短すぎます', 
			), 
			array(
				'rule' => array('maxLength', 255), 
				'message' => '長すぎます', 
			), 
		), 
	);
	
	//保存前の処理
	//
	function beforeSave($options = array()) {
		
		$flag = true;
		
		//パスワードが入力されている場合は暗号化する
		//
		if(!empty($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		
		return $flag;
	}
}
