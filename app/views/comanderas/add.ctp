<div class="comanderas form">
<?php echo $form->create('Comandera');?>
	<fieldset>
 		<legend><?php __('Add Comandera');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('path');
		echo $form->input('imprime_ticket');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Comanderas', true), array('action'=>'index'));?></li>
	</ul>
</div>
