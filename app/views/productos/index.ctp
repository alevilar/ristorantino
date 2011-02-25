<div class="productos index">
<h2><?php __('Productos');?></h2>
<p>
<?php
echo $paginator->options(array('url'=>$this->params['PaginateConditions']));

echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">

<tr>
	<th><?php echo $form->create("Producto",array("action"=>"index")); echo $form->input("id") ?></th>
	<th><?php echo $form->input('name',array('label'=>false));?></th>
	<th><?php echo $form->input('abrev',array('label'=>false));?></th>
	<th><?php echo $form->input('Comandera.name',array('label'=>false));?></th>
	<th><?php echo $form->input('Categoria.name',array('label'=>false));?></th>
	<th><?php echo $form->input('precio',array('label'=>false));?></th>
        <th><?php echo $form->input('order',array('label'=>false));?></th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th class="actions"><?php echo $form->end("Buscar")?></th>
</tr>

<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('Nombre','name');?></th>
	<th><?php echo $paginator->sort('abreviatura','abrev');?></th>
	<th><?php echo $paginator->sort('Comandera','Comandera.name');?></th>
	<th><?php echo $paginator->sort('Categoria','Categoria.name');?></th>
	<th><?php echo $paginator->sort('precio');?></th>
        <th><?php echo $paginator->sort('order');?></th>
	<th><?php echo $paginator->sort('Creado','created');?></th>
	<th><?php echo $paginator->sort('Modificado','modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($productos as $producto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $producto['Producto']['id']; ?>
		</td>
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
		<td>
			<?php echo date('d-m-y',strtotime($producto['Producto']['modified'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action'=>'view', $producto['Producto']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $producto['Producto']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $producto['Producto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $producto['Producto']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nuevo Producto', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Listar Categorias', true), '/Categorias/index'); ?></li>
		<li><?php echo $html->link(__('Agregar Nueva Categoria', true), '/Categorias/add'); ?></li>
	</ul>
</div>
