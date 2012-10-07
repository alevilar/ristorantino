<?php
class TipoDePagosController extends AppController {

	var $name = 'TipoDePagos';
	var $helpers = array('Html', 'Form');

       function beforeFilter() {
            parent::beforeFilter();
        }
        
	function index() {
		$this->TipoDePago->recursive = 0;
		$this->set('tipoDePagos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TipoDePago.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tipoDePago', $this->TipoDePago->read(null, $id));
	}


	function edit($id = null) {
		
                
                if( !empty($this->request->data['TipoDePago']['newfile']['name'])){
                    $path = WWW_ROOT.'img/';
                  
                    $cadToVec = explode('.', $this->request->data['TipoDePago']['newfile']['name']);
                    $name = Inflector::slug( $cadToVec[0] );
                    $ext = $cadToVec[1];
                    $nameFile = $name.".$ext";
                    
                    if ( file_exists($path.$nameFile) ){
                        $i = 1;
                        $nameFile = $name."_$i.$ext";
                        while ( file_exists($path.$nameFile) ) {
                            $i ++;
                            $nameFile = $name."_$i.$ext";
                        }
                    }
                    
                    $this->request->data['TipoDePago']['image_url'] = $name.".$ext";
                    
                    $this->request->data['TipoDePago']['image_url'] = $name.".$ext";
                    debug($path.$nameFile);
                    move_uploaded_file($this->request->data['TipoDePago']['newfile']['tmp_name'], $path.$nameFile) ;
                    
                }
                
                
		if (!empty($this->request->data)) {
                    if ( !empty($id)) {
                        $this->TipoDePago->create();
                    }
			if ($this->TipoDePago->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoDePago has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TipoDePago could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->TipoDePago->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TipoDePago', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TipoDePago->del($id)) {
			$this->Session->setFlash(__('TipoDePago deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>