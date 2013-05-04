<?php

class AccountController extends AccountAppController {

	var $helpers = array('Html', 'Form');
        var $uses = array();
	
        
        
	function index(){
            $this->redirect(array('controller'=>'gastos', 'action'=>'index', 'plugin' => 'account'));
	}      

	
}
