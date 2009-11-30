<div class="tipoDePagos form">
<?php echo $form->create('TipoDePago');?>
	<fieldset>
 		<legend><?php __('Add TipoDePago');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List TipoDePagos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Pago', true), array('controller'=> 'pagos', 'action'=>'add')); ?> </li>
	</ul>
</div>
