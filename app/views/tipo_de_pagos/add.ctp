    <?php  
        echo $this->element('menuadmin');
     ?>

<div class="tipoDePagos form">
<?php echo $form->create('TipoDePago');?>
	<fieldset>
 		<legend><?php __('Add TipoDePago');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
	?>
<?php echo $form->end('Submit');?>
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Tipo de Pagos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('Listar Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Crear Pago', true), array('controller'=> 'pagos', 'action'=>'add')); ?> </li>
	</ul>
</div>
