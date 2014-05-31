     <?php  
        echo $this->element('menuadmin');
     ?>


<div class="descuentos form">
<?php echo $form->create('Descuento');?>
	<fieldset>
 		<legend><?php __('Editar Descuento');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name',array('label'=>'Nombre'));
		echo $form->input('description',array('label'=>'Descripción'));
		echo $form->input('porcentaje',array('after'=>'Sólo introducir el número, sin el signo de porcentaje.'));
			?>
<?php echo $form->end('Submit');?>
        </fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('Descuento.id')), null, sprintf(__('¿Está seguro que desea borrar el descuento: %s?', true), $form->value('Descuento.name'))); ?></li>
		<li><?php echo $html->link(__('Listar Descuentos', true), array('action'=>'index'));?></li>
	</ul>
</div>
