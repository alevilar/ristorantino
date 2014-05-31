        <?php     
            echo $this->element('menuadmin');
        ?>
        
        
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
<table class="table">
    <thead>
        <tr>
            <th><?php echo $paginator->sort('activo');?><?php echo $paginator->sort('Nombre','User.nombre');?></th>
            <th></th>
            <th><?php echo $paginator->sort('numero');?></th>
            <th class="actions"><?php __('Acciones');?></th>
        </tr>
    </thead>

<?php
$i = 0;
foreach ($mozos as $mesa):
?>
	<tr>
			
		<td>
                    <span class="mozo-puntito <?php echo $mesa['Mozo']['activo'] ? 'text-success' : '' ?>" style="font-size:26pt">•</span> <?php echo $mesa['Mozo']['nombre']." ".$mesa['Mozo']['apellido']; ?>
		</td>
		<td>
             <?php 
                if (!empty($mesa['Mozo']['image_url']) ) {
                    echo $html->image(THUMB_FOLDER.DS.$mesa['Mozo']['image_url'], array('img-polaroid', 'style'=>'width: 68px')); 
                } else {
                       echo "&nbsp;";
                }
             	?>
		</td>
		<td>
			<?php echo $mesa['Mozo']['numero']; ?>
		</td>
		<td class="actions">
			<?php // echo $html->link(__('View'), array('action'=>'view', $mozo['Mozo']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $mesa['Mozo']['id'])); ?>
			<?php
                        echo $html->link(__('Delete', true), array('action'=>'delete', $mesa['Mozo']['id']), null, sprintf( '¿Desea borrar el mozo nº # %s?. Si borra el mozo desapareceran las estadísticas.', $mesa['Mozo']['numero']));
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
