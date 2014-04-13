        <?php    
        echo $this->element('menuadmin');
        ?>


<div class="users form">
    
    <p class="text-right">
    <?php echo $html->link('Modificarle la Contraseña','/users/cambiar_password/'.$this->data['User']['id'], array('class'=>'cambiopass'));?>
    </p>
    
    <div class="clear"></div>
<?php echo $form->create('User');?>
 		<legend><?php __('Editar Usuario');?></legend>
                
        
            <div class="col-md-6">
                <fieldset>
                <?php
               echo $form->input('id');
               echo $form->input('username');
               ?>
               </fieldset>
                
               <?php
               echo $form->input('rol_id', array(
//                   'type' => "radio",
                   'label' => array(
                       'fieldset' => array(
                           'class' => 'papspas',
                           'data-type' => "horizontal"
                           )
                       )
               ));
               ?>
            </div>
                
           
            <fieldset class="col-md-6">
                <?php
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
