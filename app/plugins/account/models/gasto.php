<?php
class Gasto extends AccountAppModel {

	var $name = 'Gasto';
        var $order = array('Gasto.created' => 'DESC');
        
        var $displayField = 'importe_total';

        var $actAs = array('Containable');
        
        var $validate = array(
//		'proveedor_id' => array(
//			'rule1' => array(
//				'rule' => 'numeric',
//				'required' => true,
//				'message' => 'Debe especificar un proveedor'
//			)
//		),
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
                'importe_neto' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'allowEmpty' => false,
                                'required' => true,
				'message' => 'Debe especificar un importe neto numerico'
			)
		),
                'importe_total' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'allowEmpty' => true,
				'message' => 'Debe especificar un importe total numerico'
			)
		),
                'otros' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'allowEmpty' => true,
				'message' => 'Los otros importes deben ser numericos'
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
		'Account.Impuesto',
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
           
        
        
        public function beforeSave($options = array())
        {
            parent::beforeSave($options);
            
            if (!empty($this->data['Gasto']['importe_neto'])) {
                // calcular total sumando los impuestos
                $sumaImpuestos = 0;
                if (!empty($this->data['Gasto']['Impuesto'])) {
                    foreach ($this->data['Gasto']['Impuesto'] as $imp){
                        $sumaImpuestos += $imp;
                    }
                }

                $this->data['Gasto']['importe_total'] = $sumaImpuestos + $this->data['Gasto']['importe_neto'];     
            }
            return true;
        }
       
        
        public function afterSave($created)
        {
            parent::afterSave($created);
            
            if (!empty($this->data['Gasto']['Impuesto'])) {
                if (!$created){
                        $this->Impuesto->deleteAll(array('Impuesto.gasto_id'=>$this->id ));
                }
                
                foreach ($this->data['Gasto']['Impuesto'] as $impId=>$imp){
                    if (!empty($imp)) {
                        $this->Impuesto->create();
                        $nuevoImp = array(
                            'gasto_id' => $this->id,
                            'tipo_impuesto_id' => $impId,
                            'importe' => $imp,
                        );
                        if (!$this->Impuesto->save($nuevoImp)){
                            return false;
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
        public  function enDeuda(){
            $fieldContain['recursive'] = -1;
            $fieldContain['fields'] = array('Gasto.id','Gasto.id');
            $fieldContain['conditions'] = array(
                'IFNULL((SELECT SUM(  `aeg`.`importe` ) 
                        FROM account_egresos_gastos AS aeg
                        WHERE gasto_id = `Gasto`.`id`
                        GROUP BY gasto_id) 
                        , 0) < `Gasto`.`importe_total`',
            );
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
                     $importePagado += $eg['AccountEgresosGasto']['importe'];
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
}
?>