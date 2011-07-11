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
        
        
        function mesastotal() {
            $horarioCorte = Configure::read('Horario.corte_del_dia');
            $desdeHasta = '1 = 1';
            
            if ( !empty($this->data) ) {
                $desde = $this->data['Mesa']['desde'];
                $hasta = $this->data['Mesa']['hasta'];
                $desdeHasta = "m.created BETWEEN $desde AND $hasta";
            }
            
            $query = '
SELECT count(*) as "cant_mesas", 
        sum(m.cant_comensales) as "cant_cubiertos" ,
        sum(m.total) as "total", 
        sum(m.total)/sum(m.cant_comensales) as "promedio_cubiertos",
        DATE(m.created) as "fecha" FROM (
        
            SELECT id,numero,mozo_id,total, cant_comensales, cliente_id,menu, ADDDATE(m.created,-1) as created, modified, time_cerro, time_cobro from mesas m
            WHERE
                HOUR(m.created) BETWEEN 0 AND '.$horarioCorte.'
            
            UNION
            
            SELECT id,numero,mozo_id,total, cant_comensales, cliente_id,menu, created, modified, time_cerro, time_cobro from mesas m
            WHERE
                HOUR(m.created) BETWEEN '.$horarioCorte.' AND 24) as m
        WHERE '.$desdeHasta.'                    
        GROUP BY DATE(m.created)
        ORDER BY m.created DESC                
';
            
            $mesas = $this->Mesa->query($query);
            
            foreach ($mesas as &$m) {
                $m['Mesa'] = $m[0];
                unset($m[0]);
            }
            
           $this->set('mesas', $mesas);
            
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