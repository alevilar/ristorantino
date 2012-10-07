<?php

$json = array(
    'items' => $items,
    'mozo'  => $mozo_json,
    'mesa'  => $mozo,
    'mesa_total'  => $mesa_total,
);

json_encode($json);