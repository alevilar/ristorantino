     <?php  
        echo $this->element('menuadmin');
     ?>

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
 		<legend><?php __('Editar Gasto');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('proveedor_id');
		echo $form->input('clasificacion');
		echo $form->input('tipo_factura_id');
		echo $form->input('factura_nro');
		echo $form->input('factura_fecha', array('id'=>'facturaFecha', 'type'=>'text'));;
		echo $form->input('importe_neto');
                ?>
                
                
                <div id="gastos_impuestos">
                    <legend>Impuestos</legend>
                <?php
                echo $form->input('TipoImpuesto.TipoImpuesto', array('multiple' => 'checkbox', 
                                                        'type' => 'select',
                                                        'options' => $tipo_impuestos));
                ?>
                </div>
                <?php
		echo $form->input('otros');
	?>
<?php echo $form->end('Guardar');?>
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action' => 'delete', $form->value('Gasto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Gasto.id'))); ?></li>
		<li><?php echo $html->link(__('Listar Gastos', true), array('action' => 'index'));?></li>
	</ul>
</div>
