<?php

App::uses('Component', 'Controller');

class ConfiguratorComponent extends Component {
    public $Config;
     
    public function initialize(Controller $controller) {
        $this->Config = ClassRegistry::init('Config');

        $ccc = $this->Config->find('all');
        
        foreach( $ccc as $c){
            $confName = '';
            if (!empty($c['ConfigCategory']['name'])) {
                $confName = $c['ConfigCategory']['name'].'.';
            }
            $keyName = $confName.$c['Config']['key'];
            Configure::write($keyName, $c['Config']['value']);
        }
    }
}
