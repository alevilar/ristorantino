
<div class="productos form">
<?php echo $this->Form->create('Producto');?>
	<fieldset>
 		<legend><?php echo __('Agregar Nuevo Producto');?></legend>
	<?php
		echo $this->Form->input('name',array('label'=>'Nombre','style'=>'width:200px;','after'=>'</br>Nombre con el que aparecerá en las comandas y en el sistema</br>'));
		echo $this->Form->input('abrev', array('label'=>'Abreviatura','style'=>'width:200px;','after'=>'</br>Nombre con el que se imprimirá el ticket factura</br>'));
		//echo $this->Form->input('description', array('label'=>'Descripción'));
		echo $this->Form->input('categoria_id',array('label'=>'Categoria a la que pertenece este producto','style'=>'width:230px;'));
		echo $this->Form->input('comandera_id',array('style'=>'width:230px;','after'=>'</br>Seleccione en que comandera quiere que se imprima el producto</br>'));
		echo $this->Form->input('precio',array('placeholder'=>'$','label'=>'Precio $','style'=>'width:150px;','after'=>'</br>Los centavos van separados de un punto, NO poner coma ni el signo pesos. Ejemplo de un precio correcto: <b>6.50</b></br>'));
                echo $this->Form->input('order', array('label'=>'Orden','style'=>'width:150px;','after'=>'</br>Poner un valor numerico para ordenar como se imprimiran los productos</br>'));
	?>
                
<?php echo $this->Form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Productos'), array('action'=>'index'));?></li>
	</ul>
</div>
