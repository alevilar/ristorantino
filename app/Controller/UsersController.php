<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
        var $scaffold;

        
        public function beforeFilter() {
            parent::beforeFilter();
        }
        	

        function listar_x_nombre($nombre = '') {
            if (empty($nombre)) {
                if (!empty($this->request->data['User']['name'])){
                    $nombre = $this->request->data['User']['name'];
                }
            }
            $this->set('users', $this->User->listarPorNombre($nombre));
	}

	
	     /**
         * 
         *   Cosas de Authentication
         * 
         */
        public function login() {
            if ($this->request->is('post')) {
                if ($this->Auth->login()) {
                    $this->User->id = $this->Session->read( 'Auth.User.id');
                    $usr = $this->User->read();       
                    $this->Session->write( 'Auth.User.rol', strtolower( Inflector::Slug($usr['Rol']['machin_name']) ) );
                    return $this->redirect($this->Auth->redirect());
                } else {
                    $this->Session->setFlash('Usuario o contraseña incorrectos', 'default', array(), 'auth');
                }
            }
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
		if (!$id && empty($this->request->data) || $id != $this->Auth->user('id')) {
			$this->Session->setFlash(__('Usuario Incorrecto', true));
			$this->redirect('/pages/home');
		}
		if (!empty($this->request->data)) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Se ha guardado la información correctamente', true));
				$this->request->data = $this->User->read(null, $id);
			} else {
				$this->Session->setFlash(__('El usuario no pudo ser guardado. Por favor, intente nuevamente.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->User->read(null, $id);
                        $this->request->data['User']['grupo'] =$this->User->parentNodeId();
		}
	}


/**
	 *  Este es para que un usuario se edite el perfil
	 *
	 * @param id del usuario
	 */
	function cambiar_password($id){
		if (!empty($this->request->data)) {
			if($this->comparePasswords()){ //me fijo que los passwords coincidan
				if ($this->User->save($this->request->data, $validate = false)) {
					$this->Session->setFlash(__('Se ha guardado el nuevo password correctamente', true));
					$this->redirect('/');
				} else {
                                    debug($this->User->validationErrors);
					$this->Session->setFlash(__('La contraseña no pudo ser guardada. Por favor, intente nuevamente.', true));
				}
			}
			else $this->Session->setFlash('La contraseña no coincide, por favor reintente.');
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->User->read(null, $id);
		}
	}


	/**
	 *  Esta funcion me convierte los passwors para luego ser comparados
	 *  sirve cuando quiero generar un nuevio opassword y tengo 2 imputs por comparar
	 * @return unknown_type
	 */
	private function comparePasswords(){
		if(!empty( $this->request->data['User']['password'] ) ){
			$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password'] );
		}
		if(!empty( $this->request->data['User']['password_check'] ) ){
			$this->request->data['User']['password_check'] = $this->Auth->password( $this->request->data['User']['password_check'] );
		}

		if ($this->request->data['User']['password'] == $this->request->data['User']['password_check']){
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