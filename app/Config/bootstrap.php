<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as 
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cache Engine Configuration
 * Default settings provided below
 *
 * File storage engine.
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'File', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'path' => CACHE, //[optional] use system tmp directory - remember to use absolute path
 * 		'prefix' => 'cake_', //[optional]  prefix every cache file with this string
 * 		'lock' => false, //[optional]  use file locking
 * 		'serialize' => true, // [optional]
 * 		'mask' => 0666, // [optional] permission mask to use when creating cache files
 *	));
 *
 * APC (http://pecl.php.net/package/APC)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Apc', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *	));
 *
 * Xcache (http://xcache.lighttpd.net/)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Xcache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 *		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional] prefix every cache file with this string
 *		'user' => 'user', //user from xcache.admin.user settings
 *		'password' => 'password', //plaintext password (xcache.admin.pass)
 *	));
 *
 * Memcache (http://memcached.org/)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Memcache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 * 		'servers' => array(
 * 			'127.0.0.1:11211' // localhost, default port 11211
 * 		), //[optional]
 * 		'persistent' => true, // [optional] set this to false for non-persistent connections
 * 		'compress' => false, // [optional] compress data in Memcache (slower, but uses less memory)
 *	));
 *
 *  Wincache (http://php.net/wincache)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Wincache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 *		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *	));
 */
Cache::config('default', array('engine' => 'File'));


// Read configuration file from ini file
App::uses('IniReader', 'Configure');
Configure::config('ini', new IniReader(ROOT."/".APP_DIR.'/Config/'));
Configure::load('coqus_config', 'ini');


App::uses('PrinterHelperSkel', 'PrinterEngine.Lib');
App::uses('FiscalPrinterHelper', 'PrinterEngine.Lib');


/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models', '/next/path/to/models'),
 *     'Model/Behavior'            => array('/path/to/behaviors', '/next/path/to/behaviors'),
 *     'Model/Datasource'          => array('/path/to/datasources', '/next/path/to/datasources'),
 *     'Model/Datasource/Database' => array('/path/to/databases', '/next/path/to/database'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions', '/next/path/to/sessions'),
 *     'Controller'                => array('/path/to/controllers', '/next/path/to/controllers'),
 *     'Controller/Component'      => array('/path/to/components', '/next/path/to/components'),
 *     'Controller/Component/Auth' => array('/path/to/auths', '/next/path/to/auths'),
 *     'Controller/Component/Acl'  => array('/path/to/acls', '/next/path/to/acls'),
 *     'View'                      => array('/path/to/views', '/next/path/to/views'),
 *     'View/Helper'               => array('/path/to/helpers', '/next/path/to/helpers'),
 *     'Console'                   => array('/path/to/consoles', '/next/path/to/consoles'),
 *     'Console/Command'           => array('/path/to/commands', '/next/path/to/commands'),
 *     'Console/Command/Task'      => array('/path/to/tasks', '/next/path/to/tasks'),
 *     'Lib'                       => array('/path/to/libs', '/next/path/to/libs'),
 *     'Locale'                    => array('/path/to/locales', '/next/path/to/locales'),
 *     'Vendor'                    => array('/path/to/vendors', '/next/path/to/vendors'),
 *     'Plugin'                    => array('/path/to/plugins', '/next/path/to/plugins'),
 * ));
 *
 */

App::build(array(
     'Printer/FiscalPrinter/Driver' => array('/Lib/Printer/FiscalPrinter/Driver'),
));


/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

CakePlugin::load('Acl', array('bootstrap' => true));

CakePlugin::loadAll( array(
    'Adition',
    'Stats',
)); // Loads all plugins at once


//reglas en español
 
Inflector::rules('singular', array(
    'rules' => array('/([r|d|j|n|l|m|y|z])es$/i' => '\1', '/as$/i' => 'a', '/([ti])a$/i' => '\1a'),
    'irregular' => array(
        'fiscal_printers'=>'fiscal_printer',
        'printers' => 'printer',
        'config_categories'=>'config_category',
    ),
    )
);
 
Inflector::rules('plural', array(
    'rules' => array('/([r|d|j|n|l|m|y|z])$/i' => '\1es','/a$/i' => '\1as'),
    'irregular' => array(
        'user' => 'users',
        'group'=>'groups', 
        'adicion'=>'adicion', 
        'cajero'=>'cajero', 
        'fiscal_printer'=>'fiscal_printers',
        'printer' => 'printers',
        'query'=>'queries',
        'action'=>'actions',
        'inventory' => 'inventories',
        'category' => 'categories',
        'config_category' => 'config_categories',
        'pquery_category' => 'pquery_categories',
        'habitación' => 'habitaciones',
    ),
    'uninflected' => array()
    )
);





/** 
 * 
 * 
 * COQUS APP Bootstrap
 */
define('DATETIME_NULL', '0000-00-00 00:00:00');

define('MESA_ABIERTA' , 1);
define('MESA_CERRADA' , 2);
define('MESA_COBRADA' , 3);


define('MENU_FOLDER', 'menu');
define('IMG_MENU', WWW_ROOT.'img/'.MENU_FOLDER.'/');


$estadosMesaMsg = array(
            MESA_ABIERTA => 'Abierta', 
            MESA_CERRADA => 'Cerrada', 
            MESA_COBRADA => 'Cobrada',
);


function comandosDeReinicializacionServidorImpresion($devName = null) {
    
    debug( exec("sh /etc/init.d/spooler_srv stop") );
    $devName = empty($devName) ? $devName : ' '.$devName;
    debug($devName);
    debug( exec("sh /etc/init.d/spooler_srv start$devName") );
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



function convertir_para_busqueda_avanzada($text){               
                $text = strtolower($text);
                $text = trim($text);
                $text = "($text)";
                $patron = array (
                        // Espacios, puntos y comas por guion
                        //'/[\., ]+/' => '-',
                        
                        // Vocales
                        '/a/' => '(á|a|A|Á)',
                        '/e/' => '(é|e|E|É)',
                        '/i/' => '(í|i|I|Í)',
                        '/o/' => '(ó|o|O|Ó)',
                        '/u/' => '(ú|u|Ú|U)',
                
                        '/A/' => '(á|a|A|Á)',
                        '/E/' => '(é|e|E|É)',
                        '/I/' => '(í|i|I|Í)',
                        '/O/' => '(ó|o|O|Ó)',
                        '/U/' => '(ú|u|Ú|U)',
                
                        '/Á/' => '(á|a|A|Á)',
                        '/É/' => '(é|e|E|É)',
                        '/Í/' => '(í|i|I|Í)',
                        '/Ó/' => '(ó|o|O|Ó)',
                        '/Ú/' => '(ú|u|Ú|U)',
                
                        '/á/' => '(á|a|A|Á)',
                        '/é/' => '(é|e|E|É)',
                        '/í/' => '(í|i|I|Í)',
                        '/ó/' => '(ó|o|O|Ó)',
                        '/ú/' => '(ú|u|Ú|U)',
                        
                        '/n/' => '(ñ)',
                        '/ñ/' => '(n|ñ)',
                
                        '/s/' => '(z|s|c|x)',
                        '/c/' => '(z|s|c)',
                        '/z/' => '(z|s|c)',
 
                        // Agregar aqui mas caracteres si es necesario
                        '/°/' => '',
                        '/º/' => '',
                        '/n°/' => '%',
                        '/nº/' => '%',
                        '/ /' => '%',
                        '/x/' => '(x|s|X|S)'
 
                );
                // caracteres especiales de expresiones regulares
//                $text = preg_quote($text);
                $text_aux = '';
                for($i=0; $i<strlen($text); $i++){
                        $caracter =  $text[$i];
                        $text_aux .= preg_replace(array_keys($patron),array_values($patron),$caracter,1);
                }

                return $text_aux;               
}