<?php

class ActualizadorComponent extends Object {
    var $components = array('Session');
    
    function initialize(){
        if (!$this->Session->check('mesaActualizada')) {
            // marcar solo la primera vez como actuaizada. inicializa en TRUE el valor
            $this->Session->write('mesaActualizada', true);
        }
    }
    
    function reset(){
        $this->Session->write('mesaActualizada', false);
    }
    
    
    function huboCambios(){
        return  $this->Session->read('mesaActualizada') == true ;
    }
    
    function actualizar(){
        $this->Session->write('mesaActualizada', true);
    }
}
