<?php

class StatsController extends PqueryAppController {

	var $helpers = array('Html', 'Form','Ajax');
	var $components = array('Auth','RequestHandler');
        var $uses = array('Mesa');
      
        function year() {
            
         //SELECT SUM(total),YEAR(mesas.created) FROM `mesas` GROUP BY YEAR(mesas.created) ORDER BY YEAR(mesas.created) asc
           /*
            $group = array(
                                   'YEAR(mesas.created)',
                               );
           */
            $this->Mesa->recursive=-1;
            
            $mesasporaño = $this->Mesa->find('all',array(
                                              'fields'=> array('SUM(total) AS total','YEAR(Mesa.created) AS anio'), 
                                              'group'=>'YEAR(Mesa.created)',
                                              'order'=>'YEAR(Mesa.created) asc'
                                        ));
            
            
           $this->set('mesas', $mesasporaño);
            
        }
        
        
        function mes() {
            
                   
            $this->Mesa->recursive=-1;
            
            $mesaspormes = $this->Mesa->find('all',array(
                                              'fields'=> array('SUM(total) AS total','MONTH(Mesa.created) AS mes', 'YEAR(Mesa.created) AS year'), 
                                              'group'=>'MONTH(Mesa.created)',
                                              'order'=>'MONTH(Mesa.created) asc'
                                        ));
            
            
           $this->set('mesas', $mesaspormes);
            
        } 
        
        
        function dia() {
            

                    
            $this->Mesa->recursive=-1;
            
            $mesaspordia = $this->Mesa->find('all',array(
                                              'fields'=> array('SUM(total) AS total','DAY(Mesa.created) AS dia'), 
                                              'group'=>'DAY(Mesa.created)',
                                              'order'=>'DAY(Mesa.created) asc'
                                        ));
            
            
           $this->set('mesas', $mesaspordia);
            
        }  
        
        
        function index() {
            
        }
        function mozosmesas() {
            
        }
        function mozospagos() {
            
        }
        function mozosproductos() {
            
        }
        function mesasranking() {
            
        }
        /*function mesastotal() {
            
        }*/
        function mesasfactura() {
            
        }
        function mesaspago() {
            
        }
        function mesasclientes() {
            
        }
        function contingresos() {
            
        }
        function contingr() {
            
        }
        function contcaja() {
            
        }
        function prodranking() {
            
        }
        function prodingresos() {
            
        }
        function prodpedidos() {
            
        }
        function prodlistado() {
            
        }
        function realmesasabiertas() {
            
        }
        function realcomandas() {
            
        }
        function realcomensales() {
            
        }
        function realmesasmozos() {
            
        }
}
?>