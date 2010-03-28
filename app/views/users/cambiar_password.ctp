<h1>Cambiar su contraseña</h1>
<div class="users form">
    <?php echo $form->create('User',array('action' => 'cambiar_password'));?>
    <fieldset>
        <?php
        echo $form->input('id');
        echo $form->input('password',array('label'=>'Ingrese una nueva contraseña'));
        ?><cite>(Borre previamente los asteriscos)</cite><br /><?php
        echo $form->input('password_check',array('label'=>'Reingrese su contraseña','type'=>'password'));

        ?>
    </fieldset>
    <?php echo $form->end('Guardar');?>
</div>
