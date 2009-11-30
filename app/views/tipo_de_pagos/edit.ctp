<div class="tipoDePagos form">
<?php echo $form->create('TipoDePago');?>
	<fieldset>
 		<legend><?php __('Edit TipoDePago');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('TipoDePago.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('TipoDePago.id'))); ?></li>
		<li><?php echo $html->link(__('List TipoDePagos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Pago', true), array('controller'=> 'pagos', 'action'=>'add')); ?> </li>
	</ul>
</div>
