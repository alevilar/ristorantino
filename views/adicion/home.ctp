<div id="adicion-cabecera">
	<?php 
	echo $form->create('Adicion',array('action'=>'cambiar_mozo','id'=>'MozoCambiarMozoForm'));
	//$mozos = array(1,2,3,4,5,6,7,8,9,10,11,14,16);
	echo $form->input('mozo_id',array('type'=>'select','options'=>$mozos, 'onChange'=>'$("MozoCambiarMozoForm").submit()'));
	echo $form->end(null);

	
	?>
	
</div>

