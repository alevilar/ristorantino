<div class="clientes form">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
		<legend><?php echo __('Edit Cliente'); ?></legend>
	<?php
		echo $this->Form->input('id');
		
		echo $this->Form->input('nombre');
		echo $this->Form->input('tipo_documento_id', array('default'=> TIPO_DOCUMENTO_SIN_IDENTIFICAR, 'empty' => 'Seleccione' ));
		echo $this->Form->input('nrodocumento');
		echo $this->Form->input('iva_responsabilidad_id', array('default'=> IVA_RESPONSABILIDAD_CONSUMIDOR_FINAL, 'empty' => 'Seleccione' ));
		
		echo $this->Form->input('descuento_id', array('empty'=>'Sin Descuento'));

		echo $this->Form->input('codigo');
		echo $this->Form->input('mail');
		echo $this->Form->input('telefono');
		echo $this->Form->input('domicilio');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
