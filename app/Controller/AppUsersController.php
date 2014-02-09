<?php
App::uses('UsersController', 'Users.Controller');
class AppUsersController extends UsersController {

        public $name = 'AppUsers';
        //public $uses = array('Bug', 'User'); //All models will be available
        
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
                        $user = $this->{$this->modelClass}->view($id);
                        $this->set('user', $user);
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
        
        public function delete($id = null) {
		$this->{$this->modelClass}->id = $id;
		if (!$this->{$this->modelClass}->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
                $this->request->onlyAllow('post', 'delete');
                
		//Perform delete
                if ($this->{$this->modelClass}->delete()) {
                    //Logout/destroy session
                    $user = $this->Auth->user();
                    $this->Session->destroy();
                    if (isset($_COOKIE[$this->Cookie->name])) {
                        $this->Cookie->destroy();
                    }
                    $this->RememberMe->destroyCookie();
                    $this->Session->setFlash(__('Your account has been deleted.'));
                    $this->redirect($this->Auth->logout());
		} else {
                    $this->Session->setFlash(__('Your account could not be deleted. Please, try again.'));
		}
	}
}