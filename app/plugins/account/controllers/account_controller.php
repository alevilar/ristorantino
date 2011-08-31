<?php

class AccountController extends AccountAppController {

	var $helpers = array('Html', 'Form');
        var $uses = array('Mesa', 'Account.Vale', 'Account.Gasto');
	
        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Contabilidad','link'=>'/account' );
        }
        
	function index(){

	}
        
        function arqueo($fecha = null) {            
            if (!empty($_POST['arqueoFecha'])) {
                list($dia, $mes, $anio) = explode("/", $_POST['arqueoFecha']);
                $fecha = $anio."-".$mes."-".$dia;
                $fechainput = $_POST['arqueoFecha'];
            }
            
            if ($fecha==null) {
                $fecha = date('Y-m-d');
                $fechainput = date('d/m/Y');
            }
            
            $horarioCorte = Configure::read('Horario.corte_del_dia');
            
            $this->Vale->recursive = 0;
            $vales = 0;
            // vales de hoy
            $vale = $this->Vale->find('first', array(
                                            'fields' => array('SUM(Vale.monto) as total'),
                                            'conditions' => array(
                                                'DATEDIFF(Vale.fecha, "'.$fecha.'")' => 0,
                                                   
                                            ),
                ));
            if (!empty($vale[0]['total'])) {
                $vales = $vale[0]['total'];
            }
            
            $this->Gasto->recursive = 0;
            // gastos con factura de hoy
            $gastos = 0;
            $gasto = $this->Gasto->find('first', array(
                                            'fields' => array('SUM(Gasto.importe_total) as total'),
                                            'conditions' => array(
                                                'DATEDIFF(Gasto.factura_fecha, "'.$fecha.'")' => 0,    
                                             )
                ));
            if (!empty($gasto[0]['total'])) {
                $gastos = $gasto[0]['total'];
            }

            $ventas_efectivo = 0;
            $ventas = $this->Mesa->query('
             select sum(total) as totales from (
                select Mesa.total as total from mesas Mesa 
                    inner join pagos Pago on Pago.mesa_id = Mesa.id
                 where 
                 (DATEDIFF(Mesa.created, "'.$fecha.'") = 0 AND HOUR(Mesa.created) BETWEEN '.$horarioCorte.' AND 24)
                 OR
                 (DATEDIFF(Mesa.created, "'.$fecha.'") = 1 AND HOUR(Mesa.created) BETWEEN 0 AND '.$horarioCorte.')
                 and Pago.tipo_de_pago_id = 1
                 group by Mesa.id) as totalestable
            ');
            if (!empty($ventas[0][0]['totales'])) {
                $ventas_efectivo = $ventas[0][0]['totales'];
            }
            
            /*
            Calculo del total del arqueo de caja
             */
            $total = $ventas_efectivo - $gastos - $vales;
            
            $this->set('ventas_efectivo', $ventas_efectivo);
            $this->set('vales', $vales);
            $this->set('gastos', $gastos);
            $this->set('fechainput', $fechainput);
            $this->set('total', $total);            
	}

	
}
