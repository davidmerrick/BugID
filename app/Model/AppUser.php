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
                array('user_id' => $this->id), 
                true, 
                true //Enable callbacks
            )){
                return false;
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
        
}