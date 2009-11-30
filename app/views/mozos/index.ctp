<div class="mozos index">
<h2><?php __('Mozos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('Nombre','User.nombre');?></th>
	<th><?php echo $paginator->sort('numero');?></th>
	<th class="actions"><?php __('');?></th>
</tr>
<?php
$i = 0;
foreach ($mozos as $mozo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $mozo['Mozo']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($mozo['User']['nombre']." ".$mozo['User']['apellido'], array('controller'=> 'users', 'action'=>'view', $mozo['User']['id'])); ?>
		</td>
		<td>
			<?php echo $mozo['Mozo']['numero']; ?>
		</td>
		<td class="actions">
			<?php // echo $html->link(__('View', true), array('action'=>'view', $mozo['Mozo']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $mozo['Mozo']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $mozo['Mozo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mozo['Mozo']['id'])); ?>
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
		<li><?php echo $html->link(__('Nuevo Mozo', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Listar Usuarios', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Nuevo Usuario', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('Listar Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
	</ul>
</div>
