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
        
        public $hasMany = array(
            'Bug' => array(
                'className' => 'Bug',
                'foreignKey' => 'user_id'
             )
        );
        
        public function beforeDelete($cascade = true) {
            
            //Delete all bugs associated with this user
            if(!$this->Bug->deleteall(
                array('user_id' => $this->id)
            )){
                return false;
            }
                
            return true;
        }
}