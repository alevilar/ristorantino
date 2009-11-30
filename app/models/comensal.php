<?php
class Comensal extends AppModel {

	var $name = 'Comensal';
	var $validate = array(
		'cant_mayores' => array('numeric'),
		'cant_menores' => array('numeric'),
		'cant_bebes' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Mesa' => array('className' => 'Mesa',
								'foreignKey' => 'mesa_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>