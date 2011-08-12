    <?php 
        echo $this->element('menuadmin');
    ?>


<div class="categorias index">
<h2><?php __('Categorias');?></h2>

<?php echo $html->link('Reordenar Alfabeticamente',array('action'=>'reordenar'));?>

<table class="categorias-table" cellpadding="0" cellspacing="0">

<?php
$i = 0;

while(list($categoria_id, $categoria_name) = each($categorias)):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td align="left" width="200px;">
			<span style="text-align: left;"><?php echo $html->image('right.png',array('width'=>'22px;'))."($categoria_id) $categoria_name"; ?></span>
		</td>
		<td class="actions" align="left">
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $categoria_id)); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $categoria_id), null, sprintf(__('Seguro que querés borrar la categoria # %s?', true), $categoria_name)); ?>
		</td>
	</tr>
<?php endwhile; ?>
</table>
</div>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nueva Categoria', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Listar Productos', true), array('controller'=> 'productos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Agregar un Nuevo Producto', true), array('controller'=> 'productos', 'action'=>'add')); ?> </li>
	</ul>
</div>
