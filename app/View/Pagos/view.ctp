<div class="pagos view">
<h2><?php echo __('Pago');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pago['Pago']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Mesa Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pago['Pago']['mesa_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Tipo De Pago Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pago['Pago']['tipo_de_pago_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Valor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pago['Pago']['valor']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pago'), array('action'=>'edit', $pago['Pago']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Pago'), array('action'=>'delete', $pago['Pago']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $pago['Pago']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pagos'), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pago'), array('action'=>'add')); ?> </li>
	</ul>
</div>
