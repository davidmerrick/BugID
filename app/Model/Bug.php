<?php

App::uses('AppModel', 'Model', 'Debugger', 'CakeLog');

class Bug extends AppModel {

	//Add search to Bug model
    	public $actsAs = array('Search.Searchable', 'Containable');
    
	public $filterArgs = array(
        	'filter' => array('type' => 'query', 'method' => 'orConditions')
	);

	//OR all the fields together
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
            //Make sure the uploaded file actually exists
            'uploadedImageExists' => array(
				'rule' => array('uploadedImageExists',
					'message' => 'Error uploading image. File does not exist in temporary directory on server.',
					'allowEmpty' => TRUE, 
				),
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
        
        public function beforeDelete($cascade = true){
            //delete associated image
            //Sinve all images share the same filename, this finds all of them
            $info = $this->find('first', array(
                    'conditions' => array($this->alias . '.bug_id' => $this->id),
            ));
            
            //Delete the preview image
            if(!empty($info[$this->alias]['bug_photo'])){
                if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo'])){
                    unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo']);
                }
            }
            
            //Delete the raw image
            if(!empty($info[$this->alias]['bug_photo_raw'])){
                if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo_raw'])){
                    unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo_raw']);
                }
            }
            
            //Delete the thumbnail
            if(!empty($info[$this->alias]['bug_photo_thumbnail'])){
                if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo_thumbnail'])){
                    unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['bug_photo_thumbnail']);
                }
            }
            
            //Be sure that beforeDelete() returns true, or your delete is going to fail.
            return true;
        }
        
        //Classifies the image. Invoke classifier here!
        private function classify($filename){
            //TODO: replace the following line with the classifier script when it's ready!   
            return $this->mock_classify($filename);
            
        }
    
        //Mocks up the classifier using the MD5 hash of preselected files
        private function mock_classify($filename){
            if(md5_file($filename) == 'd9c9ab6a62eae19ee3c7ed4c06b0c83e'){
                return 'Ant';
            } else if(md5_file($filename) == '7821740b416aa9bd721fb1835e3fd29c'){
                return 'Dragonfly';
            } else if(md5_file($filename) == 'e18c0a7b48af50c140428c589839f511'){
                return 'Ladybug';
            } else if(md5_file($filename) == 'f73a4d59f129ccc831f3c95a917ff2b3'){
                return 'Tarantula';
            } else {
                return null;
            }
        }
    
        //Checks if the uploaded file exists
        public function uploadedImageExists($check = array()){
            return is_uploaded_file($check['bug_photo_raw']['tmp_name']);
        }
    
        //Handles the upload of images
        public function processImageUpload($check = array()){
		//How this works:
		//
		//1. Generate a unique filename for the image 
		//2. Move the raw photo to the raw photo directory, set permissions
		//3. Convert the raw photo to a web-resolution image, move it to web-resolution directory, set permissions
		//4. Repeat step 3 for thumbnail image
		//5. Eventually (fingers crossed) run the raw image through the classifier 
		
        // Where to store the images
		$bug_photos_raw_dir = 'bug_photos_raw'; //Raw images
		$bug_photos_dir = 'bug_photos'; //Web-resolution images
        $bug_photos_thumbnails_dir = 'bug_photos_thumbnails'; //Thumbnails
        $imageMagick_bin = '/opt/local/bin/convert'; //Location of the imageMagick binary
            
        //Get the extension of the file
        $extension = pathinfo($check['bug_photo_raw']['name'], PATHINFO_EXTENSION);

        // 1. 
        //Generate a random string for the filename based on the MD5 hash of the file
        $filename = uniqid(md5_file($check['bug_photo_raw']['tmp_name']));
        $raw_photo = WWW_ROOT . 'img' . DS . $bug_photos_raw_dir . DS . $filename . "." . $extension;

        // 2. 
        //Change the name of the raw photo and move it to the raw photo directory
        if(!move_uploaded_file($check['bug_photo_raw']['tmp_name'], $raw_photo)){
            return FALSE;	
        }

        //Set the file permissions
        chmod($raw_photo, 0755);

        //Set the data to be passed back to the controller
        $this->data[$this->alias]['bug_photo_raw'] = $bug_photos_raw_dir . DS . $filename . "." . $extension;

		// 3. 
		//Convert the image for web resolution
		//Save it as same filename but in the bug_photos directory
		$compressed_photo = WWW_ROOT . 'img' . DS . $bug_photos_dir . DS . $filename . ".jpeg"; 
		
		//Compress the photo for web resolution
		exec($imageMagick_bin . ' -size 720x720 ' . $raw_photo . ' ' . $compressed_photo);
		
		//Check that the web resolution photo was converted properly
		if(!file_exists($compressed_photo)){
			return FALSE;
		}
		
		//Set the file permissions
		chmod($compressed_photo, 0755);
		
		//Set the data to be passed back to the controller
		$this->data[$this->alias]['bug_photo'] = $bug_photos_dir . DS . $filename . ".jpeg";
		
		// 4. 
		//Convert the image to thumbnail
		//Save it as same filename but in the bug_photos directory
		$thumbnail = WWW_ROOT . 'img' . DS . $bug_photos_thumbnails_dir . DS . $filename . ".jpeg"; 
		//Make sure thumbnail dimensions correspond with how they're displayed (see bugid.css)
		exec($imageMagick_bin . ' -size 200x200 ' . $raw_photo . ' ' . $thumbnail);
		
		//Check that the thumbnail was converted properly
		if(!file_exists($thumbnail)){
			return FALSE;
		}
		
		//Set the file permissions
		chmod($thumbnail, 0755);
		//Set the data to be passed back to the controller
		$this->data[$this->alias]['bug_photo_thumbnail'] = $bug_photos_thumbnails_dir . DS . $filename . ".jpeg";
		
		// 5. 
		//Classify the image
		//Use the $data variable to store the result of the classification
		//This will pass it to the database for storage
		$this->data[$this->alias]['species_name'] = $this->classify(WWW_ROOT . 'img' . DS . $this->data[$this->alias]['bug_photo_raw']);
        
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
