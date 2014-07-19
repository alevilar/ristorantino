<?php


class Caja extends CashAppModel {

	var $name = 'Caja';
	var $validate = array(
		'name' => array('isUnique', 'notEmpty'),
		'computa_ventas' => array('boolean'),
                'computa_pagos' => array('boolean'),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
            'Cash.Arqueo',
	);

}
?>