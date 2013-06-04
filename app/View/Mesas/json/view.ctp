<?php
$mesa['total'] = $mesa_total;
$mesa['items'] = array();

$comanda_ant = '';
$prod_borrados = array();

foreach ($items as $i){
    unset($item);

        $item['comanda']['id'] = $i['DetalleComanda']['comanda_id'];
        $item['comanda']['created'] = date("H:i:s",strtotime($i['DetalleComanda']['created']));

        $item['producto']['cantidad'] = $i['DetalleComanda']['cant']-$i['DetalleComanda']['cant_eliminada'];
        $item['producto']['name'] = $i['Producto']['name'];

        $item['producto']['sabor'] = array();

        if(count($i['DetalleSabor'])>0){
            foreach($i['DetalleSabor'] as $sabor):
                    $item['producto']['sabor'][] = $sabor['Sabor']['name'];
            endforeach;
        }
        $mesa['items'][] = $item;
}

$mesa['Mozo'] = $mesa;

echo json_encode($mesa)
?>

