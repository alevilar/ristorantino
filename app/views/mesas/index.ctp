<div class="mesas index">
<h2><?php __('Mesas');?></h2>
<p>
<?php

echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $form->create("Mesa",array("action"=>"index")); ?></th>
	<th><?php echo $form->input('Mesa.numero',array('label'=>false));?></th>
	<th><?php echo $form->input('Mozo.numero',array('label'=>false));?></th>
	<th><?php echo $form->input('Mesa.total',array('label'=>false));?></th>
	<th></th>
	<th></th>
	<th>&nbsp;</th>
	<th class="actions"><?php echo $form->end("Buscar")?></th>
</tr>
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('Mesa','numero');?></th>
	<th><?php echo $paginator->sort('Mozo (ID) Nº','mozo_id');?></th>
	<th><?php echo $paginator->sort('total');?></th>
	<th><?php echo $paginator->sort('Fecha','created');?></th>
	<th>Cliente</th>
	<th><?php echo $paginator->sort('Cobró','time_cobro');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($mesas as $mesa):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $mesa['Mesa']['id']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['numero']; ?>
		</td>
		<td>
			<?php echo $html->link('('.$mesa['Mesa']['mozo_id'].') Nº: '.$mesa['Mozo']['numero'],'/Mozos/view/'.$mesa['Mesa']['mozo_id']); ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['total']; ?>
		</td>
		<td>
			<?php if ( $mesa['Mesa']['created'] != '0000-00-00 00:00:00'){?>
			<?php echo date('d-m-y (H:i:s)',strtotime($mesa['Mesa']['created']));} ?>
		</td>
		<td>
			<?php 
			if(!empty($mesa['Cliente']['Descuento']['porcentaje'])){
			 	echo $mesa['Cliente']['Descuento']['porcentaje']."%"; }
			 elseif($mesa['Cliente']['tipofactura']) {
			 	echo 'factura "'.$mesa['Cliente']['tipofactura'].'"';
			 }
			 else echo 'factura "B"'?>
		</td>
		<td>
			<?php if ( $mesa['Mesa']['time_cobro'] != '0000-00-00 00:00:00'){ ?>
			<?php echo date('d-m-y (H:i:s)',strtotime($mesa['Mesa']['time_cobro']));} ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $mesa['Mesa']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $mesa['Mesa']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $mesa['Mesa']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mesa['Mesa']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Mesa', true), array('action'=>'add')); ?></li>
	</ul>
</div>
