<?php
App::uses('User', 'Users.Model');
class AppUser extends User {
	public $useTable = 'users';
	
        /*
        public $alias = 'User';

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
	}
         * 
         */
}