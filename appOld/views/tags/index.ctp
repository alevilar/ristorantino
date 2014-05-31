<div class="tags index">
	<h2><?php echo __('Tags');?></h2>
        <table cellpadding="0" cellspacing="0"   class="table">
	<tr>
			<th><?php echo $paginator->sort('id');?></th>
			<th><?php echo $paginator->sort('name');?></th>
			<th><?php echo $paginator->sort('created');?></th>
			<th><?php echo $paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($tags as $tag): ?>
	<tr>
		<td><?php echo h($tag['Tag']['id']); ?>&nbsp;</td>
		<td><?php echo h($tag['Tag']['name']); ?>&nbsp;</td>
		<td><?php echo h($tag['Tag']['created']); ?>&nbsp;</td>
		<td><?php echo h($tag['Tag']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $tag['Tag']['id'])); ?>
			<?php echo $html->link(__('Edit',true), array('action' => 'edit', $tag['Tag']['id'])); ?>
			<?php echo $html->link(__('Delete',true), array('action' => 'delete', $tag['Tag']['id']), null, __('Are you sure you want to delete # %s?', $tag['Tag']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

	<div class="paging">
	<?php
		echo $paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $paginator->numbers(array('separator' => ''));
		echo $paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $html->link(__('New Tag', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Productos', true), array('controller' => 'productos', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Producto', true), array('controller' => 'productos', 'action' => 'add')); ?> </li>
	</ul>
</div>
