<?php
App::uses('AppController', 'Controller');
/**
 * FiscalPrinteres Controller
 *
 * @property FiscalPrinter $FiscalPrinter
 */
class FiscalPrinteresController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FiscalPrinter->recursive = 0;
		$this->set('fiscalPrinteres', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->FiscalPrinter->id = $id;
		if (!$this->FiscalPrinter->exists()) {
			throw new NotFoundException(__('Invalid fiscal printer'));
		}
		$this->set('fiscalPrinter', $this->FiscalPrinter->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FiscalPrinter->create();
			if ($this->FiscalPrinter->save($this->request->data)) {
				$this->Session->setFlash(__('The fiscal printer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fiscal printer could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->FiscalPrinter->id = $id;
		if (!$this->FiscalPrinter->exists()) {
			throw new NotFoundException(__('Invalid fiscal printer'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FiscalPrinter->save($this->request->data)) {
				$this->Session->setFlash(__('The fiscal printer has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fiscal printer could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->FiscalPrinter->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->FiscalPrinter->id = $id;
		if (!$this->FiscalPrinter->exists()) {
			throw new NotFoundException(__('Invalid fiscal printer'));
		}
		if ($this->FiscalPrinter->delete()) {
			$this->Session->setFlash(__('Fiscal printer deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Fiscal printer was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
