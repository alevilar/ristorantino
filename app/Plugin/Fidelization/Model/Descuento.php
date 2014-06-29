<?php

App::uses('FidelizationAppModel', 'Fidelization.Model');


class Descuento extends FidelizationAppModel {

	public $name = 'Descuento';

    public $actsAs = array(
        'SoftDelete', 
        'Containable',
        );


	public $validate = array(
		'name' => array('notempty'),
		'porcentaje' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Solo números'
                )
        )
	);

}
?>