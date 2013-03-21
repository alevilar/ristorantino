<?php
class EgresosController extends AccountAppController {

	var $name = 'Egresos';
	var $helpers = array('Html', 'Form','Number', 'Jqm');

        function index() {
		$this->Egreso->recursive = 1;                
		$this->set('egresos', $this->paginate());
	}
        
        
        function history() {
		$this->Egreso->recursive = 1;    
                $conditions = array();

                $conditions = array();
                $url = $this->params['url'];
                unset($url['ext']);
                unset($url['url']);
                
                
                if (!empty($url['mes'])){
                    $conditions['MONTH(Egreso.fecha)'] =  $url['mes'];
                    $this->data['Egreso']['mes'] = $url['mes'];
                } 
                
                if (!empty($url['anio'])){
                    $conditions['YEAR(Egreso.fecha)'] =  $url['anio'];
                    $this->data['Egreso']['anio'] = $url['anio'];
                } 
                
                
                if (empty($url)) {
                    $this->data['Egreso']['mes'] = date('m', strtotime('now'));
                    $this->data['Egreso']['anio'] = date('Y', strtotime('now'));;
                    $conditions['MONTH(Egreso.fecha)'] =  $this->data['Egreso']['mes'];
                    $conditions['YEAR(Egreso.fecha)'] =  $this->data['Egreso']['anio'];
                }
                
                
		$this->set('egresos', $this->Egreso->find('all', array('conditions'=> $conditions)));
	}

        
        
        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Contabilidad','link'=>'/account' );
        }
        
        function add($gasto_id = null){
            $gastos = array();
            if (!empty($gasto_id)){
                $gastos[] = $gasto_id;
            }
            
            $suma_gastos = 0;
            $gastosAll = array();
            
            
            if (!empty($this->data['Gasto'])){
                // re armo el array de gastos limpiando los que no van
                foreach ($this->data['Gasto'] as $g){
                    if ($g['gasto_seleccionado']) {
                        $gastos[] = $g['gasto_seleccionado'];
                    }
                }
            }
            
            if (!empty($gastos)){
                // calculo la suma total del los gastos $$
                $gastosAll = $this->Egreso->Gasto->find('all', array(
                    'conditions' => array(
                        'Gasto.id' => $gastos,
                    ),
                    'recursive' => 1,
                ));
                foreach ($gastosAll as $g){
                    $suma_gastos += $g['Gasto']['importe_total']-$g['Gasto']['importe_pagado'];
                }
                                
                $this->set('gastos', $this->Egreso->Gasto->find('list', array(
                    'conditions' => array(
                        'Gasto.id' => $gastos,
                    )
                )));
            } else {
                $this->flash('Error, se debe seleccionar algun gasto', array('index'));
            }
            
            if (count($gastos) > 1 ) {
                $this->pageTitle = 'Pagando '.count($gastos).' Gastos';
            } else {
                $this->pageTitle = 'Pagando '.count($gastos).' Gasto';
            }
            $this->set('tipo_de_pagos', $this->Egreso->TipoDePago->find('list'));
            $this->data['Gasto'] = $gastos;
            $this->set('suma_gastos', $suma_gastos);
            $this->set('gastosAll', $gastosAll);
        }
        
        function save(){
            if (!empty($this->data)){
                $this->Egreso->create();
                if ($this->Egreso->save($this->data)){
                    $this->flash('El Egreso fue guardado correctamente', array('controller'=>'gastos', 'action'=>'index'));
                    $this->redirect(array('controller'=>'gastos', 'action'=>'index'));
                } else {
                    $this->flash('Error al guardar el egreso', array('controller'=>'gastos', 'action'=>'index'));
                }
            }
        }
        
        function view($id){
            if (empty($id)){
                $this->flash('No se pasó un ID de egreso correcto', array('controller'=>'gastos', 'action'=>'index'));                
            }
            $this->Egreso->id = $id;
            $this->set('egreso', $this->Egreso->read() );
        }
}
?>