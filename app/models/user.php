<?php
class User extends AppModel {

	var $name = 'User';
        var $displayField = 'username';
        var $actsAs = array('Acl' => array('type' => 'requester'));
	
	var $validate = array(
	
		'username' => array(
			'required' => VALID_NOT_EMPTY,
			'isUnique' => array(
                            'rule'=>'isUnique',
                            'message' => 'El nombre de usuario ya existe'),
		),
		'password' => array('notempty'),
		'nombre' => array('notempty'),
                'role'=> array(
			'required' => VALID_NOT_EMPTY,
		),
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



        function parentNode() {
            return null;
        }

        function parentNodeId() {
           if (!$this->id && empty($this->data)) {
               return null;
           }

           $aro = $this->Aro->find('all', array('fields' => array('parent_id'),
                                'conditions'=>array('foreign_key'=>$this->id)));

           return $aro[0]['Aro']['parent_id'];
           //return array('Group' => array('id' => $data['User']['group_id']));
        }

        function getParentNode($id) {
            if (!$id) {
               return null;
           }

           $aro = $this->Aro->find('all', array('fields' => array('id'),
                                    'conditions'=>array('foreign_key'=>$id)));
           $aro_parent = $this->Aro->getparentnode($aro[0]['Aro']['id']);

           return $aro_parent;
        }

	/**
         * After save callback
         *
         * Update the aro for the user.
         *
         * @access public
         * @return void
         */
        function afterSave($created) {
                if (!$created) {
                    $node = $this->node();
                    $aro = $node[0];
                    if (!empty($this->data['User']['grupo'])) {
                        $aro['Aro']['parent_id'] = $this->data['User']['grupo'];
                    }
                    $this->Aro->save($aro);
                }
                else {
                    $node = $this->node();
                    $aro = $node[0];
                    if (!empty($this->data['User']['username'])) {
                        $aro['Aro']['alias'] = $this->data['User']['username'];
                    }
                    if (!empty($this->data['User']['grupo'])) {
                        $aro['Aro']['parent_id'] = $this->data['User']['grupo'];
                    }
                    $this->Aro->save($aro);
                }
        }
        

}
?>