<div class="pagos form">
<?php echo $form->create('Pago');?>
	<fieldset>
 		<legend><?php __('Add Pago');?></legend>
	<?php
		echo $form->input('mesa_id');
		echo $form->input('tipo_de_pago_id');
		echo $form->input('valor');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Pagos', true), array('action'=>'index'));?></li>
	</ul>
</div>
