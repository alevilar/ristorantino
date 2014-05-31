<div class="productos index">
<h2><?php __('Productos sin precios futuros');?></h2>
<p>
<?php
/*
echo $paginator->options(array('url'=>$this->params['PaginateConditions']));

echo $paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%.', true)
));
*/
?></p>
<table class="productos" cellpadding="0" cellspacing="0">

    <?php echo $form->create("ProductosPreciosFuturo",array("action"=>"index")); ?>
    
    <?php /* echo $form->input('ProductosPreciosFuturos.no_tiene_precio_asignado', array(
                                'type' => 'radio',
                                'options'=>array(0=>'NO', 1=>'SI' ),
                                'label'=>'Con precio futuro o no'))*/ ;?>
    
<tr>
	<th><?php echo $form->input('Producto.name',array('style'=>'width:170px;','label'=>false));?></th>
	<th><?php echo $form->input('Producto.abrev',array('style'=>'width:150px;','label'=>false));?></th>
	<th><?php echo $form->input('Producto.precio',array('style'=>'width:60px;','label'=>false));?></th>
	<th>&nbsp;</th>
	<th class="actions"><?php echo $form->end("Buscar")?></th>
</tr>

<tr>
	<th><?php //echo $paginator->sort('Nombre','name');?></th>
	<th><?php //echo $paginator->sort('abreviatura','abrev');?></th>
	<th><?php //echo $paginator->sort('Precio','precio');?></th>
	<th><?php //echo $paginator->sort('Modificado','modified');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
debug($productos);
foreach ($productos as $producto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
        if(!empty($producto['ProductosPreciosFuturo']['precio'])) {
?>
	<tr<?php echo $class;?>>
		
            
		<td>
			<?php 
                         $name = ($producto['Producto']['deleted'])? 
                            $producto['Producto']['name']." (borrado el ".date("d/m/y H:i:s", strtotime($producto['Producto']['deleted_date']))." )"
                            :
                            $producto['Producto']['name'];

                        echo $name;
                        ?>
		</td>
		<td>
			<?php echo $producto['Producto']['abrev']; ?>
		</td>
		
                
		<td>
			<?php echo "$".$producto['Producto']['precio']; echo !empty($producto['ProductosPreciosFuturo']['precio'])?" <b>[$".$producto['ProductosPreciosFuturo']['precio']."]</b>":''?>
		</td>
		<td>
			<?php echo date('d-m-y',strtotime($producto['Producto']['modified'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $producto['Producto']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $producto['Producto']['id']), null, sprintf(__('¿Esta seguro que desea borrar "%s"?', true), $producto['Producto']['name'])); ?>
		</td>
	</tr>
<?php
        }
endforeach; ?>
</table>
</div>
<div class="paging">
	<?php //echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php //echo $paginator->numbers();?>
	<?php //echo $paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Aplicar precios futuros', true), array('action'=>'actualizarPreciosFuturos'), null, sprintf(__('¿Esta seguro que desea actualizar los precios futuros?', true))); ?></li>
		<li><?php echo $html->link(__('Listar Productos', true), '/productos/index'); ?></li>
                <li><?php echo $html->link(__('Productos con precios futuros', true), array('controller'=>'productos_precios_futuros','action'=>'index')); ?></li>
        </ul>
</div>
