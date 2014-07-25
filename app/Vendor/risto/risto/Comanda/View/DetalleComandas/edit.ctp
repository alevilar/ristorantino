<div class="comandas form">
<?php echo $this->Form->create('DetalleComanda');
?>
	<fieldset>
 		<legend>Editar detalle de la Comanda #<?php echo$this->request->data['DetalleComanda']['comanda_id']?></legend>
<?php
		echo $this->Form->input('id');
		echo $this->Form->input('producto_id');
		echo $this->Form->input('cant');
		echo $this->Form->input('cant_eliminada');
		echo $this->Form->hidden('redirect');
	?>
		
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
