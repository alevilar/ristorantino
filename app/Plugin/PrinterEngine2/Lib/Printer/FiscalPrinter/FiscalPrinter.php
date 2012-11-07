<?php


class FiscalPrinter
{

	/*
	 * este es el objeto que viene del Driver
	 * con esto yo generlo los comandos correspndiente para el modelo del 
         * controlador fiscal que yo tenga
	 */
	var $generadorComando = null;
        
/**
 * Holds configured Object Driver
 * 
 * @var Driver 
 */        
        var $Driver = null;

	/**
	 *
	 * @var array es el vector de comandos a imprimir
	 */
	var $vcomandos = array();

        
        /* variables de estado de impresion */
        var $print_success = true;
        var $imprimio_ticket = false;
        var $tipoticket = 'Ticket Factura "B"';
        var $porcentaje_descuento = 0;
        var $importe_descuento = 0;


        function __construct(){
            $nombreImpresoraFiscal = Configure::read('ImpresoraFiscal.nombre');
            $modeloImpresoraFiscal = Configure::read('ImpresoraFiscal.modelo');

            $modeloImpresoraFiscal .= 'Driver';
            App::uses('FiscalPrinter', 'PrinterEngine.Printer/FiscalPrinter');
            if ( !App::uses($modeloImpresoraFiscal, 'PrinterEngine.Printer/FiscalPrinter/Driver') ){
                throw new InternalErrorException('Error, el modelo de la impresora fiscal no existe o esta mal configurado: '.$modeloImpresoraFiscal);
                return -1;
            }
            
            $reflection = new ReflectionClass($modeloImpresoraFiscal);
            if ($reflection->isAbstract() || $reflection->isInterface()) {
                    return false;
            }
            $this->Driver = $reflection->newInstance($nombreImpresoraFiscal, $modeloImpresoraFiscal);
            debug($this->Driver);
        }

        /**
         * Imprime un archivo para la impresora fiscal
         * @param type $mesa_id
         * @return type 
         */
        function doPrint($numeroMesa, $numeroMozo, $items, $total, $cantCubiertos = 0, $importeDescuento = 0, $cliente = array() ) {

            $imprimio = false;
            
            
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
                            
                            App::import('Vendor', 'TicketTemplates', array('file' => 'TicketTemplates' . DS . 'pre_ticket_comandera.php'));
                            PreTicketComandera::output($textoAImprimir, $prod_a_imprimir, $porcentaje_descuento, $total, $mozo, $mesa );
                            
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
              
		return $texto;
	}
      
}
?>
