<?php

Router::connect('/account', array('plugin'=>'account', 'controller' => 'gastos', 'action'=>'index'));


Router::connect('/account/proveedores/*', array('plugin' =>  'account' , 'controller' => 'proveedores', 'action' => 'index'));
