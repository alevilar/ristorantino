<style>
    .horizontal li{
        display: inline;
        border-left: solid 1px grey;
        padding: 5px;
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
?>
</ul>