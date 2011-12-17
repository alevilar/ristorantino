<?php
echo $this->element('menu');

echo "<h1>" . $prods['Product']['name'] ."</h1>";

echo "<h2>Categoria: ".  $prods['Category']['name']."</h2>";
        
echo "<h3>Stock al día</h3>";

$cantidadAnterior = 0;
foreach ( $prods['Count'] as $stock ) {
    
    $dif = ( $stock['count'] - $cantidadAnterior );
    if ( $dif < 0 ) {
        $dif = "<span style='color: red'>$dif</span>";
    }
    $difTxt = " | Diferencia con el período anterior: ". $dif;
        
    echo "<p>" . "Cantidad: <b>".$stock['count']."</b> | " .date('d-M-Y, H:i', strtotime($stock['modified'])) . $difTxt ."</p>";
    
    $cantidadAnterior = $stock['count'];
}


echo $html->link('Modificar inventario', '/inventory/counts/add/'.$prods['Product']['id']);