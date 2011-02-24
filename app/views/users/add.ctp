<div class="users form">
    <?php echo $form->create('User');?>
    <fieldset>
        <legend><?php __('Add User');?></legend>
        <?php
        echo $form->input('grupo',array('type'=>'select','label'=>'Tipo de Usuario','empty'=>'Seleccione', 'options'=>$aros));
        echo $form->input('username');
        echo $form->input('password');
        echo $form->input('password_check',array('label'=>'Reingrese Password','type'=>'password'));
        echo $form->input('nombre');
        echo $form->input('apellido');
        echo $form->input('telefono');
        echo $form->input('domicilio');
        ?>

    </fieldset>
    <?php echo $form->end('Submit');?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('List Users', true), array('action'=>'index'));?></li>
        <li><?php echo $html->link(__('List Mozos', true), array('controller'=> 'mozos', 'action'=>'index')); ?> </li>
        <li><?php echo $html->link(__('New Mozo', true), array('controller'=> 'mozos', 'action'=>'add')); ?> </li>
    </ul>
</div>
