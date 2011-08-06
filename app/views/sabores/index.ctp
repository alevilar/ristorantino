<div class="sabores index">
<h2><?php __('Sabores');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $form->create('Sabor',array('action'=>'index'));?></th>
	<th><?php echo $form->input('Sabor.name',array('label'=>false));?></th>
	<th><?php echo $form->input('Categoria.name',array('label'=>false));?></th>
	<th><?php echo $form->input('Sabor.precio',array('style'=>'width:50px;', 'label'=>false));?></th>
	<th>&nbsp; </th>
	<th><?php echo $form->end('Buscar');?></th>
</tr>

<tr>
	<th></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('Categoria','Categoria.name');?></th>
	<th><?php echo $paginator->sort('Precio','precio');?></th>
	<th><?php echo $paginator->sort('Creado','created');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($sabores as $sabor):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			
		</td>
		<td>
			<?php
                        $name = ($sabor['Sabor']['deleted'])? 
                            $sabor['Sabor']['name']." (borrado el ".date("d/m/y H:i:s", strtotime($sabor['Sabor']['deleted_date']))." )"
                            :
                            $sabor['Sabor']['name'];

                        echo $name; ?>
		</td>
		<td>
			<?php echo $sabor['Categoria']['name']; ?>
		</td>
		<td>
			<?php echo "$".$sabor['Sabor']['precio']; ?>
		</td>
		<td>
			<?php echo date('d-m-y H:i:s',strtotime($sabor['Sabor']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $sabor['Sabor']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $sabor['Sabor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sabor['Sabor']['id'])); ?>
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
		<li><?php echo $html->link(__('Crear Sabor', true), array('action'=>'add')); ?></li>
	</ul>
</div>