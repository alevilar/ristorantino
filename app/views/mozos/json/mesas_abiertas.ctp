<?php

foreach($mesas as &$m){
    $aux = $m['Mozo'];
    $aux['mesas'] = $m['Mesa'];
    $m = $aux;
}

$res = array(
    'mozos' => $mesas,
    'time'  =>  time(), // curren Unix server time
);

echo json_encode($res);