<div class="descuentos index">
<h2><?php __('Descuentos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('porcentaje');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($descuentos as $descuento):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $descuento['Descuento']['id']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['name']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['description']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['porcentaje']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['created']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $descuento['Descuento']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $descuento['Descuento']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $descuento['Descuento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $descuento['Descuento']['id'])); ?>
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
		<li><?php echo $html->link(__('New Descuento', true), array('action'=>'add')); ?></li>
	</ul>
</div>
