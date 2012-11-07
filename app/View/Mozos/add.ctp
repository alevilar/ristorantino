
<div class="mozos form">
<?php echo $this->Form->create('Mozo');?>
	<fieldset>
 		<legend>Nuevo Mozo</legend>
	<?php
		echo $this->Form->input('numero');
                echo $this->Form->input('nombre');
                echo $this->Form->input('apellido');
                echo $this->Form->input('activo',array('after'=>'<p>Sólo los mozos activos aparecerán listados en la Adición.'));
                
                echo $this->Form->end('Submit');
        ?>
	</fieldset>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Mozos'), array('action'=>'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nuevo usuario'), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mesas'), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
	</ul>
</div>
