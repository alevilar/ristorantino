<?php

//if (!class_exists('File')) {
//	require LIBS . 'file.php';
//}

/**
 * 
 * 
 * Mediante la apertura "open" y cierre "close" de un archivo voy a ir
 * verificacando la actualizacion de una mesa
 * cuando hago open es que actualizo mesa, entonces el "lastAccess" del archivo 
 * me dara el tiempo en el que fue modificada la mesa.
 * 
 */
class ActualizadorComponent extends Object {
    var $components = array('Session');
    var $file;
    
    function initialize(){
        $tmpFile = TMP.DS.'mesas_last_updated_time.tmp';
        $this->file =& new File($tmpFile, true, 0777);
                
//        $this->actualizar();
    }
    
    function val(){
        return $this->file->lastAccess();
    }
        
    
    function huboCambios($time){
        // si la fecha de actualizacion es mas reciente que time
        // entonces hubieron cambios
        return  $this->file->lastAccess() > $time ;
    }
    
    function actualizar(){        
//        $this->file->open();
        $this->file->write( time() );
//        $this->file->close();
    }
   
}
