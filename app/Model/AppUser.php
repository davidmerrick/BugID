<?php
App::uses('User', 'Users.Model');
class AppUser extends User {
	public $useTable = 'users';
	
        var $uses = array('Bug'); // both models will be available
        
        public $hasMany = array(
            'Bug' => array(
                'className' => 'Bug',
                'foreignKey' => 'user_id'
             )
        );
        
        /**
        * Returns all bugs associated with a user
        *
        * @param string|integer $slug user slug or the uuid of a user
        * @param string $field
        * @throws NotFoundException
        * @return array
        */
	public function viewbugs($id = null) {
		$bugs = $this->find('all', array('conditions' => array('Bug.user_id' => $id)));
		return $bugs;
	}
        
        public function beforeFind(array $query) {
            CakeLog::debug("Query results:");
            CakeLog::debug(print_r($query, true));
        }
        
        public function afterFind(array $results, $primary = false){
            /*
            $dbo = $this->getDatasource();
            $logs = $dbo->getLog();
            $lastLog = end($logs['log']);
             * 
             */
            //CakeLog::debug("AfterFind results:");
            //CakeLog::debug($lastLog['query']);
        }
}