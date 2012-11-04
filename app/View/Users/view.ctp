<div class="users view">
<h2><?php  echo __('User');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rol'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Rol']['name'], array('controller' => 'roles', 'action' => 'view', $user['Rol']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($user['User']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apellido'); ?></dt>
		<dd>
			<?php echo h($user['User']['apellido']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefono'); ?></dt>
		<dd>
			<?php echo h($user['User']['telefono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domicilio'); ?></dt>
		<dd>
			<?php echo h($user['User']['domicilio']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($user['User']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($user['User']['deleted_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Egresos'), array('controller' => 'egresos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Egreso'), array('controller' => 'egresos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mozos'), array('controller' => 'mozos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mozo'), array('controller' => 'mozos', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php echo __('Related Egresos');?></h3>
	<?php if (!empty($user['Egreso'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Tipo Factura Id'); ?></th>
		<th><?php echo __('Iva'); ?></th>
		<th><?php echo __('Iibb'); ?></th>
		<th><?php echo __('Otros'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Egreso'] as $egreso): ?>
		<tr>
			<td><?php echo $egreso['id'];?></td>
			<td><?php echo $egreso['user_id'];?></td>
			<td><?php echo $egreso['name'];?></td>
			<td><?php echo $egreso['tipo_factura_id'];?></td>
			<td><?php echo $egreso['iva'];?></td>
			<td><?php echo $egreso['iibb'];?></td>
			<td><?php echo $egreso['otros'];?></td>
			<td><?php echo $egreso['total'];?></td>
			<td><?php echo $egreso['created'];?></td>
			<td><?php echo $egreso['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'egresos', 'action' => 'view', $egreso['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'egresos', 'action' => 'edit', $egreso['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'egresos', 'action' => 'delete', $egreso['id']), null, __('Are you sure you want to delete # %s?', $egreso['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Egreso'), array('controller' => 'egresos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Mozos');?></h3>
	<?php if (!empty($user['Mozo'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Activo'); ?></th>
		<th><?php echo __('Deleted Date'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Mozo'] as $mozo): ?>
		<tr>
			<td><?php echo $mozo['id'];?></td>
			<td><?php echo $mozo['user_id'];?></td>
			<td><?php echo $mozo['numero'];?></td>
			<td><?php echo $mozo['activo'];?></td>
			<td><?php echo $mozo['deleted_date'];?></td>
			<td><?php echo $mozo['deleted'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'mozos', 'action' => 'view', $mozo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mozos', 'action' => 'edit', $mozo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mozos', 'action' => 'delete', $mozo['id']), null, __('Are you sure you want to delete # %s?', $mozo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mozo'), array('controller' => 'mozos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
