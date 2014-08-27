<div class="comanderas index">
<h2><?php __('Comanderas');?></h2>


<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('name');?></th>
	<th><?php echo $this->Paginator->sort('description');?></th>
	<th><?php echo $this->Paginator->sort('path');?></th>
	<th><?php echo $this->Paginator->sort('imprime_ticket');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($comanderas as $comandera):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $comandera['Comandera']['id']; ?>
		</td>
		<td>
			<?php echo $comandera['Comandera']['name']; ?>
		</td>
		<td>
			<?php echo $comandera['Comandera']['description']; ?>
		</td>
		<td>
			<?php echo $comandera['Comandera']['path']; ?>
		</td>
		<td>
			<?php echo $comandera['Comandera']['imprime_ticket']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $comandera['Comandera']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $comandera['Comandera']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comandera['Comandera']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Nueva Comandera', true), array('action'=>'add')); ?></li>
	</ul>
</div>
