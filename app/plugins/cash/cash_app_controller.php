<?php

class CashAppController extends AppController
{
    public $helpers = array('Number');
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');

        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action' => 'login', 'admin' => false, 'plugin' => null);
        
        
    }

}

?>
