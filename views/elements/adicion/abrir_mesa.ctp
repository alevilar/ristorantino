

	<div id="mesa-abrir" style="display: none">
		<?php 
			echo $form->create('Mesa',array('action'=>'abrirMesa'));
			echo $form->input('mozo_id',array('type'=>'hidden','value'=>$current_mozo_id));
			echo $form->input('numero',array('label'=>'','style'=>'float:left;'));
			echo $form->button('Cancelar',array('onclick'=>'Dialog.closeInfo();'));
			echo $form->end('Abrir mesa');
		?>
	</div>