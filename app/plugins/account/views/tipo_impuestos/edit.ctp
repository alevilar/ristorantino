     <?php  
        echo $this->element('menuadmin');
     ?>

<div class="tipoImpuestos form">
<?php echo $form->create('TipoImpuesto');?>
	<fieldset>
 		<legend><?php __('Editar TipoImpuesto');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name', array('label'=>'Nombre'));
		echo $form->input('porcentaje');
	?>
<?php echo $form->end('Submit');?>
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Tipos de Impuestos', true), array('action' => 'index'));?></li>
	</ul>
</div>
