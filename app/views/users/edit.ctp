        <?php    
        echo $this->element('menuadmin');
        ?>


<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Editar Usuario');?></legend>
	<?php
        
        echo $html->link('Modificarle la Contraseña','/users/cambiar_password/'.$this->data['User']['id'], array('class'=>'cambiopass'));?>
        <?php
		echo $form->input('id');
                    
                echo $form->input('grupo', array('label'=>'Tipo de Usuario', 'options'=>$aros, 'selected'=>$parent_aro_seleced));
		echo $form->input('username');
		echo $form->input('nombre');
		echo $form->input('apellido');
		echo $form->input('telefono');
                echo $form->input('domicilio');
		
	?>
                </br>
                    
                <?php echo $form->end('Submit');?>
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('User.id')), null, sprintf(__('¿Esta seguro que desea borrar el usuario: %s?', true), $form->value('User.username'))); ?></li>
		<li><?php echo $html->link(__('Listar Usuarios', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('Listar Mozos', true), array('controller'=> 'mozos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Crear Mozo', true), array('controller'=> 'mozos', 'action'=>'add')); ?> </li>
	</ul>
</div>
