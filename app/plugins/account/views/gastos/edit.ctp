    
<div class="gastos form">
    <?php echo $form->create('Gasto', array('data-ajax' => "false", 'id'=>'GastoAddForm', 'type' => 'file')); ?>
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
            echo $form->hidden('file');
            echo $form->input('_file', array('type'=>'file', 'accept'=> "image/*", 'label' => 'PDF, Imagen, Archivo'));  
            $ext = substr(strrchr($this->data['Gasto']['file'],'.'),1);
            if ( in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg')) ) {
                $iii = $html->image(THUMB_FOLDER.$this->data['Gasto']['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
            } else {
                $iii = "Descargar $ext";
            }
            if (!empty($this->data['Gasto']['file'])) {
                echo $html->link($iii, "/" . IMAGES_URL . $this->data['Gasto']['file'], array('target' => '_blank', 'escape' => false));
            }
            ?>
        </div>
        <div class="ui-block-b">
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
                        if ( $ti['TipoImpuesto']['tiene_neto']
                                || !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'])
                                ) {
                            echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . ".neto", array(
                                'type' => 'text',
                                'label' => "Neto",
                                'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                                'class' => 'calc_neto importe',
                                'div' => array(
                                    'style' =>'float: left;'
                                ),
                                'value' => !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'] : '',
                            ));
                        }
                        
                        if ( $ti['TipoImpuesto']['tiene_impuesto'] 
                                || !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]['importe'])
                                ) {
                            echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.importe', array(
                                'type' => 'text',
                                'label' => 'Importe',
                                'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                                'class' => 'calc_impuesto importe',
                                'div' => array(
                                    'style' =>'float: right;'
                                ),
                                'value' => !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->data['Impuesto'][$ti['TipoImpuesto']['id']]['importe'] : '',
                            ));
                        }
                        ?>
                    </fieldset>
                    <?php
                }
                ?>

            </div>
            <?php
            echo $form->input('importe_neto', array('id' => 'importe-neto'));
            echo $form->input('importe_total', array('id' => 'importe-total'));

            ?>
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