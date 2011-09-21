<div data-role="header">
    <h1>Clientes</h1>
    
    <div data-role="navbar">
                <ul>
                    <li><a href="#" class="ui-btn-active ui-state-persist">Listado de Clientes</a></li>
                    <li><a href="<?php echo $html->url('/clientes/addFacturaA')?>">Agregar Factura "A"</a></li>
                </ul>
    </div>
</div>
    
<div data-role="content" >
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
        <?php echo $form->end('guardar');?>
        <?php //echo $form->submit('guardar', array('url'=> array('controller'=>'clientes', 'action'=>'addFacturaA')));?>
    </div>
</div>