        <?php    
        echo $this->element('menuadmin');
        ?>

<div class="users index">
<h2><?php __('Usuarios');?></h2>
<p>
<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>

<?php
echo $this->Form->create('User', array('url'=>'/users/index'));
echo $this->Form->input('txt_buscar', array('label' => 'Introducir texto a buscar'));
echo $this->Form->end();
?>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('Usuario','username');?></th>
	<th><?php echo $this->Paginator->sort('nombre');?></th>
	<th><?php echo $this->Paginator->sort('apellido');?></th>
        <th>Tipo de Usuario</th>
	<th><?php echo $this->Paginator->sort('telefono');?></th>
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
			<?php echo $user['User']['username']; ?>
		</td>
		<td>
			<?php echo $user['User']['nombre']; ?>
		</td>
		<td>
			<?php echo $user['User']['apellido']; ?>
		</td>
                <td>
			<?php echo $user['Rol']['name']; ?>
		</td>
		<td>
			<?php echo $user['User']['telefono']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action'=>'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $user['User']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('¿Está seguro que desea borrar el usuario: %s?', $user['User']['username'])); ?>
                        <?php echo $this->Html->link(__('Cambiar Password', true), array('action'=>'cambiar_password', $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Listar mozos', true), array('controller'=> 'mozos', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear usuario', true), array('action'=>'add')); ?></li>
		<li><?php echo $this->Html->link(__('Crear mozo', true), array('controller'=> 'mozos', 'action'=>'add')); ?> </li>
	</ul>
</div>
