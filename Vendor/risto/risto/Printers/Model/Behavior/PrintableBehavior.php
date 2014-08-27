<?php
/**
 * Behavior for printing documents
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('ModelBehavior', 'Model');



class PrintableBehavior extends ModelBehavior {

	public function loadPrinter ( $id = null ) {
		if ( !empty($id) ) {
			$this->id = $id;	
		}
		
		$printer = $this->read();
	}





/**
 * Gets from DDBB all Comanderas and put into ReceiptPrinters class var array
 * 
 * @return array self::$ReceiptPrinters
 */    
    protected static function _loadReceiptPrinters() {
        $ComanderaModel = ClassRegistry::init('Comandera');
        $ComanderaModel->recursive = -1;
        $comanderas =  $ComanderaModel->find('all', array('conditions' => array(
            'Comandera.imprime_ticket' => 0,
        )));
        foreach ($comanderas as $c ) {
            $key = $c['Comandera']['name'];
            
            // puts into array with name as KEY
            self::$ReceiptPrinters[ $key ] = $c['Comandera'];
        }
        return self::$ReceiptPrinters;
    }

    
/**
 *  Gets the Receipt printer marked as es_impresora = 1
 *  If couldn't find any, returns the first in array
 * 
 *  @return ReceiptPrinter
 *              if any, return null
 */    
    private static function _getDefaulReceiptPrinter() {
        foreach (self::$ReceiptPrinters as $rp ) {
            if ( !empty($rp['es_impresora']) ) {
                return $rp;
            }
        }
        // if any, return null
        return null;
    }




    
/**
 * Getter
 * 
 * @return array based on find('first') of Comandera 
 */    
    public static function getFiscalPrinter(){
        return self::$FiscalPrinter;
    }

    /**
     *  If printer is for sending receipts (not fiscal) return true
     * 
     * @param string $printerName
     * @return boolean 
     */
    public static function _isReceipt($printerName) {
         if ( !empty(self::$ReceiptPrinters[$printerName]) && empty(self::$ReceiptPrinters[$printerName]['imprime_ticket']) ) {
             return true;
         }
         return false;
    }    
        



  
    

    /**
     *  If printer is fiscal return true
     * 
     * @param string $printerName
     * @return boolean 
     */
    public static function _isFiscal($printerName) {
         if ( !empty(self::$FiscalPrinter) ) {
             if ( self::$FiscalPrinter['name'] == $printerName && !empty(self::$FiscalPrinter['imprime_ticket']) )
             return true;
         }
         return false;
    }
    


    
/**
 *  Instanciates the Fiscal Printer into self::$FiscalPrinter
 */    
    protected static function _loadFiscalPrinter() {
        
        $ComanderaModel = ClassRegistry::init('Comandera');
        $ComanderaModel->recursive = -1;
        $comandera =  $ComanderaModel->find('first', array('conditions' => array(
            'Comandera.imprime_ticket' => 1,
        )));
        self::$FiscalPrinter = $comandera['Comandera'];
    }
    
    
}
