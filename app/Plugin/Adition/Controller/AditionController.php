<?php 

class AditionController extends AditionAppController {
    
	public$helpers = array('Html', 'Form');
	public$uses = array('Mozo','Mesa');
	public$current_mozo_id;
	public$current_mesa_id;
	public$current_mesa_numero;
	public$layout = 'adicion';


	public function home()
        {
            $this->set('mozos',$this->Mozo->dameActivos());
	}



        public function abrirMesa() {
        if (!empty($this->request->data)) {
            // si ese numero de mesa no esta abierta continuo
            $existe = $this->Mesa->numero_de_mesa_existente($this->request->data['Mesa']['numero']);
            if(!$existe) {
                $this->Mesa->create();
                if ($this->Mesa->save($this->request->data,$validate = false)) {
                    $this->Session->setFlash(__('Se abrió la mesa n° '.$this->request->data['Mesa']['numero']));
                    //debug($this->request->data);
                    //	$this->Mesa->Mozo->id = $this->request->data['Mesa']['mozo_id'];
                    //	$this->request->data = $this->Mesa->Mozo->read();

                } else {
                    $this->Session->setFlash(__('La mesa no pudo ser abierta. Intente nuevamente.'));
                }

            }
            else { // si se encontro una mesa abierta con se numero
                $this->Session->setFlash(__('Ese número de mesa ya existe. No puede crear 2 mesas con el mismo número'));

            }
        }

        $meterMesa = '';
        if (!empty($this->Mesa->id)){
            $meterMesa = '/mesa_id:'.$this->Mesa->id;
        }
        $this->redirect(array(
                'action' => 'adicionar/mozo_id:'.$this->request->data['Mesa']['mozo_id'].$meterMesa)
                );

    }


    public function index() {
        $this->set('tipo_de_pagos', $this->Mozo->Mesa->Pago->TipoDePago->find('all'));
        $this->set('mozos', $this->Mozo->dameActivos());
        $this->set('observaciones', ClassRegistry::init('Observacion')->find('list', array('order' => 'Observacion.name')));
       $this->set('observacionesComanda', ClassRegistry::init('ObservacionComanda')->find('list', array('order' => 'ObservacionComanda.name')));
        $this->render('adicionar');
    }
	
	
	/**
	 * 
	 * esta es la accion para que adicione la adicion
	 * la diferencia aca es que se van amostrar todas las mesas abiertas independientemente del mozo
	 * @return unknown_type
	 */
	public function adicionar()
        {
            $this->set('tipo_de_pagos', $this->Mozo->Mesa->Pago->TipoDePago->find('all', array('recursive' => -1)));
            $this->set('mozos', $this->Mozo->dameActivos());
            $this->set('observaciones', ClassRegistry::init('Observacion')->find('list', array('order' => 'Observacion.name')));
            $this->set('observacionesComanda', ClassRegistry::init('ObservacionComanda')->find('list', array('order' => 'ObservacionComanda.name')));
	}
	
	
	public function cambiarMozo($mozo_id = 0)
        {
            $this->current_mozo_id = $mozo_id;
            $this->current_mesa_id = isset($this->request->data['Mesa'][0]['id'])?$this->request->data['Mesa'][0]['id']:0;
            $this->current_mesa_numero = isset($this->request->data['Mesa'][0]['numero'])?$this->request->data['Mesa'][0]['numero']:0;

            $this->redirect('adicionar/mozo_id:'.$this->current_mozo_id.'/mesa_id:'.$this->current_mesa_id.'/mesa_numero:'.$this->current_mesa_numero);
	}
	
}