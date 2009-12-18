<div class="comensales form">
<?php echo $form->create('Comensal',array('action'=>'add/'.$mesa['Mesa']['id']));?>
	<fieldset>
 		<legend>Agregar Comensales de la mesa <?php echo $mesa['Mesa']['numero']?></legend>
	<?php
		echo $form->input('cant_mayores',array('default'=>0));
		echo $form->input('cant_menores',array('default'=>0));
		echo $form->input('cant_bebes',array('default'=>0));
		echo $form->hidden('mesa_id');
	?>
	</fieldset>
<?php echo $ajax->submit('Guardar');?>
</div>
