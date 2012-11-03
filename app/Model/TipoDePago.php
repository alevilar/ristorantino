<?php
App::uses('AppModel', 'Model');
/**
 * TipoDePago Model
 *
 * @property Pago $Pago
 */
class TipoDePago extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
        
        
        public $imageFolderName = 'tipo_de_pagos';
        
        
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
                'image_file' => array(
                    'check_upload_file' => array(
                        'rule' => array( 'check_upload_error' ),
                        'message' => 'Error al subir archivo',
                    ),
                    'check_file_copy' => array(
                        'rule' => 'check_file',
                        'message' => 'error al copiar archivo en la carpeta',
                    ),
                    'check_folders_permisions' => array(
                        'rule' => 'check_folders_permisions',
                        'message' => 'No hay permisos de escritura para la carpeta',
                    )
                )
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Pago' => array(
			'className' => 'Pago',
			'foreignKey' => 'tipo_de_pago_id',
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
        
        public function check_upload_error() {
            if ( !empty($this->data['TipoDePago']['image_file']) ) {
              if ( $this->data['TipoDePago']['image_file']['error'] != UPLOAD_ERR_OK ) {
                  return false;
              }
            }
            return true;
        }
        
        public function check_folders_permisions() {
            $path = IMAGES. $this->imageFolderName;
            if (!is_writable( $path )) {
                        return false;
            }
            return true;     
        }

            public function check_file() {
                if (!empty($this->data[$this->name]['image_file'])){
                    $path = IMAGES. $this->imageFolderName . '/';
                    $tmpFile = $this->data[$this->name]['image_file']['tmp_name'];
                    $filePath = $path. $this->data[$this->name]['image_file']['name'];
                    
                    if ( !is_dir($path)) {                        
                        mkdir($path, 0777);
                    }
//                    
//                    if ( file_exists($filePath) ) {                  
//                        $i = 0;
//                        do {
//                            $filePath .= $i++;
//                        } while (file_exists($filePath));
//                    }
                    
                    if ( !move_uploaded_file($tmpFile, $filePath) ) {
                                return false;
                    }
                }
                return true;
            }
            
            public function beforeSave($options = array())
            {
                if (!empty($this->data[$this->name]['image_file'])){
                    $this->data[$this->name]['image_url'] = $this->imageFolderName.'/'.$this->data[$this->name]['image_file']['name'];
                }
                return true;
            }
            
}
