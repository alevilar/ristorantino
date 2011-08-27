<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
//EOF


define('DATETIME_NULL', '0000-00-00 00:00:00');

define('MESA_ABIERTA' , 1);
define('MESA_CERRADA' , 2);
define('MESA_COBRADA' , 3);


$estadosMesaMsg = array(
            MESA_ABIERTA => 'Abierta', 
            MESA_CERRADA => 'Cerrada', 
            MESA_COBRADA => 'Cobrada',
);


function comandosDeReinicializacionServidorImpresion($devName = null) {
    
    exec("sudo /etc/init.d/spooler_srv stop");
    $devName = empty($devName) ? $devName : ' '.$devName;
    debug($devName);
    exec("sudo /etc/init.d/spooler_srv start$devName");
    exec("cd /");	
}


function jsDate($date){
    return date( 'Y-m-d H:i:s', strtotime($date));
}


/**
 * Mejora segun politicas del negocio para la funcion de redondeo
 *
 * @param double $number
 * @param integer $precision
 * @param const $extra flags de la funcion round() de PHP ver: http://php.net/manual/es/function.round.php
 */
function cqs_round($number, $precision = 0){
    if($precision == 0){
        $num =  ceil($number);
    } else {
        $num =  round($number, $precision);
    }
    return $num;
}



//
//function jqmGrid_getBlockNumber($grid, $currentNumber) {
//
//    $grid = array(
//        'a' => array('a', 'b'),
//        'b' => array('a', 'b', 'c'),
//        'c' => array('a', 'b', 'c', 'd'),
//        'd' => array('a', 'b', 'c', 'd', 'e'),
//        );
//
//
//    $currentNumber+1 % $gridToNumber[strtolower($grid)]
//
//}
?>