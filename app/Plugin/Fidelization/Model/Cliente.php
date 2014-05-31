<?php
App::uses('FidelizationAppModel', 'Fidelization.Model');
/**
 * Cliente Model
 *
 * @property Descuento $Descuento
 * @property TipoDocumento $TipoDocumento
 * @property IvaResponsabilidad $IvaResponsabilidad
 * @property Mesa $Mesa
 */
class Cliente extends FidelizationAppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Descuento' => array(
			'className' => 'Fidelization.Descuento',
			'foreignKey' => 'descuento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TipoDocumento' => array(
			'className' => 'Risto.TipoDocumento',
			'foreignKey' => 'tipo_documento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'IvaResponsabilidad' => array(
			'className' => 'Risto.IvaResponsabilidad',
			'foreignKey' => 'iva_responsabilidad_id',
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
		'Mesa' => array(
			'className' => 'Mesa',
			'foreignKey' => 'cliente_id',
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
