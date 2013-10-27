<?php


class Arqueo extends CashAppModel {

	var $name = 'Arqueo';
	var $validate = array(
		'caja_id' => array('numeric'),
		'datetime' => array('date', 'notEmpty'),
                'importe_inicial' => array('numeric', 'notEmpty'),
                'importe_final' => array('numeric', 'notEmpty'),
	);
        
        var $order = array('Arqueo.datetime DESC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
            'Cash.Caja', 
	);
        
        var $hasOne = array(
            'Cash.Zeta',
        );

}
?>