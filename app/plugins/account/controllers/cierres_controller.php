<?php

/**
 * @property Cierre $Cierre
 */
class CierresController extends AccountAppController
{
    
    var $helpers = array('Number');

            
    function index()
    {
        $this->Cierre->recursive = -1;
        $this->set('cierres', $this->paginate());
    }

    
   
    function add()
    {        
        if (!empty($this->data)) {
            $this->Cierre->create();
            if ($this->Cierre->save($this->data)) {
                foreach ($this->data['Gasto'] as $gasto){
                    $this->Cierre->Gasto->id = $gasto['id'];
                    $this->Cierre->Gasto->saveField('cierre_id', $this->Cierre->id);
                }
                $this->Session->setFlash('Se Guardó correctamente');
            } else {
                $this->Session->setFlash('Fallo al guardar');
            }
        }
    }
    
    function view($id) {
        
        $this->set('cierre', $this->Cierre->read(null, $id));
    }


}

?>