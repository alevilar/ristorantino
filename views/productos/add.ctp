<div class="productos form">
<?php echo $form->create('Producto');?>
	<fieldset>
 		<legend><?php __('Agregar Nuevo Producto');?></legend>
	<?php
		echo $form->input('name',array('label'=>'Nombre'));
		echo $form->input('abrev', array('label'=>'Abreviatura','after'=>'<cite>Nombre con el que se imprimirá el ticket factura</cite>'));
		echo $form->input('description', array('label'=>'Descripción'));
		echo $form->input('categoria_id');
		echo $form->input('precio',array('label'=>'Precio $','after'=>'los centavos van separados de un punto, NO poner coma ni el signo pesos. Ejemplo de un precio correcto: <b>6.50</b>'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Productos', true), array('action'=>'index'));?></li>
	</ul>
</div>
