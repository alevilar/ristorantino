<?php
class Vale extends AccountAppModel {

	var $name = 'Vale';

	var $validate = array(
		'persona' => array(
			'rule1' => array(
				'rule' => array('minLength', '1'),
				'required' => true,
				'message' => 'Debe especificar una persona'
			)
		)
	);

}
?>