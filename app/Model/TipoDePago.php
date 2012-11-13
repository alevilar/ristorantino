<?php

App::uses('AppModel', 'Model');

/**
 * TipoDePago Model
 *
 * @property Pago $Pago
 */
class TipoDePago extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    
    public $recursive = -1;
    
    public $actsAs = array(
        'FileUpload.FileUpload' => array(
            'fields' => array('name' => 'image_url', 'type' => 'file_type', 'size' => 'file_size'),
        )
    );
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
                'rule' => array('check_upload_error'),
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

}
