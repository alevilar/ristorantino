<div class="ivaResponsabilidades form">
<?php echo $form->create('IvaResponsabilidad');?>
	<fieldset>
 		<legend><?php __('Edit IvaResponsabilidad');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('codigo_fiscal');
		echo $form->input('name');
	?>
                <?php echo $form->end('Submit');?>
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action' => 'delete', $form->value('IvaResponsabilidad.id')), null, sprintf(__('Esta seguro que desea borrar # %s?', true), $form->value('IvaResponsabilidad.id'))); ?></li>
		<li><?php echo $html->link(__('Listar IVA responsabilidad', true), array('action' => 'index'));?></li>
	</ul>
</div>
