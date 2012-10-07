<?php

$paginator->options(
        array('update'=>'lugarPaginado',
        'url'=>array('controller'=>'Egresos', 'action'=>'index'),
        'indicator' => 'LoadingDiv',
));

?>


<div class="egresos index">
    <h2><?php __('Egresos');?></h2>



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
            <td><? echo $form->input('Egreso.user_id', array('label'=> 'A quien esta dirigido', 'empty'=>'Seleccione'));?></td>
            <td><? echo $form->input('Egreso.tipo_factura_id', array('label'=> 'Comprobante','empty'=>'Seleccione'));?></td>
            <td><? echo $form->input('Egreso.total', array('size'=> 4));?></td>
        </tr>
        <tr id="masDataParaFactA" style="display: none">
            <td><? echo $form->input('Egreso.iva', array('label'=> 'IVA'));?></td>
            <td><? echo $form->input('Egreso.iibb', array('label'=> 'Ing. Brutos'));?></td>
            <td><? echo $form->input('Egreso.otros', array('label'=> 'Otros'));?></td>
        </tr>
        <tr  id="masDataParaFactA">
            <td colspan="3"><? echo $form->input('Egreso.name', array('label'=>'Concepto'));?></td>
        </tr>
        <tr>
            <td colspan="1"><? echo $form->button('Reset', array('type'=>'reset'));?></td>
            <td colspan="2"><? echo $form->end('Guardar');?></td>
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
        echo $paginator->counter(array(
        'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
        ));
        ?></p>


     
     <?php echo $paginator->sort('total');?>
     <?php echo $paginator->sort('Concepto','name');?>
     <?php echo $paginator->sort('Fecha','created');?>
    <?php echo $paginator->sort('Nombre','User.nombre');?>
    <?php echo $paginator->sort('Apellido','User.apellido');?>
    <?php echo $paginator->sort('Comprobante','TipoFactura.name');?>

    
    <div id="lugarPaginado">
        <? echo $this->element('egresos_ajax_paginator'); ?>
    </div>
</div>
<div class="paging">
    <?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
    | 	<?php echo $paginator->numbers();?>
    <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('New Egreso', true), array('action' => 'add')); ?></li>
    </ul>
</div>
