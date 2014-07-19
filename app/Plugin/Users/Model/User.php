<?php
App::uses('UsersAppModel', 'Users.Model');
/**
 * User Model
 *
 * @property Rol $Rol
 * @property Cliente $Cliente
 * @property Egreso $Egreso
 * @property Mozo $Mozo
 */
class User extends UsersAppModel {
/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'username';

 /**
 * Act As Behaviour
 *
 * @var array
 */       
        public $actsAs = array('Acl' => array('type' => 'requester'));
        
        
        
/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'username' => array(
            'notempty' => array(
                'rule' => array(
                                    'notempty',
                                    ),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
                    'isUnique' => array(
                'rule' => array(
                                    'isUnique',
                                    ),
                'message' => 'Alguien tiene este nombre de usuario y no se puede repetir',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
                        'comparePassword' => array(
                            'rule' => array('comparePassword'),
                            'message' => 'No coinciden las contraseñas',
                        )
        ),
        'rol_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'Rol' => array(
            'className' => 'Rol',
            'foreignKey' => 'rol_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        
    );
               
        
        public function comparePassword($coso) {          
            if ( !empty($this->request->data['User']['password']) && !empty( $this->request->data['User']['password_check'] )  ) {
                $pass1 = AuthComponent::password($this->request->data['User']['password']);
                $pass2 = AuthComponent::password( $this->request->data['User']['password_check'] );
                
                if ($pass1 != $pass2){
                    return false;
                }
            }
            return true;
        }

        public function beforeSave($options = array()) {
            if ( !empty($this->request->data['User']['password']) ) {
                $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
            }

            return parent::beforeSave($options);
        }
        
        public function afterSave($created, $options = array())
        {
            if ($created && !empty($this->request->data['User']['username']) ) {
                // colocar el nombre del rol como alias den Aro ACL
                if ( $this->Aro->saveField('alias', $this->request->data['User']['username']) ) { 
                    return parent::afterSave($created);
                } else {
                    return false;
                }
            }
        }
        
        
        function parentNode() {
            if (!$this->id && empty($this->request->data)) {
                return null;
            }
            $data = $this->request->data;
            if (empty($this->request->data)) {
                $data = $this->read();
            }
            if (!$data['User']['rol_id']) {
                return null;
            } else {
                return array('Rol' => array('id' => $data['User']['rol_id']));
            }
        }
}