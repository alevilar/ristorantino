    <?php  
        echo $this->element('menuadmin');
     ?>



<div class="descuentos index">
<h2><?php __('Descuentos');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%', true)
));
?></p>
<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort('Nombre');?></th>
	<th><?php echo $this->Paginator->sort('Descripción');?></th>
	<th><?php echo $this->Paginator->sort('Porcentaje');?></th>
	<th><?php echo $this->Paginator->sort('Creado');?></th>
	<th><?php echo $this->Paginator->sort('Modificado');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($descuentos as $descuento):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $descuento['Descuento']['name']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['description']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['porcentaje']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['created']; ?>
		</td>
		<td>
			<?php echo $descuento['Descuento']['modified']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $descuento['Descuento']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $descuento['Descuento']['id']), null, sprintf(__('¿Está seguro que desea borrar el descuento: %s?', true), $descuento['Descuento']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('Crear Descuento', true), array('action'=>'add')); ?></li>
	</ul>
</div>
