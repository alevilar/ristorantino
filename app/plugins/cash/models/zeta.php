<?php


class Zeta extends CashAppModel {

	var $name = 'Zeta';
	var $validate = array(
                'numero_comprobante' => array('numeric'),
                'total_ventas' => array('numeric'),
	);
        
        var $order = array('Zeta.numero_comprobante DESC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
            'Cash.Arqueo'
	);

}
?>