<?php

class ArqueosController extends CashAppController
{


    public $uses = array('Cash.Arqueo', 'Account.Egreso', 'Pago');
    
    public $components = array('Email');
    
    
    public function help() {
        $this->Arqueo->Caja->recursive = -1;
        $this->set('cajas', $this->Arqueo->Caja->find('all'));
    }

    public function index()
    {
        $arqueos = $this->paginate();
        $cajas = $this->Arqueo->Caja->find('list');
        $this->set(compact('arqueos', 'cajas'));
    }
    
    private function __presetIngresosEgresos ($caja = null) {
        
        if ( !empty($this->data['Arqueo']['id']) ) {
            $hasta = $this->data['Arqueo']['datetime'];
        } else {
            $hasta = date('Y-m-d H:i:s', strtotime('now'));
        }
        $conditions = array(
            'order' => array('Arqueo.datetime DESC'),
        );
        $computa_ingresos = $computa_egresos = true;
        if ( !empty( $caja ) ) {
            $conditions['conditions']['Arqueo.caja_id'] = $caja['Caja']['id'];
            $computa_ingresos = $caja['Caja']['computa_ingresos'];
            $computa_egresos = $caja['Caja']['computa_egresos'];
        }
        if ( !empty($this->data['Arqueo']['id']) ) {
            $conditions['conditions'][ 'Arqueo.datetime <'] = $this->data['Arqueo']['datetime'];
        }
        $ultimoArqueo = $this->Arqueo->find('first', $conditions);
        if ( empty($ultimoArqueo) ) {
                $desde = date('Y-m-d H:i:s', strtotime('-4 month') );
        } else {
            $desde = $ultimoArqueo['Arqueo']['datetime'];
            $this->data['Arqueo']['importe_inicial'] = $ultimoArqueo['Arqueo']['importe_final'];
        }
         $egresosList = $this->Egreso->find('all', array(
            'conditions' => array(
                'Egreso.fecha BETWEEN ? AND ?' => array($desde, $hasta),
            ),
            'group' => array('Egreso.tipo_de_pago_id'),
            'contain' => array(
                'TipoDePago'
            ),
            'fields' => array(
                'sum(Egreso.total) as total',
                'TipoDePago.name'
            ),
            'order' => array(
                'TipoDePago.name'
            ),
        ));

        $ingresosList = $this->Pago->find('all', array(
            'conditions' => array(
                'Pago.created BETWEEN ? AND ?' => array($desde, $hasta),
            ),
            'group' => array('Pago.tipo_de_pago_id'),
            'contain' => array(
                'TipoDePago',
            ),
            'fields' => array(
                'sum(Pago.valor) as total',
                'TipoDePago.name'
            ),
            'order' => array(
                'TipoDePago.name'
            ),
        ));
        $sumaEgresos = 0;
        foreach ($egresosList as $el) {            
            if (empty($this->data['Arqueo']['egreso'])) {
                if ($el['TipoDePago']['id'] == TIPO_DE_PAGO_EFECTIVO) {
                    if ( $computa_egresos ) {
                        $this->data['Arqueo']['egreso'] = $el[0]['total'];
                    }
                }
            }
            $sumaEgresos += $el[0]['total'];
        }
        $egresosList[] = array(
            0 => array(
                'total' => $sumaEgresos
            ),
            'TipoDePago' => array(
                'name' => 'Total'
            )
        );
                
        $sumaIngresos = 0;
        foreach ($ingresosList as $el) {
            if ( empty($this->data['Arqueo']['ingreso']) ) {
                if ($el['TipoDePago']['id'] == TIPO_DE_PAGO_EFECTIVO) {
                    if ( $computa_ingresos ) {
                        $this->data['Arqueo']['ingreso'] = $el[0]['total'];
                    }
                }
            }
            $sumaIngresos += $el[0]['total'];
        }
        $ingresosList[] = array(
            0 => array(
                'total' => $sumaIngresos
            ),
            'TipoDePago' => array(
                'name' => 'Total'
            )
        );
        
        $this->set(compact('egresosList', 'ingresosList','desde','hasta'));    
        
        return $sumaIngresos;
    }
    
    
    private function __presetData ($caja_id) {
        $caja = null;
        if (!empty($caja_id)) {
            $this->data['Arqueo']['caja_id'] = $caja_id;
            $this->Arqueo->Caja->recursive = -1;
            $caja = $this->Arqueo->Caja->read(null, $caja_id);
            if (!empty($caja) && empty($caja['Caja']['computa_egresos'])) {
                $this->data['Arqueo']['egreso'] = null;
            }
            if (!empty($caja) && empty($caja['Caja']['computa_ingresos'])) {
                $this->data['Arqueo']['ingreso'] = null;
            }
            $this->set('caja', $caja);
        }
        
        $sumaIngresos = $this->__presetIngresosEgresos($caja);
        
        $ultimoZeta = $this->Arqueo->Zeta->find('first', array(
            'order' => 'numero_comprobante DESC'
        ));
        if ( !empty($ultimoZeta)) {
            $this->data['Zeta']['numero_comprobante'] = $ultimoZeta['Zeta']['numero_comprobante']+1;
            $this->data['Zeta']['total_ventas'] = $sumaIngresos;
        }
        
        
    }
    
    
    private function __enviarArqueoPorMail($arqueo_id) {
                                
    }

    public function add($caja_id = null)
    {
        if (!empty($this->data)) {
            $error = false;
            
            if ($this->Arqueo->save($this->data)) {
                $this->data['Zeta']['arqueo_id'] = $this->Arqueo->id;
                if ( !empty($this->data['Arqueo']['hacer_cierre_zeta']) ) {
                    if (!$this->Arqueo->Zeta->save($this->data)) {
                        $this->Session->setFlash(__('No se pudo guardar el Zeta', true));
                        $error = true;
                    }
                }
                if (!$error) {
                    $this->__enviarArqueoPorMail($this->Arqueo->id);
                    $this->redirect('edit/'.$this->Arqueo->id);
                }
            } else {
                $this->Session->setFlash(__('No se pudo guardar el Arqueo', true));
                $error = true;
            }
            if (!$error) {
                $this->Session->setFlash("Se guardó un nuevo arqueo de caja");
            }
        }
        
         $now = strtotime('now');
        if (date('H', $now) > 0 && date('H', $now) < 5) {
            // si estamos entre la 1 y las 5 de la mañana, entonces poner como que es el dia de ayer
            $now = strtotime('-1 day');
        }
        $this->data['Arqueo']['datetime'] = date('Y-m-d H:i', $now);

        $this->__presetData($caja_id);
        
        $cajas = $this->Arqueo->Caja->find('list');
        $this->set(compact('cajas'));
    }
    
    
    public function edit($id) {
        
        if (!empty($this->data)) {
            $this->Arqueo->create();
            $error = false;
            if ($this->Arqueo->save($this->data)) {

                if ( !empty($this->data['Arqueo']['hacer_cierre_zeta']) ) {
                    $this->Arqueo->Zeta->create();
                    $this->data['Zeta']['arqueo_id'] = $this->Arqueo->id;
                    if (!$this->Arqueo->Zeta->save($this->data)) {
                        $this->Session->setFlash(__('No se pudo guardar el Zeta', true));
                        $error = true;
                    }
                }
                if (!$error) {
                    $this->__enviarArqueoPorMail($this->Arqueo->id);                    
                    $this->redirect('index');
                }
                
            } else {
                $this->Session->setFlash(__('No se pudo guardar el Arqueo', true));
                $error = true;
            }
            if (!$error) {
                $this->Session->setFlash("Se guardó un nuevo arqueo de caja");
            }
        } else {
            $this->data = $this->Arqueo->read(null, $id);
            if ( array_key_exists('Zeta', $this->data) && array_key_exists('id', $this->data['Zeta']) && !empty($this->data['Zeta']['id'])) {
                $this->data['Arqueo']['hacer_cierre_zeta'] = 1;
            } else {
                $this->data['Arqueo']['hacer_cierre_zeta'] = 0;
            }
        }
        
        $this->Arqueo->Caja->recursive = -1;
        $caja = $this->Arqueo->Caja->read(null, $this->data['Arqueo']['caja_id']);
      
        $this->set('caja', $caja);
        
        $this->__presetIngresosEgresos($caja);
        
        if ( !empty($this->data['Caja']['id']) ) {
            $this->data['Arqueo']['caja_id'] = $this->data['Caja']['id'];            
            $this->Arqueo->Caja->recursive = -1;
            $caja = $this->Arqueo->Caja->read(null, $this->data['Caja']['id']);            
            $this->set('caja', $caja);
        }
        
        
        $this->render('add');
    }

}

