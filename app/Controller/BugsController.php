<?php
App::uses('AppController', 'Controller');
/**
 * Bugs Controller
 *
 * @property Bug $Bug
 * @property PaginatorComponent $Paginator
 */
class BugsController extends AppController {
        
        public $components = array('Paginator', 'Search.Prg');
        public $presetVars = true; // using the model configuration
        
        public function find() {
            $this->set('title_for_layout', 'Find Bugs'); //Sets page title
            $this->Prg->commonProcess();
            $this->Paginator->settings['conditions'] = $this->Bug->parseCriteria($this->Prg->parsedParams());
            $this->set('bugs', $this->Paginator->paginate());
        }
        
	public function index() {
		//Set recursive to 1 to retrieve users associated with the bug
                $this->Bug->recursive = 1;
                $this->set('title_for_layout', 'All Bugs'); //Sets page title
		$this->set('bugs', $this->Paginator->paginate());
	}
        
        //Shows a list of bugs user has uploaded
	public function mybugs() {
                $this->set('title_for_layout', 'My Bugs'); //Sets page title
		
                //Do a custom pagination query for bugs belonging to user
                $this->Paginator->settings = array(
                    'conditions' => array('Bug.user_id' => $this->Auth->User('id'))
                );
                $bugs = $this->Paginator->paginate();
                $this->set(compact('bugs'));
	}
        
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$options = array('conditions' => array('Bug.' . $this->Bug->primaryKey => $id));
		$this->set('bug', $this->Bug->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Bug']['user_id'] = $this->Auth->user('id');
                        $this->Bug->create();
			$data = $this->request->data['Bug'];
			/*
                        if(!$data['bug_photo']['name']){
				unset($data['bug_photo']);
			}
                         */
                        if ($this->Bug->save($data)) {
				$this->Session->setFlash(__('The bug has been saved.'));
				return $this->redirect(array('action' => 'view', $this->Bug->id));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
			}
		}
	}
        
	public function edit($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data['Bug'];
                        //if(!$data['bug_photo']['name']){
                        //Don't allow photo to be changed
                        //unset($data['bug_photo']);
                        //}
                        
                        //Only allow certain fields to be updated
                        if ($this->Bug->save($data, true, array(
                            'bug_size', 
                            'specimen_code', 
                            'species_name', 
                            'river', 
                            'state', 
                            'country', 
                            'bug_id',
                            'collector_name',
                            'researcher_name',
                            'latitude',
                            'longitude'
                            ))) {
                                $this->Session->setFlash(__('The bug has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bug.' . $this->Bug->primaryKey => $id));
			$this->request->data = $this->Bug->find('first', $options);
		}
	}

	public function delete($id = null) {
		$this->Bug->id = $id;
		if (!$this->Bug->exists()) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Bug->delete()) {
			$this->Session->setFlash(__('The bug has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bug could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_index() {
		$this->Bug->recursive = 0;
		$this->set('bugs', $this->Paginator->paginate());
	}

	public function admin_view($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$options = array('conditions' => array('Bug.' . $this->Bug->primaryKey => $id));
		$this->set('bug', $this->Bug->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Bug->create();
			if ($this->Bug->save($this->request->data)) {
				$this->Session->setFlash(__('The bug has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bug->save($this->request->data)) {
				$this->Session->setFlash(__('The bug has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bug.' . $this->Bug->primaryKey => $id));
			$this->request->data = $this->Bug->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Bug->id = $id;
		if (!$this->Bug->exists()) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Bug->delete()) {
			$this->Session->setFlash(__('The bug has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bug could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function isAuthorized($user) {
            // All registered users can add, find, and view their own bugs
            if ($this->action === 'add' || $this->action === 'mybugs' || $this->action === 'find') {
                return true;
            }
            
            // The owner of a post can edit and delete it
            if (in_array($this->action, array('edit', 'delete'))) {
                $bugId = $this->request->params['pass'][0];
                if ($this->Bug->isOwnedBy($bugId, $user['id'])) {
                    return true;
                }
            }
            return parent::isAuthorized($user);
        }
}
