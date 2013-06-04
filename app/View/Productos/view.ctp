
<div class="productos view">
<h2><?php  echo $producto['Producto']['name'];?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $producto['Producto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Abrev'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $producto['Producto']['abrev']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Categoria'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $producto['Categoria']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Precio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo "$".$producto['Producto']['precio']; ?>
			&nbsp;
		</dd>
                
                <dt<?php if ($i % 2 == 0) echo $class;?>><?php echo "Historial de precios" ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
                        foreach ($producto['HistoricoPrecio'] as $h) {
                            echo '$'.$h['precio']." (hasta el ".date('d-m-y', strtotime($h['created'])).'), ';
                        }
                        ?>
			&nbsp;
		</dd>
                
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo date('d-m-Y H:i', strtotime($producto['Producto']['created'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo date('d-m-Y H:i', strtotime($producto['Producto']['modified'])); ?>
			&nbsp;
		</dd>
	</dl>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Producto'), array('action'=>'edit', $producto['Producto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Borrar Producto'), array('action'=>'delete', $producto['Producto']['id']), null, sprintf(__('Seguro que desea eliminar %s?'), $producto['Producto']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Productos'), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Nuevo Producto'), array('action'=>'add')); ?> </li>
	</ul>
</div>

<h3>Ventas de este producto, por día (de 12 am a 12 am)</h3>

    <table>
        <thead>
            <tr><th>Cantidad Total</th> <th>Fecha</th></tr>
        </thead>

    <?php
    foreach ($consumiciones as $cc) {
        echo "<tr>";
        echo "<td>". $cc[0]['suma']. "</td>";
        echo "<td>". date('D. d-m-y', strtotime($cc[0]['date'])) ."</td>";
        echo "</tr>";
    }
    ?>
    </table>
</div>
