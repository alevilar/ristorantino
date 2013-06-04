        

<div class="mozos form">
<?php echo $this->Form->create('Mozo', array('type'=>'file'));?>
	<fieldset>
 		<legend><?php echo __('Editar Mozo');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
                echo $this->Form->input('nombre');
                echo $this->Form->input('apellido');
				echo $this->Form->input('image_url', array('type'=>'file'));
                echo $this->Form->input('activo',array('after'=>'<p>Sólo los mozos activos apareran en la Adición.</br>Si BORRA un mozo se pierden los datos estadisticos, puede desactivarlo para no perder información.</p>'));
	?>
     <?php echo $this->Form->end('Submit');?>           
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $this->Form->value('Mozo.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Mozo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Mozos'), array('action'=>'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mesas'), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
                <li><?php echo $this->Html->link(__('Nuevo usuario'), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>
