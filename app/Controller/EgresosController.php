<?php
class EgresosController extends AppController {

	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Paginator');
        //var $components = array ('Pagination'); // Added

	function index() {
		$this->Egreso->recursive = 0;
		$this->set('egresos', $this->paginate());
                if ($this->RequestHandler->isAjax()) {
                    $this->render('ajax/index');
                }
                $this->set('tipoFacturas', $this->Egreso->TipoFactura->find('list'));
                $this->set('users', $this->Egreso->User->listarPorNombre('%'));
	}


        function ajax_agregar_gasto() {
            if (!empty($this->request->data)) {
                    $this->Egreso->create();
                    if ($this->Egreso->save($this->request->data)) {
                            $this->Session->setFlash(__('The Egreso has been saved'));
                            
                    } else {
                            $this->Session->setFlash(__('The Egreso could not be saved. Please, try again.'));
                            debug($this->Egreso->validationErrors);

                            $tx = "¡No se pudo guardar! Alguno de los campos ingresados es incorrecto";
                            exit("<div class='message' id='flashMessage'>$tx</div>");
                    }
            }
            $this->redirect('/egresos/index');
        }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Egreso'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('egreso', $this->Egreso->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Egreso->create();
			if ($this->Egreso->save($this->request->data)) {
				$this->Session->setFlash(__('The Egreso has been saved'));
				//die("lo mate");
                                $this->redirect('/egresos/index');
                                /*
                                if ($this->RequestHandler->isAjax()) {
                                    $this->Egreso->recursive = 0;
                                    $this->set('egresos', $this->paginate());
                                    $this->render('ajax/index');
                                }
                                 */
			} else {
				$this->Session->setFlash(__('The Egreso could not be saved. Please, try again.'));

                                if ($this->RequestHandler->isAjax()) {
                                    $this->Session->setFlash(__('Los valores ingresados son incorrectos.'));
                                    $this->Egreso->recursive = 0;
                                    $this->set('egresos', $this->paginate());
                                    $this->render('ajax/add');
                                }

			}
		}

               
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Egreso'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Egreso->save($this->request->data)) {
				$this->Session->setFlash(__('The Egreso has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Egreso could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Egreso->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Egreso'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Egreso->delete($id)) {
			$this->Session->setFlash(__('Egreso deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Egreso could not be deleted. Please, try again.'));
		$this->redirect(array('action' => 'index'));
	}

}
?>