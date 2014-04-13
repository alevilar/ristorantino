<div class="roles index">
	<h2><?php echo __('Roles');?></h2>
        <table class="table">
	<tr>
			<th><?php echo $paginator->sort('id');?></th>
			<th><?php echo $paginator->sort('name');?></th>
			<th><?php echo $paginator->sort('machin_name');?></th>
			<th><?php echo $paginator->sort('created');?></th>
			<th><?php echo $paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($roles as $rol): ?>
	<tr>
		<td><?php echo h($rol['Rol']['id']); ?>&nbsp;</td>
		<td><?php echo h($rol['Rol']['name']); ?>&nbsp;</td>
		<td><?php echo h($rol['Rol']['machin_name']); ?>&nbsp;</td>
		<td><?php echo h($rol['Rol']['created']); ?>&nbsp;</td>
		<td><?php echo h($rol['Rol']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $html->link(__('View',true), array('action' => 'view', $rol['Rol']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $rol['Rol']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $rol['Rol']['id']), null, __('Are you sure you want to delete # %s?', $rol['Rol']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

        <?php
        echo $paginator->counter(array('format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%.', true)));
        ?>
        
    <div class="paging">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
    </div>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $html->link(__('New Rol', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
