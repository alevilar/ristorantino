<div class="impfiscales form">
<?php echo $form->create('Impfiscal');?>
	<fieldset>
 		<legend><?php __('Add Impfiscal');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('path');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Impfiscales', true), array('action'=>'index'));?></li>
	</ul>
</div>
