<div class="ivaResponsabilidades form">
<?php echo $form->create('IvaResponsabilidad');?>
	<fieldset>
 		<legend><?php __('Edit IvaResponsabilidad');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('codigo_fiscal');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('IvaResponsabilidad.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('IvaResponsabilidad.id'))); ?></li>
		<li><?php echo $html->link(__('List IvaResponsabilidades', true), array('action' => 'index'));?></li>
	</ul>
</div>
