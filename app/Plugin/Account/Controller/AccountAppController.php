<?php
App::uses('AppController', 'Controller');

class AccountAppController extends AppController
{

    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');

        $this->Auth->loginAction = array('controller' => 'users',
                'action' => 'login', 'admin' => false, 'plugin' => null);
    }

}

?>
