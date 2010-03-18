<?php
    $paginator->options(
            array('update'=>'lugarPaginado',
                    'url'=>array('controller'=>'Gastos', 'action'=>'index'),
                    'indicator' => 'LoadingDiv',
                ));

?>



<div class="gastos index">
<h2><?php __('Gastos');?></h2>



<?
    echo $ajax->form('add','post',array(
        'model'=>'Gasto',
        'update'=>'lugarPaginado',
        'id'=> 'formAddGasto',
        ));
    ?>
<table>
    <tr>
        <td><? echo $form->input('Gasto.importe', array('size'=> 4));?></td>
        <td><? echo $form->input('Gasto.name', array('label'=> 'Concepto'));?></td>
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
		<li><?php echo $html->link(__('New Gasto', true), array('action' => 'add')); ?></li>
	</ul>
</div>
