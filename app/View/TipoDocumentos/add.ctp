<div class="tipoDocumentos form">
<?php echo $this->Form->create('TipoDocumento');?>
	<fieldset>
 		<legend><?php echo __('Crear Tipo de documento');?></legend>
	<?php
		echo $this->Form->input('codigo_fiscal');
		echo $this->Form->input('name');
	?>
<?php echo $this->Form->end('Submit');?>
</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Tipo de Documentos'), array('action' => 'index'));?></li>
	</ul>
</div>
