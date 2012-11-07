
<div class="sabores index">
<h2><?php echo __('Sabores');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%')
));
?></p>
<table cellpadding="0" cellspacing="0">

    <tr>
	<?php echo $this->Form->create('Sabor',array('action'=>'index'));?>
	<th><?php echo $this->Form->input('Sabor.name',array('style'=>'width:170px;','placeholder'=>'Sabor', 'label'=>false));?></th>
	<th><?php echo $this->Form->input('Categoria.name',array('style'=>'width:120px;','placeholder'=>'Categoría', 'label'=>false));?></th>
	<th><?php echo $this->Form->input('Sabor.precio',array('style'=>'width:40px;','placeholder'=>'Precio', 'label'=>false));?></th>
	<th>&nbsp; </th>
	<th><?php echo $this->Form->end('Buscar');?></th>
    </tr>
    
<tr>
	
	<th><?php echo $this->Paginator->sort('Nombre','name');?></th>
	<th><?php echo $this->Paginator->sort('Categoria','Categoria.name');?></th>
	<th><?php echo $this->Paginator->sort('Precio','precio');?></th>
	<th><?php echo $this->Paginator->sort('Creado','created');?></th>
	<th class="actions"><?php echo __('Acciones');?></th>
</tr>
<?php
if ($this->Paginator->params['paging']['Sabor']['count']!=0) {
$i = 0;
foreach ($sabores as $sabor):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
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
			<?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $sabor['Sabor']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $sabor['Sabor']['id']), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?'), $sabor['Sabor']['name'])); ?>
		</td>
	</tr>
<?php endforeach; 

}else{
    echo('<td>No se encontraron elementos</td>');
}
?>
        

</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('próximo').' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Crear Sabor'), array('action'=>'add')); ?></li>
	</ul>
</div>