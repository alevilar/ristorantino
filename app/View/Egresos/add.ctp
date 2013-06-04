<div class="egresos form">
<?php echo $this->Form->create('Egreso');?>
	<fieldset>
 		<legend><?php echo __('Add Egreso');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('total');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Egresos'), array('action' => 'index'));?></li>
	</ul>
</div>
