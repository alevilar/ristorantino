<div class="tipoDocumentos form">
<?php echo $form->create('TipoDocumento');?>
	<fieldset>
 		<legend><?php __('Add TipoDocumento');?></legend>
	<?php
		echo $form->input('codigo_fiscal');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List TipoDocumentos', true), array('action' => 'index'));?></li>
	</ul>
</div>
