<div class="comanderas form">
<?php echo $form->create('Comandera');?>
	<fieldset>
 		<legend><?php __('Add Comandera');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('imprime_ticket');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Comanderas', true), array('action'=>'index')); ?></li>
		<li><?php echo $html->link(__('Nueva Comandera', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Configurar Impresora Fiscal', true), array('action'=>'fiscal_edit')); ?></li>
	</ul>
</div>
