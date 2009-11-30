<?php

/******
 * 
 * 
 * 
 * expresion regular para validar CUIT o CUIL
 * 			^[0-9]{2}-[0-9]{8}-[0-9]$
 * 
 */



class Cliente extends AppModel {

	var $name = 'Cliente';
	

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Descuento' => array('className' => 'Descuento',
								'foreignKey' => 'descuento_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Mesa' => array('className' => 'Mesa',
								'foreignKey' => 'cliente_id',
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

	
	
	
	
	var $validate = array(
		'imprime_ticket' => array('boolean'),
	
		'nombre' => array(
	                        'nombre_no_vacio_si_es_factura_a' => array(
	                                'rule' => 'nombre_no_vacio_si_es_factura_a',
	                                'message'=> 'El nombre no puede quedar vacio cuando se quiere hacer una factura "A".'
	                        )
		),
		
		'nrodocumento' => array(
	                        'cuit_o_cuil_valido_si_tipodoc_es_cuit' => array(
	                                'rule' => 'cuit_o_cuil_valido_si_tipodoc_es_cuit',
	                                'required' => true,
	                                'allowEmpty' => true,
	                                'message' => 'El Nº de CUIT no es válido'
	                        ),
	                        'number' => array(
                                'rule' => VALID_NUMBER,
                                'required' => true,
                                'allowEmpty' => true,
                                'message' => 'Debe ingresar un valor numérico.'
                       		 ),
	                        
		),
		
		'tipodocumento' =>array(
							'tipodocumento' => array(
								 'rule' => 'tipodocumento_valido',
								 'message' => 'El Tipo de Documento no es válido. (C: CUIT, L: CUIL, 2:DNI, 4:CI, y hay mas....)'
							)
		),
		
		'responsabilidad_iva' =>array(
							'responsabilidad_iva' => array(
								 'rule' => 'responsabilidad_iva_valido',
								 'message' => 'El código de resposabilidad frente IVA no es válido. (I: Resp. Inscripto,E, excento, A: no responsable, C: Consumidor final)'
							)
		)
	);
	
	
	
	
	function nombre_no_vacio_si_es_factura_a(){
		if(!empty($this->data['Cliente']['tipofactura'])){
			if($this->data['Cliente']['tipofactura'] == 'A' && empty($this->data['Cliente']['nombre'])){
				return false;
			}
		}
		return true;
	}
	
	
	
	function cuit_o_cuil_valido_si_tipodoc_es_cuit(){
		if(!empty($this->data['Cliente']['tipofactura'])){
			if($this->data['Cliente']['tipofactura'] == 'A'){			
				 if(!preg_match('/^[0-9]{2}[0-9]{8}[0-9]$/', $this->data['Cliente']['nrodocumento'])) return false;
				 else return true;
			}
		}
		return true;
	}
	
	
	
	function tipodocumento_valido(){
		if(!empty($this->data['Cliente']['tipofactura'])){
			if($this->data['Cliente']['tipofactura'] == 'A'){
				if(	$this->data['Cliente']['tipodocumento'] == 'C' ||
					$this->data['Cliente']['tipodocumento'] == 'L' ||
					$this->data['Cliente']['tipodocumento'] == '0' ||
					$this->data['Cliente']['tipodocumento'] == '1' ||
					$this->data['Cliente']['tipodocumento'] == '2' ||
					$this->data['Cliente']['tipodocumento'] == '3' ||
					$this->data['Cliente']['tipodocumento'] == '4' ||
					$this->data['Cliente']['tipodocumento'] == ' '){
						return true;
					}
					else return false;
			}
		}
		return true;
	}
	
	
	
	function responsabilidad_iva_valido(){
		if(!empty($this->data['Cliente']['tipofactura'])){
			if($this->data['Cliente']['tipofactura'] == 'A'){
				if(	$this->data['Cliente']['responsabilidad_iva'] == 'I' ||
					$this->data['Cliente']['responsabilidad_iva'] == 'E' ||
					$this->data['Cliente']['responsabilidad_iva'] == 'A' ||
					$this->data['Cliente']['responsabilidad_iva'] == 'C' ||
					$this->data['Cliente']['responsabilidad_iva'] == 'T'){
						return true;
					}
					else return false;
			}
		}
		return true;		
	}
}
?>