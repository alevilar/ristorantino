        <?php    
        $menubread=array();
        echo $this->element('admin_menu', array('menubread'=>$menubread));
        ?>

<div class="productos index">
<h2><?php echo __('Productos con precios futuros');?></h2>
<p>
<?php

echo $this->Paginator->options(array('url'=>$this->request->params['PaginateConditions']));

echo $this->Paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%.')
));
?></p>
<table class="productos" cellpadding="0" cellspacing="0">

    <?php echo $this->Form->create("ProductosPreciosFuturo",array("action"=>"index")); ?>
    
    <?php /* echo $this->Form->input('ProductosPreciosFuturos.no_tiene_precio_asignado', array(
                                'type' => 'radio',
                                'options'=>array(0=>'NO', 1=>'SI' ),
                                'label'=>'Con precio futuro o no'))*/ ;?>
    
    
<tr>
	<th><?php echo $this->Form->input('Producto.name',array('style'=>'width:170px;','placeholder'=>'Nomnre', 'label'=>false));?></th>
	<th><?php echo $this->Form->input('Producto.abrev',array('style'=>'width:150px;','placeholder'=>'Abreviatura','label'=>false));?></th>
	<th><?php echo $this->Form->input('Producto.precio',array('style'=>'width:60px;','placeholder'=>'Precio','label'=>false));?></th>
	<th>&nbsp;</th>
	<th class="actions"><?php echo $this->Form->end("Buscar")?></th>
</tr>

<tr>
	<th><?php echo $this->Paginator->sort('Nombre','name');?></th>
	<th><?php echo $this->Paginator->sort('abreviatura','abrev');?></th>
	<th><?php echo $this->Paginator->sort('Precio','precio');?></th>
	<th><?php echo $this->Paginator->sort('Modificado','modified');?></th>
	<th class="actions"><?php echo __('Acciones');?></th>
</tr>
<?php
$i = 0;
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
			<?php echo $this->Html->link(__('Editar'), array('controller'=>'productos', 'action'=>'edit', $producto['Producto']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar'), array('controller'=>'productos', 'action'=>'delete', $producto['Producto']['id']), null, sprintf(__('¿Esta seguro que desea borrar "%s"?'), $producto['Producto']['name'])); ?>
		</td>
	</tr>
<?php
        }
endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('próximo').' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Aplicar precios futuros'), array('controller'=>'productos','action'=>'actualizarPreciosFuturos'), null, sprintf(__('¿Esta seguro que desea actualizar los precios futuros?'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Productos'), '/productos/index'); ?></li>
                <?php //echo $this->Html->link(__('Productos sin precios futuros'), array('controller'=>'productos','action'=>'sinpreciosfuturos')); ?>
        </ul>
</div>
