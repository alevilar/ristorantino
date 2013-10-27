<?php

class CashAppController extends AppController
{
    
    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action' => 'login', 'admin' => false, 'plugin' => null);
    }

}

?>
