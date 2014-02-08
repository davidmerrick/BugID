<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array(
                        'Cookie',
                        'DebugKit.Toolbar', 
                        'Session',
                        'Auth' => array(
                            'loginRedirect' => array(
                                'controller' => 'bugs',
                                'action' => 'mybugs'
                        ),
                        'authorize' => array('Controller'),
                        'Email',
                        'RequestHandler',
                    )
        );
    
/**
 * publically accessible controllers - all methods are allowed by all
 */
    public $publicControllers = array('pages');
        
    public function beforeFilter() {
            $this->theme='BugID';   
           
            //Allow viewing indexes and views by everyone
            $this->Auth->allow('index', 'view');
            
            //Setup Auth stuff
            $this->Auth->authError = __('Sorry, but you need to login to access this location.', true);
            $this->Auth->loginError = __('Invalid e-mail/password combination. Please try again.', true);
            $this->Auth->loginAction = array('controller' => 'app_users', 'action' => 'login');
            $this->Auth->loginRedirect = array('controller' => 'bugs', 'action' => 'mybugs');
            
            $this->Auth->authorize = array('Controller');
            
            if (in_array(strtolower($this->params['controller']), $this->publicControllers)) {
                $this->Auth->allow();
            }

            $this->Cookie->name = 'BugIDRememberMe';
            $this->Cookie->time = '1 Month';
            $cookie = $this->Cookie->read('User');

            if (!empty($cookie) && !$this->Auth->user()) {
                    $data['User']['username'] = '';
                    $data['User']['password'] = '';
                    if (is_array($cookie)) {
                            $data['User']['username'] = $cookie['username'];
                            $data['User']['password'] = $cookie['password'];
                    }
                    if (!$this->Auth->login($data)) {
                            $this->Cookie->destroy();
                            $this->Auth->logout();
                    }
            }
    }
    
    public function isAuthorized() {
            if ($this->Auth->user() && $this->params['prefix'] != 'admin') {
                    return true;
            }
            if ($this->params['prefix'] == 'admin' && $this->Auth->user('is_admin')) {
                    return true;
            }
            return false;
    }
}