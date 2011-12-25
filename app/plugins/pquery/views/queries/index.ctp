<div class="queries index">
<h1><?php __('Descargas');?></h1>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page% de %pages%, (%count% total)', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
        <th><?php echo $paginator->sort('Cat', 'pquery_category_id');?></th>
        <th><?php echo $paginator->sort('Vigencia', 'expiration_time' );?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('modified');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($queries as $query):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}

        $style = '';
        // ya venció la vigencia de la descarga
        if (@$query['Query']['expiration_time'] && $query['Query']['expiration_time'] < date('Y-m-d')) {
            $style = ' style="color:red;"';
        }
?>
	<tr<?php echo $class; echo $style;?>>
		<td style="text-align:left;">
			<?php echo 'N°' .$query['Query']['id'] . ' - '. $query['Query']['name']; ?>
		</td>
                <td>
			<?php echo $query['Category']['name']; ?>
		</td>
                <td>
			<?php echo (@$query['Query']['expiration_time'] ? $time->format('d/m/Y', $query['Query']['expiration_time']) : ''); ?>
		</td>
		<td>
			<?php echo $time->format('d/m/Y', $query['Query']['created']); ?>
		</td>
		<td>
			<?php echo $time->format('d/m/Y', $query['Query']['modified']); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $query['Query']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $query['Query']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $query['Query']['id'])); ?>
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
		<li><?php echo $html->link(__('New Query', true), array('action'=>'add')); ?></li>
	</ul>
</div>
