<div class="egresos form">
<?php echo $form->create('Egreso');?>
	<fieldset>
 		<legend><?php __('Add Egreso');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('total');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Egresos', true), array('action' => 'index'));?></li>
	</ul>
</div>
