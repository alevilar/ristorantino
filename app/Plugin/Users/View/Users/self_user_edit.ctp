
<h1>Editar Mis Datos</h1>
<div class="users form">
<?php echo $this->Form->create('User',array('action' => 'self_user_edit'));?>
	<fieldset>
	<?php
		echo $this->Form->input('id');

                echo $this->Form->hidden('username');
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellido');
		
		
		?><h2 style="float: left; clear:both;">Información de Contacto</h2><?
		echo $this->Form->input('telefono');
		echo $this->Form->input('domicilio');
	?>
<?php echo $this->Form->end('Guardar');?>
	</fieldset>

</div>
