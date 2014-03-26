<?php
App::uses('AppModel', 'Model');

class Batch extends AppModel {
    
    public $displayField = 'batch_name';
    
	public $hasMany = array(
		'Bug' => array(
			'className' => 'Bug',
			'foreignKey' => 'batch_id'
		)
	);
}
