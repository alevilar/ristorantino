<?php

Router::connect('/account', array('plugin' =>  'account' , 'controller' => 'gastos', 'action' => 'display'));

Router::connect('/account/proveedores/*', array('plugin' =>  'account' , 'controller' => 'proveedores', 'action' => 'index'));
