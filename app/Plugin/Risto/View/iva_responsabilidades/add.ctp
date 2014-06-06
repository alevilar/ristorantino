<div class="ivaResponsabilidades form">
<?php echo $this->Form->create('IvaResponsabilidad');?>
	<fieldset>
 		<legend><?php __('Add IvaResponsabilidad');?></legend>
	<?php
		echo $this->Form->input('codigo_fiscal');
		echo $this->Form->input('name');
	?>
<?php echo $this->Form->end('Submit');?>
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar IVA responsabilidad', true), array('action' => 'index'));?></li>
	</ul>
</div>
