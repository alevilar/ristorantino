<?php
class GastosController extends AccountAppController {

	var $name = 'Gastos';
        var $uses = array('Gasto', 'Cliente', 'TipoFactura');
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Gasto->recursive = 1;
                //debug($this->paginate());
		$this->set('gastos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Gasto', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gasto', $this->Gasto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
                        // fecha de factura
                        if (!empty($this->data['Gasto']['factura_fecha'])) {
                            $fechaFactura = @explode('/', $this->data['Gasto']['factura_fecha']);
                            $this->data['Gasto']['factura_fecha'] = $fechaFactura[2] . "-" . $fechaFactura[1] . "-" . $fechaFactura[0];
                        }
                
			$this->Gasto->create();
			if ($this->Gasto->save($this->data)) {
				$this->Session->setFlash(__('The Gasto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Gasto could not be saved. Please, try again.', true));
			}
		}
                
                $tipo_facturas = $this->TipoFactura->find('list');		
		$clientes = $this->Cliente->find('list', array(
                        'fields' => array('Cliente.id', 'Cliente.nombre'),
                        'order' => array('Cliente.nombre')
                    ));
		
		$this->set(compact('clientes', 'tipo_facturas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Gasto', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
                        // fecha de factura
                        if (!empty($this->data['Gasto']['factura_fecha'])) {
                            $fechaFactura = @explode('/', $this->data['Gasto']['factura_fecha']);
                            $this->data['Gasto']['factura_fecha'] = $fechaFactura[2] . "-" . $fechaFactura[1] . "-" . $fechaFactura[0];
                        }
                
			if ($this->Gasto->save($this->data)) {
				$this->Session->setFlash(__('The Gasto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Gasto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gasto->read(null, $id);
                        
                        // fechas
                        $fechaFactura = strtotime($this->data['Gasto']['factura_fecha']);
                        $this->data['Gasto']['factura_fecha'] = date('d/m/Y', $fechaFactura);
		}
                
                $tipo_facturas = $this->TipoFactura->find('list');		
		$clientes = $this->Cliente->find('list', array(
                        'fields' => array('Cliente.id', 'Cliente.nombre'),
                        'order' => array('Cliente.nombre')
                    ));
		
		$this->set(compact('clientes', 'tipo_facturas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Gasto', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Gasto->del($id)) {
			$this->Session->setFlash(__('Gasto deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Gasto could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>