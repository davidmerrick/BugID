<?php
App::uses('AppModel', 'Model');
/**
 * Issue Model
 *
 * @property IssuePublication $IssuePublication
 */
class Issue extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'issue_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'issue_number';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'issue_id' => array(
			'blank' => array(
				'rule' => array('blank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'issue_publication_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'issue_cover' => array(
			'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'The cover image upload failed.',
				'allowEmpty' => TRUE,
			),
			'mimeType' => array(
				'rule' => array(
					'mimeType' => array('image/gif', 'image/png', 'image/jpg', 'image/jpeg',),
				),
				'message' => 'Please only upload images.',
				'allowEmpty' => TRUE,
			),
			'fileSise' => array(
				'rule' => array('fileSize', '<=', '1MB'), 
				'message' => 'Cover image must be less than 1MB.',
				'allowEmpty' => TRUE,
			),
			'processCoverUpload' => array(
				'rule' => array('processCoverUpload',
				'message' => 'Unable to process cover image upload',
				'allowEmpty' => TRUE, 
				),
			),
		),
		'issue_number' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'issue_date_publication' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Publication' => array(
			'className' => 'Publication',
			'foreignKey' => 'issue_publication_id',
		)
	);

	public function processCoverUpload($check = array()){
		if(!is_uploaded_file($check['issue_cover']['tmp_name'])){
			return FALSE;
		}
		if(!move_uploaded_file($check['issue_cover']['tmp_name'], WWW_ROOT . 'img' . DS . $check['issue_cover']['name'])){
			return FALSE;	
		}
		$this->data[$this->alias]['issue_cover'] = 'uploads' . DS . $check['issue_cover']['name'];
		return TRUE;
	}
}
