<?php
class DetalleComandasController extends AppController {

	var $name = 'DetalleComandas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->DetalleComanda->recursive = 0;
		$this->set('comandas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comanda.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comanda', $this->DetalleComanda->read(null, $id));
	}

	
	function add(){
		$this->autoRender = false;
		//Configure::write('debug',0);
		/*
		if($this->DetalleComanda->Comanda->save($this->data)){
			echo "se guardo la comanda correctamente";
		}
		else echo "se grabo mal la comanda";
		*/
		$comanda = $this->data['DetalleComanda'];
		if($this->DetalleComanda->Comanda->save($comanda)){
			echo "se guardo la comandao corectamente bien";
		}
		
		$cont = 0;
		foreach ($this->data['DetalleComanda'] as $dv):
			$detacomanda[$cont] = $dv;
			$detacomanda[$cont]['comanda_id'] = $this->DetalleComanda->Comanda->id;
			$cont++;
		endforeach;
		
		if($this->DetalleComanda->saveAll($detacomanda)){
			echo "se guardo el detalle comandao corectamente bien";
		}
		else echo "se grabo mal el detallecomanda";
		/*
		if (isset($this->data)):
			$guardar = $this->data['DetalleComanda'];
			for ($i=0 ; $i < sizeof($guardar) ; $i++):
				$this->data['DetalleComanda'] = $guardar[$i]; 
				$this->data['DetalleComanda']['comanda_id'] = $this->DetalleComanda->Comanda->id;
				$this->data['Comanda']['id'] = $this->DetalleComanda->Comanda->id;
				debug($this->data);
				if ($this->DetalleComanda->guardar($this->data)) {					
					$j;
				} else {
					$this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', true));
				}
			endfor;
		endif;
		*/
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comanda', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->DetalleComanda->save($this->data)) {
				$this->Session->setFlash(__('The Comanda has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DetalleComanda->read(null, $id);
		}
		$productos = $this->DetalleComanda->Producto->find('list');
		$mesas = $this->DetalleComanda->Mesa->find('list');
		$this->set(compact('productos','mesas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comanda', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DetalleComanda->del($id)) {
			$this->Session->setFlash(__('Comanda deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>