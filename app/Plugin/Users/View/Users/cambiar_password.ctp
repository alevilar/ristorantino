
<h1>Cambiar su contraseña</h1>
<div class="users form">
    <?php echo $this->Form->create('User',array('action' => 'cambiar_password'));?>
    <fieldset>
        <?php

        
        echo $this->Form->input('id');
        echo $this->Form->input('password',array('label'=>'Ingrese una nueva contraseña', 'value'=>''));
        echo $this->Form->input('password_check',array('label'=>'Reingrese su contraseña','type'=>'password'));

        ?>
    <?php echo $this->Form->end('Guardar');?>        
    </fieldset>
</div>
