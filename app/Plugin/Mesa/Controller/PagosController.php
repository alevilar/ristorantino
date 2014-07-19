<?php

App::uses('MesaAppController', 'Mesa.Controller');


class PagosController extends MesaAppController 
{

	public $name = 'Pagos';
	

   public function index() {
    $this->Prg->commonProcess();
    $conds = $this->Pago->parseCriteria( $this->Prg->parsedParams() );



    $this->Pago->recursive = 0;
    $this->paginate = array(
        'contain' => array(
            'Mesa.Mozo',
            'TipoDePago'
            ),
        'conditions' => $conds,
        'order' => 'Pago.created DESC'
        );

    $tipo_de_pagos = $this->Pago->TipoDePago->find('list');        
    $mozos = $this->Pago->Mesa->Mozo->listFullName();
    $pagos = $this->paginate();
    $this->set(compact('tipo_de_pagos', 'mozos', 'pagos'));
}

public function view($id = null) {
  if (!$id) {
     $this->Session->setFlash(__('Invalid Pago.'));
     $this->redirect(array('action'=>'index'));
 }
 $this->set('pago', $this->Pago->read(null, $id));
}


public function addForMesa ( $mesa_id ) {
  if (!$this->Pago->Mesa->exists( $mesa_id ) ) {
      throw new NotFoundException(__('Invalid Mesa'));
  }

  if ($this->request->is('post')) {
      $this->Pago->create();
      if ($this->Pago->save($this->request->data)) {
        $this->Session->setFlash(__('The Pago has been saved.'));
        return $this->redirect( $this->request->data['Pago']['redirect'] );
      } else {
        $this->Session->setFlash(__('The Pago could not be saved. Please, try again.'));
      }
  } else {
    $this->request->data['Pago']['redirect'] = $this->referer();
    $this->request->data['Pago']['mesa_id'] = $mesa_id;
  }
  $this->set('mesaId', $mesa_id);
  $this->set('tipo_de_pagos', $this->Pago->TipoDePago->find('list'));
}

public function add() {
  if ( $this->request->is('post') ) {
    if (!empty($this->request->data['Mesa'])) {
        $this->request->data['Mesa']['estado_id'] = MESA_COBRADA;
        $this->request->data['Mesa']['time_cobro'] = date( "Y-m-d H:i:s", strtotime('now'));
        $this->Pago->Mesa->save($this->request->data['Mesa']);
    }

    $importeMesa = $this->Pago->Mesa->calcular_total($this->request->data['Mesa']['id']);

    if ( !empty( $this->request->data['Pago'] ) && count($this->request->data['Pago']) == 1 && empty($this->request->data['Pago'][0]['valor']) ) {
        if (!empty($this->request->data['Mesa'])) {
            $this->request->data['Pago'][0]['valor'] = $importeMesa;
        }
    }

    $sumaPagos = 0;
    foreach ( $this->request->data['Pago'] as $key=>$pago ) {
        if ( !array_key_exists('valor', $pago ) || empty($pago['valor']) ) {
            unset($this->request->data['Pago'][$key]);
        } else {
            $sumaPagos += $pago['valor'];
        }
    }
    if ( $sumaPagos != $importeMesa ) {
                        // creo un importe en efectivo que devuelva el cambio
        $this->request->data['Pago'][] = array(
            'mesa_id' => $this->request->data['Mesa']['id'],
            'tipo_de_pago_id' => TIPO_DE_PAGO_EFECTIVO,
            'valor' => $importeMesa - $sumaPagos,
            );
    }

    if ($this->Pago->saveAll($this->request->data['Pago'])) {
        $this->Session->setFlash(__('The Pago has been saved'));
    } else {
        $this->Session->setFlash(__('The Pago could not be saved. Please, try again.'));
    }
  }
  if (!$this->request->is('ajax')) {
      $this->redirect($this->referer());
  } else {
      exit;
  }
}



  public function edit($id = null) {
    if (!$id && empty($this->request->data)) {
       $this->Session->setFlash(__('Invalid Pago'));
       $this->redirect(array('action'=>'index'));
    }
    if (!empty($this->request->data)) {
       if ($this->Pago->save($this->request->data)) {
          $this->Session->setFlash(__('The Pago has been saved'));
          $this->redirect(array('action'=>'index'));
      } else {
          $this->Session->setFlash(__('The Pago could not be saved. Please, try again.'));
      }
    }
    if (empty($this->request->data)) {
      $this->request->data = $this->Pago->read(null, $id);
    }
    $mesa = $this->Pago->Mesa->read(null, $this->request->data['Pago']['mesa_id']);
    $tipoDePagos = $this->Pago->TipoDePago->find('list');
    $this->set(compact('mesa','tipoDePagos'));
  }

  public function delete($id = null) {
    if (!$id) {
       $this->Session->setFlash(__('Invalid id for Pago'));
       $this->redirect(array('action'=>'index'));
   }
   if ($this->Pago->delete($id)) {
       $this->Session->setFlash(__('Pago deleted'));
       $this->redirect(array('action'=>'index'));
   }
  }

}
?>