<?php

class AppController extends Controller {

    var $helpers = array('Session','Html', 'Form','Js');

    var $components = array('RequestHandler','Session','Auth');
    
    public function beforeFilter()
    {

        $this->Auth->loginError ='Usuario Incorrecto';
        $this->Auth->authError = 'No tiene permisos para acceder aquí';

        $this->Auth->logoutRedirect='/';

        $this->Auth->authorize = 'controller';
        
        $this->Auth->allow('display','login','logout','add');
        
        $this->Auth->allow(array('*'));


        if($this->RequestHandler->isAjax()){
            if (!$this->Auth->User('id') ) {
                header('HTTP/1.1 401 Unauthorized');
            }
        }

    }


    function isAuthorized(){
        return true;
    }
}