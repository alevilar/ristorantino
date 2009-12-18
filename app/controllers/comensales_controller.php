<?php
class ComensalesController extends AppController {

	var $name = 'Comensales';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Comensal->recursive = 0;
		$this->set('comensales', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comensal.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comensal', $this->Comensal->read(null, $id));
	}

	function add() {
		$mesa_id = 0;
		if(!empty($this->data['Mesa']['id'])){
			$mesa_id = $this->data['Mesa']['id'];
			unset($this->data);
		}
		$comensales = $this->Comensal->find('first',array('first'=>"Comensal.mesa_id =$mesa_id"));
		if(count($comensales)>0){
			$this->redirect('/comensales/edit/'.$comensales['Comensal']['id']);
		}
		
		if(!empty($this->passedArgs['mesa_id'])){
			$mesa_id = $this->passedArgs['mesa_id'];
		}
		
		if (!empty($this->data)) {
			$this->Comensal->create();
			if ($this->Comensal->save($this->data)) {
				$this->Session->setFlash(__('The Comensal has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comensal could not be saved. Please, try again.', true));
			}
		}
		if($mesa_id != 0){
			$this->Comensal->Mesa->recursive = -1;
			$this->Comensal->Mesa->id = $mesa_id;
			$mesa = $this->Comensal->Mesa->read();
			$this->data['Comensal']['mesa_id'] = $mesa_id;
			$this->set(compact('mesa'));
		}
		else{
			return "el ID de la mesa es incorrecto";
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comensal', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comensal->save($this->data)) {
				$this->Session->setFlash(__('The Comensal has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comensal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comensal->read(null, $id);
		}
		$mesa_id = $this->data['Comensal']['mesa_id'];
		$this->Comensal->Mesa->recursive = -1;
		$this->Comensal->Mesa->id = $mesa_id;
		$mesa = $this->Comensal->Mesa->read();		
		$this->set(compact('mesa'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comensal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comensal->del($id)) {
			$this->Session->setFlash(__('Comensal deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>