<div class="descuentos form">
<?php echo $form->create('Descuento');?>
	<fieldset>
 		<legend><?php __('Add Descuento');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('porcentaje');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Descuentos', true), array('action'=>'index'));?></li>
	</ul>
</div>
