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
        //For storing info before delete
        private $info;
        
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
                'bug_photo' => array(
                        'required' => array(
                                'required' => TRUE,
                                'message' => 'An image is required.',
			),
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
        
        // Before delete, save the record so we can delete the associated image after delete
        public function beforeDelete() {
            $this->info = $this->find('first', array(
                    'conditions' => array('Bug.bug_id' => $this->id),
            ));
        }
        
        // After delete, delete uploaded image
        public function afterDelete() {
            unlink(WWW_ROOT . 'img' . DS . $this->info ['Bug']['bug_photo']);
        }
        
        //Handles the upload of images
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
        
        public function isOwnedBy($bug, $user) {
            return $this->field('bug_id', array('bug_id' => $bug, 'user_id' => $user)) === $bug;
        }
}