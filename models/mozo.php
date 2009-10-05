<?php
class Mozo extends AppModel {

	var $name = 'Mozo';
	var $validate = array(
		'user_id' => array('numeric'),
		'numero' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Mesa' => array('className' => 'Mesa',
								'foreignKey' => 'mozo_id',
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
	
	
	/**
	 * Me devuelve todo los mozos activos
	 *
	 * @param recursive -1 por default
	 * @ return array del find(all)
	 */
	function dameActivos($recursive = 0)
	{
		$this->recursive = $recursive;
		return $this->find('all',array('conditions'=>array('Mozo.activo'=>1)));
	}
	
	
	function dameTodos($recursive = 0){
		$this->recursive = $recursive;
		return $this->find('all');
	}

}
?>