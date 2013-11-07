<?php
class Proveedor extends AccountAppModel {

	var $name = 'Proveedor';
        var $order = array('Proveedor.name' => 'ASC');
        
        var $validate = array(
		'name' => array(
			'name' => array(
				'rule' => array('minLength', '1'),
				'required' => true,
				'message' => 'Debe especificar un nombre'
			)
		),
                'cuit' => array(
                    'cuit' => array(
                            'rule' => 'validate_cuit',
                            'message' => 'CUIT inválido',
                    ),
                    'unique' => array(
                        'rule' => 'isUnique',
                        'message' => 'El Cuit ya existe'
                    )
                ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array( 'Account.Gasto' );
        
        function validate_cuit(){
            if (!empty($this->data['Proveedor']['cuit'])) {
                 return validate_cuit_cuil($this->data['Proveedor']['cuit']);
            }
            return true;
        }

}
?>