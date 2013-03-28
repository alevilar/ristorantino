<?php
class Clasificacion extends AccountAppModel {

	var $name = 'Clasificacion';
	var $validate = array(
		'name' => array('notempty')
	);
        var $actsAs = array('Tree');
        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array('Gasto');

        
        /**
         * 
         * @param integer $padre ID de la Clasificacion padre
         * @param array $vec Array recursivo para ir completando con los hijos
         * @return array armado con los subindices 
         *                  ['Clasificacion'] array del Model Clasificacion
         *                  ['Children'] find('all') con todos las Clasificaciones Hijos
         *                  ['Todos'] find(''list) con los Id´s de todos los Hijos
         */
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
                    $vec['Children'][$cId] = $this->__armar_hijos($c['Clasificacion']['id'], $vec['Children'][$cId]);
                }
            }
            return $vec;
        }
        
        
        function __subQueryDeEgresosGastos($conditions){
             $dbo = $this->getDataSource();  
             $gastosList = $this->Gasto->find('list', array(
                 'conditions'=>$conditions, 
                 'fields'=> array('id','id')
                 ));
             
             $subQuery = $dbo->buildStatement(
                array(
                    'fields' => array('sum(`Aeg`.`importe`)'),
                    'table' => 'account_egresos_gastos',
                    'alias' => 'Aeg',
                    'limit' => null,
                    'offset' => null,
                    'joins' => array(),
                    'conditions' => array('Aeg.gasto_id' => $gastosList),
                    'order' => null,
                    'group' => null
                ), $this
            );      
            return $subQuery;
        }
        
        function __gastos_sin_clasificar($baseConditions = array()){
            $baseConditions[] = 'Gasto.clasificacion_id IS NULL ';
                 
                $gasto = $this->Gasto->find('all',array(
                   'fields' => array(
                       'count(1) as cantidad',
                       'sum(Gasto.importe_total) as total',
                       "(".$this->__subQueryDeEgresosGastos($baseConditions).") as importe_pagado",
                       ),
                   'conditions' => $baseConditions,
                   'recursive' => -1,
                   'group by' => 'Gasto.clasificacion_id'
                ));
                $vec['Gasto'] = $gasto[0][0];
                $vec['Clasificacion'] = array(
                  'name'  => 'sin clasificar',
                  'id'    => null,
                  'parent_id'  => null,
                );
                return $vec;
                
        }
        
        
        function __gastos_recursivos($baseConditions = array(), $arbolClasificaciones = array()){  
            if( empty($arbolClasificaciones) ){
                $arbolClasificaciones = $this->__armar_hijos();
                $vinoSinArbol = true;
            } else {
                $vinoSinArbol = false;
            }
            if ( !empty( $arbolClasificaciones['Children'] ) ) {
                foreach ($arbolClasificaciones['Children'] as $aKey=>&$c){
                    $conditions = $baseConditions;
                    // escalo recursivamente hacia los hijos
                     if ( !empty($c['Children']) ){
                        $arbolClasificaciones['Children'][$aKey] = $this->__gastos_recursivos($baseConditions, $c);
                     }
                     
                     // le busco los gastos
                     $conds = array();
                     if ( !empty($c['Todos']) ){
                         $conds = array_keys($c['Todos']);                     
                     }
                    $conds[] = $c['Clasificacion']['id'];
                    $conditions[] = 'Gasto.clasificacion_id IN ('. implode(",", $conds) .') ';
    //                $baseConditions = array_merge($conditions, $baseConditions);
                    $gasto = $this->Gasto->find('all',array(
                       'fields' => array(
                           'count(*) as cantidad',
                           'sum(Gasto.importe_total) as total',
                           "(".$this->__subQueryDeEgresosGastos($conditions).") as importe_pagado",
                           ),
                       'conditions' => $conditions,
                       'recursive' => -1,
                    ));
                    $arbolClasificaciones['Children'][$aKey]['Gasto'] = $gasto[0][0];
//                    debug($arbolClasificaciones['Children'][$aKey]);
                }
            }
            
            if ( $vinoSinArbol ){
                 $arbolClasificaciones['Children'][] = $this->__gastos_sin_clasificar();
            }
            
            return $arbolClasificaciones;
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
            $clasificaciones = $this->__gastos_recursivos($cond);
//            die;
            return $clasificaciones;
        }
}
?>
