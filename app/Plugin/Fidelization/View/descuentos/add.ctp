     <?php  
        echo $this->element('menuadmin');
     ?>

<div class="descuentos form">
<?php echo $form->create('Descuento');?>
	<fieldset>
 		<legend><?php __('Crear Descuento');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('porcentaje',array('after'=>'Ej:15 (solo introducir el numero, no poner el signo de porcentaje)'));
	?>
<?php echo $form->end('Submit');?>
        </fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Descuentos', true), array('action'=>'index'));?></li>
	</ul>
</div>
