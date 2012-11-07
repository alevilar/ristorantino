<div class="ivaResponsabilidades form">
<?php echo $this->Form->create('IvaResponsabilidad');?>
	<fieldset>
 		<legend><?php echo __('Edit IvaResponsabilidad');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo_fiscal');
		echo $this->Form->input('name');
	?>
                <?php echo $this->Form->end('Submit');?>
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar'), array('action' => 'delete', $this->Form->value('IvaResponsabilidad.id')), null, sprintf(__('Esta seguro que desea borrar # %s?'), $this->Form->value('IvaResponsabilidad.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar IVA responsabilidad'), array('action' => 'index'));?></li>
	</ul>
</div>
