<?php

class AccountController extends AccountAppController {

	var $helpers = array('Html', 'Form');
        var $uses = array('Account.Vale', 'Account.Gasto');
	
	function index(){

	}
        
        function arqueo() {
            $this->Vale->recursive = 0;
            // vales de hoy
            $vale = $this->Vale->find('first', array(
                                            'conditions' => array('DATEDIFF(created, CURDATE())' => 0),
                                            'fields' => array('SUM(monto) as total')
                ));
            
            $this->Gasto->recursive = 1;
            // gastos con factura de hoy
            $gasto = $this->Gasto->find('all', array(
                                            //'conditions' => array('DATEDIFF(factura_fecha, CURDATE())' => 0)
                ));
            
	}

	
}
