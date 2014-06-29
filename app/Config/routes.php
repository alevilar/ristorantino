<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));



	Router::connect('/aditions/adicionar', array('plugin'=>'aditions','controller' => 'aditions', 'action' => 'adicionar'));


	Router::connect('/users/login', array('plugin'=>'users','controller' => 'users', 'action' => 'login'));
	Router::connect('/users/logout', array('plugin'=>'users','controller' => 'users', 'action' => 'logout'));





	Router::connect('/aditions/cashier/:action/*', array('plugin'=>'billings','controller' => 'fiscal_printers'));



	// URL´s para la adicion
	// estos se suponen que son rutas temporales de migracion de Chocha012 a la Chocha014
	$myPlugins = array(
		array('plugin' => 'fidelization', 'controller'=>'clientes'),
		array('plugin' => 'mesa', 'controller'=>'mesas'),
		array('plugin' => 'mesa', 'controller'=>'mozos'),
		array('plugin' => 'product', 'controller'=>'categorias'),
		array('plugin' => 'comanda', 'controller'=>'detalle_comandas'),
		array('plugin' => 'mesa', 'controller'=>'pagos'),
		);

	foreach ( $myPlugins as $rt) {		
		Router::connect('/:controller', array('plugin'=>$rt['plugin'], 'action' => 'index', array('controller' => $rt['controller'])));
		Router::connect('/:controller/:action/*', array('plugin'=>$rt['plugin']), array('controller' => $rt['controller']));		
	}

	unset($myPlugins);
	








/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';

