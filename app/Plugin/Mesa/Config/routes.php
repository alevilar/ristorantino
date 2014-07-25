<?php



Router::connect('/mesas', array('plugin'=>'mesa', 'action' => 'index', 'controller' => 'mesas'));
Router::connect('/mesas/:action/*', array('plugin'=>'mesa', 'controller' => 'mesas'));

Router::connect('/mozos', array('plugin'=>'mesa', 'action' => 'index', 'controller' => 'mozos'));
Router::connect('/mozos/:action/*', array('plugin'=>'mesa', 'controller' => 'mozos'));

Router::connect('/pagos', array('plugin'=>'mesa', 'action' => 'index', 'controller' => 'pagos'));
Router::connect('/pagos/:action/*', array('plugin'=>'mesa', 'controller' => 'pagos'));
