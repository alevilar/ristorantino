<div class="pagos index">
<h2><?php echo __('Pagos');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('mesa_id');?></th>
	<th><?php echo $this->Paginator->sort('tipo_de_pago_id');?></th>
	<th><?php echo $this->Paginator->sort('valor');?></th>
	<th class="actions"><?php echo __('Actions');?></th>
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
			<?php echo $this->Html->link(__('View'), array('action'=>'view', $pago['Pago']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action'=>'edit', $pago['Pago']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action'=>'delete', $pago['Pago']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $pago['Pago']['id'])); ?>
		</td>
	</tr>
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
		<li><?php echo $this->Html->link(__('New Pago'), array('action'=>'add')); ?></li>
	</ul>
</div>
