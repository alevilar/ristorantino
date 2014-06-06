    <?php  
    echo $this->element('menuadmin');
     ?>



<div class="tipoDePagos index">
<h2><?php __('Tipo de Pagos');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%', true)
));
?></p>
<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('Nombre');?></th>
	<th><?php echo $this->Paginator->sort('Descripción');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($tipoDePagos as $tipoDePago):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $tipoDePago['TipoDePago']['id']; ?>
                    <?php echo $this->Html->image($tipoDePago['TipoDePago']['image_url'], array('width'=>40)); ?>
		</td>
		<td>
			<?php echo $tipoDePago['TipoDePago']['name']; ?>
		</td>
		<td>
			<?php echo $tipoDePago['TipoDePago']['description']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $tipoDePago['TipoDePago']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $tipoDePago['TipoDePago']['id']), null, sprintf(__('¿Está seguro que desea borrar el tipo de pago: %s?', true), $tipoDePago['TipoDePago']['name'])); ?>
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
		<li><?php echo $this->Html->link(__('Crear Tipo de pago', true), array('action'=>'edit')); ?></li>
		<li><?php echo $this->Html->link(__('Listar Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
	</ul>
</div>
