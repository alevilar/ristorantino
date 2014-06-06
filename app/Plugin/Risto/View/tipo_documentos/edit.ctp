<div class="tipoDocumentos form">
<?php echo $this->Form->create('TipoDocumento');?>
	<fieldset>
 		<legend><?php __('Editar tipo de documento');?></legend>
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
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TipoDocumento.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TipoDocumento.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List TipoDocumentos', true), array('action' => 'index'));?></li>
	</ul>
</div>
