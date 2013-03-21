<?php

class ClasificacionesController extends AccountAppController {
        var $scaffold;

        
        function index() {
		$this->set('clasificaciones',$this->Clasificacion->generatetreelist(null, null, null, '____'));	
	}
        
        
        function add_edit($id = null) {
            
            if (!empty($this->data)) {
                if ($this->Clasificacion->save($this->data)) {
                    $this->Session->setFlash('La clasificacion ha sido guardada');
                } else {
                    $this->Session->setFlash('Error al guardar la clasificación');
                }
            }
            
            if ( !empty($id) ) {
                $this->Clasificacion->recursive = 0;
                $this->data = $this->Clasificacion->read(null, $id);
            }
            
            $this->set('clasificacion_id', $id);
            
            $treelist = $this->Clasificacion->generatetreelist();
            $this->set('clasificaciones', $treelist);
        }
        
        
        function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Clasificacion', true));
		}
		if ($this->Clasificacion->del($id)) {
			$this->Session->setFlash(__('Clasificacion deleted', true));
		}
                $this->redirect(array('action'=>'index'));
	}

}
