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
        
        // por default buscar 1 semana atras
        if (empty($this->data['Linea'])){
            $this->data['Linea'][0]['hasta'] = date('d/m/Y',strtotime('now'));
            $this->data['Linea'][0]['desde'] = date('d/m/Y',strtotime('-1 month'));
        }
        
        $mesasLineas = array();
        if ( !empty($this->data['Linea'] )) {
            $lineas = array();
            foreach ($this->data['Linea'] as $linea) {
                if(!empty($linea['desde']) && !empty($linea['hasta']))
                    {
                    list($dia, $mes, $anio) = explode("/", $linea['desde']);
                    $desde = $anio."-".$mes."-".$dia;

                    list($dia, $mes, $anio) = explode("/", $linea['hasta']);
                    $hasta = $anio."-".$mes."-".$dia;

                    $mesas = $this->Mesa->totalesDeMesasEntre($desde, $hasta, array(
                        'fields' => array(
                             'sum(m.cant_comensales) as "cant_cubiertos"' ,
                             'sum(m.total) as "total"', 
                             'sum(m.total)/sum(m.cant_comensales) as "promedio_cubiertos"',
                             'DATE(m.created) as "fecha"',
                        ),
                        'group' => array(
                            'DATE(m.created)',
                        )
                    ));
                    foreach ($mesas as &$m) {
                        $m['Mesa'] = $m[0];
                        $m['Mesa']['fecha'] = date('d-M-y',strtotime($m['Mesa']['fecha']));
                        unset($m[0]);
                    }
                    $mesasLineas[] = $mesas;
                }
            }
        }
        
        $this->set('mesas', $mesasLineas);
    }

    
    
    function mozos_total() {        
        // por default buscar hoy
        if ( empty($this->data['Linea']) ) {
            $this->data['Linea'][0]['hasta'] = date('d/m/Y',strtotime('now'));
            $this->data['Linea'][0]['desde'] = date('d/m/Y',strtotime('-1 week'));
        }
        
        $mesasLineas = array();
        if ( !empty($this->data['Linea'] )) {
            $lineas = array();
            foreach ($this->data['Linea'] as $linea) {
                if(!empty($linea['desde']) && !empty($linea['hasta']))
                    {
                    list($dia, $mes, $anio) = explode("/", $linea['desde']);
                    $desde = $anio."-".$mes."-".$dia;

                    list($dia, $mes, $anio) = explode("/", $linea['hasta']);
                    $hasta = $anio."-".$mes."-".$dia;

                    $mesas = $this->Mesa->totalesDeMesasEntre($desde, $hasta, array(
                        'fields' => array(
                             'sum(m.cant_comensales) as "cant_cubiertos"' ,
                             'sum(m.total) as "total"', 
                             'sum(m.total)/sum(m.cant_comensales) as "promedio_cubiertos"',
                             'DATE(m.created) as "fecha"',
                             'z.numero as "mozo"',
                             'z.id as "mozo_id"'
                        ),
                        'group' => array(
                            'DATE(m.created), z.id, z.numero',
                        ),
                        'order' => array(
                            'DATE(m.created) DESC',
                            'z.numero ASC',
                        )
                    ));
                      
                    $fechas = array();
                    foreach ($mesas as &$m) {
                        $m['Mozo'] = $m[0];
                        $m['Mozo']['numero'] = $m['z']['mozo'];
                        $m['Mozo']['id'] = $m['z']['mozo_id'];
                        $fechas[$m['Mozo']['fecha']][$m['Mozo']['id']] = $m;
                        unset($m[0]);
                        unset($m['z']);
                    }
                }
            }
        }
        $this->set('fechas', $fechas);
        $this->set('mozos', $mesas);
    }
    
    function mesas_factura() {
        //SELECT * FROM `clientes` WHERE DATE(created) >=(select date_sub(curdate(),interval 1 year)as Date)and DATE(created) <= NOW();
        $desde = 'select date_sub(curdate(),interval 1 day)as Date;';
        //SELECT * FROM `clientes` WHERE DATE(created) >=(select date_sub(curdate(),interval 1 year)as Date)
        $select = 'SELECT * FROM `clientes` WHERE DATE(created) >=';

        $test = $this->Mesa->query($desde);

        if(!empty($this->passedArgs['p']) && $this->passedArgs['p']!='dia'){
            
               debug($this->passedArgs['p']);
               
             if($this->passedArgs['p']=='anio'){
                 //query de año
                 $desde = '(select date_sub(curdate(),interval 1 year)as Date)';
                 $query = 'SELECT * FROM `mesas` WHERE DATE(created) >='.$desde.'and DATE(created) <= NOW();';
                 $mesas = $this->Mesa->query($query);
             }else{
                    if($this->passedArgs['p']=='mes'){
                        //query de mes
                        $desde = '(select date_sub(curdate(),interval 1 month)as Date)';
                        $query = 'SELECT * FROM `mesas` WHERE DATE(created) >='.$desde.'and DATE(created) <= NOW();';                       
                        $mesas = $this->Mesa->query($query);                      
                       }else {
                               if($this->passedArgs['p']=='semana'){
                                   //query de semana
                                    $desde = '(select date_sub(curdate(),interval 1 week)as Date)';
                                    $query = 'SELECT * FROM `mesas` WHERE DATE(created) >='.$desde.'and DATE(created) <= NOW();';                       
                                    $mesas = $this->Mesa->query($query);
                               }
                       }
                } 
                
         }else {
              //query default del dia
                $query = 'SELECT * FROM `clientes` WHERE DATE(created) = NOW();';                       
                $mesas = $this->Mesa->query($query);
            //SELECT * FROM `clientes` WHERE DATE(created) ="2010-02-01";
         }
         debug($mesas);
        $this->set('mesas', $mesas);
        // la consulta debe hacerse a mesas y luego relacionarla con "pagos" y con  "tipo de pagos". Sumar y enviar solo el total
        // Me guardo en un array todo los tipos de pago y ya tengo las mesas, hacer un foreach por cada mesa busco el id en la tabla pagos y voy sumando en el array de tipo de pagos.
        
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