    
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
		echo $jqm->input('importe_neto');                
                
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
                    ));
                }
                ?>
                </div>
                <?php echo $form->hidden('pagar', array('value'=>false)); ?>
	</fieldset>
    <?php echo $form->button('Guardar y Pagar', array('data-theme'=>'e', 'onclick'=>"$(this.form.elements['data[Gasto][pagar]']).val(1);this.form.submit();", 'name'=>'manolo')); ?>
    <?php echo $form->submit('Guardar', array('data-theme'=>'b')); ?>
    <?php echo $form->end(); ?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Gastos', true), array('action' => 'index'));?></li>
	</ul>
</div>

<div>
<script>
    jQuery("#GastoAddForm input.impuesto").click(function(e){
        papap = this;
        lala = e;
        var porcent = jQuery(this).attr('data-porcent');
        var valor;
        if (porcent){
            valor = jQuery( this.form.elements['data[Gasto][importe_neto]'] ).val() * porcent / 100;
            if (valor) {
                jQuery(this).val(valor);
            }
        }
    });
</script>
</div>