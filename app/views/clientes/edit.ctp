<div class="clientes form">
    <?php echo $form->create('Cliente');?>
    <fieldset class="row">
        
        <legend><?php echo __('Edit Cliente');?></legend>
        
        <div class="col-md-6">
        <?php
       echo $form->input('id');
        echo $form->input('nombre',
                               array(
                                  'label'=>'Nombre/Denominación',
                                  'placeholder'=>'Ej: La Serenissima S.A.'));

        echo $form->input('domicilio');
        echo $form->input('codigo', array('label' => 'Código de cliente'));
        echo $form->input('mail');
        echo $form->input('telefono');


        echo $form->input('descuento_id',array(
                'div'=>array('id' => 'div-descuento'),
                'empty'=>'Sin Descuento',
        ));

        ?>
        </div>
        
        <div class="col-md-6">
            <?

            echo $form->input('tipo_documento_id',
                               array(
//                                   'type' => 'radio',
                                   'default'=> 1, // CUIT, numero hardcodeado de la base de datos
                                   'label'=>'Tipo de Identificación',
                                   'fieldset' => false,
                                   'empty'=>'Seleccione'));
            
            echo $form->input('nrodocumento',
                               array(
                                   'label'=>'Número',
                                   'placeholder'=>'Ej: 3045623431',                                   
                                   ));

            echo $form->input('iva_responsabilidad_id',
                               array(
                                   'label'=>'Responsabilidad ante el IVA',
                                   'default'=> 4, // Consumidor final
                                   'empty'=>'Seleccione'));
            ?>

    <?php echo $form->end('Submit');?>
        </div>
    </fieldset>

</div>