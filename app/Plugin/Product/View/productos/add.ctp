        <?php    
        echo $this->element('menuadmin');
        ?>

<div class="productos form">
<?php echo $form->create('Producto');?>
	<fieldset>
 		<legend><?php __('Agregar Nuevo Producto');?></legend>
	<?php
		echo $form->input('name',array('label'=>'Nombre','style'=>'width:200px;','after'=>'</br>Nombre con el que aparecerá en las comandas y en el sistema</br>'));
		echo $form->input('abrev', array('label'=>'Abreviatura','style'=>'width:200px;','after'=>'</br>Nombre con el que se imprimirá el ticket factura</br>'));
		//echo $form->input('description', array('label'=>'Descripción'));
		echo $form->input('categoria_id',array('label'=>'Categoria a la que pertenece este producto','style'=>'width:230px;'));
		echo $form->input('comandera_id',array('style'=>'width:230px;','after'=>'</br>Seleccione en que comandera quiere que se imprima el producto</br>'));
		echo $form->input('precio',array('placeholder'=>'$','label'=>'Precio $','style'=>'width:150px;','after'=>'</br>Los centavos van separados de un punto, NO poner coma ni el signo pesos. Ejemplo de un precio correcto: <b>6.50</b></br>'));
                echo $form->input('order', array('label'=>'Orden','style'=>'width:150px;','after'=>'</br>Poner un valor numerico para ordenar como se imprimiran los productos</br>'));
	?>
                
<?php echo $form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Productos', true), array('action'=>'index'));?></li>
	</ul>
</div>
