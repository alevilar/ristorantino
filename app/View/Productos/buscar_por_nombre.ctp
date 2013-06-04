<?php
echo "<h4>estamos buscando a $buscando</h4>";

foreach ( $productos as $p ) {
    
    echo $p['Producto']['name'].'<br>';
}