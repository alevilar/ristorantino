<? echo $this->element('menu')?>

<h1>Agregar nuevo Producto</h1>

<?php

echo $form->create('Product');
echo $form->input('name');
echo $form->input('category_id', array('type'=>'radio', 'div'=> array('style'=>'width: 100%'), 'legend'=>'Seleccionar Categoria'));
echo $form->end('Guardar');

?>


<div class="actions">
    <ul>
        <li><?php echo $html->link('Listar Productos', '/inventory/products/')?></li>
        <li><?php echo $html->link('Agregar Categoria', '/inventory/categories/')?></li>
        <li><?php echo $html->link('Listar Inventario', '/inventory/counts/')?></li>
    </ul>
    
</div>

<script type="text/javascript">
    jQuery('#ProductName').focus();
</script>