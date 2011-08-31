<?php 
    echo $javascript->link('jquery/jquery-ui-1.8.14.custom.min'); 
    echo $html->css('jquery-ui/jquery-ui-1.8.14.custom');
?>
<script type="text/javascript">
    jQuery(function() {
        jQuery( "#facturaFecha" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });
</script>
<div class="gastos form">
<?php echo $form->create('Gasto');?>
	<fieldset>
 		<legend><?php __('Nuevo Gasto');?></legend>
	<?php 
		echo $form->input('proveedor_id', array('empty'=>'- Seleccione -'));
		echo $form->input('clasificacion');
		echo $form->input('tipo_factura_id');
		echo $form->input('factura_nro');
                echo $form->input('factura_fecha', array('id'=>'facturaFecha', 'type'=>'text'));
		//echo $form->input('importe_neto');
                echo $form->input('importe_total');
                ?>
                <div id="impuestos">
                <?php
                echo $form->input('TipoImpuesto.TipoImpuesto', array('multiple' => 'checkbox', 
                                                        'label' => 'Impuestos aplicados: ',
                                                        'type' => 'select',
                                                        'options' => $tipo_impuestos));
                ?>
                </div>
                <?php
		echo $form->input('otros', array('label' => 'Otros cargos', 'size' => '7'));
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Gastos', true), array('action' => 'index'));?></li>
	</ul>
</div>
