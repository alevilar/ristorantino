
<style>
    .horizontal li{
        display: inline;
    }
</style>

<ul class="horizontal">
    <li>MENU: </li>
<?php

echo '<li>'.$html->link('listar productos', '/inventory/products').'</li>';
echo '<li>'.$html->link('agregar producto', '/inventory/products/add').'</li>';

echo '<li>'.$html->link('listar categorias', '/inventory/categories').'</li>';
echo '<li>'.$html->link('agregar categorias', '/inventory/categories/add').'</li>';


echo '<li>'.$html->link('agregar stock', '/inventory/counts/add').'</li>';
?>
</ul>

<h2>Agregar Cantidad a inventario</h2>

<div class="clear" style="height: 30px;"></div>
<div>

<?php

if (empty($prod)) {
    echo "<h1 style='color: red'>Tarea Terminada</h1>";
} else {
    $prodName = $prod['Product']['name'];
    echo "<h1>$prodName</h1>";
    echo $form->create('Count');
    echo $form->input('product_id', array('type'=>'hidden', 'value'=>$prod['Product']['id']));
    echo $form->input('count', array('label'=>'ingresar cantidad'));
    echo $form->end('Guardar');
    
    ?>
    

    <div class="clear" style="height: 30px;"></div>
    <div class="">
        <h3>Productos que aún faltan cargar</h3>
    <?php
    foreach ($prodsQueFaltan as $pqf){
        echo $html->link($pqf['Product']['name'], '/inventory/counts/add/'.$pqf['Product']['id']).' - ';
    }
    ?>
    </div>    
    
    
    
    <?php
    
    
}

?>
</div>


