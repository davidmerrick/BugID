<?php
App::uses('AppController', 'Controller');

class BugsController extends AppController {
        
    public $components = array('Paginator', 'Search.Prg');
    public $presetVars = true; // using the model configuration
    public $uses = array('Bug', 'User', 'Batch');

    public $paginate = array(
        'order' => array(
            'Bug.created' => 'desc'
        )
    );
        
    public function beforeFilter(){
        parent::beforeFilter();
        if (($this->request->isPost() || $this->request->isPut()) && empty($_POST) && empty($_FILES)) {
            $this->Security->csrfCheck = false;
        }
    }

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
    
    //Todo: combine index and index_thumbnails into one view and use Javascript to change the layout
    public function index_thumbnails() {
		//Set recursive to 1 to retrieve users associated with the bug
                $this->Bug->recursive = 1;
                $this->set('title_for_layout', 'All Bugs'); //Sets page title
                $this->set('bugs', $this->Paginator->paginate());
	}
        
    //Shows a list of bugs current user has uploaded
	public function mybugs() {
        $this->set('title_for_layout', 'My Bugs'); //Sets page title

        //Do a custom pagination query for bugs belonging to user
        $this->Paginator->settings = array(
            'conditions' => array('Bug.user_id' => $this->Auth->User('id'))
        );
        $bugs = $this->Paginator->paginate();
        $this->set(compact('bugs'));
	}
    
    //Shows the last uploaded batch of bugs
    public function viewbatch($batchId = null) {
		$this->set('title_for_layout', 'Last Upload'); //Sets page title
        $this->Paginator->settings = array(
            'conditions' => array('Bug.batch_id' => $batchId)
        );
        $bugs = $this->Paginator->paginate();
        $this->set(compact('bugs'));
	}
        
	public function view($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$options = array('conditions' => array('Bug.' . $this->Bug->primaryKey => $id));
		$this->set('bug', $this->Bug->find('first', $options));
	}
        
	public function add() {
		//Todo: have it return the validation error on the bug file field.
        //Todo: If one image can't be saved, should it fail on all of them? This is current behavior.
        
        if ($this->request->is('post')) {
            
            $data = $this->request->data;
            $data['Bug']['user_id'] = $this->Auth->user('id');            
            
            $this->Batch->create();
            // We don't actually need a "batch name," but cakePHP needs some kind of data saved to
            // create an instance of a model.
            if(!$this->Batch->save(array('Batch' => array('batch_name' => '')))){
                $this->Session->setFlash(__('Error saving batch'));
            }
            $data['Bug']['batch_id'] = $this->Batch->id;
            
            $i = 0; //Index of position in bug_photo_raw array
            foreach($data['Bug']['bug_photo_raw'] as $bug_photo){
                $this->Bug->create();
                
                $tmp_data = $data;
                $tmp_data['Bug']['bug_photo_raw'] = $data['Bug']['bug_photo_raw'][$i];
                                
                if (!$this->Bug->saveAll($tmp_data)) {    
                    if(sizeof($data['Bug']['bug_photo_raw']) > 1){
                        $this->Session->setFlash(__('One of the bugs could not be saved. Please, try again.'));
                    } else {
                        $this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
                    }
                    return;
                }
                $i++;
            }   
            
            if($i > 1){
                $this->Session->setFlash(__('The bugs have been saved.'));
                //Todo: change this to a view of just the bugs they just uploaded
                return $this->redirect(array('action' => 'viewbatch', $this->Batch->id));
            } else {
                $this->Session->setFlash(__('The bug has been saved.'));
                //Redirect to a view of just this bug
                return $this->redirect(array('action' => 'view', $this->Bug->id));
            }
	   }
    }
        
	public function edit($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data['Bug'];

                        //Only allow certain fields to be updated. Don't allow photo to be updated.
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
            
            // The owner of a bug can edit and delete it
            if (in_array($this->action, array('edit', 'delete'))) {
                $bugId = $this->request->params['pass'][0];
                if ($this->Bug->isOwnedBy($bugId, $user['id'])) {
                    return true;
                }
            }
            return parent::isAuthorized($user);
        }
}
