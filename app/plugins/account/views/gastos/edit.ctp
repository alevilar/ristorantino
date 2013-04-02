    
<div class="gastos form">
    <?php echo $form->create('Gasto', array('data-ajax' => "false", 'id'=>'GastoAddForm')); ?>
    <div class="ui-grid-a">

        <div class="ui-block-a">
            <?php
            echo $form->input('id');
            echo $form->input('proveedor_id', array('empty' => '- Seleccione -'));
            echo $form->input('clasificacion_id', array('empty' => '- Seleccione -'));
            echo $form->input('observacion');
            echo $form->input('tipo_factura_id');
            echo $form->input('factura_nro');
            echo $form->input('fecha', array('type' => 'date'));
            echo $form->input('closed', array(
                'type'=>'select', 
                'data-role' => 'slider', 
                'label' => 'Estado',
                'options' => array(
                    0 => 'Abierto',
                    1 => 'Cerrado',
                    ),
                ));
            ?>
        </div>
        <div class="ui-block-b">
            <?php
            echo $form->input('importe_total', array('id' => 'importe-total'));
            ?>
            <div id="impuestos-check">
                <h4>Seleccionar los impuestos aplicados en esta factura</h4>

                <fieldset data-role="controlgroup" data-type="horizontal" data-role="fieldcontain">

                    <?php
                    foreach ($tipo_impuestos as $ti) {
                        echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.checked', array(
                            'type' => 'checkbox',
                            'label' => $ti['TipoImpuesto']['name'],
                            'div' => null,
                            'checked' => !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]),
                            'onchange' => 'if(this.checked){jQuery("#tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] . '").show()} else {jQuery("#tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] . '").hide()}'
                        ));
                    }
                    ?>
                </fieldset>

            </div>

            <div id="impuestos">
                <?php
                foreach ($tipo_impuestos as $ti) {
                    $ocultar = empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]);
                    ?>
                    <fieldset <?php echo ($ocultar) ? 'style="display: none;"' : ''; ?>  id="<?php echo 'tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] ?>">
                        <legend><?php echo $ti['TipoImpuesto']['name'] ?></legend>
                        <?php
                        echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . ".neto", array(
                            'type' => 'text',
                            'label' => "Neto",
                            'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                            'class' => 'calc_neto importe',
                            'value' => !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'] : '',
                        ));

                        echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.importe', array(
                            'type' => 'text',
                            'label' => 'Importe',
                            'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                            'class' => 'calc_impuesto importe',
                            'value' => !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->data['Impuesto'][$ti['TipoImpuesto']['id']]['importe'] : '',
                        ));
                        ?>
                    </fieldset>
                    <?php
                }
                ?>

            </div>

        </div>
    </div>

    <?php echo $form->end('Editar', array('data-theme' => 'e', 'id' => 'btn-guardar-sin-pagar')); ?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('List Gastos', true), array('action' => 'index')); ?></li>
    </ul>
</div>


<div>
    <?php echo $javascript->link('/account/js/gastos_add'); ?>
</div>