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
    echo $ajax->form('add','post',array(
        'model'=>'Egreso',
        'update'=>'lugarPaginado',
        'id'=> 'formAddGasto',
        ));
    ?>
<table>
    <tr>
       
        <td><? echo $form->input('Egreso.name', array('label'=> 'Concepto'));?></td>
        <td><? echo $form->input('Egreso.tipofactura_id', array('label'=> false,'empty'=>'Seleccione'));?></td>
        <td><? echo $form->input('Egreso.total', array('size'=> 4));?></td>
        <td><? echo $form->input('Egreso.iva', array('label'=> 'Total IVA'));?></td>
        <td><? echo $form->input('Egreso.iibb', array('label'=> 'Ing. Brutos'));?></td>
        <td><? echo $form->input('Egreso.otros', array('label'=> 'Otros'));?></td>
        <td><? echo $form->end('Guardar');?></td>
    </tr>
</table>


<script language="javascript" type="text/javascript">
    $('formAddGasto').observe('submit', function(){
        $('formAddGasto').reset();
    });
</script>


<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>

<div id="lugarPaginado">
   <? echo $this->element('gastos_ajax_paginator'); ?>
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
