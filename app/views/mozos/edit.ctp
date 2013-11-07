        <?php     
            echo $this->element('menuadmin');
        ?>
        

<div class="mozos form">
<?php echo $form->create('Mozo');?>
	<fieldset>
 		<legend><?php __('Editar Mozo');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('numero');
                echo $form->input('activo');
                echo $form->input('User.id');
                echo $form->input('User.username');
                echo $form->input('User.nombre');
                echo $form->input('User.apellido');
	?>
     <?php echo $form->end('Submit');?>           
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('Mozo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Mozo.id'))); ?></li>
		<li><?php echo $html->link(__('Listar Mozos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('Listar Usuarios', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Listar Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
                <li><?php echo $html->link(__('Nuevo usuario', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>


