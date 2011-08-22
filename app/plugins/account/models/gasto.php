<?php
class Gasto extends AccountAppModel {

	var $name = 'Gasto';
        var $order = array('Gasto.created' => 'DESC');
        
        var $validate = array(
		'proveedor_id' => array(
			'rule1' => array(
				'rule' => 'numeric',
				'required' => true,
				'message' => 'Debe especificar un proveedor'
			)
		),
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
		'Proveedor' => array(
			'className' => 'Account.Proveedor',
			'foreignKey' => 'proveedor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TipoFactura' => array(
			'className' => 'Account.TipoFactura',
			'foreignKey' => 'tipo_factura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
		'TipoImpuesto' => array(
			'className' => 'Account.TipoImpuesto',
			'joinTable' => 'gastos_tipo_impuestos',
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
		)
	);
        
        
        function getTotalConImpuestos($gasto) {
            $total = 0;
            if (!empty($gasto['Gasto']['importe_neto'])) {
                $total = $gasto['Gasto']['importe_neto'];
            }

            if (!empty($gasto['TipoImpuesto'])) {
                foreach($gasto['TipoImpuesto'] as $tipoImpuesto) {
                    $total += $gasto['Gasto']['importe_neto'] * $tipoImpuesto['porcentaje'] / 100;
                }
            }
            
            if (!empty($gasto['Gasto']['otros'])) {
                $total += $gasto['Gasto']['otros'];
            }
            
            return $total;
        }
        
        /**
  	 * Callback que se ejecuta luego de cada find()
         * Anade el total bruto, o sea, con el recargo de los impuestos
  	 *
  	 * @param array $results
  	 * @return array $results
  	 */
        function afterFind($results) {
            if (empty($results)) {
                return null;
            }
            
            foreach ($results as &$result) {
                if (!empty($result['Gasto'])) {
                    $result_aux = &$result;

                    if (!empty($result['TipoImpuesto'])) {
                        $result['Gasto']['importe_total'] = $this->getTotalConImpuestos($result);
                    }
                    else {
                        $result['Gasto']['importe_total'] = $result['Gasto']['importe_neto'];
                    }

                    unset($result_aux);
                }
            }

            return $results;
        }

}
?>