<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');

        var $roles = array(
            'principiante'=> 'Usuario Principiante',
            'adicionista' => 'Adicionista',
            'gerente'     => 'Gerente',
            'mozo'        => 'Mozo',
            'cliente'     => 'Cliente',
            'proveedor'   => 'Proveedor',
            );

        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Admin','link'=>'/pages/administracion' );
        }
        
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

        function listar_x_nombre($nombre = '') {
            if (empty($nombre)) {
                if (!empty($this->data['User']['name'])){
                    $nombre = $this->data['User']['name'];
                }
            }
            $this->set('users', $this->User->listarPorNombre($nombre));
	}

	function view($id = null) {
             $this->rutaUrl_for_layout[] =array('name'=> 'Usuarios','link'=>'/users' );
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
             $this->rutaUrl_for_layout[] =array('name'=> 'Usuarios','link'=>'/users' );
             if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
                $this->Acl->Aro->recursive = 0;
                $aros = $this->Acl->Aro->find('list', array('fields' => array('alias'), 'conditions'=>array('parent_id'=>1), 'order'=>'alias'));
                $this->set(compact('aros'));
                $this->set('roles', $this->roles);
	}

	function edit($id = null) {
             $this->rutaUrl_for_layout[] =array('name'=> 'Usuarios','link'=>'/users' );
                if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
                $this->Acl->Aro->recursive = 0;
                $aros = $this->Acl->Aro->find('list', array('fields' => array('alias'), 'conditions'=>array('parent_id'=>1), 'order'=>'alias'));
                $this->set(compact('aros'));
                $this->set('roles', $this->roles);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	     /**
         * 
         *   Cosas de Authentication
         * 
         */
        function login(){
                
        }
        
        
        function logout(){
                $this->Session->setFlash('Ha salido de su cuenta');
                $this->redirect($this->Auth->logout());
        }


        /**
	 *  Este es para que un usuario se edite el perfil
	 *
	 * @param id del usuario
	 */
	function self_user_edit($id){
             $this->rutaUrl_for_layout[] =array('name'=> 'Usuarios','link'=>'/users' );
		if (!$id && empty($this->data) || $id != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Usuario Incorrecto', true));
			$this->redirect('/pages/home');
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('Se ha guardado la información correctamente', true));
				$this->data = $this->User->read(null, $id);
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser guardado. Por favor, intente nuevamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
                        $this->data['User']['grupo'] =$this->User->parentNodeId();
		}
	}


/**
	 *  Este es para que un usuario se edite el perfil
	 *
	 * @param id del usuario
	 */
	function cambiar_password($id){
             $this->rutaUrl_for_layout[] =array('name'=> 'Usuarios','link'=>'/users' );
		if (!empty($this->data)) {
			if($this->comparePasswords()){ //me fijo que los passwords coincidan
				if ($this->User->save($this->data, $validate = false)) {
					$this->Session->setFlash(__('Se ha guardado el nuevo password correctamente', true));
					$this->redirect('/');
				} else {
                                    debug($this->User->validationErrors);
					$this->Session->setFlash(__('La contraseña no pudo ser guardada. Por favor, intente nuevamente.', true));
				}
			}
			else $this->Session->setFlash('La contraseña no coincide, por favor reintente.');
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}


	/**
	 *  Esta funcion me convierte los passwors para luego ser comparados
	 *  sirve cuando quiero generar un nuevio opassword y tengo 2 imputs por comparar
	 * @return unknown_type
	 */
	private function comparePasswords(){
		if(!empty( $this->data['User']['password'] ) ){
			$this->data['User']['password'] = $this->Auth->password($this->data['User']['password'] );
		}
		if(!empty( $this->data['User']['password_check'] ) ){
			$this->data['User']['password_check'] = $this->Auth->password( $this->data['User']['password_check'] );
		}

		if ($this->data['User']['password'] == $this->data['User']['password_check']){
			return true;
		} else return false;
	}



        function verificar(){
            debug($this->User->Aro->verify());
            die("termino");
        }


        function arreglar(){
        debug($this->User->Aro->verify());
        debug($this->User->Aro->recover());
        debug($this->User->Aro->verify());
            die("termino");
        }


	function listadoUsuarios() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

}
?>