<div class="agencies index">
<h2><?php __('Agencias');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Mostrando %start% a %end% de %count% agencias', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('Nombre', 'name');?></th>
        <th><?php echo $paginator->sort('activo');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($agencies as $agency):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $agency['Agency']['id']; ?>
		</td>
		<td>
			<?php echo $agency['Agency']['name']; ?>
		</td>
                <td>
			<?php echo ($agency['Agency']['activo'] == 1 ? "Si" : "No"); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $agency['Agency']['id'])); ?>
			<?php echo $html->link(__('Eliminar', true), array('action'=>'delete', $agency['Agency']['id']), null, sprintf(__('Seguro deseas eliminar a %s?', true), $agency['Agency']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?
if (@$paginator->numbers()) {
?>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?> | <?php echo $paginator->numbers();?>	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<?
}
?>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Crear agencia', true), array('action'=>'add')); ?></li>
	</ul>
</div>
