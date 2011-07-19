<div class="agencies form">
<?php echo $form->create('Agency');?>
	<fieldset>
 		<legend><?php __('Crear agencia');?></legend>
	<?php
		echo $form->input('name', array('label' => 'Nombre'));
                echo $form->input('activo', array('options' => array('1'=>'Si','0'=>'No')) );
	?>
	</fieldset>
<?php echo $form->end('Crear agencia');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Volver al listado', true), array('action'=>'index'));?></li>
	</ul>
</div>
