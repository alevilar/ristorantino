<div class="tipoImpuestos form">
<?php echo $form->create('TipoImpuesto');?>
	<fieldset>
 		<legend><?php __('Add TipoImpuesto');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('porcentaje');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List TipoImpuestos', true), array('action' => 'index'));?></li>
	</ul>
</div>
