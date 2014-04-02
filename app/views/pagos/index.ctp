<div class="pagos index">
<h2><?php __('Pagos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table class="table">
    <thead>
<tr>
	<th><?php echo $paginator->sort('id');?></th>
        <th>Mozo</th>
	<th><?php echo $paginator->sort('Mesa','Mesa.numero');?></th>
	<th><?php echo $paginator->sort('Tipo de Pago','TipoDePago.nombre');?></th>
	<th><?php echo $paginator->sort('valor');?></th>
        <th><?php echo $paginator->sort('created');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
</thead>

<tbody>
<?php
$i = 0;
foreach ($pagos as $pago):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td class="text-center">
			<?php echo $pago['Pago']['id']; ?>
		</td>
                <td class="text-center">
			<?php echo $pago['Mesa']['Mozo']['numero']; ?>
		</td>
		<td class="text-center">
			<?php echo $pago['Mesa']['numero']; ?>
		</td>
                <td class="text-center">
			<?php echo $html->image($pago['TipoDePago']['image_url'], array('height'=> '45', 'title'=>$pago['TipoDePago']['name'], 'alt'=>$pago['TipoDePago']['name'])); ?>
		</td>
                <td class="text-right">
			<?php echo $number->currency($pago['Pago']['valor']); ?>
		</td>
                <td class="text-center">
			<?php echo strftime('%a %e de %B %H:%M',strtotime($pago['Pago']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $pago['Pago']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $pago['Pago']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pago['Pago']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Pago', true), array('action'=>'add')); ?></li>
	</ul>
</div>
