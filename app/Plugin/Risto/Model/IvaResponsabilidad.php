<?php
App::uses('RistoAppModel', 'Risto.Model');

class IvaResponsabilidad extends RistoAppModel {

	public $name = 'IvaResponsabilidad';

	
	public $validate = array(
		'codigo_fiscal' => array('notempty'),
		'name' => array('notempty')
	);



	public $belongsTo = array(
		'TipoFactura' => array(
			'className' => 'TipoFactura',
			'foreignKey' => 'tipo_factura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'iva_responsabilidad_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	
}
