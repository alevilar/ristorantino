<?php

/**
 * @property Gasto $Gasto
 */
class Cierre extends AccountAppModel {

        var $name = 'Cierre';
        
        public $order = array('Cierre.created DESC');
        
	public $validate = array(
		'name' => array('notempty')
	);
 
        public $hasMany = array('Account.Gasto');
        
}