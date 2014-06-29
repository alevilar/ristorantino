<?php

App::uses('AppModel', 'Mesa.Model');

class Pago extends MesaAppModel {

	public $name = 'Pago';


	public $actsAs = array(
        'Search.Searchable',
        'Containable',
        );



	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'Mesa' => array('className' => 'Mesa.Mesa',
								'foreignKey' => 'mesa_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'TipoDePago' => array('className' => 'Risto.TipoDePago',
								'foreignKey' => 'tipo_de_pago_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

//        function afterSave() {
//            $this->Mesa->id = $this->data[$this->name]['mesa_id'];
//            $this->Mesa->saveField('modified', date('Y-m-d H:i:s', strtotime('now')), false);
//            return true;
//        }

	public $filterArgs = array(
        'mozo_id' => array(
            'type' => 'value',
            'field' => 'Mesa.mozo_id'
            ),
        'mesa_numero' => array(
            'type' => 'value',
            'field' => 'Mesa.numero'
            ),
        'valor' => array(
            'type' => 'value'
            ),        
        'created_from' => array(
            'type' => 'value',
            'field' => 'Pago.created >='
            ),
        'created_to' => array(
            'type' => 'value',
            'field' => 'Pago.created <='
            ),        
        );
}
?>