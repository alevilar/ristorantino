<?php

App::uses('AccountAppModel', 'Account.Model');


class Egreso extends AccountAppModel {

	public $name = 'Egreso';

    public $actsAs = array(
        'Search.Searchable',
        'Containable',
        );

    public $order = array(
        'Egreso.fecha' => 'DESC', 
        'Egreso.modified' => 'DESC'
        );
    
    public $files = array(
        '_file' => 'file'
    );
    
    public $validate = array(
        'total' => array(
        		'numeric' => array(
                    'on' => 'create',
        			'rule' => 'numeric',
        			'allowEmpty' => false,
                    'required' => true,
        			'message' => 'Debe ingresar un numero'
        		),
                'gastos_pagos' => array(
                    'on' => 'create',
                    'rule' => 'gastos_pagos',
                    'message' => 'Sus gastos ya estan pagos. No puede volver a pagarlos.',
                ),
        	),
        'fecha' => array(
        		'datetime' => array(
        			'rule' => array('datetime', 'ymd'),
                    'message' => 'Ingrese una fecha válida',
                    'allowEmpty' => false,
        			'required' => true,
        		)
                ),
	);
        
	public $belongsTo = array('Risto.TipoDePago');

//        public $hasMany = array('Account.EgresoGasto');
        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasAndBelongsToMany = array(
            'Gasto' => array(
                'className' => 'Account.Gasto',
    			'joinTable' => 'account_egresos_gastos',
    			'foreignKey' => 'egreso_id',
    			'associationForeignKey' => 'gasto_id',
    			'unique' => true,
    			'conditions' => '',
    			'fields' => '',
    			'order' => '',
    			'limit' => '',
    			'offset' => '',
    			'finderQuery' => '',
    			'deleteQuery' => '',
    			'insertQuery' => ''
                    ),
            
	);



    public $filterArgs = array(
        'cierre_id' => array(
            'type' => 'value',
            'field' => 'Gasto.cierre_id'
            ),
        'proveedor_id' => array(
            'type' => 'value',
            'field' => 'Gasto.proveedor_id'
            ),
        'clasificacion_id' => array(
            'type' => 'value',
            'field' => 'Gasto.clasificacion_id'
            ),

        'fecha_desde' => array(
            'type' => 'value',
            'field' => 'DATE(Egreso.fecha) >='
            ),
        'fecha_hasta' => array(
            'type' => 'value',
            'field' => 'DATE(Egreso.fecha) <='
            ),
        'importe_neto' => array(
            'type' => 'value',
            ),
        );
        
        
        function add($gasto_id){
            $gastos = array();
            if (!empty($gasto_id)) {
                $gastos[$gasto_id] = $gasto_id;
            }
            if(!empty($this->data['Gasto']['seleccionados'])){
                
            }
        }
        
        function pagosDelDia($dateDesde, $dateHasta = null){
            if (empty($dateHasta)){
                $dateHasta = $dateDesde;
                
            }
            $egreso = $this->find('all', array(
              'fields'  => array(
                  'DATE(Egreso.fecha) as fecha',
                  'sum(Egreso.total) as importe'
              ),
              'conditions' => array(
                  'DATE(Egreso.fecha) >=' => $dateDesde,
                  'DATE(Egreso.fecha) <=' => $dateHasta,
              ),
              'group' => array('DATE(Egreso.fecha)'),
            ));
            $salida = array();
            foreach ($egreso as $e){
                $salida[] = array(
                    'Egreso' => array(
                        'importe' => $e[0]['importe'],
                        'fecha' => $e[0]['fecha'],
                    )
                );
            }
            return $salida;
        }
        
        
        public function afterSave($created,  $options = array()) {
            if (!$created) return true;
            
            // convierte el HABTM en HasMany
            $join = 'AccountEgresosGasto';
            $this->bindModel( array('hasMany' => array($join)) );
            
            // Cuando se realiza un egreso se van procesando cada
            // salida para verificar quel dicho egreso cubra el gasto
            // a medida que va cubriendo, el gasto es marcado como "pagado"
            $gastos = $this->Gasto->find('list', array(
                'fields' => array('Gasto.id', 'Gasto.importe_total'),
                'recursive' => -1,
                'conditions' => array(
                    'Gasto.id' => $this->data['Gasto']['Gasto'],
                )
            ));
            
            $totalEgresoDisponible = $this->data['Egreso']['total'];
            
            // Primero cobro las que tienen importe nbegativo, por ejemplo las Notas de Credito
            // estas no pueden quedar con un saldo parcial
            // estas suman al total que falta por pagar en lugar de ir restandolo
            foreach ($gastos as $gastoId=>$gastoImporteTotal) {
               if ($gastoImporteTotal <= 0) {
                   $importeParcialDeEsteGasto = $gastoImporteTotal - $this->Gasto->importePagado( $gastoId );

                    $this->{$join}->create(array(
                          'gasto_id' => $gastoId,
                          'egreso_id'  => $this->id,
                          'importe'  => $importeParcialDeEsteGasto,
                         ));         
                    $this->{$join}->save();
                    
                    $totalEgresoDisponible -= $importeParcialDeEsteGasto;
               }
            }
            
            // Luego cobro el resto, que van saldando el pago y pueden quedar sin saldar completamente
            foreach ($gastos as $gastoId=>$gastoImporteTotal) {
               if ($gastoImporteTotal > 0) {
                    $importeParcialDeEsteGasto = $gastoImporteTotal - $this->Gasto->importePagado( $gastoId );
                    
                    if ( $importeParcialDeEsteGasto > $totalEgresoDisponible ) {
                        $importeParcialDeEsteGasto = $totalEgresoDisponible;
                    }
                    $this->{$join}->create(array(
                          'gasto_id' => $gastoId,
                          'egreso_id'  => $this->id,
                          'importe'  => $importeParcialDeEsteGasto,
                         ));         
                    $this->{$join}->save();
                    
                    $totalEgresoDisponible -= $importeParcialDeEsteGasto;

                    if ($totalEgresoDisponible < 0) break;
                }
               
            }
            return true;
	}
        
        
        function beforeSave($options = array())
        {
            parent::beforeSave($options);
           
            list($join) = $this->joinModel($this->hasAndBelongsToMany['Gasto']['with']);
            $this->unbindModel( array('hasAndBelongsToMany' => array('Gasto')) );
//            $this->bindModel( array('hasMany' => array($join)) );
            
            return true;
            
        }
        
        
        /**
         * Verifica que el egreso no se realizara sobre un gasto que ya esta marcado como pagado
         * @return boolean
         */
        function gastos_pagos(){
            $gastosDeuda = $this->Gasto->enDeuda();
            $gastosSeleccionados = $this->data['Gasto']['Gasto'];

            foreach ($gastosSeleccionados as $gs){
                if (in_array($gs, $gastosDeuda)){
                    return false;
                }
            }
            return true;
        }
}
?>