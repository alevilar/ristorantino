<div class="tipoImpuestos form">
<?php echo $form->create('TipoImpuesto');?>
	<fieldset>
 		<legend><?php __('Editar TipoImpuesto');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('porcentaje');
	?>
<?php echo $form->end('Submit');?>
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action' => 'delete', $form->value('TipoImpuesto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('TipoImpuesto.id'))); ?></li>
		<li><?php echo $html->link(__('Listar Tipos de Impuestos', true), array('action' => 'index'));?></li>
	</ul>
</div>
