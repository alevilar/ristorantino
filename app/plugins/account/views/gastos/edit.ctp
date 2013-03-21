    
<div class="gastos form">
<?php echo $form->create('Gasto');?>
	<fieldset>
	<?php 
		echo $jqm->input('proveedor_id', array('empty'=>'- Seleccione -'));
		echo $jqm->input('clasificacion_id', array('empty'=>'- Seleccione -'));
                echo $jqm->input('observacion');
		echo $jqm->input('tipo_factura_id');
		echo $jqm->input('factura_nro');
                echo $jqm->date('fecha');
		echo $jqm->input('importe_neto', array('disabled'=>true));                
                
                //echo $form->input('importe_total');
                ?>
                <div id="impuestos">
                <?php
                foreach ($tipo_impuestos as $ti){
                    
                    echo $jqm->input('Gasto.Impuesto.'.$ti['TipoImpuesto']['id'], array(
                        'type' => 'text',
                        'label' => $ti['TipoImpuesto']['name'],
                        'data-porcent'=> $ti['TipoImpuesto']['porcentaje'],
                        'class' => 'impuesto',
                        'disabled'=>true,
                    ));
                }
                ?>
                </div>
	</fieldset>
    <?php echo $form->submit('Guardar', array('data-theme'=>'b')); ?>
    <?php echo $form->end(); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Gastos', true), array('action' => 'index'));?></li>
	</ul>
</div>
