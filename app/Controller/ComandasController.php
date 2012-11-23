<?php
class ComandasController extends AppController {

	var $name = 'Comandas';
	var $components = array( 'Printer');

        function beforeFilter() {
            parent::beforeFilter();
        }
    
        
        function add(){
		$ok = false;
                debug($this->request->data);die;
		$imprimir = $this->request->data['Comanda']['imprimir'] ? true : false;
		unset($this->request->data['Comanda']['imprimir']);		
		
		$comanda = $this->request->data['Comanda'];
		unset($this->request->data['Comanda']);		
		
		//cuento la cantidad de comanderas involucradas en este pedido para genrar la cantidad de comandas correspondientes
		$v_comanderas = array();
		foreach($this->request->data['DetalleComanda'] as &$find_data):
                        $find_data['cant'] = $find_data['cant'] - $find_data['cant_eliminada'];
                        $find_data['cant_eliminada'] = 0;
			$v_comanderas[$find_data['comandera_id']] = $find_data['comandera_id'];
		endforeach;
		
                    
                if ($this->Comanda->saveAssociated($dataToSave)){
                    
                }
                

		$this->set('imprimir', $imprimir);
		$this->set('okval', $ok);
                $this->Comanda->contain(array('DetalleComanda' => array('DetalleSabor.Sabor')));
		$this->set('comanda', $this->Comanda->read());
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