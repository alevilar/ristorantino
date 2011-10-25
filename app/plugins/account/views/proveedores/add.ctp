     <?php  
        echo $this->element('menuadmin');
     ?>
<div class="proveedores form">
<?php echo $form->create('Proveedor');?>
	<fieldset>
 		<legend><?php __('Nuevo Proveedor');?></legend>
	<?php
		echo $form->input('name', array('label'=>'Nombre'));
		echo $form->input('cuit');
		echo $form->input('mail');
		echo $form->input('telefono');
		echo $form->input('domicilio');
	?>
<?php echo $form->end('Guardar');?>
</fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Proveedores', true), array('action' => 'index'));?></li>
	</ul>
</div>
