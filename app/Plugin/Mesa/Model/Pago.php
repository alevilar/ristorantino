<?php

App::uses('AppModel', 'Mesa.Model');

class Pago extends MesaAppModel {

	var $name = 'Pago';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
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
}
?>