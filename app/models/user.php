<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
	
		'username' => array(
			'required' => VALID_NOT_EMPTY,
			'isUnique' => array(
                            'rule'=>'isUnique',
                            'message' => 'El nombre de usuario ya existe'),
		),
		'password' => array('notempty'),
		'nombre' => array('notempty'),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasOne = array(
			'Mozo' => array('className' => 'Mozo',
								'foreignKey' => 'user_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);


        /**
         *  Realiza una busqueda con un LIKE %NOMBRE%
         * 
         * @param string $nombre
         * @return find('list') con todos los nombres posibles a esa busqueda
         */
        function listarPorNombre($nombre = '') {
            $resultado = array();
            if (!empty($nombre)){
                $conditions = array(
                    'OR' => array(
                        'User.nombre   LIKE'=>"%$nombre%",
                        'User.apellido LIKE'=>"%$nombre%",
                        'User.username LIKE'=>"%$nombre%",
                    ));
                $resultado = $this->find(
                        'list',
                        array(
                            'conditions'=>$conditions,
                            'fields'=> array('id', 'username', 'role'),
                        ));
            }
            return $resultado;
        }

}
?>