<?php
App::uses('UsersController', 'Users.Controller');
class AppUsersController extends UsersController {

        public $name = 'AppUsers';
    
	public function beforeFilter() {
            parent::beforeFilter();
            $this->User = ClassRegistry::init('AppUser');
            $this->set('model', 'AppUser');
        }

        protected function _setupAuth() {
           parent::_setupAuth();
            $this->Auth->loginRedirect = array(
                'plugin' => null,
                'admin' => false,
                'controller' => 'bugs',
                'action' => 'mybugs'
            );
            $this->Auth->loginAction = array('controller' => 'app_users', 'action' => 'login');
            $this->Auth->logoutRedirect = $this->Auth->loginAction;
        }
        
	public function render($view = null, $layout = null) {
		if (is_null($view)) {
			$view = $this->action;
		}
		$viewPath = substr(get_class($this), 0, strlen(get_class($this)) - 10);
		if (!file_exists(APP . 'View' . DS . $viewPath . DS . $view . '.ctp')) {
			$this->plugin = 'Users';
		} else {
			$this->viewPath = $viewPath;
		}
		return parent::render($view, $layout);
	}
        
        public function edit($id = null) {
		if (!$this->{$this->modelClass}->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data[$this->modelClass];
                        if ($this->{$this->modelClass}->save($this->request->data)){
                                $this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array($this->modelClass . '.' . $this->{$this->modelClass}->primaryKey => $id));
			$this->request->data = $this->{$this->modelClass}->find('first', $options);
		}
	}
}