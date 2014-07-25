<?php

App::uses('CashAppController', 'Cash.Controller');

class ArqueosController extends CashAppController
{
    const TIPO_DE_PAGO_EFECTIVO = 1;

    public $uses = array('Cash.Arqueo', 'Account.Egreso', 'Mesa.Pago');
    
    
    
    
    public function help() {
        $this->Arqueo->Caja->recursive = -1;
        $this->set('cajas', $this->Arqueo->Caja->find('all'));
    }

    public function index()
    {
        $arqueos = $this->Paginator->paginate();
        $cajas = $this->Arqueo->Caja->find('list');
        $this->set(compact('arqueos', 'cajas'));
    }
    
    private function __presetIngresosEgresos ($caja = null) {
        
        if ( !empty($this->request->data['Arqueo']['id']) ) {
            $hasta = $this->request->data['Arqueo']['datetime'];
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
        if ( !empty($this->request->data['Arqueo']['id']) ) {
            $conditions['conditions'][ 'Arqueo.datetime <'] = $this->request->data['Arqueo']['datetime'];
        }
        $ultimoArqueo = $this->Arqueo->find('first', $conditions);
        if ( empty($ultimoArqueo) ) {
                $desde = date('Y-m-d H:i:s', strtotime('-4 month') );
        } else {
            $desde = $ultimoArqueo['Arqueo']['datetime'];
            $this->request->data['Arqueo']['importe_inicial'] = $ultimoArqueo['Arqueo']['importe_final'];
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
                'count(1) as cant',
                'sum(Egreso.total) as total',
                'TipoDePago.name'
            ),
            'order' => array(
                'TipoDePago.name'
            ),
        ));

        $sumaEgresos = 0;
        $sumaEgCant = 0;
        foreach ($egresosList as $el) {            
            if (empty($this->request->data['Arqueo']['egreso'])) {
                if ($el['TipoDePago']['id'] == ArqueosController::TIPO_DE_PAGO_EFECTIVO ) {
                    if ( $computa_egresos ) {
                        $this->request->data['Arqueo']['egreso'] = $el[0]['total'];
                    }
                }
            }
            $sumaEgCant++;
            $sumaEgresos += $el[0]['total'];
        }
        $egresosList[] = array(
            0 => array(
                'total' => $sumaEgresos,
                'cant' => $sumaEgCant,
            ),
            'TipoDePago' => array(
                'name' => 'Total'
            )
        );
                
        
        
        $ingresosList = $this->Pago->find('all', array(
            'conditions' => array(
                'Pago.created BETWEEN ? AND ?' => array($desde, $hasta),
            ),
            'group' => array('Pago.tipo_de_pago_id'),
            'contain' => array(
                'TipoDePago',
            ),
            'fields' => array(
                'count(1) as cant',
                'sum(Pago.valor) as total',
                'TipoDePago.name'
            ),
            'order' => array(
                'TipoDePago.name'
            ),
        ));
        
        $sumaIngresos = 0;
        $sumaIngCant = 0;
        foreach ($ingresosList as $el) {
            if ( empty($this->request->data['Arqueo']['ingreso']) ) {
                if ($el['TipoDePago']['id'] == ArqueosController::TIPO_DE_PAGO_EFECTIVO) {
                    if ( $computa_ingresos ) {
                        $this->request->data['Arqueo']['ingreso'] = $el[0]['total'];
                    }
                }
            }
            $sumaIngCant++;
            $sumaIngresos += $el[0]['total'];
        }
        $ingresosList[] = array(
            0 => array(
                'total' => $sumaIngresos,
                'cant' => $sumaIngCant,
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
            $this->request->data['Arqueo']['caja_id'] = $caja_id;
            $this->Arqueo->Caja->recursive = -1;
            $caja = $this->Arqueo->Caja->read(null, $caja_id);
            if (!empty($caja) && empty($caja['Caja']['computa_egresos'])) {
                $this->request->data['Arqueo']['egreso'] = null;
            }
            if (!empty($caja) && empty($caja['Caja']['computa_ingresos'])) {
                $this->request->data['Arqueo']['ingreso'] = null;
            }
            $this->set('caja', $caja);
        }
        
        $sumaIngresos = $this->__presetIngresosEgresos($caja);
        
        $ultimoZeta = $this->Arqueo->Zeta->find('first', array(
            'order' => 'numero_comprobante DESC'
        ));
        if ( !empty($ultimoZeta)) {
            $this->request->data['Zeta']['numero_comprobante'] = $ultimoZeta['Zeta']['numero_comprobante']+1;
            $this->request->data['Zeta']['total_ventas'] = $sumaIngresos;
        }
        
        
    }
    
    
    private function __enviarArqueoPorMail($arqueo_id) {
                                
    }

    public function add($caja_id = null)
    {
        if (!empty($this->request->data)) {
            $error = false;
            
            if ($this->Arqueo->save($this->request->data)) {
                $this->request->data['Zeta']['arqueo_id'] = $this->Arqueo->id;
                if ( !empty($this->request->data['Arqueo']['hacer_cierre_zeta']) ) {
                    if (!$this->Arqueo->Zeta->save($this->request->data)) {
                        $this->Session->setFlash(__('No se pudo guardar el Zeta', true));
                        $error = true;
                    }
                }
                if (!$error) {
                    $this->__enviarArqueoPorMail($this->Arqueo->id);
                }
            }
            
            if (!$error) {
                $this->Session->setFlash("Se guardó un nuevo arqueo de caja");
                $this->redirect('edit/'.$this->Arqueo->id);
            } else {
                $this->Session->setFlash(__('No se pudo guardar el Arqueo', true));
                $error = true;
            }
        }
        
        $this->request->data['Arqueo']['datetime'] = date('Y-m-d H:i', strtotime('now'));

        $this->__presetData($caja_id);
        
        $cajas = $this->Arqueo->Caja->find('list');
        $this->set(compact('cajas'));
    }
    
    
    public function edit($id) {
        
        if (!empty($this->request->data)) {
            $this->Arqueo->create();
            $error = false;
            if ($this->Arqueo->save($this->request->data)) {

                if ( !empty($this->request->data['Arqueo']['hacer_cierre_zeta']) ) {
                    $this->Arqueo->Zeta->create();
                    $this->request->data['Zeta']['arqueo_id'] = $this->Arqueo->id;
                    if (!$this->Arqueo->Zeta->save($this->request->data)) {
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
            $this->request->data = $this->Arqueo->read(null, $id);
            if ( array_key_exists('Zeta', $this->request->data) && array_key_exists('id', $this->request->data['Zeta']) && !empty($this->request->data['Zeta']['id'])) {
                $this->request->data['Arqueo']['hacer_cierre_zeta'] = 1;
            } else {
                $this->request->data['Arqueo']['hacer_cierre_zeta'] = 0;
            }
        }
        
        $this->Arqueo->Caja->recursive = -1;
        $caja = $this->Arqueo->Caja->read(null, $this->request->data['Arqueo']['caja_id']);
      
        $this->set('caja', $caja);
        
        $this->__presetIngresosEgresos($caja);
        
        if ( !empty($this->request->data['Caja']['id']) ) {
            $this->request->data['Arqueo']['caja_id'] = $this->request->data['Caja']['id'];            
            $this->Arqueo->Caja->recursive = -1;
            $caja = $this->Arqueo->Caja->read(null, $this->request->data['Caja']['id']);            
            $this->set('caja', $caja);
        }
        
        
        $this->render('add');
    }

}

