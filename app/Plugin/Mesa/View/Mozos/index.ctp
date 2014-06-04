        
        
<?php
$this->Paginator->options(array('url' => $this->passedArgs)); 
?>

<div class="mozos index">
	
<p>
<?php
echo $this->Paginator->counter(array(
    'format' => __('Página %page% de %pages%, mostrando %current% elementos de %count%')
));
?></p>
<table cellpadding="0" cellspacing="0" class="table">
<tr>
        <th><?php echo $this->Paginator->sort('activo');?>&nbsp;<?php echo $this->Paginator->sort('nombre');?></th>
        <th>Foto</th>
	<th><?php echo $this->Paginator->sort('numero');?></th>
	<th class="actions"><?php echo __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($mozos as $mesa):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
			
		<td>
                    <span class="mozo-puntito <?php echo $mesa['Mozo']['activo'] ? 'text-success' : '' ?>" style="font-size:26pt">•</span> <?php echo $mesa['Mozo']['nombre']." ".$mesa['Mozo']['apellido']; ?>
		</td>
		<td>
             <?php 
             if (!empty($mesa['Mozo']['image_url']) ) {
             	echo $this->Html->image(THUMB_FOLDER . DS .$mesa['Mozo']['image_url'], array('img-polaroid', 'style'=>'width: 68px')); 
			 } else {
			 	echo "&nbsp;";
			 }
             	?>
		</td>
		<td>
			<?php echo $mesa['Mozo']['numero']; ?>
		</td>
		<td class="actions">
			<?php // echo $this->Html->link(__('View'), array('action'=>'view', $mozo['Mozo']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $mesa['Mozo']['id'])); ?>
			<?php
                        if ($this->Session->read('Auth.User.role') == 'superuser') {
                            echo $this->Html->link(__('Delete'), array('action'=>'delete', $mesa['Mozo']['id']), null, sprintf(__('¿Desea borrar el mozo nº # %s?. Si borra el mozo desaparecerá de las estadísticas.'), $mesa['Mozo']['numero']));
                        }
                        ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('próximo').' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Crear Mozo'), array('action'=>'add')); ?></li>
		<li><?php echo $this->Html->link(__('Listar Usuarios'), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear Usuario'), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Mesas'), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
	</ul>
</div>
