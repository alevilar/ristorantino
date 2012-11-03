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
        
        public $actsAs = array('Search.Searchable');
        
        public $filterArgs = array(
			'nombre' => array('type' => 'like'),
			'nrodocumento' => array('type' => 'like'),
			'codigo' => array('type' => 'value'),
                        'iva_responsabilidad_id' => array('type' => 'value'),
                        'descuento_id' => array('type' => 'value'),
			'telefono' => array('type' => 'like'),
		);
        
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nombre';
        
        public $virtualFields = array(
            'nombre_nrodocumento' => 'CONCAT(Cliente.nombre, " (", Cliente.nrodocumento, ")")'
        );


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(			
			'Descuento',
			'IvaResponsabilidad',
			'TipoDocumento',
	);

	var $hasMany = array(
			'Mesa'
	);
	
	var $validate = array(
		'imprime_ticket' => array('boolean'),
	
		'nombre' => array(
                            'notempty' => 'notempty',
                            'required' => true
		),
		
                'mail' => array(
                        'rule' => 'email',
                        'message' => 'Formato de mail incorrecto',
                        'allowEmpty' => true,
                ),
            
		'nrodocumento' => array(
	                        'cuit_o_cuil_valido_si_tipodoc_es_cuit' => array(
	                                'rule' => 'cuit_o_cuil_valido_si_tipodoc_es_cuit',
	                                'required' => true,
	                                'allowEmpty' => true,
	                                'message' => 'El Nº de CUIT no es válido'
	                        ),
	                        'number' => array(
                                    'rule' => 'numeric',
                                    'allowEmpty' => true,
                                    'message' => 'Debe ingresar un valor numérico.'
                       		 ),
	                        
		),
		
		'tipo_documento_id' =>array(
                                'tipodocumento' => array(
                                     'rule' => 'tipodocumento_valido',
                                     'message' => 'El Tipo de Documento no es válido. Para hacer factura A hay que poner el CUIT'
                                )
		),
		
		'iva_responsabilidad_id' =>array(
                                'responsabilidad_iva' => array(
                                     'rule' => 'responsabilidad_iva_valido',
                                     'message' => 'El código de responsabilidad frente IVA no es válido al hacer Factura A solo se permite responsable Inscripto y Exento'
                                )
		)
	);
	
	
	
        function cuit_o_cuil_valido_si_tipodoc_es_cuit() {
            if(!empty($this->data['Cliente']['tipo_documento_id'])) {
                if($this->data['Cliente']['tipo_documento_id'] == 1) {
                    $cuit = $this->data['Cliente']['nrodocumento'];

                    $coeficiente[0]=5;
                    $coeficiente[1]=4;
                    $coeficiente[2]=3;
                    $coeficiente[3]=2;
                    $coeficiente[4]=7;
                    $coeficiente[5]=6;
                    $coeficiente[6]=5;
                    $coeficiente[7]=4;
                    $coeficiente[8]=3;
                    $coeficiente[9]=2;

                    $ok = true;
                    $resultado=1;
                    $cuit_rearmado = "";

                    for ($i=0; $i < strlen($cuit); $i= $i +1) {    //separo cualquier caracter que no tenga que ver con numeros
                        if ((Ord(substr($cuit, $i, 1)) >= 48) && (Ord(substr($cuit, $i, 1)) <= 57)) {
                            $cuit_rearmado = $cuit_rearmado . substr($cuit, $i, 1);
                        }
                    }

                    if (strlen($cuit_rearmado) <> 11) {  // si to estan todos los digitos
                        $ok=false;
                    } else {
                        $sumador = 0;
                        $verificador = substr($cuit_rearmado, 10, 1); //tomo el digito verificador

                        for ($i=0; $i <=9; $i=$i+1) {
                            $sumador = $sumador + (substr($cuit_rearmado, $i, 1)) * $coeficiente[$i];//separo cada digito y lo multiplico por el coeficiente
                        }

                        $resultado = $sumador % 11;
                        if ($resultado != 0) {
                            $resultado = 11 - $resultado;  //saco el digito verificador
                        }
                        
                        $veri_nro = intval($verificador);

                        if ($veri_nro == $resultado) {
                            $ok = true;
                            $cuit_rearmado = substr($cuit_rearmado, 0, 2) . "-" . substr($cuit_rearmado, 2, 8) . "-" . substr($cuit_rearmado, 10, 1);
                        } else {
                            $ok=false;
                        }
                    }

                    return $ok;
                }
            }
            return true;
        }
	
	
	
	function tipodocumento_valido(){
		if(!empty($this->data['Cliente']['tipofactura'])){
			if($this->data['Cliente']['tipofactura'] == 'A'){
				// tiene que ser un CUIT si o si para hacer factura A
				if(	$this->data['Cliente']['tipo_documento_id'] == 1){  // '-'
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
				if(	$this->data['Cliente']['iva_responsabilidad_id'] == 1 || // 'I'
					$this->data['Cliente']['iva_responsabilidad_id'] == 2  // 'E'
					//$this->data['Cliente']['iva_responsabilidad_id'] == 3 || // 'A'
					//$this->data['Cliente']['iva_responsabilidad_id'] == 4 || // 'C'
					//$this->data['Cliente']['iva_responsabilidad_id'] == 5    // 'T'
					){  
						return true;
					}
					else return false;
			}
		}
		return true;		
	}
	
	
	
	/**
	 * Me devuelve la responsabilidad del cliente frente el IVA
	 * 
	 * @return array find(first) con Cliente e IvaResponsabilidad
	 */
	function getResponsabilidadIva($id = 0){
		if($id == 0){
		 $id = $this->id;
		}
		$ret = $this->find('first',array('conditions'=>array('Cliente.id'=>$id),'contain'=>array('IvaResponsabilidad')));
		return $ret;
	}
	
	
	
	/**
	 * Me devuelve la responsabilidad del cliente frente el IVA
	 * 
	 * @return array find first con Cliente y TipoDocumento
	 */
	function getTipoDocumento($id = 0){
		if($id == 0){
		 $id = $this->id;
		}
		$ret = $this->find('first',array('conditions'=>array('Cliente.id'=>$id),'contain'=>array('TipoDocumento')));
		return $ret;
	}
        
        
        
        function todos($type = 'all', $limitarDescuento = false){
                $conds = array();
                if ($limitarDescuento) {
                    $descMax = Configure::read('Mozo.descuento_maximo');
                    if ( isset($descMax) ) {
                        $conds['Descuento.porcentaje <='] = $descMax;
                    }
                }
                $clientes = $this->find($type, array(
                    'order'      => 'Cliente.nombre',
//                    'limit' => 10,
                    'conditions' => $conds,
                    'contain' => array(
                        'Descuento'
                    ),
                ));
                
                return $clientes;
        }
        
        
        function todosLosTipoA($type = 'all'){
                $clientes = $this->find($type, array(
                    'order'      => 'Cliente.nombre',
                    'conditions' => array('Cliente.tipofactura' => 'A'),
                ));
                return $clientes;
        }
        
        function todosLosDeDescuentos($type = 'all', $limitarDescuento = false){
                $conds = array('Cliente.tipofactura <>' => 'A');
                
                if ($limitarDescuento) {
                    $conds['Descuento.porcentaje <='] = Config::read('Mozo.descuento_maximo');
                }
                
		$ops = array(
                    'conditions'=>$conds,
                    'order' => 'Cliente.nombre',
                    'contain' => array(
                        'Descuento'
                    ),
		);
                $clientes = $this->find($type, $ops);
                return $clientes;
        }
}
?>