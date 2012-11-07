<?php

abstract class ReceiptPrinterDriver
{
    
    private $ESC = '';
    private $CORTAR_PAPEL = '';
    private $ENFATIZADO = '';
    private $SACA_ENFATIZADO = '';
    private $TEXT_STRONG = '';
    private $TEXT_NORMAL = '';
    private $DOBLE_ALTO = '';
    private $SACA_DOBLE_ALTO = '';
    private $RETORNO_DE_CARRO = '';

    /**
	 * Imprime una Comanda para la cocina
	 *
	 */
	function imprimirComanda($comanda_id){
		
			
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
	function imprimirTicket($productos, $mozo , $mesa, $porcentaje_descuento = 0){
                
	}
}