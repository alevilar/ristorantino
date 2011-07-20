<?php 
    echo $javascript->link('jquery/jquery-ui-1.8.12.custom.min'); 
    echo $html->css('jquery-ui/blitzer/jquery-ui-1.8.12.custom');
?>
<script type="text/javascript">
jQuery(function() {
    jQuery( "#facturaFecha" ).datepicker({ dateFormat: 'dd/mm/yy' });
});
</script>
<div class="gastos form">
<?php echo $form->create('Gasto');?>
	<fieldset>
 		<legend><?php __('Add Gasto');?></legend>
	<?php
		echo $form->input('cliente_id');
		echo $form->input('clasificacion');
		echo $form->input('tipo_factura_id');
		echo $form->input('factura_nro');
                echo $form->input('factura_fecha', array('id'=>'facturaFecha', 'type'=>'text'));
		echo $form->input('importe_neto');
		echo $form->input('iva_a');
		echo $form->input('iva_b');
		echo $form->input('iibb');
		echo $form->input('imp_int');
		echo $form->input('percep_iva');
		echo $form->input('no_gravado');
		echo $form->input('otros');
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Gastos', true), array('action' => 'index'));?></li>
	</ul>
</div>
