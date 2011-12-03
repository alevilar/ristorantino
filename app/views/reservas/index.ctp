<div class="reservas index">
<h2><?php __('Reservas');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nueva Reserva', true), array('action' => 'add')); ?></li>
	</ul>
</div>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('nombre');?></th>
	<th><?php echo $paginator->sort('personas');?></th>
	<th><?php echo $paginator->sort('mesa');?></th>
	<th><?php echo $paginator->sort('evento');?></th>
	<th><?php echo $paginator->sort('fecha');?></th>
        <th><?php echo $paginator->sort('observaciones');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($reservas as $reserva):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $reserva['Reserva']['id']; ?>
		</td>
		<td>
			<?php echo $reserva['Reserva']['nombre']; ?>
		</td>
		<td>
			<?php echo $reserva['Reserva']['personas']; ?>
		</td>
		<td>
			<?php echo $reserva['Reserva']['mesa']; ?>
		</td>
		
		<td>
			<?php echo $reserva['Reserva']['evento']; ?>
		</td>
		<td>
			<?php echo $reserva['Reserva']['fecha']; ?>
		</td>
                <td>
			<?php echo $reserva['Reserva']['observaciones']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $reserva['Reserva']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $reserva['Reserva']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $reserva['Reserva']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $reserva['Reserva']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nueva Reserva', true), array('action' => 'add')); ?></li>
	</ul>
</div>
