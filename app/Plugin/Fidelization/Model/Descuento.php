<?php

App::uses('FidelizationAppModel', 'Fidelization.Model');


class Descuento extends FidelizationAppModel {

	var $name = 'Descuento';
	var $validate = array(
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