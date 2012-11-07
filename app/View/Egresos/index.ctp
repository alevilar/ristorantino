<?php

$this->Paginator->options(
        array('update'=>'lugarPaginado',
        'url'=>array('controller'=>'Egresos', 'action'=>'index'),
        'indicator' => 'LoadingDiv',
));

?>


<div class="egresos index">
    <h2><?php echo __('Egresos');?></h2>



    <?
    echo $ajax->form(
            'ajax_agregar_gasto',
            'post',
            array(
                'model'=>'Egreso',
                'update'=>'lugarPaginado',
                'id'=> 'formAddGasto',
    ));

    
    ?>
    <table>
        <tr>
            <td><? echo $this->Form->input('Egreso.user_id', array('label'=> 'A quien esta dirigido', 'empty'=>'Seleccione'));?></td>
            <td><? echo $this->Form->input('Egreso.tipo_factura_id', array('label'=> 'Comprobante','empty'=>'Seleccione'));?></td>
            <td><? echo $this->Form->input('Egreso.total', array('size'=> 4));?></td>
        </tr>
        <tr id="masDataParaFactA" style="display: none">
            <td><? echo $this->Form->input('Egreso.iva', array('label'=> 'IVA'));?></td>
            <td><? echo $this->Form->input('Egreso.iibb', array('label'=> 'Ing. Brutos'));?></td>
            <td><? echo $this->Form->input('Egreso.otros', array('label'=> 'Otros'));?></td>
        </tr>
        <tr  id="masDataParaFactA">
            <td colspan="3"><? echo $this->Form->input('Egreso.name', array('label'=>'Concepto'));?></td>
        </tr>
        <tr>
            <td colspan="1"><? echo $this->Form->button('Reset', array('type'=>'reset'));?></td>
            <td colspan="2"><? echo $this->Form->end('Guardar');?></td>
        </tr>
        
    </table>

    

    <script language="javascript" type="text/javascript">

        function completarCampoNameAuto(){
            var usuario = '[nadie]';
            var factura = '[sin factura seleccionada]';
            var i = 0;

            i = $('EgresoUserId').selectedIndex;
            if (i != 0){
                usuario = $('EgresoUserId').options[i].text;
            }

            i = $('EgresoTipoFacturaId').selectedIndex;
            if (i != 0){
                factura = $('EgresoTipoFacturaId').options[i].text;
            }

            $('EgresoName').value = "Se recibió "+factura+" de "+usuario;
        }

        function mostrarDatosParaFactA(){
            var label = $$('label[for="EgresoTotal"]');
            if ( $F('EgresoTipoFacturaId') == 1) {
               $('masDataParaFactA').show();
               label[0].update("Total Neto");
            } else {
                $('masDataParaFactA').hide();
                label[0].update("Total");
            }
        }

        $('EgresoUserId').observe('change', completarCampoNameAuto);
        $('EgresoTipoFacturaId').observe('change', completarCampoNameAuto);

        // si es factura "A" mostrar mas datos
        $('EgresoTipoFacturaId').observe('change',mostrarDatosParaFactA)
        Event.observe(window,'load',mostrarDatosParaFactA);



    </script>


    <p>
        <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
        ));
        ?></p>


     
     <?php echo $this->Paginator->sort('total');?>
     <?php echo $this->Paginator->sort('Concepto','name');?>
     <?php echo $this->Paginator->sort('Fecha','created');?>
    <?php echo $this->Paginator->sort('Nombre','User.nombre');?>
    <?php echo $this->Paginator->sort('Apellido','User.apellido');?>
    <?php echo $this->Paginator->sort('Comprobante','TipoFactura.name');?>

    
    <div id="lugarPaginado">
        <? echo $this->element('egresos_ajax_paginator'); ?>
    </div>
</div>
<div class="paging">
    <?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
    | 	<?php echo $this->Paginator->numbers();?>
    <?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('New Egreso'), array('action' => 'add')); ?></li>
    </ul>
</div>
