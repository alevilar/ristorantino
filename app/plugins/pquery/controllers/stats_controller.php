<?php

class StatsController extends PqueryAppController {

    var $helpers = array('Html', 'Form', 'Ajax');
    var $components = array('Auth', 'RequestHandler');
    var $uses = array('Mesa');

    function year() {

        //SELECT SUM(total),YEAR(mesas.created) FROM `mesas` GROUP BY YEAR(mesas.created) ORDER BY YEAR(mesas.created) asc
        /*
          $group = array(
          'YEAR(mesas.created)',
          );
         */
        $this->Mesa->recursive = -1;

        $mesasporaño = $this->Mesa->find('all', array(
                    'fields' => array('SUM(total) AS total', 'YEAR(Mesa.created) AS anio'),
                    'group' => 'YEAR(Mesa.created)',
                    'order' => 'YEAR(Mesa.created) asc'
                ));


        $this->set('mesas', $mesasporaño);
    }

    function mesas_total() {
        $horarioCorte = Configure::read('Horario.corte_del_dia');
        $desdeHasta = '1 = 1';
        $limit = '';
        $lineas = array($desdeHasta);
        if ( !empty($this->data['Linea'] )) {
            $lineas = array();
            foreach ($this->data['Linea'] as $linea) {
                if(!empty($linea['desde']) && !empty($linea['hasta']))
                    {
                    list($dia, $mes, $anio) = explode("/", $linea['desde']);
                    $desde = $anio."-".$mes."-".$dia;

                    list($dia, $mes, $anio) = explode("/", $linea['hasta']);
                    $hasta = $anio."-".$mes."-".$dia;

                    $desdeHasta = "m.created BETWEEN '$desde' AND '$hasta'";
                    $lineas[] = $desdeHasta;
                }
            }
        } else {
            $limit = ' LIMIT 7 ';
        }

        $mesasLineas = array();
        foreach ( $lineas as $l ) {
            $query = '    SELECT count(*) as "cant_mesas", 
            sum(m.cant_comensales) as "cant_cubiertos" ,
            sum(m.total) as "total", 
            sum(m.total)/sum(m.cant_comensales) as "promedio_cubiertos",
            DATE(m.created) as "fecha" FROM (

                SELECT id,numero,mozo_id,total, cant_comensales, cliente_id,menu, ADDDATE(m.created,-1) as created, modified, time_cerro, time_cobro from mesas m
                WHERE
                    HOUR(m.created) BETWEEN 0 AND ' . $horarioCorte . '

                UNION

                SELECT id,numero,mozo_id,total, cant_comensales, cliente_id,menu, created, modified, time_cerro, time_cobro from mesas m
                WHERE
                    HOUR(m.created) BETWEEN ' . $horarioCorte . ' AND 24) as m
            WHERE ' . $l . '                    
            GROUP BY DATE(m.created)
            ORDER BY m.created DESC     
            ' . $limit;

            $mesas = $this->Mesa->query($query);

            foreach ($mesas as &$m) {
                $m['Mesa'] = $m[0];
                unset($m[0]);
            }
            $mesasLineas[] = $mesas;
        }
        $this->set('mesas', $mesasLineas);
    }
    
    
    function mesas_factura() {
        /*
        debug($this->passedArgs['p']);
        if(!empty($this->passedArgs['p']))
        
                
        $desdeHasta = '1 = 1';
        $limit = '';
        $lineas = array($desdeHasta);
        if ( !empty($this->data['Linea'] )) {
            $linea = array();
            foreach ($this->data['Linea'] as $linea) {
                if(!empty($linea['desde']) && !empty($linea['hasta']))
                    {
                    list($dia, $mes, $anio) = explode("/", $linea['desde']);
                    $desde = $anio."-".$mes."-".$dia;

                    list($dia, $mes, $anio) = explode("/", $linea['hasta']);
                    $hasta = $anio."-".$mes."-".$dia;

                    $desdeHasta = "m.created BETWEEN '$desde' AND '$hasta'";
                    $lineas[] = $desdeHasta;
                }
            }
        } else {
            $limit = ' LIMIT 7 ';
        }

        $mesasLineas = array();
        foreach ( $lineas as $l ) {
            $query = '    SELECT count(*) as "cant_mesas", 
            sum(m.cant_comensales) as "cant_cubiertos" ,
            sum(m.total) as "total", 
            sum(m.total)/sum(m.cant_comensales) as "promedio_cubiertos",
            DATE(m.created) as "fecha" FROM (

                SELECT id,numero,mozo_id,total, cant_comensales, cliente_id,menu, ADDDATE(m.created,-1) as created, modified, time_cerro, time_cobro from mesas m
                WHERE
                    HOUR(m.created) BETWEEN 0 AND ' . $horarioCorte . '

                UNION

                SELECT id,numero,mozo_id,total, cant_comensales, cliente_id,menu, created, modified, time_cerro, time_cobro from mesas m
                WHERE
                    HOUR(m.created) BETWEEN ' . $horarioCorte . ' AND 24) as m
            WHERE ' . $l . '                    
            GROUP BY DATE(m.created)
            ORDER BY m.created DESC     
            ' . $limit;

            $mesas = $this->Mesa->query($query);

            foreach ($mesas as &$m) {
                $m['Mesa'] = $m[0];
                unset($m[0]);
            }
            $mesasLineas[] = $mesas;
        }
        $this->set('mesas', $mesasLineas);
        */
    }
    
    
    
    
      
    
    
    

    function dia() {



        $this->Mesa->recursive = -1;

        $mesaspordia = $this->Mesa->find('all', array(
                    'fields' => array('SUM(total) AS total', 'DAY(Mesa.created) AS dia'),
                    'group' => 'DAY(Mesa.created)',
                    'order' => 'DAY(Mesa.created) asc'
                ));


        $this->set('mesas', $mesaspordia);
    }

    function index() {
        
    }

    function mozos_mesas() {
        
    }

    function mozos_pagos() {
        
    }

    function mozos_productos() {
        
    }

    function mesas_ranking() {
        
    }

    /* function mesastotal() {

      } */



    function mesas_pago() {
        
    }

    function mesas_clientes() {
        
    }

    function cont_ingresos() {
        
    }

    function cont_caja() {
        
    }

    function prod_ranking() {
        
    }

    function prod_ingresos() {
        
    }

    function prod_pedidos() {
        
    }

    function prod_listado() {
        
    }

    function real_mesasabiertas() {
        
    }

    function real_comandas() {
        
    }

    function real_comensales() {
        
    }

    function real_mesasmozos() {
        
    }

}

?>