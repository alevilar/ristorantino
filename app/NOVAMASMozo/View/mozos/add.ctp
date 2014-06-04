<?php
echo $this->element('menuadmin');
?>

<div class="mozos form">
    <?php echo $form->create('Mozo'); ?>
        <legend>Nuevo Mozo</legend>
        <?php
        echo $form->input('numero');
        echo $form->input('activo');
        
        echo $form->input('User.nombre');
        echo $form->hidden('User.role', array('value'=>'mozo'));
        echo $form->input('User.apellido');
        echo $form->input('User.username');
        echo $form->input('User.password');
        echo $form->end('Submit');
        ?>

</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('Listar Mozos', true), array('action' => 'index')); ?></li>
        <li><?php echo $html->link(__('Listar Usuarios', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $html->link(__('Nuevo usuario', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $html->link(__('Listar Mesas', true), array('controller' => 'mesas', 'action' => 'index')); ?> </li>
    </ul>
</div>
