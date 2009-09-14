<div class="pagos index">
<h2><?php __('Pagos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('mesa_id');?></th>
	<th><?php echo $paginator->sort('tipo_de_pago_id');?></th>
	<th><?php echo $paginator->sort('valor');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($pagos as $pago):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $pago['Pago']['id']; ?>
		</td>
		<td>
			<?php echo $pago['Pago']['mesa_id']; ?>
		</td>
		<td>
			<?php echo $pago['Pago']['tipo_de_pago_id']; ?>
		</td>
		<td>
			<?php echo $pago['Pago']['valor']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $pago['Pago']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $pago['Pago']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $pago['Pago']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pago['Pago']['id'])); ?>
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
		<li><?php echo $html->link(__('New Pago', true), array('action'=>'add')); ?></li>
	</ul>
</div>
