<?php


//define('CORTAR_PAPEL','i');

// COMANDOS ESC/P
/*
define('ESC',chr(27));
define('CORTAR_PAPEL',"w");
define('ENFATIZADO',"E1");
define('SACA_ENFATIZADO',"E0");
define('TEXT_STRONG',"");
define('TEXT_NORMAL',"");
define('DOBLE_ALTO',"");
define('SACA_DOBLE_ALTO',"");
*/

// COMANDOS ESC/BEMATECH

define('ESC',chr(27));
define('CORTAR_PAPEL',"w");
define('ENFATIZADO',"E");
define('SACA_ENFATIZADO',"F");
define('TEXT_STRONG',"N4");
define('TEXT_NORMAL',"N2");
define('DOBLE_ALTO',"d1");
define('SACA_DOBLE_ALTO',"d0");


class PrinterComponent extends Object {
	/**
	 * es lo qu me trae el find all de cakephp
	 * @var array comanderas del tipo find('all')
	 */
	var $comanderas = array();

	/*
	 * este es el objeto que viene del Vendors comandos_fiscales
	 * con esto yo generlo los comandos correspndiente para el modelo del controlador fiscal que yo tenga
	 */
	var $generadorComando = null;

	/**
	 *
	 * @var array es el vector de comandos a imprimir
	 */
	var $vcomandos = array();

	/*****
	 *
	 *
	 * Esto es todo para la fiscal
	 */

	
	var $impresoraFiscal = null;
	var $nombreImpresoraFiscal = null;
	var $serverImpresoraFiscal = null;

        /* @var $Controller AppController */
        var $Controller;


        /* @var $Mesa array Mesa->find('first') */
        var $Mesa = array();

        /* variables de estado de impresion */
        var $print_success = true;
        var $imprimio_ticket = false;
        var $tipoticket = 'Ticket Factura "B"';
        var $porcentaje_descuento = 0;
        var $importe_descuento = 0;


        function initialize(&$controller, $settings){
            $this->Controller =& $controller;
            $modeloImpresoraFiscal = Configure::read('ImpresoraFiscal.modelo');

            if (!App::import('Vendor', 'comandos_fiscales'.DS.'comandos_fiscales_'.$modeloImpresoraFiscal)){
                $this->log('Error, el modelo de la impresora fiscal no existe o esta mal configurado');
                debug('Error, el modelo de la impresora fiscal no existe o esta mal configurado');
                return -1;
            }




            $this->generadorComando = new ComandosImpresora();
        }


        function doPrint($mesa_id) {
            $this->Controller->Mesa->id = $mesa_id;

            $this->Mesa = $this->Controller->Mesa->find('first',array(
                'contain'=>array(
                    'Mozo',
                    'Cliente'=>array(
                        'Descuento'
                        )
                    ),
                'condition' => array(
                    'Mesa.id' => $mesa_id
                ),
                )
                    );
            if(empty($this->Mesa['Cliente']) || empty($this->Mesa['Cliente']['id']) ){
                $this->Mesa['Cliente']['tipofactura'] = 'B';
                $this->Mesa['Cliente']['imprime_ticket'] = true;
            }

            $mesa_nro = $this->Controller->Mesa->getNumero();
            $mozo_nro = $this->Controller->Mesa->getMozoNumero();

            $cont  = 0;
            $total = 0;
            $prod = array();
            if ( $this->Mesa['Mesa']['menu'] > 0 ) {
                $prod = $this->Controller->Mesa->getProductosSinDescripcion($this->Mesa['Mesa']['menu']);
            } else {
                $prod = $this->Controller->Mesa->dameProductosParaTicket();
            }
            
            // agregar el valor del cubierto
            $valorCubierto = Configure::read('Restaurante.valorCubierto');
            if ( empty ( $valorCubierto ) ) {
                $valorCubierto = 0;
            }
            if ( $valorCubierto >= 0 && is_numeric($this->Mesa['Mesa']['cant_comensales']) ) {
                $prod[] = array(
                    'nombre'   => 'Cubiertos',
                    'cantidad' => $this->Mesa['Mesa']['cant_comensales'],
                    'precio'   => $valorCubierto,
                            );
            }

            if(!empty($this->Mesa['Cliente']['Descuento']['porcentaje'])) {
                $this->porcentaje_descuento = $this->Mesa['Cliente']['Descuento']['porcentaje'];
                
                $this->importe_descuento = abs($this->Mesa['Mesa']['subtotal'] - $this->Mesa['Mesa']['total']);
            }

            $imprimio = false;
            
            
            //imprimir pre-ticket al cerrar la mesa. Solo si esta configurado asi y la mesa esta cerrada por primera vez (o que aun este abierta)
            if (Configure::read('Mesa.imprimePrimeroRemito') && $this->Controller->Mesa->estaAbierta()){
                    return $this->imprimirTicketConComandera($prod, $mozo_nro, $mesa_nro,$this->porcentaje_descuento);
            } else{
                if ( isset ( $this->Mesa['Cliente']['imprime_ticket']) && $this->Mesa['Cliente']['imprime_ticket'] != 0) {
                    switch($this->Mesa['Cliente']['tipofactura']){
                        case 'A':
                            $ivaresp = $this->Controller->Mesa->Cliente->getResponsabilidadIva($this->Mesa['Cliente']['id']);
                            $this->Mesa['Cliente']['responsabilidad_iva'] = $ivaresp['IvaResponsabilidad']['codigo_fiscal'];

                            $tipodoc = $this->Controller->Mesa->Cliente->getTipoDocumento($this->Mesa['Cliente']['id']);
                            $this->Mesa['Cliente']['tipodocumento'] = $tipodoc['TipoDocumento']['codigo_fiscal'];

                            return $this->imprimirTicketFacturaA($prod, $this->Mesa['Cliente'], $mozo_nro, $mesa_nro, $this->importe_descuento);
                        default:
                            return $this->imprimirTicket($prod, $mozo_nro, $mesa_nro, $this->importe_descuento);
                            break;
                    };   
                }
            }
            // por default imprimir un  pre-ticket, en caso de no pasar ningun parametro
            return $this->imprimirTicketConComandera($prod, $mozo_nro, $mesa_nro,$this->porcentaje_descuento);
        }


	/**
	 * de todas las comanderas cargadas en el arrat $comanderas, me trae la primera que encuentra
	 * que permita imprimir tickets tipo factura
	 *
	 * @return array['Comandera], false si no encuentra ninguna
	 */
	function __find_comandera_que_imprima_tickets(){
		foreach($this->comanderas as $c):
		if($c['Comandera']['imprime_ticket']){
			return $c;
		}
		endforeach;
		return false;
	}



	function __inicio_manual() {
		$comandera =& ClassRegistry::init('Comandera');
		$comandera->recursive = -1;
		$comanderas = $comandera->find('all');	

		// creo las carpetas temporales
		foreach($comanderas as $c)
		{
			$this->comanderas[$c['Comandera']['id']] = $c;
		}	

		$this->impresoraFiscal = Configure::read('Dev.printer');
	}

	/**
	 * Imprime una Comanda para la cocina
	 *
	 */
	function imprimirComanda($comanda_id){
		$this->__inicio_manual();

		$Comanda =& ClassRegistry::init('Comanda');

		$productos_x_comanda = array();
		// se supone que en una comanda yo no voy a tener productos que se impriman en comanderas distitas
		// (esto es separado desde el mismo controlador y se manda aimprimir a comandas diferentes)
		// pero , por las dudas que ésto suceda, cuando yo listo los productos de una comanda, me los separa para ser impreso en Comanderas distintas
		// Entonces, por lo genral (SIEMPRE) se imprimiria x 1 sola Comandera en este método del Componente

		//comanderas_involucradas es un array de IDś dlas comaderas involucradas en esta comanda
		$comanderas_involucradas =  $Comanda->comanderas_involucradas($comanda_id);

		$entradas = $Comanda->listado_de_productos_con_sabores($comanda_id, DETALLE_COMANDA_TRAER_ENTRADAS);
		
		$platos_principales = $Comanda->listado_de_productos_con_sabores($comanda_id, DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES);

		
		$productos = array_merge($entradas, $platos_principales);

		// genero el array lindo paraimprimir por cada comanda
		// o sea, genero un renglón de la comanda
		// por ejmeplo me queraria algo asi:
		// "1) Milanesa de pollo\n"
		foreach($comanderas_involucradas as $comandera_id):
			
			$cant_entradas = count($entradas);
			if($cant_entradas >0){
					$prod_a_imprimir[] =	" -----        ENTRADAS       -----";
					$prod_a_imprimir[] = 	" ";
			}
			$i = 0;
			foreach($productos as $detalle):
				if(($i == $cant_entradas) && count($platos_principales)>0){
					$prod_a_imprimir[] = 	" ";
					$prod_a_imprimir[] =	" -----   PLATOS PRINCIPALES   -----";
					$prod_a_imprimir[] = 	" ";
				}
				
				// solo imprimir el producto que se imprime con esta comandera
				if($detalle['Producto']['comandera_id']==$comandera_id){
					$prod_cant = $detalle['DetalleComanda']['cant'];
					$prod_name = $detalle['Producto']['name'].' - '.$detalle['DetalleComanda']['observacion'];
					$prod_sabor = '';
					$primero = true;
					foreach ( $detalle['DetalleSabor'] as $sabor){
						if(!$primero){
							$prod_sabor .= ', ' ;
						}
						else{
							$prod_sabor .= ':: [' ;
							$primero = false;
						}
						$prod_sabor .= $sabor['Sabor']['name'];
					}
					$prod_sabor .= (count($detalle['DetalleSabor']) == 0)?'':']';
						
					$prod_a_imprimir[] =	"$prod_cant) $prod_name $prod_sabor";
				}
				$i++;
			endforeach;
			
			// imprimo el array de esta primer comanda
			try {
                            $textoAImprimir = '';
                            include (ROOT . DS . APP_DIR . DS .'vendors/ticket_templates/comanda_comandera.php');
			} catch (Exception $e) {
                            return 'Error: '.  $e->getMessage();
			}
                        
            //si paso todo bien la creacion del archivo la mando a imprimir
			$comandera_name = $this->comanderas[$comandera_id]['Comandera']['name'];
            return $this->cupsPrint($comandera_name, $textoAImprimir);
				
			return $retorno;
		endforeach;
	}




	/**
	 * 	Me crea el directorio si es que no existe previamente
	 * ademas me lo tansofrma en lectura y escritura para todos 666
	 *
	 *	@param string nombre del directorio
	 *	@return boolean si paso todo 	 1 = bien = 1,
	 *									 0 = todo mal = 0,
	 *									-1 = si ya existia el directorio devuelve -1
	 *									-2 = si no pudo cambiar los permisos
	 */
	function __crearDirectorioSiNoExiste($directorio_name)
	{debug($directorio_name);
		$ok = 0;
		try {
			if(!is_dir($directorio_name)){
				mkdir($directorio_name,0777,true);
				$ok = 1;
			}
			if (!chmod($directorio_name,0777)){
				$ok = -2;
			}
                        
		} catch (Exception $e) {
			return $e;
		}
		return $ok;
	}
	
	/**
	 * Inserta en el vector de comandos 4 lineas que corresponden a los datos
	 * de Mozo y Mesa
	 * 
	 * @param number $mozo
	 * @param number $mesa
	 * @return void
	 */
	function __setMozoMesa($mozo, $mesa){
		//seteo el pie de pagina con mesa y mozo
		$this->vcomandos[] = $this->generadorComando->setTrailer(0,"-  -  -  -  -  -  -  -");
                
                if ($mozoTitle = Configure::read('Mesa.tituloMozo')) {
                    $this->vcomandos[] = $this->generadorComando->setTrailer(1,"$mozoTitle $mozo ",true);
                } else { // no escribir nada
                    $this->vcomandos[] = $this->generadorComando->setTrailer(1," ",true);
                }
                
                if ( $mesaTitle = Configure::read('Mesa.tituloMesa')) {
                    $this->vcomandos[] = $this->generadorComando->setTrailer(2,"$mesaTitle $mesa",true);
                } else { // no escribir nada
                    $this->vcomandos[] = $this->generadorComando->setTrailer(2," ",true);
                }
		
		$this->vcomandos[] = $this->generadorComando->setTrailer(3,"-  -  -  -  -  -  -  -");
		
		$this->__setearLoDeConsumidorFinal();
	}
	
	
	
	/**
	 * 
	 * 
	 * Por nueva normativa hay que poner esto en algun lugar del tiquet
	 * @return void
	 */
	function __setearLoDeConsumidorFinal(){
		$this->vcomandos[] = $this->generadorComando->setTrailer(6, "  ORIENTACION AL COSUMIDOR PROVINCIA");
		$this->vcomandos[] = $this->generadorComando->setTrailer(7, "     DE BUENOS AIRES 0-800-333-6422");
	}
	
	
	
	/**
	 * Inserta en el vector de comandos los productos pasados como parametros y luego cierra la mesa
	 * insertando el comando de cierre de ticket fiscal
	 * 
	 * @param array $productos
	 * @return void
	 */
	function __setProductosYCerrar($productos, $importe_descuento = 0){
		foreach ($productos as $p):
		$this->vcomandos[] = $this->generadorComando->printLineItem(
                        $p['nombre'],
                        $p['cantidad'],
                        $p['precio']);
		//$this->vcomandos[] = "B".FS.$p['nombre'].FS.$p['cantidad'].FS.$p['precio'].FS."21.00".FS."M".FS."0.11".FS."1".FS."T";
		endforeach;

                if ($importe_descuento > 0) {
                    $this->vcomandos[] = $this->generadorComando->generalDiscount($importe_descuento);
                }

		$this->vcomandos[] = $this->generadorComando->closeFiscalReceipt();
	}


	/**
	 * Imprime un comprobante del tipo ticket para consumidor final
	 * en realidad el que voy a usar yo para el restaurant es el comprobante tipo ticket
	 * factura A o B porque admiten montos mayores a los $1000 pesos
	 *
	 * @param array $productos
	 * @param number $mozo
	 * @param number $mesa
	 * @return boolean true si pudo enviar a imprimiir, false en caso contrario
	 */
	function imprimirTicket($productos, $mozo, $mesa, $importe_descuento = 0)
	{
		//setteo el pie de pagina con el numero de mozo y mesa
		$this->__setMozoMesa($mozo, $mesa);

		//abro el tiquet consumidor final
		$this->vcomandos[] = $this->generadorComando->openFiscalReceipt("T");

		//inserto los productos en vcomandas y cierro la mesa
		$this-> __setProductosYCerrar($productos, $importe_descuento);

		return $this->printHasarFiscal();
	}

	/**
	 * Imprime un comprobante del tipo ticket para consumidor final
	 * en realidad el que voy a usar yo para el restaurant es el comprobante tipo ticket
	 * factura A o B porque admiten montos mayores a los $1000 pesos
	 *
	 * @param array $productos
	 * @param number $mozo
	 * @param number $mesa
	 * @return boolean true si pudo enviar a imprimir o false sino pudo
	 */
	function imprimirTicketFacturaB($productos, $mozo, $mesa, $porcentaje_descuento = 0)
	{
		//setteo el pie de pagina con el numero de mozo y mesa
		$this->__setMozoMesa($mozo, $mesa);

		//abro el tiquet consumidor final
		$this->vcomandos[] = $this->generadorComando->openFiscalReceipt("B");

		//inserto los productos en vcomandas y cierro la mesa
		$this-> __setProductosYCerrar($productos, $porcentaje_descuento);

		return $this->printHasarFiscal();
	
	}
	
	/**
	 * Imprime un comprobante del tipo ticket para consumidor final
	 * en realidad el que voy a usar yo para el restaurant es el comprobante tipo ticket
	 * factura A o B porque admiten montos mayores a los $1000 pesos
	 *
	 * @param array $productos
	 * @param number $mozo
	 * @param number $mesa
	 * @return boolean true si pudo enviar a imprimir o false sino pudo
	 */
	function imprimirTicketFacturaA($productos, $cliente, $mozo, $mesa, $importe_descuento = 0)
	{
		//setteo el pie de pagina con el numero de mozo y mesa
		$this->__setMozoMesa($mozo, $mesa);
		
		$comandos = $this->generadorComando->setCustomerData(	$cliente['nombre'],
                                                                        $cliente['nrodocumento'],
                                                                        $cliente['responsabilidad_iva'],
                                                                        $cliente['tipodocumento'],
                                                                        $cliente['domicilio']
                                                                );
		
		switch ($comandos){
			case -1:
				$this->log("comandos_fiscales_hassar_441::setCustomerData():: El tipo de documento no es válido: ".$cliente['tipodocumento'], LOG_ERROR);
				return false;
			case -2:
				$this->log("comandos_fiscales_hassar_441::setCustomerData():: La responsabilidad frente al IVA no es válida".$cliente['responsabilidad_iva'], LOG_ERROR);
				return false;
			default:
				$this->vcomandos[] = $comandos;
				break;
		}
																		
		//abro el tiquet consumidor final
		$this->vcomandos[] = $this->generadorComando->openFiscalReceipt("A");

		//inserto los productos en vcomandas y cierro la mesa
		$this-> __setProductosYCerrar($productos, $importe_descuento);
		
		if($this->printHasarFiscal()){
			$this->log("Se imprimió una factura A correctamente", LOG_INFO);	
			return true;
		}else{
			$this->log("Falló al imprimir una factura A", LOG_ERROR);
			return false;
		}
	}



	/**
	 * Valida los comandos del vector comandos $vcomandos
	 * de esta manera yo me aseguro que a la impresora le estoy pasando un formato de archivo mas o menos vàlido
	 * 
	 * @return boolean true si esta bien, false si esta mal
	 */
	function __validarComandos(){
		foreach($this->vcomandos as $comando){
			// si alguna de las lineas es vacia es porque hay un comando mal pasado
			if($comando == ''){
				return false;
			}
		}
		return true;
	}                




	/**
         * IMPRESION DE PRE-TICKET
	 * Imprime un ticket en la comandera, pr lo general es utilizado para mostrar previamente al ticket
	 *
	 * @param array $productos
	 * @param number $mozo_nro
	 * @param number $mesa_nro
	 * @param number $porcentaje_descuento Ej: 15, 21, 0
	 * @return boolean si salio todo bien true
	 */
	function imprimirTicketConComandera($productos, $mozo , $mesa, $porcentaje_descuento = 0){
		$this->__inicio_manual();
                $prod_a_imprimir = array();
		if($comandera = $this->__find_comandera_que_imprima_tickets()){
			$comandera_id = $comandera['Comandera']['id'];
				
			$total = 0;
			$j = 0;
			foreach($productos as $detalle):
			// solo imprimir el producto que se imprime con esta comandera
				$prod_cant = $detalle['cantidad'];
				$prod_name = $detalle['nombre'];
				$prod_precio = $detalle['precio'];
				$prod_precio_total = cqs_round($prod_cant*$prod_precio*100)/100; // esto se hace para que siempre me devualva con 2 ddecimales
				$total += $prod_precio_total;
				$prod_a_imprimir[$j] =	"$prod_cant x $prod_precio: $prod_name";
				if(strlen($prod_a_imprimir[$j])>30){
					$prod_a_imprimir[$j] = substr($prod_a_imprimir[$j],0,40);
				}
				
				for($i= strlen($prod_a_imprimir[$j])+strlen($total); $i<36;$i++){
					$prod_a_imprimir[$j] .= ".";
				}
				
				$prod_a_imprimir[$j] .=	"$$prod_precio_total";
				$j++;
			endforeach;
				
                        $textoAImprimir = '';
				
                        // armo el temṕlate del ticket importando el archivo de templates
                        
                        try {
                            include (ROOT . DS . APP_DIR . DS .'vendors/ticket_templates/pre_ticket_comandera.php');
			} catch (Exception $e) {
                            return 'Error: '.  $e->getMessage();
			}
				
			//si paso todo bien la creacion del archivo la mando a imprimir
			$comandera_name = $this->comanderas[$comandera_id]['Comandera']['name'];
                        return $this->cupsPrint($comandera_name, $textoAImprimir);
		}
		else return false;
	}



	/**
	 * me manda a imprimir un archivito de comanda con el cierre X
	 */
	function imprimirCierreX()
	{
		$this->vcomandos[] = $this->generadorComando->delHeaderTrailer();
		$this->vcomandos[] = $this->generadorComando->dailyClose("X");
		$this->printHasarFiscal();
	}



	/**
	 * me manda a imprimir un archivito de comanda con el cierre Z
	 * @param Boolean encolar, 	me dice si lo mando ala cola de impresion o no,por lo genral si lo pongo en false es por cuestiones de testeo,
	 * 							asi no me imprime cada vez que quiero probar algo
	 */
	function imprimirCierreZ()
	{
		$this->vcomandos[] = $this->generadorComando->delHeaderTrailer();
		$this->vcomandos[] = $this->generadorComando->dailyClose("Z");
		$this->printHasarFiscal();

	}

    /**
     * @param integer $numeroTicket numero de tiquet factura original
     * @param char $tipo A o B segun el tipo de la nota de credito a imprimir
     */
    function imprimirNotaDeCredito($numeroTicket, $importe, $tipo = 'B', $descrip, $cliente = array()){
        $tipoId = $tipo == 'B' ? 'S' : 'R';
        if (!empty($cliente) && $tipo == 'A') {
            $this->vcomandos[] = $this->generadorComando->setCustomerData($cliente['razonsocial'], $cliente['numerodoc'], $cliente['respo_iva'], $cliente['tipodoc']);
        } else {
            //condumidor Final
            $this->vcomandos[] = $this->generadorComando->setCustomerData();
        }
        $this->vcomandos[] = $this->generadorComando->setEmbarkNumber($numeroTicket);
        $this->vcomandos[] = $this->generadorComando->openDNFH($tipoId);
        $this->vcomandos[] = $this->generadorComando->printLineItem($descrip, 1, $importe);
        $this->vcomandos[] = $this->generadorComando->closeDNFH();
        $this->printHasarFiscal();
    }

	function printFacturaB($vproductos){

	}

	/**
	 * me toma el array vcomandos y me manda a imprimir
	 * 					si no pongo nada me genera un nombre aleatorio
	 * @return boolean true si paso todo bien, false si paso mal
	 */
	function printHasarFiscal()
	{
		//primero valida los comandos... si estan todos bien, entonces sigue adelante
		$nombreImpresoraFiscal = Configure::read('ImpresoraFiscal.nombre');
		if(!$this->__validarComandos()){
			return false;
		}
                
                $texto = '';
                // retorno de carro
                $CR = chr(13);
                $LF = chr(10);
                foreach ($this->vcomandos as $c){
                    $texto .= $c . $CR . $LF;
                }
                $this->cupsPrint( $nombreImpresoraFiscal, $texto );

		return false;
	}
        
        
        /**
         *  Comando cups de impresion
         * 
         * @param type $serverImpresoraFiscal es el nombre del host o IP
         * @param type $nombreImpresoraFiscal nombre CUPS de la impresora 
         * @param type $texto es el texto a imprimir
         * @return type boolean true si salio todo bien false caso contrario
         */
        function cupsPrint( $nombreImpresoraFiscal, $texto ) {
        	$comanda = ClassRegistry::init('Comandera');
        	$comanda->recursive = -1;

        	$printer = $comanda->findByName($nombreImpresoraFiscal);
        	
        	if ( !empty($printer)){
        		$printer_id = $printer['Comandera']['id'];
        	} else {
        		$printer_id = 0;
        	}
        	
        	$pjData['PrinterJob'] = array(
        		'printer_id' => $printer_id ,
        		'text' => $texto
        		);

        	$pj =& ClassRegistry::init('PrinterJob');
        	
        	$pj->create();

        	$pj->save($pjData);

			return 1;
            
        }
}
