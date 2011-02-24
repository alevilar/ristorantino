<h1>Editar Mis Datos</h1>
<div class="users form">
<?php echo $form->create('User',array('action' => 'self_user_edit'));?>
	<fieldset>
	<?php
		echo $form->input('id');

                echo $form->hidden('username');
		echo $form->input('nombre');
		echo $form->input('apellido');
		
		
		?><h2>Información de Contacto</h2><?
		echo $form->input('telefono');
		echo $form->input('domicilio');
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
