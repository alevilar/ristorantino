    <?php    
//    echo $this->element('menuadmin');
    ?>

<div class="clientes form">
    <?php echo $this->Form->create('Cliente');?>
    <fieldset>
        <legend><?php __('Add Cliente');?></legend>
        <?php
       
        echo $this->Form->input('nombre',
                               array(
                                  'label'=>'Nombre/Denominación',
                                  'placeholder'=>'Ej: La Serenissima S.A.'));

        echo $this->Form->input('domicilio');
        echo $this->Form->input('codigo', array('label' => 'Código de cliente'));
        echo $this->Form->input('mail');
        echo $this->Form->input('telefono');


        echo $this->Form->input('descuento_id',array(
                'div'=>array('id' => 'div-descuento'),
                'empty'=>'Sin Descuento',
        ));

        ?>

            <?

            echo $this->Form->input('tipo_documento_id',
                               array(
                                   'options' => $tipo_documentos,
                                   'default'=>1, // CUIT, numero hardcodeado de la base de datos
                                   'label'=>'Tipo de Identificación',
                                   'empty'=>'Seleccione'));
            echo $this->Form->input('nrodocumento',
                               array(
                                   'label'=>'Número',
                                   'placeholder'=>'Ej: 3045623431',                                   
                                   ));

            echo $this->Form->input('iva_responsabilidad_id',
                               array(
                                   'label'=>'Responsabilidad ante el IVA',
                                   'options' => $iva_responsabilidades,
                                   'default'=>4, // Consumidor final
                                   'empty'=>'Seleccione'));
            ?>

    <?php echo $this->Form->end('Submit');?>

    </fieldset>

</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('List Clientes', true), array('action'=>'index'));?></li>
    </ul>
</div>
