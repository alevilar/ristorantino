<?php

App::uses('AppController', 'Controller');


class ConfigsController extends AppController {

	var $name = 'Configs';
	var $scaffold;
        
        
        function toggle_remito() {
            $par = array(                
                'ConfigCategory.name' => 'Mesa', 
                'Config.key' => 'imprimePrimeroRemito',
            );
            $conf = $this->Config->find('first', array(
                'conditions' => $par,
            ));
            
            $conf['Config']['value'] = !$conf['Config']['value'];
            $this->Config->save($conf);
            
            if ($this->RequestHandler->isAjax()) {
                $this->autoRender = false;
                return $conf['Config']['value'];
            }
        }
}
?>