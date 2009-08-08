<div class="comensales index">
<h2><?php __('Comensales');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('cant_mayores');?></th>
	<th><?php echo $paginator->sort('cant_menores');?></th>
	<th><?php echo $paginator->sort('cant_bebes');?></th>
	<th><?php echo $paginator->sort('mesa_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($comensales as $comensal):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $comensal['Comensal']['id']; ?>
		</td>
		<td>
			<?php echo $comensal['Comensal']['cant_mayores']; ?>
		</td>
		<td>
			<?php echo $comensal['Comensal']['cant_menores']; ?>
		</td>
		<td>
			<?php echo $comensal['Comensal']['cant_bebes']; ?>
		</td>
		<td>
			<?php echo $html->link($comensal['Mesa']['id'], array('controller'=> 'mesas', 'action'=>'view', $comensal['Mesa']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $comensal['Comensal']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $comensal['Comensal']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $comensal['Comensal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comensal['Comensal']['id'])); ?>
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
		<li><?php echo $html->link(__('New Comensal', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Mesa', true), array('controller'=> 'mesas', 'action'=>'add')); ?> </li>
	</ul>
</div>
