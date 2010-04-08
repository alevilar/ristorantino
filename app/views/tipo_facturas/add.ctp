<div class="tipoFacturas form">
<?php echo $form->create('TipoFactura');?>
	<fieldset>
 		<legend><?php __('Add TipoFactura');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List TipoFacturas', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Egresos', true), array('controller' => 'egresos', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Egreso', true), array('controller' => 'egresos', 'action' => 'add')); ?> </li>
	</ul>
</div>
