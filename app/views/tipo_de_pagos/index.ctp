    <?php  
        $menubread=array();
        echo $this->element('menuadmin', array('menubread'=>$menubread));
     ?>



<div class="tipoDePagos index">
<h2><?php __('Tipo de Pagos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('Nombre');?></th>
	<th><?php echo $paginator->sort('Descripción');?></th>
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
		</td>
		<td>
			<?php echo $tipoDePago['TipoDePago']['name']; ?>
		</td>
		<td>
			<?php echo $tipoDePago['TipoDePago']['description']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $tipoDePago['TipoDePago']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $tipoDePago['TipoDePago']['id']), null, sprintf(__('¿Está seguro que desea borrar el tipo de pago: %s?', true), $tipoDePago['TipoDePago']['name'])); ?>
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
		<li><?php echo $html->link(__('Crear Tipo de pago', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Listar Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Nuevo Pago', true), array('controller'=> 'pagos', 'action'=>'add')); ?> </li>
	</ul>
</div>
