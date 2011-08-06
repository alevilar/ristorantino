<div class="tipoImpuestos form">
<?php echo $form->create('TipoImpuesto');?>
	<fieldset>
 		<legend><?php __('Nuevo Tipo de Impuesto');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('porcentaje');
	?>
<?php echo $form->end('Submit');?>
    </fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar TipoImpuestos', true), array('action' => 'index'));?></li>
	</ul>
</div>
