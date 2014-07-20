<?php

App::uses('AccountAppController', 'Account.Controller');

/**
 * @property Cierre $Cierre
 */
class CierresController extends AccountAppController
{

            
    function index()
    {
        $this->Cierre->recursive = -1;
        $this->set('cierres', $this->paginate());
    }

    
   
    function add()
    {        
        if (!empty($this->request->data)) {
            $this->Cierre->create();
            if ($this->Cierre->save($this->request->data)) {
                foreach ($this->request->data['Gasto'] as $gasto){
                    $this->Cierre->Gasto->id = $gasto['id'];
                    $this->Cierre->Gasto->saveField('cierre_id', $this->Cierre->id);
                }
                $this->Session->setFlash('Se Guardó correctamente');
            } else {
                $this->Session->setFlash('Fallo al guardar');
            }
        }
    }
    
    function view( $id ) {
        debug( $this->RequestHandler->ext );
        if ( empty($id) ) {
            throw new Exception("Se debe pasar un ID como parámetro");            
        }
        
        $ops = array(            
            'conditions' => array(
                'Gasto.cierre_id' => $id,
            ),
            'recursive' => 1,
        );

        $gastos = $this->Cierre->Gasto->find('all', $ops);
        $cierre = $this->Cierre->read( null, $id );
        $tipo_impuestos = $this->Cierre->Gasto->TipoImpuesto->find('list');
        $this->set(compact('gastos', 'cierre', 'tipo_impuestos'));       
            
    }


}

