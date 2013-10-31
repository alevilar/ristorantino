<?php
class Gasto extends AccountAppModel {

	var $name = 'Gasto';
        var $order = array('Gasto.fecha' => 'DESC', 'Gasto.modified' => 'DESC');
        
        var $displayField = 'importe_total';

        var $actAs = array('Containable'
            );
        
        
        var $files = array(
            '_file' => 'file'
        );
        
        var $validate = array(
		'factura_nro' => array(
			'no_repetido' => array(
                                'on' => 'create',
				'rule' => 'factura_no_repetida',
				'required' => true,
				'message' => 'Este número de factura ya esta cargada para este mismo proveedor'
			)
		),
                'fecha' => array(
			'date' => array(
				'rule' => 'date',
                                'message' => 'Ingrese una fecha válida',
                                'allowEmpty' => false,
				'required' => true,
			)
		),
                'tipo_factura_id' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'required' => false,
				'message' => 'Debe especificar un tipo de factura'
			)
		),
                'importe_total' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'allowEmpty' => true,
				'message' => 'Debe especificar un importe total numerico'
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Account.Proveedor',
                'Account.Clasificacion',
		'TipoFactura',
	);
        
        var $hasMany = array(
		'Account.Impuesto'
            );
        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(                
            'Egreso' => array(
                        'className' => 'Account.Egreso',
			'joinTable' => 'account_egresos_gastos',
			'foreignKey' => 'gasto_id',
			'associationForeignKey' => 'egreso_id',
			'unique' => true, 
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
                    
                    ),
            'TipoImpuesto' => array(
			'className' => 'Account.TipoImpuesto',
			'joinTable' => 'account_impuestos',
			'foreignKey' => 'gasto_id',
			'associationForeignKey' => 'tipo_impuesto_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'TipoImpuesto.name ASC',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
	);
           
        
        public function beforeDelete($cascade = true)
        {            
            parent::beforeDelete($cascade);
            $gasto = $this->read();            
            foreach ( $gasto['Egreso'] as $g ) {
                if ( !$this->Egreso->delete($g['id']) ) {
                    return false;
                }
            }
            return true;
        }
       
        public function beforeSave($options = array())
        {
            parent::beforeSave($options);
            
            $this->_calcularImporteNeto();
            
            return true;
        }
       
        
        public function afterSave($created)
        {
            parent::afterSave($created);
            
            return $this->_refreshImpuestos($created);
        }
        
        
        /**
         * Calcula el neto sumando los impuestos y lo setea en el data
         */
        private function _calcularImporteNeto(){
            if (!empty($this->data['Gasto']['Impuesto']) && empty($this->data['Gasto']['importe_neto'])) {
                if (!empty($this->data['Gasto']['Impuesto'])) {
                    foreach ($this->data['Gasto']['Impuesto'] as $imp){
                        $this->data['Gasto']['importe_neto'] += $imp['neto'];
                    }
                }
            }
        }
        
        /**
         *  Ante un cambio en e gasto, resetea los valores anteriores
         * @param boolean $created
         * @return boolean
         */
        private function _refreshImpuestos($created){
            if (!empty($this->data['Gasto']['Impuesto'])) {
                if (!$created){
                        $this->Impuesto->deleteAll(array('Impuesto.gasto_id'=>$this->id ));
                }
                
                foreach ($this->data['Gasto']['Impuesto'] as $impId=>$imp){
                    if (!empty($imp)) {                       
                        if (!empty($imp['checked']) && (!empty($imp['importe']) || !empty($imp['neto'])) ) {
                            $importe = empty($imp['importe'])?0:$imp['importe'];
                            $neto = empty($imp['neto'])?0:$imp['neto'];
                            $nuevoImp = array(
                                'gasto_id' => $this->id,
                                'tipo_impuesto_id' => $impId,
                                'importe' => $importe,
                                'neto' => $neto,
                            );
                            $this->Impuesto->create($nuevoImp);
                            if (!$this->Impuesto->save()){
                                return false;
                            }
                        }
                    }
                }
            }
            return true;
        }
        
        
        /**
         * Devuelve todos los gastos que adeudan pagos
         * o sea, cuyo importe_total no llega a ser cubierto con los pagos realizados
         * @return array de Gastos
         */
        public  function enDeuda($conditions = array()){
            
             $dbo = $this->getDataSource();  
             
             
             $subQuery = $dbo->buildStatement(
                array(
                    'fields' => array('SUM(  `Aeg`.`importe` )'),
                    'table' => 'account_egresos_gastos',
                    'alias' => 'Aeg',
                    'limit' => null,
                    'offset' => null,
                    'joins' => array(),
                    'conditions' => array(
                        'Aeg.gasto_id = `Gasto`.`id`',
                        ),
                    'order' => null,
                    'group' => array('Aeg.gasto_id')
                ), $this
            );      
             
            $conditions[] = "IFNULL(($subQuery), 0) <> `Gasto`.`importe_total`";
            $fieldContain['recursive'] = -1;
            $fieldContain['fields'] = array('Gasto.id','Gasto.id');
            $fieldContain['conditions'] = $conditions;
            $ret = parent::find('list', $fieldContain);
            return $this->find('all', array('conditions'=>array('Gasto.id'=>$ret)));
        }

        

        /**
         * Indica la sumatoria de todos los pagos realizados para ese gasto
         * @param integer $id gasto_id
         * @return $ importe pagado
         */
        public function importePagado($id = null){
            $importePagado = 0;
            
            if (empty($id)) {
                $id = $this->id;
            }
            
            $fieldContain['contain'] = 'Egreso';  
            $fieldContain['conditions'] = array('Gasto.id'=>$id);
            $coso = parent::find('first', $fieldContain);            
            if (!empty($coso['Egreso'])) {
                foreach ($coso['Egreso'] as $eg){
                    if ($eg['AccountEgresosGasto']['gasto_id'] == $id ) {
                        $importePagado += $eg['AccountEgresosGasto']['importe'];
                    }
                }
            }
            
            return $importePagado;
        }
        
        public function find($conditions = null, $fields = array(), $order = null, $recursive = null)
        {
            $ret = parent::find($conditions, $fields, $order, $recursive);
                       
            if (is_array($ret) && ($conditions == 'all' || $conditions == 'first') ) {
                if ($conditions == 'first') {
                    $ret = array($ret);
                }
                
                foreach ($ret as &$g){
                    if (!empty($g['Gasto'])) {
                        $g['Gasto']['importe_pagado'] = $this->importePagado($g['Gasto']['id']);                    
                    }
                }

                if ($conditions == 'first') {
                    $ret = $ret[0];
                }
            }
            return $ret;
        }
        
        
        
        function factura_no_repetida(){
            if (!empty($this->data['Gasto']['factura_nro'])){
                $cant = $this->find('count', array(
                    'conditions' => array(
                        'Gasto.factura_nro' => $this->data['Gasto']['factura_nro']
                    ),
                ));
                return !($cant > 0);
            }
            return true;
        }
}
?>