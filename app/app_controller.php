<?php
/* SVN FILE: $Id: app_controller.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-02 01:33:52 -0500 (Wed, 02 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */
class AppController extends Controller {
	var $helpers = array('Html', 'Form','Javascript','Ajax');
        var $components = array('Acl', 'Session', 'Auth', 'Requesthandler', 'Configurator');
	
	
	
	 function beforeFilter()
	 {
             /* @var $auth AuthComponent */
             $auth;

            $this->Auth->loginError ='Usuario o Contraseña Incorrectos';
            $this->Auth->authError = 'Usted no tiene permisos para acceder a esta página.';

            $this->Auth->authorize = 'actions';
            //$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
            $this->Auth->logoutRedirect='/users/login';
            //$this->Auth->autoRedirect = false;
//$this->Auth->allow('*'); return true;

            // si es Ajax y no tengo permisos que me tire un error HTTP
            // asi lo puedo capturar desde jQuery
            if($this->Requesthandler->isAjax()){
                Configure::write ( 'debug', 1);
                if (!$this->Acl->check($this->Auth->user(), $this->action)){
                    header('HTTP/1.1 401 Unauthorized');
                }
            }

      }       
        
}
?>