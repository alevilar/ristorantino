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

	public $actsAs = array(
        'Search.Searchable',
        'Containable',
        );

	public $virtualFields = array(
            'nombre_nrodocumento' => 'CONCAT(Cliente.nombre, " (", Cliente.nrodocumento, ")")'
        );

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
		),
		'TipoFactura' => array(
			'className' => 'Risto.TipoFactura',
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



	public $filterArgs = array(
        'codigo' => array(
            'type' => 'like',
            ),
        'mail' => array(
            'type' => 'like',
            ),
        'mozo_numero' => array(
            'type' => 'value',
            'field' => 'Mozo.numero'
            ),
        'nrodocumento' => array(
            'type' => 'like',
            ),
        'tipo_documento_id' => array(
            'type' => 'value',
            ),
        'nombre' => array(
            'type' => 'like',
            ),
        'descuento' => array(
            'type' => 'value'
            ),        
        'tipofactura' => array(
            'type' => 'value',
            ),        
        'iva_responsabilidad_id' => array(
            'type' => 'value',
            ),  
        'descuento_id' => array(
            'type' => 'value',
            ),
        'telefono' => array(
            'type' => 'like',
            ),  
        'domicilio' => array(
            'type' => 'like',
            ),
        );


	public function todos ($type = 'all')
    {
        $clientes = $this->find($type, array(
            'order' => 'Cliente.nombre',
//                    'limit' => 10,
            'contain' => array(
                'Descuento'
            ),
                ));
        return $clientes;
    }

}
