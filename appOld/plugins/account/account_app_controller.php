<?php

class AccountAppController extends AppController
{

    var $helpers = array('Html', 'Form','Javascript', 'Jqm');
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');

        $this->Auth->loginAction = array('controller' => 'users',
                'action' => 'login', 'admin' => false, 'plugin' => null);
    }

}

?>
