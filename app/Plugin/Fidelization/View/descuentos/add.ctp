     <?php  
        echo $this->element('menuadmin');
     ?>

<div class="descuentos form">
<?php echo $this->Form->create('Descuento');?>
	<fieldset>
 		<legend><?php __('Crear Descuento');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('porcentaje',array('after'=>'Ej:15 (solo introducir el numero, no poner el signo de porcentaje)'));
	?>
<?php echo $this->Form->end('Submit');?>
        </fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar Descuentos', true), array('action'=>'index'));?></li>
	</ul>
</div>
