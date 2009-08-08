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
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('numero');?></th>
	<th><?php echo $paginator->sort('mozo_id');?></th>
	<th><?php echo $paginator->sort('total');?></th>
	<th><?php echo $paginator->sort('descuento_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('time_abrio');?></th>
	<th><?php echo $paginator->sort('time_paso_pedido');?></th>
	<th><?php echo $paginator->sort('time_cerro_mesa');?></th>
	<th><?php echo $paginator->sort('time_cobro');?></th>
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
			<?php echo $mesa['Mesa']['mozo_id']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['total']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['descuento_id']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['created']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['time_abrio']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['time_paso_pedido']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['time_cerro_mesa']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['time_cobro']; ?>
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
