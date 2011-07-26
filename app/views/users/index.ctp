<div class="users index">
<h2><?php __('Usuarios');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('usuario');?></th>
	<th><?php echo $paginator->sort('nombre');?></th>
	<th><?php echo $paginator->sort('apellido');?></th>
	<th><?php echo $paginator->sort('telefono');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $user['User']['id']; ?>
		</td>
		<td>
			<?php echo $user['User']['username']; ?>
		</td>
		<td>
			<?php echo $user['User']['nombre']; ?>
		</td>
		<td>
			<?php echo $user['User']['apellido']; ?>
		</td>
		<td>
			<?php echo $user['User']['telefono']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action'=>'view', $user['User']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $user['User']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar mozos', true), array('controller'=> 'mozos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Crear usuario', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Crear mozo', true), array('controller'=> 'mozos', 'action'=>'add')); ?> </li>
	</ul>
</div>
