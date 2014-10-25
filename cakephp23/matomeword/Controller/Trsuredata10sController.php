<?php
App::uses('AppController', 'Controller');
/**
 * Trsuredata10s Controller
 *
 * @property Trsuredata10 $Trsuredata10
 */
class Trsuredata10sController extends AppController {
	public $uses = array('TrSuredata10');

//	public function beforeRender() {
		
		//$this->set('kateList', $this->TrSuredata10->Mskate10->find('list'));
//		$this->set('kateList', $this->Trsuredata10->Mskate10->find('list'));
//	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Trsuredata10->recursive = 0;
		$this->set('trsuredata10s', $this->paginate());
		$this->set('kateList', $this->Mskate10->find('list'));
 	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Trsuredata10->exists($id)) {
			throw new NotFoundException(__('Invalid trsuredata10'));
		}
		$options = array('conditions' => array('Trsuredata10.' . $this->Trsuredata10->primaryKey => $id));
		$this->set('trsuredata10', $this->Trsuredata10->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Trsuredata10->create();
			if ($this->Trsuredata10->save($this->request->data)) {
				$this->flash(__('Trsuredata10 saved.'), array('action' => 'index'));
			} else {
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Trsuredata10->exists($id)) {
			throw new NotFoundException(__('Invalid trsuredata10'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Trsuredata10->save($this->request->data)) {
				$this->flash(__('The trsuredata10 has been saved.'), array('action' => 'index'));
			} else {
			}
		} else {
			$options = array('conditions' => array('Trsuredata10.' . $this->Trsuredata10->primaryKey => $id));
			$this->request->data = $this->Trsuredata10->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Trsuredata10->id = $id;
		if (!$this->Trsuredata10->exists()) {
			throw new NotFoundException(__('Invalid trsuredata10'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Trsuredata10->delete()) {
			$this->flash(__('Trsuredata10 deleted'), array('action' => 'index'));
		}
		$this->flash(__('Trsuredata10 was not deleted'), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
