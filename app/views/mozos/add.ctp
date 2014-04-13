<?php
echo $this->element('menuadmin');
?>

<div class="mozos form">
    <?php echo $form->create('Mozo'); ?>
        <fieldset>
 		<legend>Nuevo Mozo</legend>
	<?php
                echo $form->input('id');
		echo $form->input('numero');
                echo $form->input('nombre');
                echo $form->input('apellido');
                echo $form->input('image_url', array('type'=>'file'));
                echo $form->input('activo',array('after'=>'<p>Sólo los mozos activos aparecerán listados en la Adición.'));
                
                echo $form->end('Submit');
        ?>
	</fieldset>

</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('Listar Mozos', true), array('action' => 'index')); ?></li>
        <li><?php echo $html->link(__('Listar Usuarios', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $html->link(__('Nuevo usuario', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $html->link(__('Listar Mesas', true), array('controller' => 'mesas', 'action' => 'index')); ?> </li>
    </ul>
</div>
