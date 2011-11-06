<?php

$vec['mesas'] = $mesas;
$vec['time'] = $mesasLastUpdatedTime; // curren Unix server time

echo json_encode($vec);