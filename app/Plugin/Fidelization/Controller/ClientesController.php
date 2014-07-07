<?php
App::uses('FidelizationAppController', 'Fidelization.Controller');
/**
 * Clientes Controller
 *
 * @property Cliente $Cliente
 * @property PaginatorComponent $Paginator
 */
class ClientesController extends FidelizationAppController {

    public $presetVars = true; // using the model configuration
         
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Search.Prg');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Prg->commonProcess();
        $conds = $this->Cliente->parseCriteria( $this->Prg->parsedParams() );

		$this->Cliente->recursive = 0;
                
        $descuentoMaximo = Configure::read('Mozo.descuento_maximo');
        $currentRole = $this->Session->read('Auth.User.role');
             
        
        if ( strtolower($currentRole) == 'mozo' && is_numeric( $descuentoMaximo ) ) {                
            $conds['OR'] = array(
                    "Descuento.porcentaje <= $descuentoMaximo",
                    'Descuento.porcentaje IS NULL'
                );
        }
        $this->Paginator->settings['conditions'] = $conds;
        
        $descuentos = $this->Cliente->Descuento->find('list');
		$tipoDocumentos = $this->Cliente->TipoDocumento->find('list');
		$ivaResponsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));
		$this->set('clientes', $this->Paginator->paginate());
	}



	public function jqm_clientes($tipo = 'todos'){
		// die("asas asmasm");
		 	$this->Cliente->contain(array(
		 		'Descuento',
		 		'TipoDocumento',
		 		'IvaResponsabilidad' => array('TipoFactura'),
		 		'Mesa'
		 		));

             $this->conHeader = false;
             $this->pageTitle = 'Listado de Clientes';
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
            // $this->layout = 'jqm' ;
            $this->set('title_for_layout',"Clientes");
            $this->set('tipo',$tipo);
            $this->set('clientes',$clientes);
        }


	// addFacturaA
    function simple_add() {
        $this->pageTitle = 'Agregar Factura A';
		if (!empty($this->request->data)) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('Se agregó un nuevo cliente'));
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser gardado, intente nuevamente.'), 'flash_error');
			}
            $this->set('cliente_id', $this->Cliente->id);
            $this->layout = false;
            $this->render('jqm_result');
		}
		
		$tipo_documentos = $this->Cliente->TipoDocumento->find('list');
		$iva_responsabilidades = $this->Cliente->IvaResponsabilidad->find('list');

		$descuentos = $this->Cliente->Descuento->find('list');
		$tipoDocumentos = $this->Cliente->TipoDocumento->find('list');
		$ivaResponsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));

		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));
	}



/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('The cliente has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cliente could not be saved. Please, try again.'));
			}
		}
		$descuentos = $this->Cliente->Descuento->find('list');
		$tipoDocumentos = $this->Cliente->TipoDocumento->find('list');
		$ivaResponsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));
		$this->render('form');
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cliente->exists($id)) {
			throw new NotFoundException(__('Invalid cliente'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('The cliente has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cliente could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
			$this->request->data = $this->Cliente->find('first', $options);
		}
		$descuentos = $this->Cliente->Descuento->find('list');
		$tipoDocumentos = $this->Cliente->TipoDocumento->find('list');
		$ivaResponsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));
		$this->render('form');
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cliente->id = $id;
		if (!$this->Cliente->exists()) {
			throw new NotFoundException(__('Invalid cliente'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Cliente->delete()) {
			$this->Session->setFlash(__('The cliente has been deleted.'));
		} else {
			$this->Session->setFlash(__('The cliente could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
