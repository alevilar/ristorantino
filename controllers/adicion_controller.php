<?php

class AdicionController extends AppController {

	var $name = 'Adicion';
	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $current_mozo_id;
	var $current_mesa_id;
	var $current_mesa_numero;
	var $layout = 'adicion';

	
	function beforeFilter(){
		//siempre poner el mozo actual, cuando no hay ndie seleccionado mete un CERO
		$this->current_mozo_id =  (isset($this->passedArgs['mozo_id']))?$this->passedArgs['mozo_id']:0;
		
		$this->current_mesa_id = (isset($this->passedArgs['mesa_id']))?$this->passedArgs['mesa_id']:0;
		$this->current_mesa_numero = (isset($this->passedArgs['mesa_numero']))?$this->passedArgs['mesa_numero']:0;
	}
	
	
	function beforerender(){
		$this->set('current_mozo_id', $this->current_mozo_id);
		
		$this->set('current_mesa_id', $this->current_mesa_id);
		$this->set('current_mesa_numero', $this->current_mesa_numero);
		
		
		// esto es para javascript -----------------------------------
		$this->Mozo->id = $this->current_mozo_id;
		$this->set('current_mozo', json_encode($this->Mozo->read()));
 	
		$this->Mesa->id = $this->current_mesa_id;
		$this->set('current_mesa', json_encode($this->Mesa->read()));
		//---------------------------------------------------------------
	} 
	
	function home(){
		$this->set('mozos',$this->Mozo->find('list',array('fields'=>array('id','numero'))));
	}
	
	
	
	function adicionar(){
		$this->Mozo->id = $this->current_mozo_id;
		$this->Mozo->hasMany['Mesa']['order'] = "created DESC";
		$this->data = $this->Mozo->read();
		$this->set('mozos',$this->Mozo->find('list',array('fields'=>array('id','numero'))));
	}
	
	
	
	function cambiar_mozo(){				
		$this->set('mozos',$this->Mozo->find('list',array('fields'=>array('id','numero'))));
		if (isset($this->data['Adicion']['mozo_id'])):
			$this->current_mozo_id = $this->data['Adicion']['mozo_id'];
		else: $this->current_mozo_id = 0;	
		endif;
			
		$this->Mozo->id = $this->current_mozo_id;
		
		$this->data = $this->Mozo->read();
		
		$this->current_mesa_id = isset($this->data['Mesa'][0]['id'])?$this->data['Mesa'][0]['id']:0;
		$this->current_mesa_numero = isset($this->data['Mesa'][0]['numero'])?$this->data['Mesa'][0]['numero']:0;
		
		$this->redirect('adicionar/mozo_id:'.$this->current_mozo_id.'/mesa_id:'.$this->current_mesa_id.'/mesa_numero:'.$this->current_mesa_numero);
	}
	
}