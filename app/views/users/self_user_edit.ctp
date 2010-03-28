<h1>Editar Usuario <b>"<?php echo $this->data['User']['username']?>"</b></h1>
<div class="users form">
    <?php echo $form->create('User',array('action' => 'self_user_edit'));?>
    <fieldset>
        <?php
        echo $form->input('id');

        echo $form->input('username');
        echo $form->input('nombre');
        echo $form->input('apellido');

        ?>

        <h2>Informacion de Contacto</h2>

        <?
        echo $form->input('telefono');
        echo $form->input('domicilio');
        ?>
    </fieldset>
    <?php echo $form->end('Guardar');?>
</div>
