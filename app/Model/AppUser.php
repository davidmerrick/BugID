<?php
App::uses('User', 'Users.Model');
class AppUser extends User {
	//public $useTable = 'users';
        
        protected function _setupBehaviors() {
            parent::_setupBehaviors();
            if (class_exists('Containable')) {
			$this->actsAs[] = 'Containable';
            }
        }
        
        public function __construct($id = false, $table = null, $ds = null) {
            parent::__construct($id, $table, $ds);
            $this->validate['profile_photo'] = array(
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
                )
            );
        }
        
        public $hasMany = array(
            'Bug' => array(
                'className' => 'Bug',
                'foreignKey' => 'user_id'
             )
        );
        
        public function beforeDelete($cascade = true) {
            //Delete all bugs associated with this user
            if(!$this->Bug->deleteall(
                array('user_id' => $this->id), 
                true, 
                true //Enable callbacks
            )){
                return false;
            }
            //Delete profile photo
            $info = $this->find('first', array(
                        'conditions' => array($this->alias . '.id' => $this->id),
            ));
            
            if(!empty($info[$this->alias]['profile_photo'])){
                if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['profile_photo'])){
                    unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['profile_photo']);
                }
            }
            
            return true;
        }
        
    //For searchable behavior
    public $filterArgs = array(
        'filter' => array('type' => 'query', 'method' => 'orConditions')
    );

    public function orConditions($data = array()) {
        $filter = $data['filter'];
        $cond = array(
            'OR' => array(
                $this->alias . '.username LIKE' => '%' . $filter . '%',
                $this->alias . '.email LIKE' => '%' . $filter . '%',
                $this->alias . '.first_name LIKE' => '%' . $filter . '%',
                $this->alias . '.last_name LIKE' => '%' . $filter . '%',
                $this->alias . '.university LIKE' => '%' . $filter . '%',
            ));
        return $cond;
    }
    
    public function processImageUpload($check = array()){
            if(!is_uploaded_file($check['profile_photo']['tmp_name'])){
                    return FALSE;
            }
            $extension = pathinfo($check['profile_photo']['name'], PATHINFO_EXTENSION);
            //Generate a random string for the filename based on the MD5 hash of the file
            $filename = uniqid(md5_file($check['profile_photo']['tmp_name'])) . "." . $extension;
            if(!move_uploaded_file($check['profile_photo']['tmp_name'], WWW_ROOT . 'img' . DS . 'profiles' . DS . $filename)){
                    return FALSE;	
            }
            //Set permissions on the file
            chmod(WWW_ROOT . 'img' . DS . 'profiles' . DS . $filename, 0755);
            $this->data[$this->alias]['profile_photo'] = 'profiles' . DS . $filename;
            return TRUE;
    }
    
    public function edit($userId = null, $postData = null, $fields = array('first_name', 'last_name', 'university', 'profile_photo')) {
            $user = $this->getUserForEditing($userId);
            $this->set($user);
            if (empty($user)) {
                    throw new NotFoundException(__d('users', 'Invalid User'));
            }

            if (!empty($postData)) {
                    $this->set($postData);
                    $result = $this->save(null, true, $fields);
                    if ($result) {
                            $this->data = $result;
                            return true;
                    } else {
                            return $postData;
                    }
            }
    }
    
    public function beforeSave(array $options = array()){
        if(isset($this->data[$this->alias]['profile_photo'])){
            //Delete previosly-uploaded profile photo
            $info = $this->find('first', array(
                        'conditions' => array($this->alias . '.id' => $this->id),
            ));
            //But only if they're updating it
            if(!empty($info[$this->alias]['profile_photo']) && $this->data[$this->alias]['profile_photo'] != $info[$this->alias]['profile_photo']){
                if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['profile_photo'])){
                    unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['profile_photo']);
                }
            }
        }
    }
    
    public function delete_profile_photo($id = null){
        if(!isset($id)){
            return false;
        }

        //Delete previosly-uploaded profile photo
        $info = $this->find('first', array(
                    'conditions' => array($this->alias . '.id' => $this->id),
        ));
        //But only if it actually exists
        if(!empty($info[$this->alias]['profile_photo'])){
            if(file_exists(WWW_ROOT . 'img' . DS . $info[$this->alias]['profile_photo'])){
                unlink(WWW_ROOT . 'img' . DS . $info[$this->alias]['profile_photo']);
            }
        }
        //Delete it in the database as well
        $info[$this->alias]['profile_photo'] = '';
        $this->set($info);
        $result = $this->save(null, false, array('profile_photo'));
        if ($result) {
            $this->data = $result;
            return true;
        } else {
            return false;
        }
    }

}