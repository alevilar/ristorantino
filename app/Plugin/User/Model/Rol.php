<?php
App::uses('UserAppModel', 'User.Model');
/**
 * Rol Model
 *
 * @property User $User
 */
class Rol extends UserAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
        
        
        public $actsAs = array('Acl' => array('type' => 'requester'));
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User.User',
			'foreignKey' => 'rol_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
        
        public function beforeSave($options = array()) {
            $this->data['Rol']['machin_name'] = strtolower( Inflector::slug( $this->data['Rol']['name'])) ;
            return true;
        }
        
        public function afterSave($created, $options = Array())
        {
            // colocar el nombre del rol como alias den Aro ACL
            if ( $this->Aro->saveField('alias', $this->data['Rol']['machin_name']) ) { 
                return parent::afterSave($created);
            } else {
                return false;
            }
        }
        
        public function parentNode(){
            return;
        }

}
