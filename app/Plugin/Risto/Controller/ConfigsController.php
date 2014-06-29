<?php

App::uses('AppController', 'Controller');


class ConfigsController extends AppController {

	public $name = 'Configs';


	public $scaffold;

    public function beforeFilter() {
        $this->Config->recursive = 1;
    }

    public function beforeRender() {        
        $this->set('scaffoldFields', array(
                'config_category_id',
                'key',
                'value',
                'description',
            ));
    }
        
        
    public function toggle_remito() {
            $par = array(                
                'ConfigCategory.name' => 'Mesa', 
                'Config.key' => 'imprimePrimeroRemito',
            );
            $conf = $this->Config->find('first', array(
                'conditions' => $par,
            ));
            
            $conf['Config']['value'] = !$conf['Config']['value'];
            $this->Config->save($conf);
            
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                return $conf['Config']['value'];
            }
        }
}
?>