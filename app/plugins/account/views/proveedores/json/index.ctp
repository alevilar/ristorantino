<?php

$np = array();
$i = 0;
foreach ( $proveedores as $p ) {
   $np[$i]['value']  = $p['Proveedor']['name']."( ".$p['Proveedor']['cuit'] . " )";
   $np[$i]['id']  = $p['Proveedor']['id'];
   $i++;
}

echo json_encode($np);