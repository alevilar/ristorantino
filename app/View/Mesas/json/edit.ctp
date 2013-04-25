<?php
    foreach($mesa['Mesa'] as $ak=>$att) {
        $mesa[$ak] = $att;
    }
    unset($mesa['Mesa']);  
    if ( empty($mesa['Cliente']['id']) ){
        unset($mesa['Cliente']);
    }
    $mesa['time'] = date('H:i',strtotime($mesa['created']));

echo json_encode($mesa);