<?php


class Movimiento extends CashAppModel {

	public $name = 'Movimiento';
	public $validate = array(
                'de_caja_id' => array('numeric', 'notEmpty'),
                'a_caja_id' => array('numeric', 'notEmpty'),
		'valor' => array('numeric'),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
            'DeCaja' => array(
                'className' => 'Caja.Caja',
                'foreign_key' => 'de_caja_id'
            ),
            'ACaja' => array(
                'className' => 'Caja.Caja',
                'foreign_key' => 'a_caja_id'
            ),
	);

}
?>