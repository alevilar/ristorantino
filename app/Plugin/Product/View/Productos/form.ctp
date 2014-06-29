
<div class="productos form">
<?php echo $this->Form->create('Producto');?>
	<fieldset>
 		<legend><?php __('Editar Producto');?></legend>
	<?php
		echo $this->Form->input('id');

		echo $this->Form->input('name',array('label'=>'Nombre','after'=>'</br>Nombre con el que aparecerá en las comandas y en el sistema'));
		echo $this->Form->input('abrev', array('label'=>'Abreviatura','after'=>'</br>Nombre con el que se imprimirá el ticket factura'));

		echo $this->Form->input('Tag');


		//echo $this->Form->input('description', array('label'=>'Descripción'));
		echo $this->Form->input('categoria_id',array('label'=>'Categoria a la que pertenece este producto'));
		echo $this->Form->input('comandera_id',array('after'=>'</br>Seleccione en que comandera quiere que se imprima el producto'));
		echo $this->Form->input('precio',array('label'=>'Precio $','after'=>'</br>Los centavos van separados de un punto, NO poner coma ni el signo pesos.</br>Ejemplo de un precio correcto: <b>6.50</b>'));

        echo $this->Form->input('ProductosPreciosFuturo.producto_id', array('type'=>'hidden'));
        echo $this->Form->input('ProductosPreciosFuturo.precio',array('placeholder'=>'$','label'=>'Precio Futuro $'));

        


        echo $this->Form->input('order', array('label'=>'Orden','after'=>'</br>Colocar un valor numerico para ordenar como se imprimiran los productos'));
	?>
<?php echo $this->Form->end('Submit');?>
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $this->Form->value('Producto.id')), null, sprintf(__('¿Esta seguro que desea borrar el producto: %s?', true), $this->Form->value('Producto.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Productos', true), array('action'=>'index'));?></li>
	</ul>
</div>
