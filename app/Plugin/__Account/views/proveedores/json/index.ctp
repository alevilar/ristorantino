<?php

$np = array();
$i = 0;
foreach ( $proveedores as $p ) {
    $cuit = '';
    if (!empty( $p['Proveedor']['cuit'] )) {
        $cuit = " (".$p['Proveedor']['cuit'].")";
    }
   $np[$i]['value']  = $p['Proveedor']['name'].$cuit;
   $np[$i]['id']  = $p['Proveedor']['id'];
   $i++;
}

echo json_encode($np);