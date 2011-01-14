<div class="productos form">
<?php echo $form->create('Producto');?>
	<fieldset>
 		<legend><?php __('Agregar Nuevo Producto');?></legend>
	<?php
		echo $form->input('name',array('label'=>'Nombre','after'=>'nombre con el que aparecerá en las comandas y en el sistema'));
		echo $form->input('abrev', array('label'=>'Abreviatura','after'=>'<cite>Nombre con el que se imprimirá el ticket factura</cite>'));
		//echo $form->input('description', array('label'=>'Descripción'));
		echo $form->input('categoria_id',array('label'=>'Categoria a la que pertenece este producto'));
		echo $form->input('comandera_id',array('after'=>'Seleccione en que comandera quiere que se imprima el producto'));
		echo $form->input('precio',array('label'=>'Precio $','after'=>'los centavos van separados de un punto, NO poner coma ni el signo pesos. Ejemplo de un precio correcto: <b>6.50</b>'));
                echo $form->input('order', array('label'=>'Orden','after'=>'poner un valor numerico para ordenar como se imprimiran los productos'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Productos', true), array('action'=>'index'));?></li>
	</ul>
</div>
