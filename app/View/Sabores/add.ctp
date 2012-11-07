<div class="sabores form">
<?php echo $this->Form->create('Sabor');?>
	<fieldset>
 		<legend><?php echo __('Crear Sabor');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('categoria_id');
		echo $this->Form->input('precio');
	?>
<?php echo $this->Form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Sabores'), array('action'=>'index'));?></li>
	</ul>
</div>
