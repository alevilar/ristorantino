<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
                
        public $paginate = array(
            'limit' => 55,
        );
       
        
        
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
 * index method
 *
 * @return void
 */
	public function index() {
                if ( $this->request->is('post') && !empty($this->data['User']['txt_buscar']) ){
                    $this->paginate['conditions'] = array('or' => array(
                        'lower(User.username) LIKE' => '%'. strtolower( $this->data['User']['txt_buscar'] ) .'%',
                        'lower(User.nombre) LIKE'   => '%'. strtolower( $this->data['User']['txt_buscar'] ) .'%',
                        'lower(User.apellido) LIKE' => '%'. strtolower( $this->data['User']['txt_buscar'] ) .'%',
                    ));
                }
                
		$this->set('users', $this->paginate());
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
            $this->User->id = $id;
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
                    $this->request->data = $this->User->read();
            }
	}


/**
	 *  Este es para que un usuario se edite el perfil
	 *
	 * @param id del usuario
	 */
	function cambiar_password($id){
		if (!empty($this->request->data)) {
                    if ($this->User->save( $this->request->data )) {
                            $this->Session->setFlash(__('Se ha guardado el nuevo password correctamente', true));
                            $this->redirect('/');
                    } else {
                            $this->Session->setFlash(__('La contraseña no pudo ser guardada. Por favor, intente nuevamente.', true));
                    }
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->User->read(null, $id);
		}
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
        

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post') || $this->request->is('put')) {
                        $this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Rol->find('list');
                $title_for_layout = __('Add New User');
		$this->set(compact('roles', 'title_for_layout'));
                $this->render('edit');
	}
        
       
        
        
/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Rol->find('list');
		$this->set(compact('roles'));
	}
        
        
        /**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {           
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        
/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}        

}
?>