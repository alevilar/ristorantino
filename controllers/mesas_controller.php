<?php
class MesasController extends AppController {

	var $name = 'Mesas';
	var $helpers = array('Html', 'Form');
	var $components = array( 'Printer');
	
	
	function prueba(){
		$this->Printer->imprimirComanda(16);
	}

	function index() {
		$this->Mesa->recursive = 0;
		$this->set('mesas', $this->paginate());
	}

	function view($id = null) {
		$this->layout='ajax';
		
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid Mesa.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->Mesa->id = $id;
		$items = $this->Mesa->listado_de_productos();
		
		
		$mesa = $this->Mesa->read(null, $id);	
		$this->set(compact('mesa', 'items'));	
		
		$cont = 0;
		//debug($items);
		//convierto detaleComanda a Producto por el Json, porque en javascript tengpo una coleccion de productos para esta mesa, y no DetalleComandas como lo llamo en php
		foreach ($items as $d):
			$mesa['Producto'][$cont]['cantidad'] = $d[0]['cant'];
			$mesa['Producto'][$cont]['name'] = $d['Producto']['name'];
			$mesa['Producto'][$cont]['id'] 	 = $d['Producto']['id'];
			$cont++;
		endforeach;
		
		//debug($mesa);
		
		$this->set('mesa_json', json_encode($mesa));
		$this->set('mozo_json', json_encode($this->Mesa->Mozo->read(null, $mesa['Mozo']['id'])));
	}

	function abrirMesa() {
		if (!empty($this->data)) {
			if(!$this->Mesa->numero_de_mesa_existente($this->data['Mesa']['numero'])){
				$this->Mesa->create();
				if ($this->Mesa->save($this->data)) {
					$this->Session->setFlash(__('Se abrió la mesa n° '.$this->data['Mesa']['numero'], true));
					//debug($this->data);
				//	$this->Mesa->Mozo->id = $this->data['Mesa']['mozo_id'];
				//	$this->data = $this->Mesa->Mozo->read();
					
					$this->redirect(array(	'controller'=>'Adicion', 
											'action' => 'adicionar/mozo_id:'.$this->data['Mesa']['mozo_id']));
				} else {
					$this->Session->setFlash(__('La mesa no pudo ser abierta. ¿Ingresó un número correcto?.', true));
					
					$this->redirect(array(	'controller'=>'Adicion', 
											'action' => 'adicionar/mozo_id:'.$this->data['Mesa']['mozo_id']));
				}
			}
			else{
				$this->Session->setFlash(__('Ese número de mesa ya existe. No puede crear 2 mesas con el mismo número', true));
					
				$this->redirect(array(	'controller'=>'Adicion', 
											'action' => 'adicionar/mozo_id:'.$this->data['Mesa']['mozo_id']));
			}
		}
		
	}
	

	
	function cerrarMesa($mesa_id){
		$this->Mesa->id = $mesa_id;
		
		$this->Mesa->cerrar_mesa();
		
		$mozo_id = $this->passedArgs['mozo_id'];
		
		$this->Session->setFlash(__('Se mandó a cerrar la mesa', true));
		$this->redirect("/adicion/adicionar/mozo_id:$mozo_id");
	}
	

	function add() {
		if (!empty($this->data)) {
			$this->Mesa->create();
			if ($this->Mesa->save($this->data)) {
				$this->Session->setFlash(__('The Mesa has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Mesa could not be saved. Please, try again.', true));
			}
		}
		$mozos = $this->Mesa->Mozo->find('list');
		$descuentos = $this->Mesa->Descuento->find('list');
		$this->set(compact('mozos', 'descuentos'));
	}
	
	
	
	function ajax_edit(){
		$this->autoRender = false;
		
		if (!empty($this->data)) {
			if(isset($this->data['Mesa']['id'])){
				if(($this->data['Mesa']['id'] != '') || ($this->data['Mesa']['id'] != null) || ($this->data['Mesa']['id'] != 0)){
					$this->Mesa->recursive = -1;
					$this->Mesa->id = $this->data['Mesa']['id'];
					$mesa = $this->Mesa->read();

					while(list($k,$v) = each($this->data['Mesa'])){
						if($k!='modified'){ // para que no me sobreescriba el campo modified
							$mesa['Mesa'][$k] = $v;
						}
					}
					if ($this->Mesa->save($mesa)) {
						return 1;
					} else {
						return 0;
					}
				}
			}
		}
	}
	

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Mesa', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Mesa->save($this->data)) {
				$this->Session->setFlash(__('The Mesa has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Mesa could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mesa->read(null, $id);
		}
		$mozos = $this->Mesa->Mozo->find('list');
		$descuentos = $this->Mesa->Descuento->find('list');
		$this->set(compact('mozos','descuentos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Mesa', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Mesa->del($id)) {
			$this->Session->setFlash(__('Mesa deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>