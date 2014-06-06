<div class="queries index">
<h2><?php echo __('Queries');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('name');?></th>
	<th><?php echo $this->Paginator->sort('created');?></th>
	<th><?php echo $this->Paginator->sort('modified');?></th>
	<th class="actions"><?php echo __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($queries as $query):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $query['Query']['id']; ?>
		</td>
		<td>
			<?php echo $query['Query']['name']; ?>
		</td>
		<td>
			<?php echo $query['Query']['created']; ?>
		</td>
		<td>
			<?php echo $query['Query']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action'=>'view', $query['Query']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action'=>'edit', $query['Query']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action'=>'delete', $query['Query']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $query['Query']['id'])); ?>
		</td>
	</tr>
	<tr><td colspan="5"><?php echo $query['Query']['description']; ?></td>	</tr>
	<tr><td colspan="5"> </td></tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Query'), array('action'=>'add')); ?></li>
	</ul>
</div>
