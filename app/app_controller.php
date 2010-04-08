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
	var $components = array( 'Auth' , 'RequestHandler');
	
	
	
	 function beforeFilter()
	 {
             $this->Auth->loginError ='Usuario o Password Incorrectos';
             $this->Auth->authError = 'Debe registrarse para acceder a esta página';

             $this->Auth->logoutRedirect='/users/login';
             
             //$this->Auth->allow('display','login','logout');
             //$this->Auth->allow('*');
             //$this->Auth->allow('home','login','logout');
             
             $this->Auth->authorize = 'controller';

             /*
              * Esto hace que cuando se auna peticion ajax, vaya  a buscar la vista den
              * tro de la carpeta "ajax" de cada controlador
              */
             if ($this->RequestHandler->isAjax()) {
                 Configure::write('debug', 1);
                 $this->layout = 'ajax';
             }
      }       
        
        
        function isAuthorized() {
            $llAuth = false;
            $this->Auth->allow('display','login','logout');

            if($this->RequestHandler->isAjax()) {
                $llAuth = true;
                return $llAuth;
            }

            // usuarios remotos sin privilegios grosos son banneados
            $ipCortada = strtok($this->RequestHandler->getClientIP(),'.');
            if ( (int)$ipCortada > 192
                && (
                    $this->Auth->user('role') != 'gerente' ||
                    $this->Auth->user('role') != 'superuser')
            ) {
                debug($this->RequestHandler->getClientIP());die();
                return false;
            }
            

            if ($this->name == 'Adicion') {
                $llAuth = true;
            }

            if ($this->name == 'Mesas') {
                $llAuth = true;
            }


            switch ($this->Auth->user('role')):
                case 'superuser':
                    $llAuth = true;
                    break;
                case 'gerente':
                    $llAuth = true;
                    break;
                case 'adicionista':
                    if($this->name != 'Queries') {
                        $llAuth = true;
                    }
                    break;
                case 'mozo':
                    if($this->name == 'Adicion') {
                        $llAuth = true;
                    }
                    break;
                default:
                    $llAuth = false;
                    break;
                endswitch;


            if ($llAuth == true) {
                return true;
            }
            else {
                $this->Session->setFlash('El perfil de usuario suyo no tiene permisos para acceder aquí.', true);

                $this->redirect('/pages/home');
                return false;
            }
        }
}
?>