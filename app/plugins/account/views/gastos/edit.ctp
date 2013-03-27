    
<div class="gastos form">
<?php echo $form->create('Gasto', array( 'data-ajax' => "false"));?>
	<fieldset>
	<?php 
                echo $form->input('id');
		echo $form->input('proveedor_id', array('empty'=>'- Seleccione -'));
		echo $form->input('clasificacion_id', array('empty'=>'- Seleccione -'));
                echo $form->input('observacion');
		echo $form->input('tipo_factura_id');
		echo $form->input('factura_nro');
                echo $form->input('fecha', array('type'=>'date'));
		echo $form->input('importe_neto', array('disabled'=>true));                
                
                //echo $form->input('importe_total');
                ?>
                <div id="impuestos">
                <?php
                function ponerImpuestoDe($form, $data, $tipoImpuesto) {
                    $ti = $tipoImpuesto;
                    foreach ( $data['Impuesto'] as $imps) {
                        if ($imps['tipo_impuesto_id'] == $ti['TipoImpuesto']['id'] ){
                            echo $form->input('Gasto.Impuesto.'.$ti['TipoImpuesto']['id'], array(
                                'type' => 'text',
                                'label' => $ti['TipoImpuesto']['name'],
                                'data-porcent'=> $ti['TipoImpuesto']['porcentaje'],
                                'class' => 'impuesto',
                                'disabled'=>true,
                                'value' => $imps['importe'],
                            ));
                        }
                    }
                }
                foreach ($tipo_impuestos as $ti){
                    ponerImpuestoDe($form, $this->data, $ti);
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
