<div class="tipoDocumentos form">
<?php echo $this->Form->create('TipoDocumento');?>
	<fieldset>
 		<legend><?php __('Crear Tipo de documento');?></legend>
	<?php
		echo $this->Form->input('codigo_fiscal');
		echo $this->Form->input('name');
	?>
<?php echo $this->Form->end('Submit');?>
</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Tipo de Documentos', true), array('action' => 'index'));?></li>
	</ul>
</div>
