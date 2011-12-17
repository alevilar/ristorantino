<div class="reservas form">
<?php echo $form->create('Reserva');?>
	<fieldset>
 		<legend><?php __('Add Reserva');?></legend>
	<?php
		echo $form->input('nombre');
		echo $form->input('personas');
                echo $form->input('menores');
		echo $form->input('mesa');
                echo $form->input('debe_pagar');
                echo $form->input('pago');
		echo $form->input('observaciones');
		echo $form->input('evento');
		echo $form->input('fecha');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Reservas', true), array('action' => 'index'));?></li>
	</ul>
</div>
