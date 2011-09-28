<?php

$okval;
$comanda;

$vec = array(
    'imprimir' => $imprimir,
    'okval' => $okval,
    'Comanda' => $comanda,
);

echo json_encode($vec, JSON_NUMERIC_CHECK);