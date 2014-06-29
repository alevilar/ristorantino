<div class="clientes form">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
		<legend><?php echo __('Edit Cliente'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo');
		echo $this->Form->input('mail');
		echo $this->Form->input('telefono');
		echo $this->Form->input('descuento_id');
		echo $this->Form->input('tipofactura');
		echo $this->Form->input('nombre');
		echo $this->Form->input('nrodocumento');
		echo $this->Form->input('tipo_documento_id');
		echo $this->Form->input('domicilio');
		echo $this->Form->input('responsabilidad_iva');
		echo $this->Form->input('iva_responsabilidad_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
