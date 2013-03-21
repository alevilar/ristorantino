<?php
class Clasificacion extends AccountAppModel {

	var $name = 'Clasificacion';
	var $validate = array(
		'name' => array('notempty')
	);
        var $actsAs = array('Tree');
        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array('Gasto');

        
        function __armar_hijos($padre = null, $vec = array()){            
            $vec['Children'] = $this->children($padre, true);
            
            if (empty($vec['Children'])) {
                unset($vec['Children']);
                
            } else {
                 $todos = $this->children($padre);
                foreach ($todos as $t){
                    $vec['Todos'][$t['Clasificacion']['id']] = $t['Clasificacion']['name'];
                }

                foreach ($vec['Children'] as $cId=>$c){
                    $this->__armar_hijos($c['Clasificacion']['id'], &$vec['Children'][$cId]);
                }
            }
            return $vec;
        }
        
        
        function __gastos_sin_clasificar($baseConditions){
                
                $baseConditions[] = 'Gasto.clasificacion_id IS NULL ';
                 
                $gasto = $this->Gasto->find('all',array(
                   'fields' => array(
                       'count(1) as cantidad',
                       'sum(Gasto.importe_total) as total', 
                       'sum(Gasto.importe_pagado) as pagado'
                       ),
                   'conditions' => $baseConditions,
                   'recursive' => -1,
                ));
                $vec['Gasto'] = $gasto[0][0];
                $vec['Clasificacion'] = array(
                  'name'  => 'sin clasificar',
                  'id'    => null,
                  'parent_id'  => null,
                );
                return $vec;
                
        }
        
        
        function __gastos_recursivos($clasificaciones = array(), $baseConditions = array()){   
            
            foreach ($clasificaciones as &$c){
                $conds = array();
                $conditions = $baseConditions;
                
                
                 if (!empty($c['Children'])){
                    $this->__gastos_recursivos(&$c['Children']);
                 }
                 
                 if (!empty($c['Todos'])){
                     $conds = array_keys($c['Todos']);                     
                 }
                 
                 $conds[] = $c['Clasificacion']['id'];
                $conditions[] = 'Gasto.clasificacion_id IN ('. implode(",", $conds) .') ';
                 
                $gasto = $this->Gasto->find('all',array(
                   'fields' => array(
                       'count(1) as cantidad',
                       'sum(Gasto.importe_total) as total', 
                       'sum(Gasto.importe_pagado) as pagado'
                       ),
                   'conditions' => $conditions,
                   'recursive' => -1,
                ));
                $c['Gasto'] = $gasto[0][0];
                
            }
            
        }
 
        
        
        /**
         * 
         * devuelve los gastos separados por Clasificacion
         * el array tendria la forma:
         *          array(
         *               'Clasificacion' => 'Model Clasifciacion',
         *              'Children' => array() // de la misma forma de este
         *              'Todos' => 'find list de todas las clasificaciones hija a esta clasificacion'
         * 
         */
        function gastos($cond = array()) {
            
            $this->recursive = -1;
            $clasificaciones = $this->__armar_hijos();            
            $this->__gastos_recursivos(&$clasificaciones['Children'], $cond);  
            
            $clasificaciones['Children'][] = $this->__gastos_sin_clasificar($cond);  
            
            return $clasificaciones;
        }
}
?>