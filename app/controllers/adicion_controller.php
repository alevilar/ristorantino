<?php

class AdicionController extends AppController {

	var $name = 'Adicion';
	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $current_mozo_id;
	var $current_mesa_id;
	var $current_mesa_numero;
	var $layout = 'adicion';

	
	function beforeFilter()
        {
            parent::beforeFilter();

            //siempre poner el mozo actual, cuando no hay ndie seleccionado mete un CERO
            $this->current_mozo_id =  (isset($this->passedArgs['mozo_id']))?$this->passedArgs['mozo_id']:0;

            $this->current_mesa_id = (isset($this->passedArgs['mesa_id']))?$this->passedArgs['mesa_id']:0;
            $this->current_mesa_numero = (isset($this->passedArgs['mesa_numero']))?$this->passedArgs['mesa_numero']:0;
	}
	
	
	function beforeRender()
        {
            $this->set('current_mozo_id', $this->current_mozo_id);

            $this->set('current_mesa_id', $this->current_mesa_id);
            $this->set('current_mesa_numero', $this->current_mesa_numero);


            // esto es para javascript -----------------------------------
            $this->Mozo->id = $this->current_mozo_id;
            $this->Mozo->recursive = 1;
            $this->set('current_mozo', json_encode($this->Mozo->read()));
            //---------------------------------------------------------------
	} 
	
	function home()
        {
            $this->set('mozos',$this->Mozo->dameActivos());
	}
	
	
	/**
	 * 
	 * esta es la accion para que adicione la adicion
	 * la diferencia aca es que se van amostrar todas las mesas abiertas independientemente del mozo
	 * @return unknown_type
	 */
	function adicionar()
        {
            if(!empty($this->passedArgs['mozo_id'])){
                    $this->current_mozo_id = $this->passedArgs['mozo_id'];
            }

            if(!empty($this->data['Mozo']['id'])){
                    $this->current_mozo_id = $this->data['Mozo']['id'];
            }
		
            $this->Mozo->id = $this->current_mozo_id;
            $this->Mozo->hasMany['Mesa']['order'] = "created DESC";
            $this->Mozo->hasMany['Mesa']['conditions'] = "time_cobro = '0000-00-00 00:00:00'";
            $this->data = $this->Mozo->read();
            $this->set('mozos',$this->Mozo->dameActivos());

            $this->Mesa->order = "Mesa.numero ASC";
            $this->set('mesasabiertas',$this->Mesa->listado_de_abiertas($recursividad = -1));
	}
	
	
	function cambiarMozo($mozo_id = 0)
        {
            $this->current_mozo_id = $mozo_id;
            $this->current_mesa_id = isset($this->data['Mesa'][0]['id'])?$this->data['Mesa'][0]['id']:0;
            $this->current_mesa_numero = isset($this->data['Mesa'][0]['numero'])?$this->data['Mesa'][0]['numero']:0;

            $this->redirect('adicionar/mozo_id:'.$this->current_mozo_id.'/mesa_id:'.$this->current_mesa_id.'/mesa_numero:'.$this->current_mesa_numero);
	}
	
}