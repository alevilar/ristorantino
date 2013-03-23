
<div class="gastos form">
    <?php echo $form->create('Gasto', array( 'data-ajax' => "false")); ?>
    <?php echo $form->hidden('pagar', array('value' => true)); ?>
    <div class="ui-grid-a">

        <div class="ui-block-a">
            <?php
            echo $form->input('fecha', array('type' => 'date', 'value' => date('Y-m-d', strtotime('now'))));
            echo $form->input('clasificacion_id', array('empty' => '- Seleccione -'));
            echo $form->input('observacion');
            echo $form->input('proveedor_id', array('empty' => '- Seleccione -'));
            echo $form->input('tipo_factura_id');
            echo $form->input('factura_nro');
            
            ?>

        </div>
        <div class="ui-block-b">
            <?php
            echo $form->input('importe_neto');

            //echo $form->input('importe_total');
            ?>
            <div id="impuestos">
                <?php
                foreach ($tipo_impuestos as $ti) {
                    echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'], array(
                        'type' => 'text',
                        'label' => $ti['TipoImpuesto']['name'],
                        'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                        'class' => 'impuesto',
                    ));
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="ui-grid-a">
        <div class="ui-block-a">
            <?php echo $form->button('Guardar Sin Pagar', array('data-theme' => 'b', 'onclick' => "$(this.form.elements['data[Gasto][pagar]']).val(0);this.form.submit();")); ?>
        </div>
        <div class="ui-block-b">

            
            <?php echo $form->submit('Guardar Gasto y Crear Pago', array('data-theme' => 'e', 'name' => 'manolo')); ?>
        </div>
    </div>



    <?php echo $form->end(); ?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('List Gastos', true), array('action' => 'index')); ?></li>
    </ul>
</div>

<div>
    <script>
        jQuery("#GastoAddForm input.impuesto").click(function(e){
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
