<div class="reservas form">
<?php echo $this->Form->create('Reserva');?>
	<fieldset>
 		<legend><?php __('Add Reserva');?></legend>
	<?php
		echo $this->Form->input('nombre');
		echo $this->Form->input('personas');
                echo $this->Form->input('menores');
		echo $this->Form->input('mesa');
                echo $this->Form->input('debe_pagar');
                echo $this->Form->input('pago');
		echo $this->Form->input('observaciones');
		echo $this->Form->input('evento');
		echo $this->Form->input('fecha');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Reservas', true), array('action' => 'index'));?></li>
	</ul>
</div>
