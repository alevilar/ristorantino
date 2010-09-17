<?php
class ClientesController extends AppController {

	var $name = 'Clientes';
	var $helpers = array('Html', 'Form', 'Ajax');

	function index() {
		$this->Cliente->recursive = 0;
		$this->set('clientes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cliente.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('cliente', $this->Cliente->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('Se agregó un nuevo cliente', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser gardado, intente nuevamente.', true));
			}
		}
		$users = $this->Cliente->User->find('list',array('fields'=>array('User.nombre')));
		$descuentos = $this->Cliente->Descuento->find('list');
		
		$tipo_documentos = $this->Cliente->TipoDocumento->find('list');		
		$iva_responsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		
		$this->set(compact('users', 'descuentos', 'iva_responsabilidades', 'tipo_documentos'));
	}

        function addFacturaA() {
		if (!empty($this->data)) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->data)) {
				$this->Session->setFlash(__('Se agregó un nuevo cliente', true));
				$this->autoRender = false;
                                $this->redirect('/clientes/ajax_clientes_factura_a');
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser gardado, intente nuevamente.', true));
			}
		}
		
		$tipo_documentos = $this->Cliente->TipoDocumento->find('list');
		$iva_responsabilidades = $this->Cliente->IvaResponsabilidad->find('list');

		$this->set(compact('iva_responsabilidades', 'tipo_documentos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Cliente incorrecto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cliente->saveAll($this->data)) {
				$this->Session->setFlash(__('El Cliente fue guardado', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser guardado.intente nuevamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cliente->read(null, $id);
		}
		$users = $this->Cliente->User->find('list',array('fields'=>array('User.nombre')));
		$descuentos = $this->Cliente->Descuento->find('list');
		$tipo_documentos = $this->Cliente->TipoDocumento->find('list');		
		$iva_responsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		
		$this->set(compact('users', 'descuentos', 'iva_responsabilidades', 'tipo_documentos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Cliente', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cliente->del($id)) {
			$this->Session->setFlash(__('Cliente deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	/**
	 * me lista todos los clientes que sean del tipo Factura "A"
	 *
	 */
	function ajax_clientes_factura_a(){
		$this->Cliente->order = 'Cliente.nombre';
		$this->paginate = array('conditions'=>array('Cliente.tipofactura' => 'A'),
					'limit'=> 7,
                                        'contain' => array('Cliente'),
		);		
		$this->set('clientes',$this->paginate());
	}
	
        /**
	 * me lista todos los clientes con descuento
	 *
	 */
	function ajax_clientes_con_descuento(){
                $conditions = array('tipofactura <>' => "A");
                if ($this->Auth->user('role') == 'mozo') {
                    $conditions = array_merge($conditions, array('Descuento.porcentaje <' => 16));
                }
		$this->Cliente->order = 'Cliente.nombre';
		$this->paginate = array('conditions'=>$conditions,
                                        'limit'=> 7,
                                        'contain' => array('Cliente'=>array('Descuento')),
		);
		
		$this->set('clientes',$this->paginate());
	}

}
?>