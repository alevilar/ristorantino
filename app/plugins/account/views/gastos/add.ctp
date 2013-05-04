
<div class="gastos form">
    <?php echo $form->create('Gasto', array( 'data-ajax' => "false", 'type' => 'file' )); ?>
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
            echo $form->input('file', array('type'=>'file', 'accept'=> "image/*"));
            ?>
        </div>
        <div class="ui-block-b">
            <?php
            echo $form->input('importe_total', array('id' => 'importe-total'));

            //echo $form->input('importe_total');
            ?>
            <div id="impuestos-check">
                <h4>Seleccionar los impuestos aplicados en esta factura</h4>
                
                <fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">

                <?php
                foreach ($tipo_impuestos as $ti) {
                    echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'].'.checked', array(
                            'type' => 'checkbox',
                            'label' => $ti['TipoImpuesto']['name'],
                            'div' => null,
                            'onchange' => 'if(this.checked){jQuery("#tipo-impuesto-id-'.$ti['TipoImpuesto']['id'].'").show()} else {jQuery("#tipo-impuesto-id-'.$ti['TipoImpuesto']['id'].'").hide()}'
                    ));
                }    ?>
                </fieldset>
                
            </div>
            
            <div id="impuestos">
                <?php
                foreach ($tipo_impuestos as $ti) {
                    ?>
                <fieldset style="display: none;" id="<?php echo 'tipo-impuesto-id-'.$ti['TipoImpuesto']['id'] ?>">
                         <legend><?php echo $ti['TipoImpuesto']['name'] ?></legend>
                <?php                    
                    echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'].".neto", array(
                        'type' => 'text',
                        'label' => "Neto",
                        'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                        'class' => 'calc_neto importe',
                    ));
                    
                    echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'].'.importe', array(
                        'type' => 'text',
                        'label' => 'Importe',
                        'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                        'class' => 'calc_impuesto importe',
                    ));
                    ?>
                         
                    </fieldset>
                <?php
                }
                ?>
                <div style="color: brown">Total de "Netos" e "Importes sumados": $<span id="account-total-sumado">0</span></div>   
            </div>
            <div id="importes-sumados"></div>
        </div>
    </div>
    
    <div class="ui-grid-a">
        <div class="ui-block-a">
            <?php echo $form->button('Guardar Sin Pagar', array('data-theme' => 'b', 'id' => 'btn-guardar-sin-pagar')); ?>
        </div>
        <div class="ui-block-b">
            <?php echo $form->button('Pagar', array('data-theme' => 'e',  'id' => 'btn-guardar-y-pagar')); ?>            
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
    <?php echo $javascript->link('/account/js/gastos_add');?>
</div>
