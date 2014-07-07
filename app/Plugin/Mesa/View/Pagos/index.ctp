<div class="pagos index">
<h2><?php __('Pagos');?></h2>
<p>
<?php
$this->Paginator->options(array('url' => $this->request->query));

?>
</p>





        <h2 style="text-align: center;"><?php __('Buscador de Pagos'); ?></h2>

<table class="table">
    
<?php echo $this->Form->create("Pago", array("action" => "index", 'method'=>'get')); ?>
<thead>
<tr>
	<th>&nbsp;</th>
        <th><?php echo $this->Form->input('mozo_id', array('placeholder' => 'N°Mozo', 'label' => false, 'empty' => 'Seleccione')); ?></th>
	<th><?php echo $this->Form->input('mesa_numero', array('placeholder' => 'N°Mesa', 'label' => false)); ?></th>
	<th><?php echo $this->Form->input('Pago.tipo_de_pago_id', array('placeholder' => 'Tipo de Pago', 'label' => false, 'empty' => 'Seleccione')); ?></th>
	<th>
            <?php echo $this->Form->input('Pago.valor', array('placeholder' => 'Valor', 'label' => false)); ?>            
        </th>
        <th>
            <?php
            echo $this->Form->input('Pago.created_from', array(
                'placeholder' => 'Desde',
                'label' => false,
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $this->Form->input('Pago.created_to', array(
                'placeholder' => 'Hasta',
                'label' => false,
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
        </th>
	<th class="actions"><?php echo $this->Form->submit("Buscar") ?></th>
</tr>
</thead>
<?php echo $this->Form->end() ?>


<thead>
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
        <th>Mozo</th>
	<th><?php echo $this->Paginator->sort('Mesa','Mesa.numero');?></th>
	<th><?php echo $this->Paginator->sort('Tipo de Pago','TipoDePago.nombre');?></th>
	<th><?php echo $this->Paginator->sort('valor');?></th>
        <th><?php echo $this->Paginator->sort('created');?></th>
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
			<?php echo $this->Html->link($pago['Mesa']['numero'], array('plugin'=>'mesa', 'controller'=>'mesas', 'action'=>'edit', $pago['Mesa']['id'] )); ?>
		</td>
                <td class="text-center">
			<?php echo $this->Html->image($pago['TipoDePago']['image_url'], array('height'=> '45', 'title'=>$pago['TipoDePago']['name'], 'alt'=>$pago['TipoDePago']['name'])); ?>
		</td>
                <td class="text-right">
			<?php echo $this->Number->currency($pago['Pago']['valor']); ?>
		</td>
                <td class="text-center">
			<?php echo strftime('%a %e de %B %H:%M',strtotime($pago['Pago']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action'=>'edit', $pago['Pago']['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('action'=>'delete', $pago['Pago']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $pago['Pago']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class'=>'disabled'));?>
</div>
