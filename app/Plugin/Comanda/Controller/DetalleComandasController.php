<?php
App::uses('ComandaAppController', 'Comanda.Controller');

class DetalleComandasController extends ComandaAppController {

	public $name = 'DetalleComandas';	

    public $components = array(
        'Search.Prg',
        'Paginator', 
        );


    /**
     * Listado de los productos mas Vendidos csegun regla de Paretto
     *
     */
	public function index() {

        // por default ordenar por sumatoria de dinero vendido
        $conditions['order'] = array('ventas DESC',"cant DESC");
        if ( !empty( $this->request->params['named'] ) && $this->request->params['named']['cant_o_tot'] == 1 ) {
            // ordenado por cantidad de unidades vendidas            
            $conditions['order'] = array("cant DESC", 'ventas DESC');
        }

        $this->Prg->commonProcess();
        $conds = $this->DetalleComanda->parseCriteria( $this->Prg->parsedParams() );
        $conditions['conditions'] = $conds;
        $conditions['conditions']['Mesa.deleted'] = 0;


		$this->DetalleComanda->Producto->recursive = -1;        
        $conditions['group'] = array('Producto.id', 'Producto.name');        
        $conditions['joins'] = array(
            array(
                'table' => 'detalle_comandas',
                'alias' => 'DetalleComanda',
                'type' => 'left',
                'conditions' => 'Producto.id = DetalleComanda.producto_id',
            ),
            array(
                'table' => 'comandas',
                'alias' => 'Comanda',
                'type' => 'left',
                'conditions' => 'Comanda.id = DetalleComanda.comanda_id',
            ),
            array(
                'table' => 'mesas',
                'alias' => 'Mesa',
                'type' => 'left',
                'conditions' => 'Mesa.id = Comanda.mesa_id',
            ), 
        );
        $conditions['fields'] = array(
            'Producto.name', 
            'sum(DetalleComanda.cant-DetalleComanda.cant_eliminada)*Producto.precio as "ventas"',
            'Producto.precio', 
            'sum(DetalleComanda.cant-DetalleComanda.cant_eliminada) as "cant"',
            );
                                

        $comandas  = $this->DetalleComanda->Producto->find('all', $conditions);
        $cantTotal = 0;
        $ventasTotal = 0;
        foreach ($comandas as $c) {
            $cantTotal += $c[0]['cant'];
            $ventasTotal += $c[0]['ventas'];
        }

        
        if ( !empty( $this->request->params['named'] ) && $this->request->params['named']['cant_o_tot'] == 1 ) {
            $this->request->data['DetalleComanda']['cant_o_tot']  = 1;
        }

        $this->set('categorias', $this->DetalleComanda->Producto->Categoria->generateTreeList());
        $this->set('productos', $this->DetalleComanda->Producto->find('list', array('order' => 'name')));
		$this->set(compact('comandas', 'cantTotal', 'ventasTotal'));
	}
	

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comanda.'), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comanda', $this->DetalleComanda->read(null, $id));
	}

	
	// public function sacarProductos(){
	// 	$this->autoRender = false;
	// 	$ok = false;
	// 	//Configure::write('debug',1);
	// 	if($this->DetalleComanda->saveAll($this->request->data)){
	// 		$ok = true;
	// 	}
		
	// 	return ($ok)?'ok':'failed to save comanda';
	// }
	
	public function add ( $mesa_id = null ) {
        
        if ( !empty($this->request->data) ) {
    		if ( $this->DetalleComanda->saveComanda( $this->request->data ) ) {
                $this->Session->setFlash('Se guardó correctamente', 'flash_success');
            } else {
                $this->Session->setFlash('No se guardó correctamente', 'flash_error');
            }
            if ( $this->request->is('ajax') ) {
                 exit;
            }
            $this->redirect($this->request->data['Comanda']['redirect']);
        }
	
        $productos = $this->DetalleComanda->Producto->find('list');

        $mesas = $this->DetalleComanda->Comanda->Mesa->find('list', array(
            'fields' => array('id','numero'),
            'conditions' => array("Mesa.estado_id" => MESA_ABIERTA),
            ));
        $this->set(compact('productos', 'mesas', 'mesa_id'));
	}

	public function edit($id = null) {
            
            if($this->request->is('ajax')){
                $this->autoRender = false;
            }
                        
            if (!$id && empty($this->request->data)) {
                    $this->Session->setFlash(__('Invalid Comanda'), 'flash_error');
                    $this->redirect($this->referer());
            }
            if ( !empty($this->request->data)) {
                    if ($this->DetalleComanda->save($this->request->data)) {
                        if( !$this->request->is('ajax') ){
                            $this->Session->setFlash(__('Producto modificado'), 'flash_success');
                        } else {
                            exit;
                        }
                        $this->redirect($this->request->data['DetalleComanda']['redirect']);
                    } else {
                        if($this->request->is('ajax')){
                            throw new InternalErrorException("No se pudo guardar el DetalleComanda");                         
                        }
                        $this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', 'flash_success'));
                    }                    
            }
            
            if ( empty($this->request->data) ) {
                $this->request->data = $this->DetalleComanda->read(null, $id);
                $this->request->data['DetalleComanda']['redirect'] = $this->referer();
            }           

            $productos = $this->DetalleComanda->Producto->find('list');
            $mesas = $this->DetalleComanda->Comanda->Mesa->find('list');
            $this->set(compact('productos','mesas'));
	}

	public function delete( $id = null ) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Detalle Comanda'), 'flash_error');
			$this->redirect($this->referer());
		}
		if ($this->DetalleComanda->delete($id)) {
			$this->Session->setFlash(__('DetalleComanda deleted'), 'flash_success');
			$this->redirect($this->referer());
		}
	}

}
?>