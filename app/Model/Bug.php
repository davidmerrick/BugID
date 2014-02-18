<?php

App::uses('AppModel', 'Model', 'Debugger', 'CakeLog');

class Bug extends AppModel {

    //Add search to Bug model
    public $actsAs = array('Search.Searchable', 'Containable');
    public $filterArgs = array(
        'filter' => array('type' => 'query', 'method' => 'orConditions')
    );

    public function orConditions($data = array()) {
        $filter = $data['filter'];
        $cond = array(
            'OR' => array(
                $this->alias . '.bug_size LIKE' => '%' . $filter . '%',
                $this->alias . '.specimen_code LIKE' => '%' . $filter . '%',
                $this->alias . '.lab_name LIKE' => '%' . $filter . '%',
                $this->alias . '.river LIKE' => '%' . $filter . '%',
                $this->alias . '.state LIKE' => '%' . $filter . '%',
                $this->alias . '.country LIKE' => '%' . $filter . '%',
                $this->alias . '.collector_name LIKE' => '%' . $filter . '%',
                $this->alias . '.researcher_name LIKE' => '%' . $filter . '%',
                $this->alias . '.latitude LIKE' => '%' . $filter . '%',
                $this->alias . '.longitude LIKE' => '%' . $filter . '%',
                $this->alias . '.species_name LIKE' => '%' . $filter . '%',
                $this->alias . '.created LIKE' => '%' . $filter . '%',
                'User.username LIKE' => '%' . $filter . '%',
                'User.email LIKE' => '%' . $filter . '%',
            ));
        return $cond;
    }
    
    public $primaryKey = 'bug_id';
    public $displayField = 'species_name';
        
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
        'bug_photo_raw' => array(
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
				    'message' => 'Unable to process image upload.',
				    'allowEmpty' => TRUE, 
				),
			),
        ),
	);
        
        public function beforeDelete(){
            //delete associated image
            $info = $this->find('first', array(
                    'conditions' => array($this->alias . '.bug_id' => $this->id),
            ));
            
            if(!empty($info[$this->alias]['bug_photo'])){
                if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo'])){
                    unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo']);
                }
            }
        }
        
        //Handles the upload of images
        public function processImageUpload($check = array()){

            // Where to store the images
            $bug_photos_dir = 'bug_photos';
            $bug_photos_raw_dir = 'bug_photos_raw';

            if(!is_uploaded_file($check['bug_photo_raw']['tmp_name'])){
			 return FALSE;
		    }

            $extension = pathinfo($check['bug_photo_raw']['name'], PATHINFO_EXTENSION);
            //Generate a random string for the filename based on the MD5 hash of the file
            $filename = uniqid(md5_file($check['bug_photo_raw']['tmp_name']));

            $raw_photo = WWW_ROOT . 'img' . DS . $bug_photos_raw_dir . DS . $filename . "." . $extension;
		if(!move_uploaded_file($check['bug_photo_raw']['tmp_name'], $raw_photo)){
			return FALSE;	
		}
        
        //Set permissions on the file
        chmod($raw_photo, 0755);
        $this->data[$this->alias]['bug_photo_raw'] = $bug_photos_raw_dir . DS . $filename . "." . $extension;
		
        //Convert the image 
        //Save it as same filename but in the bug_photos directory
        $compressed_photo = WWW_ROOT . 'img' . DS . $bug_photos_dir . DS . $filename . ".jpeg"; 
        exec('/usr/bin/convert -size 720x720 ' . $raw_photo . ' ' . $compressed_photo);
        if(!file_exists($compressed_photo)){
            return FALSE;
        }
        chmod($compressed_photo, 0755);
        $this->data[$this->alias]['bug_photo'] = $bug_photos_dir . DS . $filename . ".jpeg";

        return TRUE;
	}
        
        public function isOwnedBy($bug, $user) {
            return $this->field('bug_id', array('bug_id' => $bug, 'user_id' => $user)) === $bug;
        }
        
        public $belongsTo = array(
            'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
             )
        );
        
        
}
