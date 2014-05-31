<div class="tipoFacturas form">
<?php echo $form->create('TipoFactura');?>
	<fieldset>
 		<legend><?php __('Edit TipoFactura');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('TipoFactura.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('TipoFactura.id'))); ?></li>
		<li><?php echo $html->link(__('List TipoFacturas', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Egresos', true), array('controller' => 'egresos', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Egreso', true), array('controller' => 'egresos', 'action' => 'add')); ?> </li>
	</ul>
</div>
