<?php

class StatsController extends StatsAppController
{

    var $helpers = array('Html', 'Form', 'Ajax', 'Number');
    var $components = array('Auth', 'RequestHandler');
    var $uses = array('Mesa', 'Account.Egreso', 'Account.Gasto', 'Cash.Zeta');

    /**
     *
     * @param type $groupByRange string posibilidades: day - month -  year. Indica como seran agrupados los datos
     * 
     */
    function mesas_total($groupByRange = 'day')
    {
        $egresos = array();
        $horarioCorte = Configure::read('Horario.corte_del_dia');
        $desdeHasta = '1 = 1';
        $limit = '';
        $lineas = array($desdeHasta);

        // por default buscar 1 semana atras
        if (empty($this->data['Linea'])) {
            $this->data['Linea'][0]['hasta'] = date('Y-m-d', strtotime('now'));
            $this->data['Linea'][0]['desde'] = date('Y-m-d', strtotime('-6 day'));
        }

        $mesasLineas = array();
        if (!empty($this->data['Linea'])) {
            $lineas = array();
            foreach ($this->data['Linea'] as $linea) {
                if (!empty($linea['desde']) && !empty($linea['hasta'])) {

                    $desde = $linea['desde'];
                    $hasta = $linea['hasta'];

                    // buscar gastos
                    $gasOps = array(
                        'fields' => array(
                            'sum(Gasto.importe_neto) as neto',
                            'sum(Gasto.importe_total) as total',
                        ),
                        'conditions' => array(
                            'Gasto.created BETWEEN ? AND ?' => array($desde, $hasta)
                        ),
                        'group' => array(
                            'DATE(Gasto.created)'
                        )
                    );
                    // primero buscar los egresos del intervalo seleccionado
                    $egresos = $this->Egreso->pagosDelDia($desde, $hasta);
                    $egresos_total = 0;
                    foreach ($egresos as $e) {
                        $egresos_total += $e['Egreso']['importe'];
                    }
                    $this->set('egresos_total', $egresos_total);
                    $egresos = array($egresos);


                    $gastosSumas = $this->Gasto->find('first', $gasOps);
                    $gasOps['group'] = array(
                        'DATE(Gasto.created)'
                    );
                    $gastos = $this->Gasto->find('all', $gasOps);
                    $this->set('gastos', $gastos);
                    $this->set('gastos_neto', $gastosSumas[0]['neto']);
                    $this->set('gastos_total', $gastosSumas[0]['total']);


                    $zetas = $this->Zeta->delDia($desde, $hasta);
                    $zeta_iva_total = $zeta_neto_total = 0;
                    foreach ($zetas as $z) {
                        $zeta_iva_total += $z[0]['iva'];
                        $zeta_neto_total += $z[0]['neto'];
                    }
                    $this->set('zetas', $zetas);
                    $this->set('zeta_iva_total', $zeta_iva_total);
                    $this->set('zeta_neto_total', $zeta_neto_total);

                    // luego, lo mas largo: buscar las mesas
                    $fields = array();
                    $group = array();

                    switch (strtolower($groupByRange)) {
                        case 'day':
                            break;
                        case 'month':
//                            $fields[] = 'GET_FORMAT( DATE(Mesa.created),"%Y-%m") as "fecha"';
                            $fields[] = 'YEAR(Mesa.created) as "anio"';
                            $fields[] = 'MONTH(Mesa.created) as "mes"';
                            $fields[] = 'CONCAT(YEAR(Mesa.created),"-",MONTH(Mesa.created)) as "fecha"';

                            $group = array(
                                'YEAR(fecha)', 'MONTH(fecha)',
                            );
                            break;
                        case 'year':
                            $fields[] = 'YEAR(Mesa.created) as "fecha"';
                            $group = array(
                                'YEAR(fecha)',
                            );
                            break;
                    }


                    $mesas = $this->Mesa->totalesDeMesasEntre($desde, $hasta, array(
                        'fields' => $fields,
                        'group' => $group,
                    ));


                    $resumenCuadro = array(
                        'total' => 0,
                        'cubiertos' => 0,
                        'desde' => $desde,
                        'hasta' => $hasta,
                    );

                    foreach ($mesas as &$m) {
                        $m['Mesa'] = $m[0];

                        $resumenCuadro['cubiertos'] += $m['Mesa']['cant_cubiertos'];
                        $resumenCuadro['total'] += $m['Mesa']['total'];

                        unset($m[0]);
                    }
                    $mesasLineas[] = $mesas;
                }
            }
        }

        $this->set('egresos', $egresos);
        $this->set('mesas', $mesasLineas);
        $this->set('resumenCuadro', $resumenCuadro);
    }

    function mozos_total()
    {
        $fechas = array();
        // por default buscar hoy
        if (empty($this->data['Mesa'])) {
            $this->data['Mesa']['hasta'] = date('Y-m-d', strtotime('now'));
            $this->data['Mesa']['desde'] = date('Y-m-d', strtotime('-6 day'));
        }

        if (!empty($this->data['Mesa']['desde']) && !empty($this->data['Mesa']['hasta'])) {
            $desde = $this->data['Mesa']['desde'];
            $hasta = $this->data['Mesa']['hasta'];

            $mesas = $this->Mesa->totalesDeMesasEntre($desde, $hasta, array(
                'fields' => array(
                    'Mozo.*'
                ),
                'group' => array(
                    'Mozo.id',
                    'Mozo.numero',
                ),
                'order' => array(
                    'fecha DESC',
                    'Mozo.numero ASC',
                ),
                'contain' => array(
                    'Mozo'
                )
            ));

            // traer array de fechas
            $fechas = array_flip(crear_fechas($desde, $hasta));

            // aray de los mozos que estan en este intervalo de mesas
            $mozosList = $mozos = $mozosTotales = $mozosCubiertos = array();
            foreach ($mesas as &$m) {
                $mozosList[$m['Mozo']['id']] = null;
                $mozos[$m['Mozo']['id']] = $m['Mozo']['numero'];
                
                if ( empty($mozosTotales[$m['Mozo']['id']]) ) {
                    $mozosTotales[$m['Mozo']['id']] = array(
                        'total' => 0,
                        'cubiertos' => 0,
                    );
                }
                $mozosTotales[$m['Mozo']['id']]['total'] += $m[0]['total'];
                $mozosTotales[$m['Mozo']['id']]['cubiertos'] += $m[0]['cant_cubiertos'];
            }

            // convertir matriz con fechas y mozos
            foreach ($fechas as &$f) {
                $f = $mozosList;
            }
            // colocar el dato en la matriz
            foreach ($mesas as &$m) {
                $fechas[$m[0]['fecha']][$m['Mozo']['id']] = $m;
            }
        }
        $this->set(compact('fechas', 'mozos', 'mozosTotales'));
    }

}

?>