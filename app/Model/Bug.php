<?php
App::uses('AppModel', 'Model', 'Debugger', 'CakeLog');
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
				'message' => 'Please specify a number.',
				'allowEmpty' => true,
				'required' => false,
			),
                        'nonNegative' => array(
                            'rule' => array('comparison', '>=', 0),
                            'message' => 'Bug size must be greater than or equal to 0.',
                        ),
		),
		'specimen_code' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Specimen Code Must be Alphanumeric.',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'lab_name' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Lab Name Must be Alphanumeric.',
				'allowEmpty' => true,
				'required' => false,
			),
		),
                'bug_photo' => array(
                        'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'The image upload failed.',
				'allowEmpty' => TRUE,
			),
			'mimeType' => array(
				'rule' => array('mimeType', array('image/gif', 'image/png', 'image/jpg', 'image/jpeg', 'image/tiff')),
				'message' => 'Please only upload images.',
				'allowEmpty' => TRUE,
			),
			'processImageUpload' => array(
				'rule' => array('processImageUpload',
				'message' => 'Unable to process cover image upload.',
				'allowEmpty' => TRUE, 
				),
			),
                    ),
	);
        
        public function processImageUpload($check = array()){
                if(!is_uploaded_file($check['bug_photo']['tmp_name'])){
			return FALSE;
		}
                $extension = pathinfo($check['bug_photo']['name'], PATHINFO_EXTENSION);
                //Generate a random string for the filename based on the MD5 hash of the file
                $filename = uniqid(md5_file($check['bug_photo']['tmp_name'])) . "." . $extension;
		if(!move_uploaded_file($check['bug_photo']['tmp_name'], WWW_ROOT . 'img' . DS . 'uploads' . DS . $filename)){
			return FALSE;	
		}
                //Set permissions on the file
		chmod(WWW_ROOT . 'img' . DS . 'uploads' . DS . $filename, 0755);
                $this->data[$this->alias]['bug_photo'] = 'uploads' . DS . $filename;
		return TRUE;
	}
}
