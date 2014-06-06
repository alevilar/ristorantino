     <?php  
        echo $this->element('menuadmin');
     ?>


<div class="descuentos form">
<?php echo $this->Form->create('Descuento');?>
	<fieldset>
 		<legend><?php __('Editar Descuento');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Nombre'));
		echo $this->Form->input('description',array('label'=>'Descripción'));
		echo $this->Form->input('porcentaje',array('after'=>'Sólo introducir el número, sin el signo de porcentaje.'));
			?>
<?php echo $this->Form->end('Submit');?>
        </fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $this->Form->value('Descuento.id')), null, sprintf(__('¿Está seguro que desea borrar el descuento: %s?', true), $this->Form->value('Descuento.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Descuentos', true), array('action'=>'index'));?></li>
	</ul>
</div>
