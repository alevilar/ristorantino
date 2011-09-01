<?php
class Vale extends AccountAppModel {

	var $name = 'Vale';

	var $validate = array(
                'user_persona' => array(
                        'rule' => 'validateUserPersona',
                        'message' => 'Debe especificar un usuario o persona a quien se le adjudica el vale'
                ),
                'fecha' => array(
			'rule1' => array(
				'rule' => array('minLength', '1'),
				'required' => true,
				'message' => 'Debe especificar la fecha del vale'
			)
		),
                'monto' => array(
			'rule1' => array(
				'rule' => 'numeric',
                                'required' => true,
                                'allowEmpty' => false,
				'message' => 'Debe especificar el monto del vale'
			)
		)
	);
        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
        
        
        function validateUserPersona($check) {
            
            return true;
        }

}
?>