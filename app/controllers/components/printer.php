<?php


//App::import('Vendor', 'comandos_fiscales'.DS.'comandos_fiscales_hasar_441'); // loads example/example.php



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


        function doPrint($mesa_id){
            $this->Controller->Mesa->id = $mesa_id;

            $this->Mesa = $this->Controller->Mesa->find('first',array(
                'contain'=>array(
                    'Mozo',
                    'Cliente'=>array(
                        'Descuento'
                        )
                    )
                )
                    );
            if(empty($this->Mesa['Cliente'])){
                $this->Mesa['Cliente']['tipofactura'] = 'B';
                $this->Mesa['Cliente']['imprime_ticket'] = '';
            }

            $mesa_nro = $this->Controller->Mesa->getNumero();
            $mozo_nro = $this->Controller->Mesa->getMozoNumero();

            $cont  = 0;
            $total = 0;
            $prod = array();
            if($this->Mesa['Mesa']['menu']>0) {
                $prod = $this->Controller->Mesa->getProductosSinDescripcion($this->Mesa['Mesa']['menu']);
            } else {
                $prod = $this->Controller->Mesa->dameProductosParaTicket();
            }

            if(!empty($this->Mesa['Cliente']['Descuento']['porcentaje'])) {
                $this->porcentaje_descuento = $this->Mesa['Cliente']['Descuento']['porcentaje'];
                $this->importe_descuento = cqs_round(($this->porcentaje_descuento/100)*$this->Mesa['Mesa']['subtotal']);
            }

            $imprimio = false;
            
            //imprimir pre-ticket en caso de que este configurado asi
            if (Configure::read('Mesa.imprimePrimeroRemito') && !$this->Controller->Mesa->estaCerrada()){
                    $this->print_success = $this->imprimirTicketConComandera($prod, $mozo_nro, $mesa_nro,$this->porcentaje_descuento);
                    $this->log("se imprimio un ticket no fiscal desde comandera como remito para la mesa $mesa_nro, mozo $mozo_nro",LOG_INFO);
                    $this->tipoticket = 'Remito';
                    $this->imprimio_ticket = true;
                    $imprimio = true;
            }

            if(($this->Mesa['Cliente']['imprime_ticket'] > 0 || $this->Mesa['Cliente']['imprime_ticket'] == '') && !$imprimio):
                switch($this->Mesa['Cliente']['tipofactura']):
                    case 'A':
                        $ivaresp = $this->Controller->Mesa->Cliente->getResponsabilidadIva($this->Mesa['Cliente']['id']);
                        $this->Mesa['Cliente']['responsabilidad_iva'] = $ivaresp['IvaResponsabilidad']['codigo_fiscal'];

                        $tipodoc = $this->Controller->Mesa->Cliente->getTipoDocumento($this->Mesa['Cliente']['id']);
                        $this->Mesa['Cliente']['tipodocumento'] = $tipodoc['TipoDocumento']['codigo_fiscal'];

                        $this->print_success = $this->imprimirTicketFacturaA($prod, $this->Mesa['Cliente'], $mozo_nro, $mesa_nro, $this->importe_descuento);
                        $this->tipoticket = 'Ticket Factura "A"';

                        $this->log("se imprimio una factura A para la mesa $mesa_nro, mozo $mozo_nro",LOG_INFO);
                        $this->imprimio_ticket = true;
                        break;
                    case '':
                    case 'B':
                        $this->print_success = $this->imprimirTicket($prod, $mozo_nro, $mesa_nro, $this->importe_descuento);
                        $this->tipoticket = 'Ticket Factura "B"';
                        $this->log("se imprimio una factura B para la mesa $mesa_nro, mozo $mozo_nro",LOG_INFO);
                        $this->imprimio_ticket = true;
                        break;
                    default:
                        $this->print_success = $this->imprimirTicketConComandera($prod, $mozo_nro, $mesa_nro,$this->porcentaje_descuento);
                        $this->log("se imprimio un ticket no fiscal desde comandera como remito para la mesa $mesa_nro, mozo $mozo_nro",LOG_INFO);
                        $this->tipoticket = 'Ticket Descuento';
                        $this->imprimio_ticket = true;
                    endswitch;
            endif;

            $vreturn['print_success'] = $this->print_success;
            $vreturn['imprimio_ticket'] = $this->imprimio_ticket;
            $vreturn['tipoticket'] = $this->tipoticket;
            $vreturn['porcentaje_descuento'] = $this->porcentaje_descuento;
            $vreturn['Mesa'] = $this->Mesa = $this->Mesa;

            return $vreturn;
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
				
			$this->__crearDirectorioSiNoExiste($c['Comandera']['path']);
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
				//path y nombre del txt que voy a guardar en elpath temporal de la impresora par luego mandarlo a imprimir
				$arch_name = $this->comanderas[$comandera_id]['Comandera']['path']."/printer_".$comandera_id."_comanda_".$comanda_id.".txt";
	
				if(!file_exists($arch_name)){
					// si el archivo no existe lo creo
					$archivo_comanda = fopen($arch_name, "w+t");

					// pongo el ESC para comenzar ESC/P
					fwrite($archivo_comanda,ESC.'@');
					
					//DOBLE_ALTO
					fwrite($archivo_comanda,ESC.DOBLE_ALTO);
						
					// IMPRIMO EL HEADER
					if($productos[0]['Comanda']['prioridad']){
						$header = " - $title # $comanda_id -";
						fwrite($archivo_comanda,'*****************************************');
						fwrite($archivo_comanda,"\n");
						fwrite($archivo_comanda,'*********** COMANDA PRIORIDAD ***********');
						fwrite($archivo_comanda,"\n");
						fwrite($archivo_comanda,"                 #$comanda_id");
						fwrite($archivo_comanda,"\n");
						fwrite($archivo_comanda,'*****************************************');
						fwrite($archivo_comanda,"\n\n");
					}else{
						fwrite($archivo_comanda,"              Comanda  #$comanda_id");
						fwrite($archivo_comanda,"\n\n");
					}
					
					
									
						
					foreach($prod_a_imprimir as $item){
						if(!fwrite($archivo_comanda,iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $item))) throw new Exception("no se puede escribir en el archivo: $arch_name");
						fwrite($archivo_comanda,"\n");
					}				
					
					
					if($productos[0]['Comanda']['observacion']){
						fwrite($archivo_comanda,"\n");
						fwrite($archivo_comanda,'||||||||||||    OBSERVACION     |||||||||');
						fwrite($archivo_comanda,"\n");
						fwrite($archivo_comanda, iconv('UTF-8', 'ASCII//TRANSLIT', $productos[0]['Comanda']['observacion']));
						fwrite($archivo_comanda,"\n");
						fwrite($archivo_comanda,'|||||||||||||||||||||||||||||||||||||||||');
						fwrite($archivo_comanda,"\n");
						fwrite($archivo_comanda,"\n");
					}
					
					fwrite($archivo_comanda,"\n");
					
					
					// DOBLE ANCHO
					fwrite($archivo_comanda,ESC.ENFATIZADO);
					$tail = " - Mesa #: ".$productos[0]['Comanda']['Mesa']['numero'];
					fwrite($archivo_comanda,$tail);
					// SACA DOBLE ANCHO
					fwrite($archivo_comanda,ESC.SACA_ENFATIZADO);
					
					
					fwrite($archivo_comanda,"\n");
					// DOBLE ANCHO
					fwrite($archivo_comanda,ESC.ENFATIZADO);
					$tail = " - Mozo #: ".$productos[0]['Comanda']['Mesa']['Mozo']['numero'];
					fwrite($archivo_comanda,$tail);
					// SACA DOBLE ANCHO
					fwrite($archivo_comanda,ESC.SACA_ENFATIZADO);
					
					
					fwrite($archivo_comanda,ESC.SACA_DOBLE_ALTO);
					
					fwrite($archivo_comanda,"\n");
					
					$tail ="                          ".date('H:i:s',strtotime('now'))."\n";
					fwrite($archivo_comanda,$tail);
					
					
					
					//  retorno de carro
					fwrite($archivo_comanda,chr(13));
					fwrite($archivo_comanda,'-  -  -  -  -  -  -  -  -  -  -  -  -  -  -');
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");					
					
					// probando corte completo ESC/P
					fwrite($archivo_comanda,ESC.CORTAR_PAPEL);
					
						
					fclose($archivo_comanda);
				}
			} catch (Exception $e) {
				return 'Error: '.  $e->getMessage();
			}
			
			
			//si paso todo bien la creacion del archivo la mando a imprimir
			$comandera_name = $this->comanderas[$comandera_id]['Comandera']['name'];
			$comando = "lpr -P $comandera_name $arch_name";
			$retorno = exec($comando);
			//debug("Se mando el comando". $comando." ---El EL JOB ID es->> ".$retorno);
				
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
		$this->vcomandos[] = $this->generadorComando->printLineItem($p['nombre'],$p['cantidad'],$p['precio']);
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
				
				
			// imprimo el array de esta primer comanda
			try {
				//path y nombre del txt que voy a guardar en elpath temporal de la impresora par luego mandarlo a imprimir
				$arch_name = $this->comanderas[$comandera_id]['Comandera']['path']."/TicketComanda_Mesa".$mesa.".txt";

				
				if(file_exists($arch_name)){
					// lo borro
					unlink($arch_name);					
				}
				
				if(!file_exists($arch_name)){
					// si el archivo no existe lo creo
					$archivo_comanda = fopen($arch_name, "w+t");
						
					// pongo el ESC para comenzar ESC/P
					fwrite($archivo_comanda,ESC.'@');
			
					
					
					
					/*****
					 * 				 ENCABEZADO
					 */
					$header = Configure::read('Restaurante.name');
					if ($header) {
                                            fwrite($archivo_comanda,$header);
                                            fwrite($archivo_comanda,"\n\n");
                                        }

                                        if (Configure::read('Restaurante.razon_social')){
                                            fwrite($archivo_comanda,Configure::read('Restaurante.razon_social'));
                                            fwrite($archivo_comanda,"\n");
                                        }
                                        if (Configure::read('Restaurante.cuit')){
                                            fwrite($archivo_comanda,Configure::read('Restaurante.cuit'));
                                            fwrite($archivo_comanda,"\n");
                                        }
                                        if (Configure::read('Restaurante.ib')){
                                            fwrite($archivo_comanda,Configure::read('Restaurante.ib'));
                                            fwrite($archivo_comanda,"\n");
                                        }
                                        if (Configure::read('Restaurante.iva_resp')){
                                            fwrite($archivo_comanda,Configure::read('Restaurante.iva_resp'));
                                            fwrite($archivo_comanda,"\n");
                                        }
					fwrite($archivo_comanda,'Fecha: '.date('d/m/y',strtotime('now')).'   Hora: '.date('H:i:s',strtotime('now')));
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					
					fwrite($archivo_comanda,'Cant. P.Unit. Item               Total');
					fwrite($archivo_comanda,"\n");
					
						
					foreach($prod_a_imprimir as $item){
						if(!fwrite($archivo_comanda,$item)) throw new Exception("no se puede escribir en el archivo: $arch_name");
						fwrite($archivo_comanda,"\n");
					}
						
						

					$descuento = $porcentaje_descuento/100;
					$total_c_descuento = cqs_round($total - ($total*$descuento));
						
					if($porcentaje_descuento){
						$tail = " -     SUBTOTAL                $$total";
						fwrite($archivo_comanda,$tail);
						fwrite($archivo_comanda,"\n");
							
						$tail = " -     DTO.                   -%$porcentaje_descuento";
						fwrite($archivo_comanda,$tail);
						fwrite($archivo_comanda,"\n");
					}
						
						$tail = " -     TOTAL                   $".$total_c_descuento;
					fwrite($archivo_comanda,$tail);
					
					fwrite($archivo_comanda,"\n\n");
						
					$tail  = " \n - MOZO: ".$mozo;
					$tail .= " \n - MESA: ".$mesa."\n";
					fwrite($archivo_comanda,$tail);
					
					//  retorno de carro
					fwrite($archivo_comanda,chr(13));
					
					fwrite($archivo_comanda,'  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -');
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,'           Verifique antes de abonar');
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,'        NO VALIDO COMO COMPROBANTE FISCAL');
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					fwrite($archivo_comanda,"\n");
					
					
					
					// probando corte completo ESC/P
					fwrite($archivo_comanda,ESC.'i');
				
						
					fclose($archivo_comanda);
				}
			} catch (Exception $e) {
				$this->log($e->getMessage(), LOG_ERROR);
				return false;
			}
				
				
			//si paso todo bien la creacion del archivo la mando a imprimir
			$comandera_name = $this->comanderas[$comandera_id]['Comandera']['name'];
			$comando = "lpr -P $comandera_name $arch_name";
			$retorno = exec($comando);
			//debug("Se mando el comando". $comando." ---El EL JOB ID es->> ".$retorno);

			return $retorno;

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
		$serverImpresoraFiscal = Configure::read('ImpresoraFiscal.server');
		$nombreImpresoraFiscal = Configure::read('ImpresoraFiscal.nombre');
		if(!$this->__validarComandos()){
			return false;
		}

		$descriptorspec = array(
		   0 => array("pipe", "r"), //esto lo uso para mandarle comandos
		   1 => array("pipe", "/tmp/lprstdout.txt", "a"),  // el stdout a un archivo tmp
		   2 => array("file", "/tmp/lprerrout.txt", "a") // el stderr a un archivo tmp
		);
        $process = proc_open('lpr -H '.$serverImpresoraFiscal.' -P '.$nombreImpresoraFiscal, $descriptorspec, $pipes, null, null);
        if (is_resource($process)) 
		{
			foreach($this->vcomandos as $comando):
                fwrite($pipes[0],$comando);
                fwrite($pipes[0],"\n");
			endforeach;
			fclose($pipes[0]);
			$ret =  proc_close($process);
			return true;
		}
		return false;
	}
}
?>
