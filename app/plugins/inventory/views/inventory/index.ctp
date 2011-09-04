<ul>
<?php


echo '<li>Productos</li>';
echo '<li>'.$html->link('listar productos', '/inventory/products').'</li>';
echo '<li>'.$html->link('agregar producto', '/inventory/products/add').'</li>';


echo '<li>Categorias</li>';
echo '<li>'.$html->link('listar categorias', '/inventory/categories').'</li>';
echo '<li>'.$html->link('agregar categorias', '/inventory/categories/add').'</li>';



echo '<li>Inventario</li>';
echo '<li>'.$html->link('Listar inventario', '/inventory/counts').'</li>';
echo '<li>'.$html->link('agregar stock', '/inventory/counts/add').'</li>';
?>
</ul>
