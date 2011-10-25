        <?php    
        $menubread=array();   
        echo $this->element('menuadmin', array('menubread'=>$menubread));
        ?>

<div class="productos index">
<h2><?php __('Productos');?></h2>
<p>
<?php
echo $paginator->options(array('url'=>$this->params['PaginateConditions']));
//debug($paginator->params['paging']['Producto']['count']);
echo $paginator->counter(array('format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%.', true)));?></p>
<table class="productos" cellpadding="0" cellspacing="0">
        <tr>
	<?php echo $form->create("Producto",array("action"=>"index")); echo $form->input("id") ?>
	<th><?php echo $form->input('name',array('style'=>'width:170px;','placeholder'=>'Nombre del producto', 'label'=>false));?></th>
	<th><?php echo $form->input('abrev',array('style'=>'width:145px;','placeholder'=>'Abreviatura','label'=>false));?></th>
	<th><?php echo $form->input('Comandera.name',array('style'=>'width:85px;','placeholder'=>'Comandera','label'=>false));?></th>
	<th><?php echo $form->input('Categoria.name',array('style'=>'width:85px;','placeholder'=>'Categoria','label'=>false));?></th>
	<th><?php echo $form->input('precio',array('style'=>'width:40px;','placeholder'=>'Precio','label'=>false));?></th>
        <th><?php echo $form->input('order',array('style'=>'width:35px;','placeholder'=>'Orden','label'=>false));?></th>
	<th>&nbsp;</th>
	<th class="actions"><?php echo $form->end("Buscar")?></th>
        </tr>

<tr>
	<th><?php echo $paginator->sort('Nombre','name');?></th>
	<th><?php echo $paginator->sort('Abreviatura','abrev');?></th>
	<th><?php echo $paginator->sort('Comandera','Comandera.name');?></th>
	<th><?php echo $paginator->sort('Categoria','Categoria.name');?></th>
	<th><?php echo $paginator->sort('Precio','precio');?></th>
        <th><?php echo $paginator->sort('Orden','order');?></th>
	<th><?php echo $paginator->sort('Creado','created');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php

if ($paginator->params['paging']['Producto']['count']!=0) {
$i = 0;
foreach ($productos as $producto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
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
			<?php echo $producto['Comandera']['name']; ?>
		</td>
		<td>
			<?php echo $producto['Categoria']['name']; ?>
		</td>
		<td>
			<?php echo "$".$producto['Producto']['precio']; echo !empty($producto['ProductosPreciosFuturo']['precio'])?" <b>[$".$producto['ProductosPreciosFuturo']['precio']."]</b>":''?>
		</td>
                <td>
			<?php echo $producto['Producto']['order']; ?>
		</td>
		<td>
			<?php echo date('d-m-y',strtotime($producto['Producto']['created'])); ?>
		</td>
		<td class="actions">
                    <?php echo $html->link(__('Ver', true), array('action'=>'view', $producto['Producto']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $producto['Producto']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $producto['Producto']['id']), null, sprintf(__('¿Esta seguro que desea borrar el producto: %s?', true), $producto['Producto']['name'])); ?>
		</td>
	</tr>
<?php 
endforeach; 

}else{
    echo('<td>No se encontraron elementos</td>');
}
    
?>
       
</table>


</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nuevo Producto', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Listar Categorias', true), '/Categorias/index'); ?></li>
		<li><?php echo $html->link(__('Agregar Nueva Categoria', true), '/Categorias/add'); ?></li>
	</ul>
</div>
