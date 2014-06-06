     <?php  
        echo $this->element('menuadmin');
     ?>

<?php
echo $this->Form->create('Proveedor', array('url'=>$this->action));
echo $this->Form->input('buscar_proveedor', array('type'=>'text'));
echo $this->Form->end('buscar');
?>
<div class="proveedores index">
<h2><?php __('Proveedores');?></h2>
<p>
<?php
    echo $this->Paginator->counter(array(
        'format' => __('Mostrando %start% a %end% de %count% proveedores', true)
    ));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('Nombre','name');?></th>
	<th><?php echo $this->Paginator->sort('CUIT', 'cuit');?></th>
	<th><?php echo $this->Paginator->sort('mail');?></th>
	<th><?php echo $this->Paginator->sort('telefono');?></th>
	<th><?php echo $this->Paginator->sort('domicilio');?></th>
	<th><?php echo $this->Paginator->sort('Creado','created');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($proveedores as $proveedor):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $proveedor['Proveedor']['name']; ?>
		</td>
		<td>
			<?php echo $proveedor['Proveedor']['cuit']; ?>
		</td>
		<td>
			<?php echo $proveedor['Proveedor']['mail']; ?>
		</td>
		<td>
			<?php echo $proveedor['Proveedor']['telefono']; ?>
		</td>
		<td>
			<?php echo $proveedor['Proveedor']['domicilio']; ?>
		</td>
		<td>
			<?php echo date("d/m/Y H:i", strtotime($proveedor['Proveedor']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $proveedor['Proveedor']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $proveedor['Proveedor']['id']), null, sprintf(__('¿Esta seguro que desea eliminar "%s"?', true), $proveedor['Proveedor']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?
if (@$this->Paginator->numbers()) {
?>
    <div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?> | 
    <?php echo $this->Paginator->numbers(); ?>	
    <?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
<?
}
?>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Nuevo Proveedor', true), array('action' => 'add')); ?></li>
	</ul>
</div>
