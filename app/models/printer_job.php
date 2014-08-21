<?php

class PrinterJob extends AppModel {

	public $name = 'PrinterJob';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'Printer' => array(
				'className' => 'Comandera',
				'foreignKey' => 'printer_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
	);

}
