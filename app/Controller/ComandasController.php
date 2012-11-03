<?php
class ComandasController extends AppController {

	var $name = 'Comandas';
	var $components = array( 'Printer');

        function beforeFilter() {
            parent::beforeFilter();
        }
    
	function add($mesa_id = null){

            //Configure::write('debug',0);
            if (isset($this->request->data)):
                $this->Comanda->create();
                if ($this->Comanda->save($this->request->data)) {
                    $j = 1;
                    $this->autoRender = false;
                    $this->Session->setFlash( __("Comanda Enviada") );
                } else {
                    $this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', true));
                }
            endif;
            $this->set('mesa_id', $mesa_id);
            
             
//            $categorias = $this->Comanda->DetalleComanda->Producto->Categoria->array_listado();
//            $categoria_tree = $this->Comanda->DetalleComanda->Producto->Categoria->generatetreelist(null, null, null, '&nbsp;&nbsp;&nbsp;');
            
            $this->set(compact('categorias', 'categorias_tree' ) );
	}
	
	
	function index() {
		$this->set('comandas',$comandas = $this->Comanda->dame_las_comandas_abiertas());
	}
	
	/**
	 * REimprime comandas
	 * @param integer $id ID de la comanda
	 * @return envia a imprimir
	 */
	function imprimir($id){
		$this->Printer->imprimirComanda($id);
                if ( !$this->request->is('ajax') ) {
                    $this->redirect('/comandas/index');
                } else {
                    return 1;
                }
	}
}
?>