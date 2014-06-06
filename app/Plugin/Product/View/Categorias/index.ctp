
<div class="categorias index">
<h2><?php echo __('Categorias');?></h2>

<?php echo $this->Html->link('Reordenar Alfabeticamente',array('action'=>'reordenar'));?>
<br>
<?php echo $this->Html->link('Recuperar',array('action'=>'recover'));?>
<br>
<?php echo $this->Html->link('Verificar estructura',array('action'=>'verify'));?>

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
                echo $this->Html->image('menu/'.$imagenes[$catId],array('height'=>'22px;')); 
        }
        echo "($catId) $catName";
        ?></span>
        </td>
        <td class="actions" align="left">
            <?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $catId)); ?>
            <?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $catId), null, sprintf(__('Seguro que querés borrar la categoria # %s?'), $catName)); ?>
        </td>
    </tr>
<?php } ?>
</table>
</div>


<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Nueva Categoria'), array('action'=>'edit')); ?></li>
        <li><?php echo $this->Html->link(__('Listar Productos'), array('controller'=> 'productos', 'action'=>'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Agregar un Nuevo Producto'), array('controller'=> 'productos', 'action'=>'add')); ?> </li>
    </ul>
</div>