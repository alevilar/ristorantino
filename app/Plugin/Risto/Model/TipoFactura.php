<?php

App::uses('RistoAppModel', 'Risto.Model');


class TipoFactura extends RistoAppModel {

	public $name = 'TipoFactura';
	public $validate = array(
		'name' => array('notempty')
	);
    public $order = 'TipoFactura.name';        

}
?>