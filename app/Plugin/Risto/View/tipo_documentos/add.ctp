<div class="tipoDocumentos form">
<?php echo $form->create('TipoDocumento');?>
	<fieldset>
 		<legend><?php __('Crear Tipo de documento');?></legend>
	<?php
		echo $form->input('codigo_fiscal');
		echo $form->input('name');
	?>
<?php echo $form->end('Submit');?>
</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Tipo de Documentos', true), array('action' => 'index'));?></li>
	</ul>
</div>
