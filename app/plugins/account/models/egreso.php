<?php
class Egreso extends AccountAppModel {

	var $name = 'Egreso';
        var $order = array('Egreso.fecha' => 'DESC', 'Egreso.modified' => 'DESC');
        
        var $validate = array(
                'total' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'allowEmpty' => false,
                                'required' => true,
				'message' => 'Debe ingresar un numero'
			),
                        'gastos_pagos' => array(
                            'rule' => 'gastos_pagos',
                            'message' => 'Sus gastos ya estan pagos. No puede volver a pagarlos.',
                        ),
		),
                'fecha' => array(
			'date' => array(
				'rule' => 'date',
                                'message' => 'Ingrese una fecha válida',
                                'allowEmpty' => false,
				'required' => true,
			)
                    ),
	);
        
	var $belongsTo = array('TipoDePago');

//        var $hasMany = array('Account.EgresoGasto');
        
        //The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
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
        
        
        function afterSave($created) {
            // convierte el HABTM en HasMany
            $join = 'AccountEgresosGasto';
            $this->bindModel( array('hasMany' => array($join)) );
            
            $thisId = $this->id;
            
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
            $total = $this->data['Egreso']['total'];
            $pagado = 0;
            foreach ($gastos as $gastoId=>$gastoImporteTotal) {
               $paraPagar = $gastoImporteTotal - $this->Gasto->importePagado( $gastoId ) ;
               $loQueHabriaQuePagar = $total-$pagado;
               if ($loQueHabriaQuePagar > 0) {
                   if ($paraPagar  > $loQueHabriaQuePagar) {
                       $paraPagar = $loQueHabriaQuePagar;
                   }
                   $pagado += $paraPagar;
                   
                   $this->{$join}->create(array(
                        'gasto_id' => $gastoId,
                        'egreso_id'  => $thisId,
                        'importe'  => $paraPagar,
                       ));         
                    $this->{$join}->save();
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