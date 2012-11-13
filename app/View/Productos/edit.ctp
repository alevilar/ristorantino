

<div class="productos form">
<?php echo $this->Form->create('Producto');?>
	<fieldset>
 		<legend><?php echo __('Editar Producto');?></legend>
	<?php
		echo $this->Form->input('id');

                
                                echo $this->Form->input('name',array('label'=>'Nombre','after'=>'</br>Nombre con el que aparecerá en las comandas y en el sistema</br>'));
		echo $this->Form->input('abrev', array('label'=>'Abreviatura','after'=>'</br>Nombre con el que se imprimirá el ticket factura</br>'));
		echo $this->Form->input('categoria_id',array('label'=>'Categoria a la que pertenece este producto'));
                echo $this->Form->input('Tag');
		echo $this->Form->input('comandera_id');
		echo $this->Form->input('precio',array('placeholder'=>'$','label'=>'Precio $','after'=>'</br>Los centavos van separados de un punto, NO poner coma ni el signo pesos. Ejemplo de un precio correcto: <b>6.50</b></br>'));
                
                
                echo $this->Form->input('ProductosPreciosFuturo.producto_id', array('type'=>'hidden'));
                echo $this->Form->input('ProductosPreciosFuturo.precio',array('placeholder'=>'$','label'=>'Precio Futuro $'));
                echo $this->Form->input('order', array('label'=>'Orden','after'=>'</br>Colocar un valor numerico para ordenar como se imprimiran los productos'));
                
                
                

	?>
<?php echo $this->Form->end('Submit');?>
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $this->Form->value('Producto.id')), null, sprintf(__('¿Esta seguro que desea borrar el producto: %s?'), $this->Form->value('Producto.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Productos'), array('action'=>'index'));?></li>
	</ul>
</div>
