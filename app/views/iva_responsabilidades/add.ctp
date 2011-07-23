<div class="ivaResponsabilidades form">
<?php echo $form->create('IvaResponsabilidad');?>
	<fieldset>
 		<legend><?php __('Add IvaResponsabilidad');?></legend>
	<?php
		echo $form->input('codigo_fiscal');
		echo $form->input('name');
	?>
<?php echo $form->end('Submit');?>
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar IVA responsabilidad', true), array('action' => 'index'));?></li>
	</ul>
</div>
