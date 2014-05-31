<?php
/* SVN FILE: $Id: app_model.php 7945 2008-12-19 02:16:01Z gwoo $ */

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppModel extends Model {
       
       var $actsAs = array('Containable');
       
        /**
         *
         * Lo que hace es convertir una cadena en una expresion regular para
         * buscar el texto sin tener en cuenta los acentos y la eñe
         *
         * @param $text
         */
        function convertir_para_busqueda_avanzada($text){              
                $text = strtolower($text);
                $text = trim($text);
                $text = "%$text%";
                $patron = array (
                        // Espacios, puntos y comas por guion
                        //'/[\., ]+/' => '-',
                       
                        // Vocales
                        '/a/' => '[áaAÁ]',
                        '/e/' => '[éeEÉ]',
                        '/i/' => '[íiIÍ]',
                        '/o/' => '[óoOÓ]',
                        '/u/' => '[úuÚU]',
               
                        '/A/' => '[áaAÁ]',
                        '/E/' => '[éeEÉ]',
                        '/I/' => '[íiIÍ]',
                        '/O/' => '[óoOÓ]',
                        '/U/' => '[úuÚU]',
               
                        '/Á/' => '[áaAÁ]',
                        '/É/' => '[éeEÉ]',
                        '/Í/' => '[íiIÍ]',
                        '/Ó/' => '[óoOÓ]',
                        '/Ú/' => '[úuÚU]',
               
                        '/á/' => '[áaAÁ]',
                        '/é/' => '[éeEÉ]',
                        '/í/' => '[íiIÍ]',
                        '/ó/' => '[óoOÓ]',
                        '/ú/' => '[úuÚU]',
                       
                        '/n/' => '[ñ]',
                        '/ñ/' => '[nñ]',
               
                        '/s/' => '[zsc]',
                        '/c/' => '[zsc]',
                        '/z/' => '[zsc]',
 
                        // Agregar aqui mas caracteres si es necesario
                        '/°/' => '',
                        '/º/' => '',
                        '/n°/' => '%',
                        '/nº/' => '%',
                        '/de/' => '%',
                        '/la/' => '%',
                        '/con/' => '%',
                        '/los/' => '%',
                        '/ /' => '%'
 
                );
                // caracteres especiales de expresiones regulares
                $text = preg_quote($text);
                $text_aux = '';
                for($i=0; $i<strlen($text); $i++){
                        $caracter =  $text[$i];
                        $text_aux .= preg_replace(array_keys($patron),array_values($patron),$caracter,1);
                }

                return $text_aux;              
        }
       
}
       
?>