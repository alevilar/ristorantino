<?php 
//esta variable no la uso
 //$mozo_json
 ?>
 
<script type="text/javascript">
<!--

fabricaMesa = new FabricaMesa(<?php echo $mesa_json?>);
currentMesa = fabricaMesa.getMesa();

actualizar_numero_mesa_div();
//-->
</script>

<div class="mesas view">

	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mesa']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Numero'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mesa']['numero']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mozo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($mesa['Mozo']['id'], array('controller'=> 'mozos', 'action'=>'view', $mesa['Mozo']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mesa']['total']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descuento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo $mesa['Mesa']['descuento']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mesa']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Time Abrio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mesa']['time_abrio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Time Paso Pedido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mesa']['time_paso_pedido']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Time Cerro Mesa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mesa']['time_cerro_mesa']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Time Cobro'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mesa']['time_cobro']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Mesa', true), array('action'=>'edit', $mesa['Mesa']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Mesa', true), array('action'=>'delete', $mesa['Mesa']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mesa['Mesa']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Mesas', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Mesa', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Mozos', true), array('controller'=> 'mozos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Mozo', true), array('controller'=> 'mozos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Comensales', true), array('controller'=> 'comensales', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comensal', true), array('controller'=> 'comensales', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Items', true), array('controller'=> 'items', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Item', true), array('controller'=> 'items', 'action'=>'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php  __('Related Comensales');?></h3>
	<?php if (!empty($mesa['Comensal'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $mesa['Comensal']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cant Mayores');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $mesa['Comensal']['cant_mayores'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cant Menores');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $mesa['Comensal']['cant_menores'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cant Bebes');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $mesa['Comensal']['cant_bebes'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mesa Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $mesa['Comensal']['mesa_id'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Comensal', true), array('controller'=> 'comensales', 'action'=>'edit', $mesa['Comensal']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Related Items');?></h3>
	<?php if (!empty($mesa['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Abrev'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Categoria Id'); ?></th>
		<th><?php __('Precio'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($mesa['Item'] as $item):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['abrev'];?></td>
			<td><?php echo $item['description'];?></td>
			<td><?php echo $item['categoria_id'];?></td>
			<td><?php echo $item['precio'];?></td>
			<td><?php echo $item['created'];?></td>
			<td><?php echo $item['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'items', 'action'=>'view', $item['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'items', 'action'=>'edit', $item['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'items', 'action'=>'delete', $item['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Item', true), array('controller'=> 'items', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
