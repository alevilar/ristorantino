<?php

class EgresosController extends AccountAppController
{

    var $name = 'Egresos';
    var $helpers = array('Html', 'Form', 'Number', 'Jqm');

    function index()
    {
        $this->Egreso->recursive = 1;
        $this->set('egresos', $this->paginate());
    }

    function history()
    {
        $this->pageTitle = "Pagos Realizados";
        $this->Egreso->recursive = 1;
        $conditions = array();

        $conditions = array();
        $url = $this->params['url'];
        unset($url['ext']);
        unset($url['url']);

        
        if (!empty($url['fecha_desde'])) {
            $conditions['Egreso.fecha >='] = $url['fecha_desde'];
            $this->data['Egreso']['fecha_desde'] = $url['fecha_desde'];
        }

        if (!empty($url['fecha_hasta'])) {
            $conditions['Egreso.fecha <='] = $url['fecha_hasta'];
            $this->data['Egreso']['fecha_hasta'] = $url['fecha_hasta'];
        }        

        if (empty($url)) {
            $conditions['Egreso.fecha >='] = $this->data['Gasto']['fecha_desde'] = date('Y-m-d', strtotime('-1month'));
            $conditions['Egreso.fecha <='] = $this->data['Gasto']['fecha_hasta'] = date('Y-m-d', strtotime('now'));
        }
        
        $this->paginate = array(
            'contain' => array(
                'TipoDePago',
                'Gasto' => array(
                    'Proveedor',
                    'TipoFactura',
                ),
            ),
            'conditions' => $conditions,
        );

        $this->set('proveedores', $this->Egreso->Gasto->Proveedor->find('list'));
        $this->set('egresos', $this->paginate());
    }

    function edit($egreso_id)
    {
        if (!empty($this->data)) {
            if (!$this->Egreso->save($this->data )) {
                $this->Session->setFlash('El pago no pudo ser guardado');
            } else {
                $this->Session->setFlash('El Pago fue guardado');
            }
        }
        $this->data = $this->Egreso->read(null, $egreso_id);
        $this->set('tipoDePagos', $this->Egreso->TipoDePago->find('list'));
    }

    function add($gasto_id = null)
    {
        $gastos = array();
        if (!empty($gasto_id)) {
            $gastos[] = $gasto_id;
        }

        $suma_gastos = 0;
        $gastosAll = array();


        if (!empty($this->data['Gasto'])) {
            // re armo el array de gastos limpiando los que no fueron seleccionados para pagar
            foreach ($this->data['Gasto'] as $g) {
                if ($g['gasto_seleccionado']) {
                    $gastos[] = $g['gasto_seleccionado'];
                }
            }
        }

        if (!empty($gastos)) {
            // calculo la suma total del los gastos $$ seleccionados
            $gastosAll = $this->Egreso->Gasto->find('all', array(
                'conditions' => array(
                    'Gasto.id' => $gastos,
                ),
                'recursive' => 1,
                    ));
            foreach ($gastosAll as $g) {
                $suma_gastos += $g['Gasto']['importe_total'] - $g['Gasto']['importe_pagado'];
            }

            $this->set('gastos', $this->Egreso->Gasto->find('list', array(
                        'conditions' => array(
                            'Gasto.id' => $gastos,
                        )
                    )));
        } else {
            $this->flash('Error, se debe seleccionar algun gasto', array('index'));
        }

        if (count($gastos) > 1) {
            $this->pageTitle = 'Pagando ' . count($gastos) . ' Gastos';
        } else {
            $this->pageTitle = 'Pagando ' . count($gastos) . ' Gasto';
        }
        $this->set('tipo_de_pagos', $this->Egreso->TipoDePago->find('list'));
        $this->data['Gasto'] = $gastos;
        $this->set('suma_gastos', $suma_gastos);
        $this->set('gastosAll', $gastosAll);
    }

    function save()
    {
        if (!empty($this->data)) {
            $this->Egreso->create();
            if ($this->Egreso->save($this->data)) {
                $this->Session->setFlash('El Pago fue guardado correctamente');
                $this->redirect(array('controller' => 'gastos', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error al guardar el pago');
            }
        }
    }

    function view($id)
    {
        if (empty($id)) {
            $this->flash('No se pasó un ID de pago correcto', array('controller' => 'gastos', 'action' => 'index'));
        }
        $this->Egreso->id = $id;
        $this->set('egreso', $this->Egreso->read());
    }

}

?>