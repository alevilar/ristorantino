        <?php     
            echo $this->element('menuadmin');
        ?>
        

<div class="mozos form">
<?php echo $this->Form->create('Mozo');?>
	<fieldset>
 		<legend><?php __('Editar Mozo');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
                echo $this->Form->input('nombre');
                echo $this->Form->input('apellido');
                echo $this->Form->input('activo',array('after'=>'<p>Sólo los mozos activos apareran en la Adición.</br>Si BORRA un mozo se pierden los datos estadisticos, puede desactivarlo para no perder información.</p>'));
	?>
     <?php echo $this->Form->end('Submit');?>           
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $this->Form->value('Mozo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Mozo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Mozos', true), array('action'=>'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
                <li><?php echo $this->Html->link(__('Nuevo usuario', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>
