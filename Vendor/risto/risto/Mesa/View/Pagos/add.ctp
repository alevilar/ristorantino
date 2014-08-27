<div class="pagos form">
<?php echo $this->Form->create('Pago');?>
	<fieldset>
 		<legend><?php __('Add Pago');?></legend>
	<?php
		echo $this->Form->input('mesa_id');
		echo $this->Form->input('tipo_de_pago_id');
		echo $this->Form->input('valor');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Pagos', true), array('action'=>'index'));?></li>
	</ul>
</div>
