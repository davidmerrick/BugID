<?php
App::uses('AppController', 'Controller');
/**
 * Issues Controller
 *
 * @property Issue $Issue
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class IssuesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public $paginator_settings = array(
		'limit' => 1, //Limits the number of items per page to 1
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = $this->paginator_settings;
		$this->set('issues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
		$this->set('issue', $this->Issue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Issue->create();
			$data = $this->request->data['Issue'];
			if(!$data['issue_cover']['name']){
				unset($data['issue_cover']);
			}
			if ($this->Issue->save($data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		}
		$issuePublications = $this->Issue->Publication->find('list');
		$this->set(compact('issuePublications'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Issue->exists($id)) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$data = $this->request->data['Issue'];
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->data['Issue'];
                        if(!$data['issue_cover']['name']){
                        	unset($data['issue_cover']);
                        }
                        if ($this->Issue->save($data)) {
				$this->Session->setFlash(__('The issue has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The issue could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Issue.' . $this->Issue->primaryKey => $id));
			$this->request->data = $this->Issue->find('first', $options);
		}
		$issuePublications = $this->Issue->Publication->find('list');
		$this->set(compact('issuePublications'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Issue->id = $id;
		if (!$this->Issue->exists()) {
			throw new NotFoundException(__('Invalid issue'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Issue->delete()) {
			$this->Session->setFlash(__('The issue has been deleted.'));
		} else {
			$this->Session->setFlash(__('The issue could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
