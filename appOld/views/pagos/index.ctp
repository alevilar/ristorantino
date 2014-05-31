<div class="pagos index">
<h2><?php __('Pagos');?></h2>
<p>
<?php
$paginator->options(array('url' => $this->passedArgs));

echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>





        <h2 style="text-align: center;"><?php __('Buscador de Pagos'); ?></h2>

<table class="table">
    
<?php echo $form->create("Pago", array("action" => "index", 'method'=>'get')); ?>
<thead>
<tr>
	<th>&nbsp;</th>
        <th><?php echo $form->input('Mesa.mozo_id', array('placeholder' => 'N°Mozo', 'label' => false, 'empty' => 'Seleccione')); ?></th>
	<th><?php echo $form->input('Mesa.numero', array('placeholder' => 'N°Mesa', 'label' => false)); ?></th>
	<th><?php echo $form->input('Pago.tipo_de_pago_id', array('placeholder' => 'Tipo de Pago', 'label' => false, 'empty' => 'Seleccione')); ?></th>
	<th>
            <?php echo $form->input('Pago.valor', array('placeholder' => 'Valor', 'label' => false)); ?>            
        </th>
        <th>
            <?php
            echo $form->input('Pago.created_from', array(
                'placeholder' => 'Desde',
                'label' => false,
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $form->input('Pago.created_to', array(
                'placeholder' => 'Hasta',
                'label' => false,
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
        </th>
	<th class="actions"><?php echo $form->submit("Buscar") ?></th>
</tr>
</thead>
<?php echo $form->end() ?>


<thead>
<tr>
	<th><?php echo $paginator->sort('id');?></th>
        <th>Mozo</th>
	<th><?php echo $paginator->sort('Mesa','Mesa.numero');?></th>
	<th><?php echo $paginator->sort('Tipo de Pago','TipoDePago.nombre');?></th>
	<th><?php echo $paginator->sort('valor');?></th>
        <th><?php echo $paginator->sort('created');?></th>
	<th class="actions">&nbsp;</th>
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
