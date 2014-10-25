<?php
App::uses('AppController', 'Controller');

/**
 * Trsurelists Controller
 *
 * @property Trsurelist $Trsurelist
 */
class TrsurelistsController extends AppController {
//        public $Mskatelist;


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Trsurelist->recursive = 0;
		$this->set('trsurelists', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Trsurelist->exists($id)) {
			throw new NotFoundException(__('Invalid trsurelist'));
		}
		$options = array('conditions' => array('Trsurelist.' . $this->Trsurelist->primaryKey => $id));
		$this->set('trsurelist', $this->Trsurelist->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Trsurelist->create();
			if ($this->Trsurelist->save($this->request->data)) {
				$this->Session->setFlash(__('The trsurelist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trsurelist could not be saved. Please, try again.'));
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
	        App::import('Model', 'Mskate');
	        $this->Mskatelist= new Mskate();
                $this->set('Mskatelist', $this->Mskatelist->find('list'));

		if (!$this->Trsurelist->exists($id)) {
			throw new NotFoundException(__('Invalid trsurelist'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Trsurelist->save($this->request->data)) {
				//$this->Session->setFlash(__('The trsurelist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The trsurelist could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Trsurelist.' . $this->Trsurelist->primaryKey => $id));
			$this->request->data = $this->Trsurelist->find('first', $options);
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
		$this->Trsurelist->id = $id;
		if (!$this->Trsurelist->exists()) {
			throw new NotFoundException(__('Invalid trsurelist'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Trsurelist->delete()) {
			$this->Session->setFlash(__('Trsurelist deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Trsurelist was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
