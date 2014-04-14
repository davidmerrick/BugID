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
        
	//Validation criteria	
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
        	//Validation for the image
        	'bug_photo_raw' => array(
            		//User must upload an image
            		'required' => array(
                		'required' => TRUE,
                		'message' => 'An image is required.',
			),
            		'uploadError' => array(
				'rule' => 'uploadError',
				'message' => 'The image upload failed.',
				'allowEmpty' => TRUE,
			),
			//Check the MIME type to make sure it's actually an image (and not a text file or something)
			'mimeType' => array(
				'rule' => array('mimeType', array('image/gif', 'image/png', 'image/jpg', 'image/jpeg', 'image/tiff')),
				'message' => 'Please only upload images.',
				'allowEmpty' => TRUE,
			),
			//Run it through the processImageUpload method
			//This takes care of generating thumbnails, web-resolution preview images,
			//and runs it through the vision algorithm
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
            if(!empty($info[$this->alias]['bug_photo_raw'])){
                if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo_raw'])){
                    unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo_raw']);
                }
            }
            if(!empty($info[$this->alias]['bug_photo_thumbnail'])){
                if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo_thumbnail'])){
                    unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo_thumbnail']);
                }
            }
            
            //Be sure that beforeDelete() returns true, or your delete is going to fail.
            return true;
        }
        
        //Handles the upload of images
        public function processImageUpload($check = array()){

            	// Where to store the images
		$bug_photos_dir = 'bug_photos';
		$bug_photos_raw_dir = 'bug_photos_raw';
            	$bug_photos_thumbnails_dir = 'bug_photos_thumbnails';

		if(!is_uploaded_file($check['bug_photo_raw']['tmp_name'])){
			return FALSE;
		}

            	//Get the extension of the file
            	$extension = pathinfo($check['bug_photo_raw']['name'], PATHINFO_EXTENSION);
            
            	//Generate a random string for the filename based on the MD5 hash of the file
            	$filename = uniqid(md5_file($check['bug_photo_raw']['tmp_name']));
            	$raw_photo = WWW_ROOT . 'img' . DS . $bug_photos_raw_dir . DS . $filename . "." . $extension;
            	
            	//Change the name of the raw photo and move it to the raw photo directory
            	if(!move_uploaded_file($check['bug_photo_raw']['tmp_name'], $raw_photo)){
                	return FALSE;	
            	}

            	//Set the file permissions
            	chmod($raw_photo, 0755);
            	
            	//Set the data to be passed back to the controller
            	$this->data[$this->alias]['bug_photo_raw'] = $bug_photos_raw_dir . DS . $filename . "." . $extension;

		//Convert the image for web resolution
		//Save it as same filename but in the bug_photos directory
		$compressed_photo = WWW_ROOT . 'img' . DS . $bug_photos_dir . DS . $filename . ".jpeg"; 
		
		//Compress the photo for web resolution
		exec('/usr/bin/convert -size 720x720 ' . $raw_photo . ' ' . $compressed_photo);
		
		//Check that the web resolution photo was converted properly
		if(!file_exists($compressed_photo)){
			return FALSE;
		}
		
		//Set the file permissions
		chmod($compressed_photo, 0755);
		
		//Set the data to be passed back to the controller
		$this->data[$this->alias]['bug_photo'] = $bug_photos_dir . DS . $filename . ".jpeg";
		
		//Convert the image to thumbnail
		//Save it as same filename but in the bug_photos directory
		$thumbnail = WWW_ROOT . 'img' . DS . $bug_photos_thumbnails_dir . DS . $filename . ".jpeg"; 
		//Make sure thumbnail dimensions correspond with how they're displayed (see bugid.css)
		exec('/usr/bin/convert -size 200x200 ' . $raw_photo . ' ' . $thumbnail);
		
		//Check that the thumbnail was converted properly
		if(!file_exists($thumbnail)){
			return FALSE;
		}
		
		//Set the file permissions
		chmod($thumbnail, 0755);
		$this->data[$this->alias]['bug_photo_thumbnail'] = $bug_photos_thumbnails_dir . DS . $filename . ".jpeg";
		
		return TRUE;
	}
        
        public function isOwnedBy($bug, $user) {
            return $this->field('bug_id', array('bug_id' => $bug, 'user_id' => $user)) === $bug;
        }
        
        public $belongsTo = array(
            'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
             ),
            'Batch' => array(
                'className' => 'Batch',
                'foreignKey' => 'batch_id'
            )
        );
}
