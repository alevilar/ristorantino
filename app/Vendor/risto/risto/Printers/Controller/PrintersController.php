<?php
App::uses('PrintersAppController', 'Printers.Controller');
/**
 * Printers Controller
 *
 * @property Printer $Printer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PrintersController extends PrintersAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Printer->recursive = 0;
		$this->set('printers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Printer->exists($id)) {
			throw new NotFoundException(__('Invalid printer'));
		}
		$options = array('conditions' => array('Printer.' . $this->Printer->primaryKey => $id));
		$this->set('printer', $this->Printer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Printer->create();
			if ($this->Printer->save($this->request->data)) {
				$this->Session->setFlash(__('The printer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer could not be saved. Please, try again.'));
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
		if (!$this->Printer->exists($id)) {
			throw new NotFoundException(__('Invalid printer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Printer->save($this->request->data)) {
				$this->Session->setFlash(__('The printer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Printer.' . $this->Printer->primaryKey => $id));
			$this->request->data = $this->Printer->find('first', $options);
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
		$this->Printer->id = $id;
		if (!$this->Printer->exists()) {
			throw new NotFoundException(__('Invalid printer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Printer->delete()) {
			$this->Session->setFlash(__('The printer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The printer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}



	/**
	 * @param string $type puede ser X o Z. 
	 * 		El cierre X realiza un cierre parcial, típico para cambio de cajero
	 * 		El cierre Z es un cierre fiscal, y pone los contadopres del impresor fiscal en cero
	 */
	public function cierre( $type = "X"){
		$this->Printer->imprimirCierre( $type );

		if ( !$this->request->is('ajax') ) {
			$this->Session->setFlash("Se imprimió un Cierre Z");
			$this->redirect($this->referer());
        } else {
        	exit;
        }
    }




    public function nota_credito(){
		if ( $this->request->is(array('post', 'put')) ) {
            $cliente = array();
            if( !empty($this->request->data['Cliente']) && $this->request->data['Cajero']['tipo'] == 'A'){
                $cliente['razonsocial'] = $this->request->data['Cliente']['razonsocial'];
                $cliente['numerodoc'] = $this->request->data['Cliente']['numerodoc'];
                $cliente['respo_iva'] = $this->request->data['Cliente']['respo_iva'];
                $cliente['tipodoc'] = $this->request->data['Cliente']['tipodoc'];
            }
         
            $this->Printer->imprimirNotaDeCredito(
                    $this->request->data['Cajero']['numero_ticket'],
                    $this->request->data['Cajero']['importe'],
                    $this->request->data['Cajero']['tipo'],
                    $this->request->data['Cajero']['descripcion'],
                    $cliente
                    );

            $this->Session->setFlash("Se envió a imprimir una nota de crédito", 'flash_success');
        }
	}

}
