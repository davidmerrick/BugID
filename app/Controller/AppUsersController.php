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
		try {
			$result = $this->{$this->modelClass}->edit($id, $this->request->data);
			if ($result === true) {
				$this->Session->setFlash(__('User saved'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->request->data = $result;
			}
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'index'));
		}

		if (empty($this->request->data)) {
			$this->request->data = $this->{$this->modelClass}->read(null, $id);
		}
	}
        
        public function view($slug = null) {
                try {
			$user = $this->{$this->modelClass}->view($slug);
                        $this->set('user', $user);
                        $this->set('title_for_layout', $user[$this->modelClass]['username'] . '\'s Profile'); //Sets page title
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect('/');
		}            
        }
}