<?php
$paginator->options(array('url' => $this->passedArgs)); 
?>

<div class="mozos index">
<h2><?php __('Mozos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page% de %pages%, mostrando %current% elementos de %count%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('activo');?></th>
	<th><?php echo $paginator->sort('Nombre','User.nombre');?></th>
	<th><?php echo $paginator->sort('numero');?></th>
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
		<td class="mozo_active"
		<?php 
                        if($mozo['Mozo']['activo']==1){
                            echo(' style="color:green;">');
                                     echo('■');
                        }else{
                            echo(' style="color:##000000;">');
                                     echo('■');    
                        }
                ?>
		</td>
		<td>
			<?php echo $html->link($mozo['User']['nombre']." ".$mozo['User']['apellido'], array('controller'=> 'users', 'action'=>'view', $mozo['User']['id'])); ?>
		</td>
		<td>
			<?php echo $mozo['Mozo']['numero']; ?>
		</td>
		<td class="actions">
			<?php // echo $html->link(__('View', true), array('action'=>'view', $mozo['Mozo']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $mozo['Mozo']['id'])); ?>
			<?php
                        if ($session->read('Auth.User.role') == 'superuser') {
                            echo $html->link(__('Delete', true), array('action'=>'delete', $mozo['Mozo']['id']), null, sprintf(__('¿Desea borrar el mozo nº # %s?. Si borra el mozo desaparecerá de las estadísticas.', true), $mozo['Mozo']['numero']));
                        }
                        ?>
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
		<li><?php echo $html->link(__('Crear Mozo', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Listar Usuarios', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Crear Usuario', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('Listar Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
	</ul>
</div>
