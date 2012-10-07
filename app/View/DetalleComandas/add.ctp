<div class="comandas form">
<?php echo $form->create('DetalleComanda');?>
	<fieldset>
 		<legend><?php __('Add Comanda');?></legend>
	<?php
		echo $form->input('producto_id');
		echo $form->input('cant');
		echo $form->input('mesa_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Comandas', true), array('action'=>'index'));?></li>
	</ul>
</div>
