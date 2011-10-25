<style>
    .horizontal li{
        display: inline;
    }
    h1{
        margin: 20px;
        font-size: large;
    }
</style>

<ul class="horizontal no-print">
    <li>MENU: </li>
<?php
    echo '<li>'.$html->link('listar productos', '/inventory/products').'</li>';
    echo '<li>'.$html->link('agregar producto', '/inventory/products/add').'</li>';
    echo '<li>'.$html->link('listar categorias', '/inventory/categories').'</li>';
    echo '<li>'.$html->link('agregar categorias', '/inventory/categories/add').'</li>';
    echo '<li>'.$html->link('Listar inventario', '/inventory/counts').'</li>';
    echo '<li>'.$html->link('agregar stock', '/inventory/counts/add').'</li>';
    echo '<li>'.$html->link('Listado para imprimir', '/inventory/counts/listar_faltantes_para_imprimir').'</li>';    
?>
</ul>