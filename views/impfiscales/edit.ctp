<div class="impfiscales form">
<?php echo $form->create('Impfiscal');?>
	<fieldset>
 		<legend><?php __('Edit Impfiscal');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('path');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Impfiscal.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Impfiscal.id'))); ?></li>
		<li><?php echo $html->link(__('List Impfiscales', true), array('action'=>'index'));?></li>
	</ul>
</div>
