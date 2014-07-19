<?php 
echo $this->Html->script('/lib/bootstrap/plugins/bootstrap3-typeahead');
?>
<div class="gastos form">
    <?php echo $this->Form->create('Gasto', array('url'=>$this->action,'type' => 'file', 'id'=>'GastoAddForm')); ?>
    <?php echo $this->Form->hidden('id'); ?>
    <?php echo $this->Form->hidden('pagar', array('value' => true)); ?>
    <div class="row">

        <div class="col-md-4">
            <?php
            echo $this->Form->input('fecha', array('type' => 'date'));
            
            echo $this->Form->hidden('proveedor_id');

            echo $this->Form->input('proveedor_list', array(
                'autocomplete'=>'off',
                'label' => 'Proveedor', 
                'type' => 'text', 
                'id' => 'proveedores', 
                'class' => 'form-control auto-complete',
                'data-url' => $this->html->url(array('plugin' => 'account', 'controller' => 'proveedores', 'action' => 'index', 'ext' => 'json')),
                'data-toggle' => 'popover',
                'after' => '<div style="display:none" class="text-warning" id="nuevo-proveedor">Se va a creear un nuevo proveedor</div>',
                )
                    );

            echo $this->Form->input('tipo_factura_id');
            echo $this->Form->input('factura_nro');
            
            echo $this->Form->hidden('file');
            echo $this->Form->input('_file', array('type'=>'file', 'accept'=> "image/*", 'label' => 'PDF, Imagen, Archivo'));  
            
            if (!empty($this->request->data['Gasto']['file'])) {
                $ext = substr(strrchr($this->request->data['Gasto']['file'],'.'),1);
                if ( in_array(strtolower($ext), array('jpg', 'png', 'gif', 'jpeg')) ) {
                    $iii = $this->Html->image(THUMB_FOLDER.$this->request->data['Gasto']['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
                } else {
                    $iii = "Descargar $ext";
                }
                if (!empty($this->request->data['Gasto']['file'])) {
                    echo $this->Html->link($iii, "/" . IMAGES_URL . $this->request->data['Gasto']['file'], array('target' => '_blank', 'escape' => false));
                }
            }
            
            echo $this->Form->input('clasificacion_id', array('empty' => '- Seleccione -'));
            echo $this->Form->input('observacion');
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
                                echo $this->Form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.checked', array(
                                    'type' => 'checkbox',
                                    'class' => '',
                                    'label' => $ti['TipoImpuesto']['name'],
                                    'div' => array('class' => 'checkbox'),
                                    'checked' => !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]),
                                    'onchange' => 'if(this.checked){jQuery("#tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] . '").show()} else {jQuery("#tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] . '").hide()}'
                                ));
                            }
                            ?>
                            <div class="clear"></div>
                        </div>


                    </div>

                    <div class="col-md-8">

                        <div class="row" id="impuestos">
                            <?php
                            foreach ($tipo_impuestos as $ti) {
                                $ocultar = empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]);
                                ?>
                                <fieldset <?php echo ($ocultar) ? 'style="display: none;"' : ''; ?> id="<?php echo 'tipo-impuesto-id-' . $ti['TipoImpuesto']['id'] ?>">
                                    <legend><?php echo $ti['TipoImpuesto']['name'] ?></legend>
                                    <div class="col-md-6">
                                    <?php
                                    if ( $ti['TipoImpuesto']['tiene_neto']
                                        || !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'])
                                        ) {
                                        echo $this->Form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . ".neto", array(
                                            'type' => 'number',
                                            'label' => "Neto",
                                            'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                                            'class' => 'calc_neto importe',                                            
                                            'value' => !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['neto'] : '',
                                        ));
                                    }
                                    ?>
                                        </div>
                                    
                                    <div class="col-md-6">
                                    <?php

                                     if ( $ti['TipoImpuesto']['tiene_impuesto'] 
                                        || !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['importe'])
                                        ) {
                                        echo $this->Form->input('Gasto.Impuesto.' . $ti['TipoImpuesto']['id'] . '.importe', array(
                                            'type' => 'number',
                                            'label' => 'Impuesto',
                                            'data-porcent' => $ti['TipoImpuesto']['porcentaje'],
                                            'class' => 'calc_impuesto importe',                                            
                                            'value' => !empty($this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]) ? $this->request->data['Impuesto'][$ti['TipoImpuesto']['id']]['importe'] : '',
                                        ));
                                    }
                                    ?>
                                    </div>
                                </fieldset>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            echo $this->Form->input('importe_neto', array('id' => 'importe-neto', 'type' => 'number'));
            echo $this->Form->input('importe_total', array('id' => 'importe-total', 'type' => 'number'));
            ?>


            <?php if (empty($this->request->data['Gasto']['id'])) { ?>
                <div>
                    <?php echo $this->Form->button('Guardar Sin Pagar', array('data-theme' => 'b', 'id' => 'btn-guardar-sin-pagar', 'class' => 'btn btn-lg')); ?>

                    <?php echo $this->Form->button('Pagar', array('data-theme' => 'e', 'id' => 'btn-guardar-y-pagar', 'class' => 'pull-right btn btn-lg btn-primary')); ?>            

                </div>
            <?php } else { ?>
                <?php echo $this->Form->button('Editar', array('type' => 'submit', 'id' => 'btn-guardar-sin-pagar',  'class' => 'pull-right btn btn-lg btn-primary')); ?>
            <?php } ?>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>

<div>
    <?php echo $this->Html->script('/account/js/gastos_add'); ?>
</div>
