<?php

class AditionAppController extends AppController
{
    public $components = array('Configurator', 'Auth');
    

    function beforeFilter()
    {
        parent::beforeFilter();


        $this->Auth->loginAction = array('controller' => 'users',
            'action' => 'login', 'admin' => false, 'plugin' => null);
    }
//
//    function success()
//    {
//        header("HTTP/1.0 200 Success", null, 200);
//        exit;
//    }
//
//    function failure()
//    {
//        header("HTTP/1.0 404 Failure", null, 404);
//        exit;
//    }

}

?>