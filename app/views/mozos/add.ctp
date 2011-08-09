<div class="mozos form">
<?php echo $form->create('Mozo');?>
	<fieldset>
 		<legend>Nuevo Mozo</legend>
	<?php
		echo $form->input('user_id', array('empty'=>'No relacionar con usuarios del sistema'));
		echo $form->input('numero');
                echo $form->input('User.nombre');
                echo $form->input('User.apellido');
                echo $form->input('User.username');
		echo $form->input('User.password');
                echo $form->input('activo',array('after'=>'<p>Sólo los mozos activos apareran en la Adición.</br>Si BORRA un mozo se pierden los datos estadisticos, puede desactivarlo para no perder información.</p>'));
	?>
        <?php echo $form->end('Submit');?>
	</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Mozos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('Listar Usuarios', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Nuevo usuario', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('Listar Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
	</ul>
</div>
