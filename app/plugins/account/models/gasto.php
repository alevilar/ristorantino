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
//                'fecha' => array(
//			'rule1' => array(
//				'rule' => VALID_NOT_EMPTY,
//				'required' => true,
//				'message' => 'Debe especificar una fecha'
//			)
//		),
                'tipo_factura_id' => array(
			'rule1' => array(
				'rule' => 'numeric',
				'required' => true,
				'message' => 'Debe especificar un tipo de factura'
			)
		),
                'importe_neto' => array(
			'rule1' => array(
				'rule' => 'numeric',
				'allowEmpty' => true,
				'message' => 'Debe especificar un importe neto numerico'
			)
		),
                'importe_total' => array(
			'rule1' => array(
				'rule' => 'numeric',
				'allowEmpty' => true,
				'message' => 'Debe especificar un importe total numerico'
			)
		),
                'otros' => array(
			'rule1' => array(
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
    //                debug($this->data);die;
                // guardar los impuestos
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

        
        
        public function find($conditions = null, $fields = array(), $order = null, $recursive = null)
        {
            if ($conditions == 'clasificacion') {
                
            }
            
            return parent::find($conditions, $fields, $order, $recursive);
        }
}
?>