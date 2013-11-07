<?php 
echo $javascript->link('/lib/bootstrap.typehead/bootstrap3-typeahead');
?>
<div class="gastos form">
    <?php echo $form->create('Gasto', array('data-ajax' => "false", 'type' => 'file', 'id'=>'GastoAddForm')); ?>
    <?php echo $form->hidden('pagar', array('value' => true)); ?>
    <div class="row">

        <div class="col-md-4">
            <?php
            echo $form->input('fecha', array('type' => 'date'));
            

            echo $form->hidden('proveedor_id');
            echo $form->input('proveedor_list', array('autocomplete'=>'off','label' => 'Proveedor', 'type' => 'text', 'id' => 'proveedores', 'class' => 'form-control auto-complete'));

            echo $form->input('tipo_factura_id');
            echo $form->input('factura_nro');
            
            echo $form->hidden('file');
            echo $form->input('_file', array('type'=>'file', 'accept'=> "image/*", 'label' => 'PDF, Imagen, Archivo'));  
            
            if (!empty($this->data['Gasto']['file'])) {
                $ext = substr(strrchr($this->data['Gasto']['file'],'.'),1);
                if ( in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg')) ) {
                    $iii = $html->image(THUMB_FOLDER.$this->data['Gasto']['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
                } else {
                    $iii = "Descargar $ext";
                }
                if (!empty($this->data['Gasto']['file'])) {
                    echo $html->link($iii, "/" . IMAGES_URL . $this->data['Gasto']['file'], array('target' => '_blank', 'escape' => false));
                }
            }
            
            echo $form->input('clasificacion_id', array('empty' => '- Seleccione -'));
            echo $form->input('observacion');
            ?>
        </div>
        <div class="col-md-8">

            <div class="well">
                <div class="row">
                    <div class="col-md-4">
                        <div id="impuestos-check">
                            <h4>Seleccionar los impuestos aplicados en esta factura</h4>
                            <?php
                            foreach ($tipo_impuestos as $ti) {
                                echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.checked', array(
                                    'type' => 'checkbox',
                                    'class' => '',
                                    'label' => $ti['TipoImpuesto']['name'],
                                    'div' => array('class' => 'checkbox'),
                                    'checked' => !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]),
                                    'onchange' => 'if(this.checked){jQuery("#tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] . '").show()} else {jQuery("#tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] . '").hide()}'
                                ));
                            }
                            ?>
                            <div class="clear"></div>
                        </div>


                    </div>

                    <div class="col-md-8">

                        <div id="impuestos">
                            <?php
                            foreach ($tipo_impuestos as $ti) {
                                $ocultar = empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]);
                                ?>
                                <fieldset <?php echo ($ocultar) ? 'style="display: none;"' : ''; ?> id="<?php echo 'tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] ?>">
                                    <legend><?php echo $ti['TipoImpuesto']['name'] ?></legend>
                                    <?php
                                    if ( $ti['TipoImpuesto']['tiene_neto']
                                        || !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'])
                                        ) {
                                        echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . ".neto", array(
                                            'type' => 'number',
                                            'label' => "Neto",
                                            'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                                            'class' => 'calc_neto importe',
                                            'div' => array(
                                                'style' => 'float: left;'
                                            ),
                                            'value' => !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'] : '',
                                        ));
                                    }

                                     if ( $ti['TipoImpuesto']['tiene_impuesto'] 
                                        || !empty($this->data['Impuesto'][$ti['TipoImpuesto']['id']]['importe'])
                                        ) {
                                        echo $form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.importe', array(
                                            'type' => 'number',
                                            'label' => 'Impuesto',
                                            'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                                            'class' => 'calc_impuesto importe',
                                            'div' => array(
                                                'style' => 'float: right;'
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
                    </div>
                </div>
            </div>

            <?php
            echo $form->input('importe_neto', array('id' => 'importe-neto', 'type' => 'number'));
            echo $form->input('importe_total', array('id' => 'importe-total', 'type' => 'number'));
            ?>


            <?php if (empty($this->data['Gasto']['id'])) { ?>
                <div>
                    <?php echo $form->button('Guardar Sin Pagar', array('data-theme' => 'b', 'id' => 'btn-guardar-sin-pagar', 'class' => 'btn btn-lg')); ?>

                    <?php echo $form->button('Pagar', array('data-theme' => 'e', 'id' => 'btn-guardar-y-pagar', 'class' => 'pull-right btn btn-lg btn-primary')); ?>            

                </div>
            <?php } else { ?>
                <?php echo $form->button('Editar', array('type' => 'submit', 'id' => 'btn-guardar-sin-pagar',  'class' => 'pull-right btn btn-lg btn-primary')); ?>
            <?php } ?>
        </div>
    </div>

    <?php echo $form->end(); ?>
</div>

<div>
    <?php echo $javascript->link('/account/js/gastos_add'); ?>
</div>
