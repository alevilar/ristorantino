<div class="gastos form">
<?php echo $form->create('Gasto');?>
	<fieldset>
 		<legend><?php __('Add Gasto');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('importe');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Gastos', true), array('action' => 'index'));?></li>
	</ul>
</div>
