<?php
class Egreso extends AccountAppModel {

	var $name = 'Egreso';
        var $order = array('Egreso.created' => 'DESC');
        
        var $validate = array(
                'total' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'required' => true,
				'message' => 'Debe ingresar un numero'
			),
                        'gastos_pagos' => array(
                            'rule' => 'gastos_pagos',
                            'message' => 'Sus gastos ya estan pagos. No puede volver a pagarlos.',
                        ),
		),
                'fecha' => array(
			'notEmpty' => array(
				'rule' => VALID_NOT_EMPTY,
				'required' => true,
				'message' => 'Debe ingresar una fecha de egreso'
			),
                    ),
	);
        
	var $belongsTo = array('TipoDePago');

        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
            'Gasto' => array(
                        'className' => 'Account.Gasto',
			'joinTable' => 'account_egresos_gastos',
			'foreignKey' => 'egreso_id',
			'associationForeignKey' => 'gasto_id',
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
            
	);
        
        
        function add($gasto_id){
            $gastos = array();
            if (!empty($gasto_id)) {
                $gastos[$gasto_id] = $gasto_id;
            }
            if(!empty($this->data['Gasto']['seleccionados'])){
                
            }
        }
        
        function beforeSave($options = array())
        {
            parent::beforeSave($options);
            
            // Cuando se realiza un egreso se van procesando cada
            // salida para verificar quel dicho egreso cubra el gasto
            // a medida que va cubriendo, el gasto es marcado como "pagado"
            $gastos = $this->Gasto->find('all', array(
                'recursive' => -1,
                'conditions' => array(
                    'Gasto.id' => $this->data['Gasto']['Gasto'],
                )
            ));
            $total = $this->data['Egreso']['total'];
            foreach ($gastos as $g) {
               $deuda = $g['Gasto']['importe_total']-$g['Gasto']['importe_pagado'];
               $total -= $deuda;
               
               if ($total >= 0) {
                   $importe_pagado =  $g['Gasto']['importe_total'];
               } else {
                   $restaPagar = $deuda+$total;
                   $importe_pagado =  $restaPagar+$g['Gasto']['importe_pagado'];
               }
               $this->Gasto->id = $g['Gasto']['id'];
               $this->Gasto->saveField('importe_pagado', $importe_pagado);
               return true;
            }
            
            return true;
            
        }
        
        
        /**
         * Verifica que el egreso no se realizara sobre un gasto que ya esta marcado como pagado
         * @return boolean
         */
        function gastos_pagos(){
            $cant = $this->Gasto->find('count', array(
                'conditions' => array(
                    'Gasto.id' => $this->data['Gasto']['Gasto'],
                    'Gasto.importe_pagado >= Gasto.importe_total',
                )
            ));
            return ($cant == 0);
        }
}
?>