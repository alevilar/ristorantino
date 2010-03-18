<?php
class GastosController extends AppController {

	var $name = 'Gastos';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript', 'Paginator');
        //var $components = array ('Pagination'); // Added

	function index() {
		$this->Gasto->recursive = 0;
		$this->set('gastos', $this->paginate());
                if ($this->RequestHandler->isAjax()) {
                    $this->render('ajax/index');
                }
	}


        function ajax_agregar_gasto() {
            if (!empty($this->data)) {
                    $this->Gasto->create();
                    if ($this->Gasto->save($this->data)) {
                            $this->Session->setFlash(__('The Gasto has been saved', true));
                            $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The Gasto could not be saved. Please, try again.', true));
                    }
            }
        }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Gasto', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('gasto', $this->Gasto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Gasto->create();
			if ($this->Gasto->save($this->data)) {
				$this->Session->setFlash(__('The Gasto has been saved', true));
				//die("lo mate");
                                $this->redirect('/gastos/index');
                                /*
                                if ($this->RequestHandler->isAjax()) {
                                    $this->Gasto->recursive = 0;
                                    $this->set('gastos', $this->paginate());
                                    $this->render('ajax/index');
                                }
                                 */
			} else {
				$this->Session->setFlash(__('The Gasto could not be saved. Please, try again.', true));

                                if ($this->RequestHandler->isAjax()) {
                                    $this->Session->setFlash(__('Los valores ingresados son incorrectos.', true));
                                    $this->Gasto->recursive = 0;
                                    $this->set('gastos', $this->paginate());
                                    $this->render('ajax/add');
                                }

			}
		}

               
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Gasto', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Gasto->save($this->data)) {
				$this->Session->setFlash(__('The Gasto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Gasto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gasto->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Gasto', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Gasto->del($id)) {
			$this->Session->setFlash(__('Gasto deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Gasto could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>