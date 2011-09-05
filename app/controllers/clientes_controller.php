<?php
class ClientesController extends AppController {

	var $name = 'Clientes';
	var $helpers = array('Html', 'Form', 'Ajax');
        
        
        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Admin','link'=>'/pages/administracion' );
        }
        
	function index() {
           
            $this->params['PaginateConditions'] = array();
		
		if(!empty($this->data)){
			$condiciones = array();
			$pagCondiciones = array();
			foreach($this->data as $modelo=>$campos){
				foreach($campos as $key=>$val){
						if(!is_array($val))
							$condiciones[$modelo.".".$key." LIKE"] = '%'.$val.'%';
							$pagCondiciones[$modelo.".".$key] = $val;
				}
			}
			$this->Cliente->recursive = 0;
			$this->paginate['Cliente'] = array(
				'conditions' => $condiciones
			);
			
			$this->params['PaginateConditions'] = $pagCondiciones;
			$this->set('clientes', $this->paginate('Cliente'));
		}
		
		
		if(!empty($this->passedArgs) && empty($this->data)){ 
		 	$condiciones = array();
			$pagCondiciones = array();
			foreach($this->passedArgs as $campo=>$valor){
				if($campo == 'page' || $campo == 'sort' || $campo == 'direction'){ 
					continue;
				}
				$condiciones["$campo LIKE"] = '%'.$valor.'%';
				$pagCondiciones[$campo] = $valor;
				$this->data[$campo] = $valor;
				
			}
			$this->Cliente->recursive = 0;
			$this->paginate['Clientes'] = array(
				'conditions' => $condiciones
			);
                        
			$this->params['PaginateConditions'] = $pagCondiciones;
			$this->set('clientes', $this->paginate('Cliente'));
		 }   
 
                /* <- Esto es lo original -> */
                
		$this->Cliente->recursive = 0;
		$this->set('clientes', $this->paginate());
                
	}

	function view($id = null) {
            $this->rutaUrl_for_layout[] =array('name'=> 'Clientes','link'=>'/clientes' );
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cliente.', true));
			$this->redirect(array('action'=>'index'));
		}
                $this->Cliente->contain(array(
                    'Descuento',
                ));
		$this->set('cliente', $this->Cliente->read(null, $id));
	}

	function add() {
            $this->rutaUrl_for_layout[] =array('name'=> 'Clientes','link'=>'/clientes' );
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
            $this->rutaUrl_for_layout[] =array('name'=> 'Clientes','link'=>'/clientes' );
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
			$this->Session->setFlash(__('Cliente invalido', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cliente->del($id)) {
			$this->Session->setFlash(__('Cliente eliminado', true));
			$this->redirect(array('action'=>'index'));
		}
	}
        
        


        /**
	 * me busca clientes
	 *
	 */
	function ajax_buscador(){
		$this->Cliente->order = 'Cliente.nombre';
                
                if (!empty($this->data['Cliente']['busqueda']) || !empty($this->passedArgs)){
                    if (!empty($this->data['Cliente']['busqueda'])) {
                        $this->passedArgs['busqueda'] = strtolower($this->data['Cliente']['busqueda']);
                    }
                    $busqueda = $this->passedArgs['busqueda'];
                    
                    $this->paginate = array('conditions'=>array(
                        'OR' => array(
                            'lower(Cliente.nombre) LIKE' => "%$busqueda%",
                            'lower(Cliente.nrodocumento) LIKE' => "%$busqueda%",
                        )),
                        'limit'=> 4,
                        'contain' => array(
                                                'Descuento'
                                            ),
                    );
                    $this->set('clientes',$this->paginate());
                }
		
	}
        
        
         function jqm_clientes($tipo = 'todos'){
             $tipo = '';
             $clientes = array();
             switch ($tipo) {
                 case 'a':
                 case 'A':
                     $clientes = $this->Cliente->todosLosTipoA();
                     $tipo = 'a';
                     break;
                 case 'd':
                 case 'descuento':
                     $clientes = $this->Cliente->todosLosDeDescuentos();
                     $tipo = 'd';
                     break;
                 default:
                     $tipo = 't';
                         $clientes = $this->Cliente->todos();
                     break;
             }
             
             $this->set('tipo',$tipo);
            $this->set('clientes',$clientes);
        }
	
	
	/**
	 * me lista todos los clientes que sean del tipo Factura "A"
	 *
	 */
	function ajax_clientes_factura_a(){
		$this->set('clientes',$this->Cliente->todosLosTipoA());
	}
	
        /**
	 * me lista todos los clientes con descuento
	 *
	 */
	function ajax_clientes_con_descuento(){
		$this->set('clientes',$this->Cliente->todosLosDeDescuentos());
	}

}
?>
