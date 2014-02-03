<?php
App::uses('AppModel', 'Model');
/**
 * Bug Model
 *
 */
class Bug extends AppModel {


/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'bug_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'species_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'bug_size' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'specimen_code' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lab_name' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
