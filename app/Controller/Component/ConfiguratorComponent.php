<?php

App::uses('Component', 'Controller');

class ConfiguratorComponent extends Component {
     public $Config = null;
     
    function initialize(){
        $this->Config = & ClassRegistry::init('Config');

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

?>
