<?php

Router::connect('/stats', array('plugin' => 'stats', 'controller' => 'stats', 'action' => 'mesas_total'));
Router::connect('/stats/:action', array('plugin'=>'stats', 'controller' => 'stats'));
Router::connect('/stats/:action/*', array('plugin' => 'stats', 'controller' => 'stats'));

