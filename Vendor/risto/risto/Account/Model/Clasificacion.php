<?php

App::uses('AccountAppModel', 'Account.Model');


class Clasificacion extends AccountAppModel {

	public $name = 'Clasificacion';
	
    public $validate = array(
		'name' => array('notempty')
	);
    
    public $actsAs = array('Tree');
        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array('Account.Gasto');

        
        /**
         * 
         * @param integer $padreId ID de la Clasificacion padre
         * @param array $vec Array recursivo para ir completando con los hijos
         * @return array armado con los subindices 
         *                  ['Clasificacion'] array del Model Clasificacion
         *                  ['Children'] find('all') con todos las Clasificaciones Hijos
         *                  ['Todos'] find(''list) con los Id´s de todos los Hijos
         */
        function __armar_hijos($padreId = null, $vec = array()){
            $this->id = $padreId;
            $this->recursive = -1;
            $vecAux = $this->read();
            $vec['Clasificacion'] = $vecAux['Clasificacion'];
            $vec['Children'] = $this->children($padreId, true);
            $vec['Todos'][$vec['Clasificacion']['id']] = $vec['Clasificacion']['name'];

            if (empty($vec['Children'])) {
                unset($vec['Children']);
            } else {
                $todos = $this->children($padreId);
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
                 
                $gasto = $this->Gasto->find('first',array(
                   'fields' => array(
                       'count(1) as cantidad',
                       'sum(Gasto.importe_total) as total',
                       "(".$this->__subQueryDeEgresosGastos($baseConditions).") as importe_pagado",
                       ),
                   'conditions' => $baseConditions,
                   'recursive' => -1,
                   'group by' => 'Gasto.clasificacion_id'
                ));
                $vec['Gasto'] = $gasto[0];
                $vec['Clasificacion'] = array(
                  'name'  => 'sin clasificar',
                  'id'    => null,
                  'parent_id'  => null,
                );
                return $vec;
                
        }
        
        
        function __gastos_recursivos($padreId = null, $baseConditions = array()){  
            $arbolClasificaciones = $this->children($padreId, true);
            $vec = array();
            if ( !empty( $arbolClasificaciones ) ) {
                foreach ($arbolClasificaciones as $c){
                    // escalo recursivamente hacia los hijos
                    
                    $hijos = $this->__gastos_recursivos($c['Clasificacion']['id'], $baseConditions);
                    
                    $vec[$c['Clasificacion']['id']] = $this->gastosDeClasificacion($c['Clasificacion']['id'], $baseConditions);
                    
                    if (!empty($hijos )) {
                        $vec[$c['Clasificacion']['id']]['Children'] = $hijos;
                    }
                }
            }
            
            if ( empty($padreId) ){
                 $vec[0] = $this->__gastos_sin_clasificar($baseConditions);
            }
            
            return $vec;
        }
 
        
        function gastosDeClasificacion($id = null, $gastosConditions = array()){
            $vClas = $this->__armar_hijos($id);
            if (empty($vClas['Todos'])) return array();
            $gastosConditions['Gasto.clasificacion_id'] = array_keys( $vClas['Todos'] ); 
            $gasto = $this->Gasto->find('first',array(
                       'fields' => array(
                           'count(*) as cantidad',
                           'sum(Gasto.importe_neto) as neto',
                           'sum(Gasto.importe_total) as total',
                           "(".$this->__subQueryDeEgresosGastos($gastosConditions).") as importe_pagado",
                           ),
                       'conditions' => $gastosConditions,
                       'recursive' => -1,
                    ));
            $vClas['Gasto'] = $gasto[0];            
            return $vClas;
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
            $clasificaciones = $this->__gastos_recursivos(null, $cond);      
            return $clasificaciones;
        }
}
?>
