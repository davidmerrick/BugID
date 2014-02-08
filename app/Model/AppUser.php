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
}