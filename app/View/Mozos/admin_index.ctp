        
        
<?php
$this->Paginator->options(array('url' => $this->passedArgs)); 
?>

<div class="mozos index">
<h2><?php __('Mozos');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
    'format' => __('Página %page% de %pages%, mostrando %current% elementos de %count%')
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
        <th><?php echo $this->Paginator->sort('activo');?>&nbsp;<?php echo $this->Paginator->sort('nombre');?></th>
	<th><?php echo $this->Paginator->sort('numero');?></th>
	<th class="actions"><?php __('Acciones');?></th>
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
                    <span class="mozo-puntito <?php echo $mozo['Mozo']['activo'] ? 'mozo_activo' : 'mozo_inactivo' ?>">•</span> <?php echo $mozo['Mozo']['nombre']." ".$mozo['Mozo']['apellido']; ?>
		</td>
		<td>
			<?php echo $mozo['Mozo']['numero']; ?>
		</td>
		<td class="actions">
			<?php // echo $this->Html->link(__('View', true), array('action'=>'view', $mozo['Mozo']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $mozo['Mozo']['id'])); ?>
			<?php
                        if ($this->Session->read('Auth.User.role') == 'superuser') {
                            echo $this->Html->link(__('Delete', true), array('action'=>'delete', $mozo['Mozo']['id']), null, sprintf(__('¿Desea borrar el mozo nº # %s?. Si borra el mozo desaparecerá de las estadísticas.', true), $mozo['Mozo']['numero']));
                        }
                        ?>
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
		<li><?php echo $this->Html->link(__('Crear Mozo', true), array('action'=>'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear Usuario', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
	</ul>
</div>
