

<div id="form-cliente-a" class="clientes form">
    <?php echo $form->create('Cliente', array('action'=>'addFacturaA'));?>
    <fieldset>
        <legend><?php __('Agregar Factura "A"');?></legend>
        <?php

        echo $form->input('nombre',array('label'=>'Nombre/Denominación'));


        echo $form->hidden('tipofactura',array('value'=>'A'));

        echo $form->hidden('iva_responsabilidad_id',array('value'=>1)); // Resp. Inscripto, Numero hardcodeado de la base de datos
        
        echo $form->hidden('tipo_documento_id', array('value' => 1)); // CUIT, numero hardcodeado de la base de datos

        
        echo $form->input('nrodocumento',
                           array(
                               'label'=>'Número (sin los guiones)',
                               ));
                       
       ?>
    </fieldset>
    <?php //echo $form->end('guardar');?>
    <?php echo $ajax->submit('guardar', array('url'=> array('controller'=>'clientes', 'action'=>'addFacturaA'), 'update' => 'clientes-listado'));?>
</div>
