<?php
class GastosController extends AccountAppController {

	var $name = 'Gastos';
	var $helpers = array('Html', 'Form','Number', 'Jqm');

        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Contabilidad','link'=>'/account' );
        }
        
        function index() {
            $this->pageTitle = 'Gastos Pendientes de Pago';
		$this->Gasto->recursive = 1; 
                $this->Gasto->order = array('Gasto.created ASC');
		$this->set('gastos', $this->Gasto->find('all', array('conditions'=> array('Gasto.importe_pagado < Gasto.importe_total') )));
	}
        
        
        function history() {
		$this->Gasto->recursive = 1;           
                
                $conditions = array();
                $url = $this->params['url'];
                unset($url['ext']);
                unset($url['url']);
                
                
                if (!empty($url['mes'])){
                    $conditions['MONTH(Gasto.fecha)'] =  $url['mes'];
                    $this->data['Gasto']['mes'] = $url['mes'];
                } 
                
                if (!empty($url['anio'])){
                    $conditions['YEAR(Gasto.fecha)'] =  $url['anio'];
                    $this->data['Gasto']['anio'] = $url['anio'];
                } 
                
                
                if (empty($url)) {
                    $this->data['Gasto']['mes'] = date('m', strtotime('now'));
                    $conditions['MONTH(Gasto.fecha)'] =  $this->data['Gasto']['mes'];
                    $conditions['YEAR(Gasto.fecha)'] =  date('Y', strtotime('now'));
                }
                
                
                if (!empty($url['proveedor_id'])){
                    $conditions['Gasto.proveedor_id'] =  $url['proveedor_id'];
                    $this->data['Gasto']['proveedor_id'] = $url['proveedor_id'];
                }
                
                if (!empty($url['clasificacion_id'])){
                    $conditions['Gasto.clasificacion_id'] =  $url['clasificacion_id'];
                    $this->data['Gasto']['clasificacion_id'] = $url['clasificacion_id'];
                }
                
                $this->data['Gasto']['tipo_factura_id'] = null;
                if (!empty($url['tipo_factura_id'])){
                    $conditions['Gasto.tipo_factura_id'] =  $url['tipo_factura_id'];
                    $this->data['Gasto']['tipo_factura_id'] = $url['tipo_factura_id'];
                }
                
                $this->set('resumen_x_clasificacion', $this->Gasto->Clasificacion->gastos($conditions));
                $this->set('clasificaciones', $this->Gasto->Clasificacion->find('list'));
                $this->set('tipo_facturas', $this->Gasto->TipoFactura->find('list'));
                $this->set('proveedores', $this->Gasto->Proveedor->find('list'));
                $this->set('tipo_impuestos', $this->Gasto->TipoImpuesto->find('list'));
		$this->set('gastos', $this->Gasto->find('all', array('conditions' => $conditions)));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Gasto', true));
			$this->redirect(array('action' => 'index'));
		}
                
                $this->Gasto->contain(array(
                     'Proveedor',
                     'Clasificacion',
                     'TipoFactura',                    
                     'Egreso' => 'TipoDePago',
                     'Impuesto' => 'TipoImpuesto',
                     
                    ));
                
		$this->set('gasto', $this->Gasto->read(null, $id));
	}

	function add() {
            
            $this->rutaUrl_for_layout[] =array('name'=> 'Gastos','link'=>'/account/gastos' );
		if (!empty($this->data)) {
                
			$this->Gasto->create();
			if ($this->Gasto->save($this->data)) {
                            $this->Session->setFlash(__('The Gasto has been saved', true));
                            
                            if (!empty($this->data['Gasto']['pagar'])){
                                $this->redirect(array('controller'=>'egresos','action' => 'add', $this->Gasto->id));
                            } else {
                                $this->redirect(array('action' => 'index'));
                            }
			} else {
                            $this->Session->setFlash(__('The Gasto could not be saved. Please, try again.', true));
			}
		}
                            
                $this->pageTitle = 'Nuevo Gasto';
                        
                $tipo_facturas = $this->Gasto->TipoFactura->find('list');
                $tipo_impuestos = $this->Gasto->TipoImpuesto->find('all', array('recursive'=>-1));
                $impuestos = $this->Gasto->Impuesto->find('all');
                $clasificaciones = $this->Gasto->Clasificacion->generatetreelist();
		$proveedores = $this->Gasto->Proveedor->find('list', array(
                        'order' => array('Proveedor.name')
                    ));
		$this->set('tipo_impuestos', $tipo_impuestos);
		$this->set(compact('proveedores', 'tipo_facturas','clasificaciones'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Gasto', true));
			$this->redirect(array('action' => 'index'));
		}
                
                if (!empty($this->data)) {
                
			$this->Gasto->create();
			if ($this->Gasto->save($this->data)) {
                            $this->Session->setFlash(__('The Gasto has been saved', true));
                            
                            if (!empty($this->data['Gasto']['pagar'])){
                                $this->redirect(array('controller'=>'egresos','action' => 'add', $this->Gasto->id));
                            } else {
                                $this->redirect(array('action' => 'index'));
                            }
			} else {
                            $this->Session->setFlash(__('The Gasto could not be saved. Please, try again.', true));
			}
		}
		                
		if (empty($this->data)) {
			$this->data = $this->Gasto->read(null, $id);                        
		}
                
                $this->pageTitle = 'Editar Gasto #'.$id;
                        
                $tipo_facturas = $this->Gasto->TipoFactura->find('list');
                $tipo_impuestos = $this->Gasto->TipoImpuesto->find('all', array('recursive'=>-1));
                $impuestos = $this->Gasto->Impuesto->find('all');
                $clasificaciones = $this->Gasto->Clasificacion->generatetreelist();
		$proveedores = $this->Gasto->Proveedor->find('list', array(
                        'order' => array('Proveedor.name')
                    ));
		$this->set('tipo_impuestos', $tipo_impuestos);
		$this->set(compact('proveedores', 'tipo_facturas','clasificaciones'));
                
                
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