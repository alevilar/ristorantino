<?php

$vec['mesas'] = $mesas;
$vec['time'] = $mesasLastUpdatedTime; // curren Unix server time
$vec['modified'] = $modified;

echo json_encode($vec);