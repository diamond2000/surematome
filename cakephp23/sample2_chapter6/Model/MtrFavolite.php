<?php
App::uses('AppModel', 'Model');

class MtrFavolite extends AppModel {

	public $displayField = 'name';
	
	public $hasAndBelongsToMeny = array(
		'Contact', 
	);
	
}
