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
                if($id != $this->Auth->user('id')){
                    $this->Session->setFlash(__('You are not permitted to edit another user\'s profile.'));
                    $this->redirect(array('controller' => 'app_users', 'action' => 'view', $this->Auth->user('id')));
                }
                $this->set('title_for_layout', 'Edit Profile'); 
                if ($this->request->is(array('post', 'put'))) {
                        $data = $this->request->data[$this->modelClass];
                        //Fields for validation
                        $fields = array('first_name', 'last_name', 'university', 'profile_photo');
                        try {
                            $result = $this->{$this->modelClass}->edit($id, $data, $fields);
                            if ($result === true) {
                                    $this->Session->setFlash(__('User saved'));
                                    $this->redirect(array('action' => 'view', $id));
                            }
                        } catch (OutOfBoundsException $e) {
                            $this->Session->setFlash($e->getMessage());
                            $this->redirect(array('action' => 'index'));
                        }
                        if ($this->{$this->modelClass}->save($data, true, array('university'))){
                                $this->Session->setFlash(__('Your profile has been updated.'));
                                return $this->redirect(array('action' => 'view', $id));
                        } else {
                                $this->Session->setFlash(__('Your profile could not be saved. Please, try again.'));
                        }
		} else {
			$this->request->data = $this->{$this->modelClass}->read(null, $id);
                        $user = $this->{$this->modelClass}->view($id);
                        $this->set('user', $user);
		}
	}
        
        public function view($slug = null) {
                try {
			$user = $this->{$this->modelClass}->view($slug);
                        $this->set('user', $user);
                        $this->set('title_for_layout', ucfirst($user[$this->modelClass]['username']) . '\'s Profile'); //Sets page title
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect('/');
		}            
        }
        
        public function delete_profile_photo($id = null){
            $this->{$this->modelClass}->id = $id;
            if(!$this->{$this->modelClass}->exists()){
                    throw new NotFoundException(__('Invalid user'));
            }
            $this->request->onlyAllow('post');
            if ($this->{$this->modelClass}->delete_profile_photo($id)) {
                $this->Session->setFlash(__('Profile photo has been deleted.'));
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('Your profile photo could not be deleted. Please, try again.'));
                $this->redirect(array('action' => 'view', $id));
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
        
        public function find() {
            $this->set('title_for_layout', 'Find Users'); 
            $this->Prg->commonProcess();
            $this->Paginator->settings['conditions'] = $this->{$this->modelClass}->parseCriteria($this->Prg->parsedParams());
            $this->set('users', $this->Paginator->paginate());
        }
        
        public function login(){
            $this->set('title_for_layout', 'Login'); 
            if ($this->Auth->user()) {
                $this->Session->setFlash(__d('users', 'You are already logged in!'));
                $this->redirect('/');
            }
            $Event = new CakeEvent(
            'Users.Controller.Users.beforeLogin',
            $this,
            array(
                    'data' => $this->request->data,
            )
            );

		$this->getEventManager()->dispatch($Event);

		if ($Event->isStopped()) {
			return;
		}

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$Event = new CakeEvent(
					'Users.Controller.Users.afterLogin',
					$this,
					array(
						'data' => $this->request->data,
						'isFirstLogin' => !$this->Auth->user('last_login')
					)
				);

				$this->getEventManager()->dispatch($Event);

				$this->{$this->modelClass}->id = $this->Auth->user('id');
				$this->{$this->modelClass}->saveField('last_login', date('Y-m-d H:i:s'));

				if ($this->here == $this->Auth->loginRedirect) {
					$this->Auth->loginRedirect = '/';
				}
				$this->Session->setFlash(sprintf(__('Welcome, %s'), $this->Auth->user('username')));
				if (!empty($this->request->data)) {
					$data = $this->request->data[$this->modelClass];
					if (empty($this->request->data[$this->modelClass]['remember_me'])) {
						$this->RememberMe->destroyCookie();
					} else {
						$this->_setCookie();
					}
				}

				if (empty($data[$this->modelClass]['return_to'])) {
					$data[$this->modelClass]['return_to'] = null;
				}

				// Checking for 2.3 but keeping a fallback for older versions
				if (method_exists($this->Auth, 'redirectUrl')) {
					$this->redirect($this->Auth->redirectUrl($data[$this->modelClass]['return_to']));
				} else {
					$this->redirect($this->Auth->redirect($data[$this->modelClass]['return_to']));
				}
			} else {
				$this->Auth->flash(__d('users', 'Invalid e-mail / password combination.  Please try again'));
			}
		}
		if (isset($this->request->params['named']['return_to'])) {
			$this->set('return_to', urldecode($this->request->params['named']['return_to']));
		} else {
			$this->set('return_to', false);
		}
		$allowRegistration = Configure::read('Users.allowRegistration');
		$this->set('allowRegistration', (is_null($allowRegistration) ? true : $allowRegistration));
        }
}