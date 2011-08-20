<div class="mesaEstados form">
<?php echo $form->create('MesaEstado');?>
	<fieldset>
 		<legend><?php __('Add MesaEstado');?></legend>
	<?php
		echo $form->input('parent_id');
		echo $form->input('name');
		echo $form->input('lft');
		echo $form->input('rght');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List MesaEstados', true), array('action' => 'index'));?></li>
	</ul>
</div>
