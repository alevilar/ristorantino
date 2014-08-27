<?php

App::uses('AccountAppModel', 'Account.Model');

class Proveedor extends AccountAppModel {

	public $name = 'Proveedor';
    
    public $order = array('Proveedor.name' => 'ASC');
    
    public $validate = array(
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
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'El Cuit ya existe',
                'allowEmpty' => true,
            )
        ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array( 'Account.Gasto' );
        
    function validate_cuit(){
        if (!empty($this->request->data['Proveedor']['cuit'])) {
             return validate_cuit_cuil($this->request->data['Proveedor']['cuit']);
        }
        return true;
    }

}
