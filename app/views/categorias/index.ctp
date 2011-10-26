    <?php 
        echo $this->element('menuadmin');
    ?>


<div class="categorias index">
<h2><?php __('Categorias');?></h2>

<?php echo $html->link('Reordenar Alfabeticamente',array('action'=>'reordenar'));?>

<table class="categorias-table" cellpadding="0" cellspacing="0">

<?php
$i = 0;
foreach($categorias as $catId => $catName){
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
    <tr>
		<td align="left" width="200px;">
			<span style="text-align: left;">
        <?php  
       
        if( !empty($imagenes[$catId])) {
                echo $html->image('menu/'.$imagenes[$catId],array('height'=>'22px;')); 
        }
        echo "($catId) $catName";
        ?></span>
		</td>
		<td class="actions" align="left">
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $catId)); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $catId), null, sprintf(__('Seguro que querés borrar la categoria # %s?', true), $catName)); ?>
		</td>
	</tr>
<?php } ?>
</table>
</div>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nueva Categoria', true), array('action'=>'edit')); ?></li>
		<li><?php echo $html->link(__('Listar Productos', true), array('controller'=> 'productos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Agregar un Nuevo Producto', true), array('controller'=> 'productos', 'action'=>'add')); ?> </li>
	</ul>
</div>
